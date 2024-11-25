<?php

$character_slug = get_query_var('mood');

// Set the title to the slug
echo '<title>'. 'Moods - ' . ucfirst( slugToTitleCase($character_slug) ) . ' | ' . wp_kses_data( get_bloginfo( 'name', 'display' ) ) . '</title>';
get_template_part('header-custom');

?>

<style>
.mood-color {
    color: var(--mood-color);
}
</style>

<div class="content-container min-h-screen mt-6 md:mt-32"
     id="mood__container">
    <div id="mood__title">
    </div>

    <!-- Note :Banner -->
    <div class="max-w-[1440px] mx-auto">
        <div class="py-10"
             id="mood__subtitle"></div>
        <div class="py-10"
             id="mood__gallery"></div>
        <div class="py-10 md:py-20"
             id="mood__materials"></div>
        <div class="py-10 md:py-20 px-3 md:px-5"
             id="mood__inspirations"></div>
        <div class="py-10 md:py-20"
             id="mood__catalogue"></div>
        <div class="py-10 md:py-20 px-3 md:px-5"
             id="mood__other_moods"></div>
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
    $(':root').css('--mood-color', selectedMood.color);
    // Note : Set Banner Title 
    const descriptionTitle = selectedMood.desc.split('<br/>')[0]
    const description = selectedMood.desc.split('<br/>')[1]
    $('#mood__title').append(`
        <div class="flex gap-5 md:items-end w-full mt-20 md:flex-row flex-col">
            <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${selectedMood.banner}" class="w-full md:w-3/5 h-auto object-cover" />
            <div class="ps-3 md:ps-5">
                <h1 class="text-3xl md:text-5xl lg:text-6xl xl:text-[7.5rem] xl:leading-[9rem] mood-color font-bold mb-5">${selectedMood.name}</h1>
                <div class="max-w-sm ">
                    <h3 class="mood-color  mb-3">${descriptionTitle}</h3>
                    <p class="text-sm mood-color">${description}</p>
                </div>
            </div>
        </div>
    `);
    // Note : Set Subtitle
    $('#mood__subtitle').append(`
        <div class="py-5 md:py-10 mx-auto w-full mt-20">
            <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${selectedMood.subTitle.subImage}" class="w-full h-[300px] md:h-auto object-cover " />
            <div class="max-w-3xl mx-auto px-3 md:px-5 text-center  mood-color py-5 md:py-10">
                <h3 class=" mood-color">${selectedMood.subTitle.title}</h3>
                <p class="text-sm mt-5 mood-color">${selectedMood.subTitle.description}</p>
            </div>
        </div>
    `);
}

function renderGallery(galleries) {
    if (galleries) {
        $('#mood__gallery').append(`
            <div class="py-5 md:py-10 grid md:grid-cols-4 grid-cols-2 gap-5 w-full px-3 md:px-5">
                ${galleries.map((gallery, i) => `
                    <div class="gallery-item ${i%2 !== 0 && 'mt-10 -mb-10'}">
                        <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${gallery.image}" class="w-full h-auto object-cover" alt="${gallery.title}" />
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
                    <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${selectedMood.materials.image}" class="w-full md:w-auto max-h-[38rem] object-cover relative z-10" />
                </div>
                <div class="p-3 md:p-5 w-full md:w-[40%]">
                    <h2 class="text-2xl mood-color md:text-3xl text-white mb-5">
                        Materials
                    </h2>
                    <p class="text-sm mood-color max-w-md">
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
                <div class="max-w-xl order-2 sm:order-1 px-3 md:px-5">
                    <p class="uppercase text-xs tracking-widest mood-color mb-2">CATALOG</p>
                    <h2 class="mood-color text-3xl">Triconville - 2024 Catalog</h2>
                    <p class="text-sm tracking-wider mt-3 mb-12 mood-color">Discover an unrivaled selection of luxuriant designs from Triconville. Brought to life with captivating imagery, the 2024 Triconville catalogue is a go-to resource for inspiration and information. Qualified trade members can reserve a copy by filling out the form below.</p>
                    <p><a href="<?= BASE_LINK ?>/collections" class="btn-ghost uppercase text-xs">View Catalog</a></p>
                </div>
                <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${catalogueImage}" class=" w-full h-auto object-cover order-1 sm:order-2" />
            </div>
        `);
    }
}

function renderOtherMoods() {
    // Note : Set Other Moods
    $('#mood__other_moods').append(`
        <div class="py-10 text-center">
            <h2 class="text-2xl md:text-3xl mood-color">
                Discover Other Moods
            </h2>
            <div class="flex items-center lg:justify-center my-5 snap-x overflow-x-scroll scrollbar-none">
                ${otherMoods.map(mood => `
                    <div class ="snap-center me-2">
                        <div class="h-[322px] md:h-[600px] w-[180px] md:w-[400px] max-w-screen bg-no-repeat bg-center bg-cover group overflow-hidden"
                            style="background-image: url('<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${mood.thumb}')">
                            <a href="<?= BASE_LINK ?>/moods/${mood.slug}"
                                class="h-full w-full flex flex-col items-end justify-end p-5 transition duration-300 md:translate-y-14 md:group-hover:translate-y-0 ease-in-out md:group-hover:bg-gradient-to-b from-transparent to-black/40">
                                <h1 class="text-2xl md:text-5xl !leading-none font-medium text-end text-white max-w-[260px] md:mb-6">${mood.name}</h1>
                                <div class="text-end h-0 md:h-8">
                                    <p class="text-white text-sm invisible md:group-hover:visible duration-300 md:mb-6">${mood.subName}</p>
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
            <h1 class="text-3xl md:text-5xl font-medium mood-color text-center">Inspirations</h1>
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