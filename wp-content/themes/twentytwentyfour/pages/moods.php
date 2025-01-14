<?php
$character_slug = get_query_var('mood');

$url =  BASE_URL . '/?rest_route=/wp/v2/selected_moods/';
$response = wp_remote_get($url,[]);
$data = json_decode(wp_remote_retrieve_body($response), true);

if (is_wp_error($response)) {
    echo 'Error fetching data: ' . $response->get_error_message();
    return;
}

$selectedMood = array_filter($data, function($e) use ($character_slug) {
    return $e['slug'] === $character_slug;
});
$selectedMood = array_values($selectedMood);

$otherMoods = array_filter($data, function($e) use ($character_slug) {
    return $e['slug'] !== $character_slug;
}); 
$otherMoods = array_values($otherMoods);

if (empty($selectedMood)) {
    return;
}

echo '<title>'. esc_attr($selectedMood['meta']['title']) . '</title>';
echo '<meta name="description" content="' . esc_attr($selectedMood['meta']['description']) . '"/>';
echo '<meta name="keywords" content="' . esc_attr($selectedMood['meta']['keywords']). '"/>';

get_template_part('header-custom');
?>

<style>
.mood-color {
    color: var(--mood-color);
    border-color: var(--mood-border-color);
}
</style>

<div class="content-container min-h-screen mt-6 md:mt-32 overflow-hidden"
     id="mood__container">
    <div id="mood__title">
    </div>

    <!-- Note :Banner -->
    <div class="max-w-[1440px] mx-auto">
        <div class="py-10"
             id="mood__subtitle"></div>
        <div class="py-10"
             id="mood__gallery"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000"></div>
        <div class="py-10 md:py-20"
             id="mood__materials"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000"></div>
        <div class="py-10 md:py-20 px-5 md:px-8"
             id="mood__inspirations"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000"></div>
        <div class="py-10 md:py-20"
             id="mood__catalogue"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000"></div>
        <div class="py-10 md:py-20 px-5 md:px-8 relative"
             id="mood__other_moods"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000"></div>
    </div>
</div>

<div id="page-loading">

</div>
<script>
let moods = [];
let selectedMood = {};
let otherMoods = [];

$(document).ready(function() {
    try {
        $('#page-loading').hide();
        selectedMood = <?= json_encode($selectedMood[0]); ?>;
        otherMoods = <?= json_encode($otherMoods); ?>;
        renderMaster()
    } catch (error) {
        redirectError()
    }
})

function renderMaster() {
    try {
        renderBanner()
        renderGallery(selectedMood.galleries)
        renderMaterials(selectedMood.materials)
        renderCatalogue(selectedMood.catalogueImage)
        renderInspirations(selectedMood.inspirations)
        renderOtherMoods()
    } catch (error) {
        console.error('Error rendering data:', error);
        redirectError()
    } finally {
        $('#page-loading').hide();
    }
}

function renderBanner() {
    $('#mood__container').addClass('mood-color');
    $(':root').css({
        '--mood-color': selectedMood.color,
        '--mood-border-color': selectedMood.color
    });
    // Note : Set Banner Title 
    const descriptionTitle = selectedMood.desc.split('<br/>')[0]
    const description = selectedMood.desc.split('<br/>')[1]
    $('#mood__title').append(`
        <div class="flex gap-5 w-full mt-20 md:flex-row flex-col">
            <img src="${selectedMood.banner}" class="w-full md:w-3/5 h-auto object-cover" />
            <div class="ps-3 md:ps-5 flex flex-col md:justify-end">
                <h1 class="text-3xl lg:text-5xl lg:text-6xl xl:text-[7.5rem] xl:!leading-[9rem] mood-color font-bold mb-5">${selectedMood.name}</h1>
                <div class="max-w-sm ">
                    <h3 class="mood-color  mb-3">${descriptionTitle}</h3>
                    <p class="mood-color">${description}</p>
                </div>
            </div>
        </div>
    `);
    // Note : Set Subtitle
    $('#mood__subtitle').append(`
        <div class="py-5 md:py-10 mx-auto w-full mt-20">
            <img data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000" src="${selectedMood.subTitle.subImage}" class="w-full h-[300px] md:h-auto object-cover " />
            <div data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000" class="max-w-3xl mx-auto px-5 md:px-8 text-center mood-color py-5 md:py-10">
                <h3 class=" mood-color">${selectedMood.subTitle.title}</h3>
                <p class="mt-5 mood-color">${selectedMood.subTitle.description}</p>
            </div>
        </div>
    `);
}

