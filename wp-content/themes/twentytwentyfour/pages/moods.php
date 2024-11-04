<?php

$character_slug = get_query_var('mood');

// Set the title to the slug
echo '<title>'. 'Moods - ' . ucfirst( slugToTitleCase($character_slug) ) . ' | ' . wp_kses_data( get_bloginfo( 'name', 'display' ) ) . '</title>';
get_template_part('header-custom');

?>


<div class="content-container min-h-screen tracking-wider">
    <div class="p-3 md:p-5">
        <!-- Note :Banner -->
        <div class="max-w-[1440px] mx-auto">
            <div id="mood__title"
                 class="flex py-5 md:py-10 gap-5 md:gap-20 md:items-center md:flex-row flex-col">
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
            <div class="py-5 md:py-10 flex sm:flex-row flex-col gap-3 items-center">
                <div class="md:p-5 w-full md:w-1/2 flex justify-end md:justify-center relative">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/${selectedMood.materials.image}" class="w-3/4 md:w-auto max-h-[500px] object-cover relative z-10" />
                    <div class="absolute opacity-50 h-3/4 w-1/2 top-1/2 -translate-y-1/2 left-10 z-1" style="background-color: ${selectedMood.color.end}"></div>
                </div>
                <div class="md:p-5 w-full md:w-1/2 max-w-xl">
                    <h2 class="text-2xl md:text-3xl tracking-wider text-white mb-5">
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
            <div class="py-5 md:py-10">
               <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
                    <h2 class="text-2xl md:text-3xl tracking-wider md:col-span-2 text-center text-white md:pb-60">
                        Inspirations
                    </h2>
                   ${selectedMood.relatedProjects.map(e => `
                        <div class="md:p-5 w-auto bg-no-repeat h-[450px] ${e.id % 2 === 0 ? 'mt-0' : 'md:-mt-40'} relative" style="background: url('https://storage.googleapis.com/back-bucket/wp_triconville/${e.thumb}'); background-size: cover">
                            <div class="absolute bg-opacity-50 ${e.id % 2 === 0 ? ' md:-bottom-20 z-2' : 'md:-top-20 z-1'} p-5 max-w-lg -right-20" style="background-color: ${selectedMood.color.end}">
                                <h2 class="text-2xl md:text-3xl max-w-sm tracking-wider text-white mb-5 ">
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
                <h2 class="text-2xl md:text-3xl tracking-wider text-white">
                    Discover Other Moods
                </h2>
                <div class="flex items-center my-5 snap-x overflow-x-scroll scrollbar-none">
                    ${otherMoods.map(e => `
                        <div class="me-2 snap-center">
                            <div class="h-[322px] md:h-[600px] w-[182px] md:w-[400px] max-w-screen bg-no-repeat bg-center bg-cover"
                                style="background-image: url('https://storage.googleapis.com/back-bucket/wp_triconville/${e.thumb}')">
                                <a href="<?= BASE_LINK ?>/moods/${e.slug}"
                                class="h-full w-full flex items-end justify-end p-5">
                                    <h1 class="text-2xl md:text-5xl font-semibold text-end text-white max-w-[260px]">${e.name}</h1>
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
            <h1 class="text-3xl md:text-5xl max-w-md font-extrabold uppercase text-white tracking-widest">
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
        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/${selectedMood.banner}" class="w-auto h-[550px] md:h-auto object-cover" />
    `);
    // Note : Set Subtitle
    $('#mood__subtitle').append(`
        <div class="py-5 md:py-10 mx-auto w-full">
            <p class="text-sm max-w-2xl mx-auto text-center text-white py-5 md:py-10">
                ${selectedMood.subTitle.title}
            </p>
            <img src="https://storage.googleapis.com/back-bucket/wp_triconville/${selectedMood.subTitle.subImage}" class="w-auto h-auto object-cover " />
        </div>
    `);
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>