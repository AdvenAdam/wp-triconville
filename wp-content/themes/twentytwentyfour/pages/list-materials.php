<?php
/*
Template Name: List Materials
*/
get_template_part('header-custom');
?>
<style>
.materials-banner {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/material-banner.png');
    height: 70vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container overflow-hidden mt-20">
    <!-- NOTE: Banner -->
    <div class="materials-banner ">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-20">
            <h1 class="text-5xl font-medium text-center text-white"
                id="category__name">Materials</h1>
        </div>
    </div>
    <!-- NOTE : Material list -->
    <div class="my-12">
        <div id="list__materials_filter"
             class='flex items-center text-sm py-8 px-3 md:px-5 justify-center flex-wrap gap-3'
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="500">
            <button type="button"
                    class="btn-ghost-dark !py-2"
                    onclick="changeFilter('all')"
                    id="btn-all">All Materials</button>
        </div>
    </div>
    <div class="px-3 md:px-5">
        <div id="material__page"
             class="max-w-[1440px] mt-5 mx-auto">
        </div>
    </div>
    <div id="page-loading">
        <div class="three-balls">
            <div class="ball ball1"></div>
            <div class="ball ball2"></div>
            <div class="ball ball3"></div>
        </div>
    </div>
    <div id="errorIndicator"
         class="hidden">Error</div>
    <div class="fixed z-0 h-screen w-screen invisible bg-black bg-opacity-40 transition-opacity duration-500 ease-in-out top-0"
         id="page-modal">
    </div>

</div>
<script>
let selectedMaterialIds = [];
let groupingMaterials = [];
let allMaterialProducts = [];
$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_materials",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            selectedMaterialIds = res.selectedMaterial;
            groupingMaterials = res.groups;
            // ANCHOR : filter by Id
            // groupingMaterials = res.groups.filter(e => e.id === 8);
        },
        error: (xhr, status, error) => {
            $('#errorIndicator').show();
        },
        complete: () => {
            renderMaster();
        }
    })
});

async function renderMaster() {
    try {
        for (const data of groupingMaterials) {
            renderMaterialFilter(data);
            renderGroupContainer(data);
            await loadMaterials(data);
        }
    } catch (error) {
        redirectError();
        console.error(error);
    } finally {
        $('#page-loading').hide()
    }
}

function renderMaterialFilter(data) {
    $('#list__materials_filter').append(`
        <button class="btn-ghost !py-2" id="btn-${data.id}" type="button" onClick = "changeFilter(${data.id})">${data.alias}</button>
    `);
}

function renderGroupContainer(data) {
    $('#material__page').append(`
        <div class="material-container" id="material__container_${data.id}" 
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="500"
        >
            <h1 class="text-3xl mb-4">${toTitleCase(data.name)}</h1>
            <img class="w-full h-auto min-h-56 mb-16 object-cover" src="${data.banner}" alt="${data.name}-banner" />
        </div>
    `)
}

async function loadMaterials(data) {
    try {
        for (const slug of data.slugs) {
            const res = await $.ajax({
                url: `<?= BASE_API; ?>/v1_swatchparent_det_slug/${slug}/`,
                type: 'GET',
                headers: {
                    Authorization: '<?= API_KEY; ?>',
                }
            })
            allMaterialProducts.push(res);
        }
    } catch (error) {
        console.error(error);
    } finally {
        const subGroups = {
            id: data.id,
            name: data.name,
            products: allMaterialProducts,
            subGroupFilter: data.subGroups
        }
        renderSubGroups(subGroups);
    }
}

function renderSubGroups(data) {
    const productsData = data.products;

    for (const subGroup of data.subGroupFilter) {
        const materials = productsData.find(e => e.slug === subGroup.materials.slug);
        if (materials) {
            const isExclusion = subGroup.materials.keyword.includes('!');
            const keyword = slugify(subGroup.materials.keyword).replace('!', '');
            const products = materials.swatch_options.filter(option => {
                const optionSlug = slugify(option.name);
                return isExclusion ? !optionSlug.includes(keyword) : optionSlug.includes(keyword);
            });
            $('#material__container_' + data.id).append(`
                <div class="material-products material-products_${data.id}" id="material__products_${slugify(subGroup.name)}" 
                    data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="500"
                >
                    <h2 class="text-2xl mb-2">${toTitleCase(subGroup.name)}</h2>
                    <p class="mb-6">${subGroup.description}</p>
                    <div id="material__list__${slugify(subGroup.name)}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 lg:gap-10 ">
                        ${products.map(product => {
                            return (
                                `<div class="cursor-pointer inline-flex flex-col items-center" onclick='bannerClick("${materials.slug}", "${product.code}")'>
                                    <img class="w-full h-auto object-contain" src="${product.image_384}" />
                                    <p class="text-center max-w-[90%] mx-auto mt-2">${product.alias} (${product.code})</p>
                                </div>
                            `)
                        }).join('')}
                    </div>
                </div>
                <hr class="my-16 border border-[#bcbcbc]" />
            `);
        }
    }
}

function bannerClick(slug, code) {
    const product = allMaterialProducts.find(e => e.slug === slug);
    const swatchOption = product.swatch_options.find(option => option.code === code);

    $('#page-modal').empty();
    $('#page-modal').removeClass('invisible z-0').addClass('z-30');
    $('#page-modal').append(`
        <div class="w-full h-full flex items-center justify-center" onclick="event.stopPropagation(); $('#page-modal').addClass('invisible z-0').removeClass('z-30')">
            <div class="bg-white flex items-center relative" onclick="event.stopPropagation()">
                <img class="w-auto h-auto max-w-[50vw] object-contain" src="${swatchOption.image_384}" />
                <div class="p-5 w-[50vw] max-w-xl">
                    <h3 class="text-center text-2xl mx-auto">${swatchOption.alias} (${swatchOption.code})</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer absolute top-5 right-5" onclick="event.stopPropagation(); $('#page-modal').addClass('invisible z-0').removeClass('z-30')">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    `);
}

function changeFilter(id) {
    $('.material-container').addClass('hidden');
    $('#list__materials_filter button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (id == 'all') {
        $(`.material-container`).removeClass('hidden');
        $(`#btn-all`).removeClass('btn-ghost').addClass('btn-ghost-dark');
    } else {
        $(`#btn-${id}`).removeClass('btn-ghost').addClass('btn-ghost-dark');
        $(`#material__container_${id}`).removeClass('hidden').addClass('aos-animate');
        $(`.material-products_${id}`).addClass('aos-animate');
    }
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>