function renderGallery(galleries) {
    if (galleries) {
        $('#mood__gallery').append(`
            <div class="py-5 md:py-10 grid md:grid-cols-4 grid-cols-2 gap-5 w-full px-5 md:px-8">
                ${galleries.map((gallery, i) => `
                    <div class="gallery-item ${i%2 !== 0 && 'mt-10 -mb-10'}">
                        <img src="${gallery.image}" class="w-full h-auto object-cover" alt="${gallery.title}" />
                    </div>
                `).join('')}
            </div>
        `);
    }
}

function renderMaterials(materials) {
    if (materials) {
        // Note : Set Materials
        $('#mood__materials').append(`
            <div class="py-5 md:py-10 flex sm:flex-row flex-col items-center">
                <div class="md:p-5 w-full md:w-[60%]">
                    <img src="${selectedMood.materials.image}" class="w-full md:w-auto max-h-[38rem] object-cover relative z-10" />
                </div>
                <div class="p-3 md:p-5 w-full md:w-[40%]">
                    <h2 class="text-2xl mood-color md:text-3xl text-white mb-5">
                        Materials
                    </h2>
                    <p class="mood-color max-w-md">
                        ${selectedMood.materials.desc}
                    </p>
                </div>
            </div>
        `);
    }
}

function renderCatalogue(catalogueImage) {
    if (catalogueImage) {
        $('#mood__catalogue').append(`
            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-5">
                <div class="max-w-xl order-2 sm:order-1 px-5 md:px-8">
                    <p class="uppercase text-xs tracking-widest mood-color mb-2">CATALOG</p>
                    <h2 class="mood-color text-3xl">Triconville - 2024 Catalog</h2>
                    <p class="tracking-wider mt-3 mb-12 mood-color">Discover an unrivaled selection of luxuriant designs from Triconville. Brought to life with captivating imagery, the 2024 Triconville catalogue is a go-to resource for inspiration and information. Qualified trade members can reserve a copy by filling out the form below.</p>
                    <p><a href="<?= BASE_LINK ?>/collections" class="btn-ghost uppercase text-xs  mood-color">View Catalog</a></p>
                </div>
                <img src="${catalogueImage}" class=" w-full h-auto object-cover order-1 sm:order-2" />
            </div>
        `);
    }
}

function renderOtherMoods() {
    // Note : Set Other Moods
    $('#mood__other_moods').append(`
        <div class="md:py-10 text-center">
            <h2 class="text-2xl md:text-3xl mood-color">
                Discover Other Moods
            </h2>
            <div class="flex items-center lg:justify-center my-5 snap-x overflow-x-scroll scrollbar-none">
                ${otherMoods.map(mood => `
                    <div class ="snap-center me-2">
                        <div class="h-[600px] w-80 max-w-screen bg-no-repeat bg-center bg-cover group overflow-hidden"
                            style="background-image: url('${mood.thumb}')">
                            <a href="<?= BASE_LINK ?>/moods/${mood.slug}"
                                style="background-image: linear-gradient(to bottom, transparent, ${mood.color});"
                                class="h-full w-full flex flex-col items-end justify-end p-5 transition duration-300 md:translate-y-14 md:group-hover:translate-y-0 ease-in-out">
                                <h1 class="text-3xl lg:text-5xl !leading-none font-medium text-end text-white max-w-[160px] md:max-w-[260px] md:mb-6">${mood.name}</h1>
                                <div class="text-end h-0 md:h-8">
                                    <p class="text-white invisible md:group-hover:visible duration-300 md:mb-6">${mood.subName}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                `).join('')}
                
            </div>
        </div>
    `);
}

function renderInspirations(inspirations) {
    if (inspirations) {
        $('#mood__inspirations').append(`
            <h1 class="text-3xl lg:text-5xl font-medium mood-color text-center">Inspirations</h1>
            <div id="inspiration__container"
                class="my-10 mx-auto grid grid-cols-3 gap-1 sm:gap-3">
            </div>
        `);
        $.ajax({
            url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_inspirations",
            type: "GET",
            success: (res) => {
                const inspirationsData = res.inspirationList.filter(e => inspirations.includes(e.id));
                inspirationsData.forEach(inspiration => {
                    $('#inspiration__container').append(`
                        <a class="inspiration__card relative" href="${inspiration.link}">
                            <div class="inspiration__card__overlay absolute inset-0 bg-black bg-opacity-0 group hover:bg-opacity-20 transition duration-300 flex flex-col items-center justify-center">
                                <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/Instagram-white.svg" alt="Triconville" class="w-11 h-11 hidden group-hover:block">
                                <h3 class="text-white font-medium text-center hidden group-hover:block">@triconville</h3>
                            </div>
                            <img src="${inspiration.img}" alt="${inspiration.alt}" class="w-full h-full object-contain" />
                        </a>
                    `);
                });
            }
        });
    }
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>