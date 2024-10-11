<?php
    get_template_part('header-custom');
    $character_slug = get_query_var('mood');  
?>

<div class="content-container min-h-screen">
    <div class="p-3 md:p-5">
        <!-- Note :Banner -->
        <div class="max-w-[1440px] mx-auto">
            <div id="mood__title"
                 class="flex py-10 gap-20 items-center md:flex-row flex-col ">
            </div>
            <div id="mood__banner"></div>
            <div id="mood__subtitle"></div>
            <div id="mood__materials"></div>
            <div id="mood__inspirations"></div>
            <div id="mood__other_moods"></div>
        </div>
    </div>
</div>

<div id="page-loading">
    <div class="three-balls">
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
    </div>
</div>
<script>
let moods = [];
let selectedMood = {};
let otherMoods = [];

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_moods",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            moods = res;
            selectedMood = moods.find(e => e.slug === '<?= $character_slug; ?>');
            otherMoods = moods.filter(e => e.slug !== '<?= $character_slug; ?>');

        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            renderMaster();
        }
    })
})

function renderMaster() {
    try {
        renderBanner()
        // Note : Set Materials
        $('#mood__materials').append(`
            <div class="py-10 grid grid-cols-1 sm:grid-cols-2 gap-3 items-center">
                <div class="p-5 flex justify-center relative">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/${selectedMood.materials.image}" class="w-auto max-h-[500px] object-cover relative z-10" />
                    <div class="absolute opacity-50 h-3/4 w-1/2 top-1/2 -translate-y-1/2 left-10 z-1" style="background-color: ${selectedMood.color.end}"></div>
                </div>
                <div class="p-5 max-w-xl">
                    <h2 class="text-3xl tracking-wider text-white mb-5">
                        Materials
                    </h2>
                    <p class="text-sm text-white text-justify">
                        ${selectedMood.materials.desc}
                    </p>
                </div>
            </div>
        `);
        // Note : Set Inspirations / Projects
        $('#mood__inspirations').append(`
            <div class="py-10">
               <div class="grid grid-cols-1 md:grid-cols-2 gap-10 py-10">
                    <h2 class="text-3xl tracking-wider md:col-span-2 text-center text-white md:pb-60">
                        Inspirations
                    </h2>
                   ${selectedMood.relatedProjects.map(e => `
                        <div class="p-5 w-auto bg-no-repeat h-[450px] ${e.id % 2 === 0 ? 'mt-0' : 'md:-mt-40'} relative" style="background: url('<?php echo get_stylesheet_directory_uri(); ?>/${e.thumb}');">
                            <div class="absolute bg-opacity-50 ${e.id % 2 === 0 ? 'md:-bottom-20 z-2' : 'md:-top-20 z-1'} p-5 max-w-lg ${e.id % 2 === 0 ? '-right-20' : '-right-20'}" style="background-color: ${selectedMood.color.end}">
                                <h2 class="text-3xl tracking-wider text-white mb-5">
                                    ${e.title}
                                </h2>
                                <p class="text-sm text-white text-justify">
                                    ${e.location}
                                </p>
                            </div>
                        </div>
                    `).join('')}
               </div>
            </div>
        `);
        // Note : Set Other Moods
        $('#mood__other_moods').append(`
            <div class="py-10">
                <h2 class="text-3xl tracking-wider text-white">
                    Discover Other Moods
                </h2>
                <div class="flex items-center my-5 snap-x overflow-x-scroll scrollbar-none">
                    ${otherMoods.map(e => `
                        <div class="mx-2 snap-center">
                            <div class="h-[600px] w-[400px] max-w-screen bg-no-repeat bg-center bg-cover"
                                style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/${e.thumb}')">
                                <a href="<?= BASE_LINK ?>/moods/${e.slug}"
                                class="h-full w-full flex items-end justify-end p-5">
                                    <h1 class="text-5xl font-semibold text-end text-white max-w-[260px]">${e.name}</h1>
                                </a>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `);
    } catch (error) {
        console.error('Error rendering data:', error);
        redirectError()
    } finally {
        $('#page-loading').hide();
    }
}

function renderBanner() {
    // Note : Set background
    $('.content-container').attr('style', `background-image: linear-gradient(to bottom, ${selectedMood.color.start}, ${selectedMood.color.end});`);
    // Note : Set Banner Title 
    $('#mood__title').append(`
        <div>
            <h1 class="text-5xl max-w-md font-extrabold uppercase text-white tracking-widest">
                ${selectedMood.name}
            </h1>
        </div>
        <div>
            <p class="text-sm max-w-2xl text-justify text-white">
                ${selectedMood.desc}
            </p>
        </div>
    `);
    // Note : Set Mood Banner
    $('#mood__banner').append(`
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/${selectedMood.banner}" class="w-auto h-auto object-cover" />
    `);
    // Note : Set Subtitle
    $('#mood__subtitle').append(`
        <div class="py-10 mx-auto w-full">
            <p class="text-sm max-w-2xl mx-auto text-center text-white py-10">
                ${selectedMood.subTitle.title}
            </p>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/${selectedMood.subTitle.subImage}" class="w-auto h-auto object-cover " />
        </div>
    `);
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>