<?php
/*
Template Name: List Materials
*/
get_template_part('header-custom');
?>
<style>
.materials-banner {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/material-banner.png');
    height: 60vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container mt-20">
    <!-- NOTE: Banner -->
    <div class="materials-banner ">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-20">
            <h1 class="text-5xl font-medium text-center text-white"
                id="category__name">materials</h1>
        </div>
    </div>
    <!-- NOTE : Material list -->
    <div class="mt-8">
        <div id="list__materials_filter"
             class='flex items-center text-sm p-8 justify-center flex-wrap gap-3'>
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
</div>
<script>
let selectedMaterialIds = [];
let groupingMaterials = [];
let readyToRenderMaterial = [];
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
        $('#page-loading').hide();
    }
}

function renderMaterialFilter(data) {
    $('#list__materials_filter').append(`
        <button class="btn-ghost !py-2" id="btn-${data.id}" type="button" onClick = "changeFilter(${data.id})">${data.alias}</button>
    `);
}

function renderGroupContainer(data) {
    $('#material__page').append(`
        <div class="material-container visible" id="material__container_${data.id}">
            <h1 class="text-3xl font-medium">${toTitleCase(data.name)}</h1>
            <img class="w-full h-auto min-h-40 mb-5" src="${data.banner}" alt="${data.name}-banner">
            
        </div>
    `)
}

async function loadMaterials(data) {
    let products = [];
    try {
        for (const slug of data.slugs) {
            const res = await $.ajax({
                url: `<?= BASE_API; ?>/v1_swatchparent_det_slug/${slug}/`,
                type: 'GET',
                headers: {
                    Authorization: '<?= API_KEY; ?>',
                }
            })
            products.push(res);
        }
    } catch (error) {
        console.error(error);
    } finally {
        const subGroups = {
            id: data.id,
            name: data.name,
            products: products,
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
                <div class="material-products" id="material__products_${slugify(subGroup.name)}">
                    <h2 class="text-2xl font-medium">${toTitleCase(subGroup.name)}</h2>
                    <p class="text-sm mb-5">${subGroup.description}</p>
                    <div id="material__list__${slugify(subGroup.name)}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        ${products.map(product => `
                            <div class="product-item mb-5">
                                <img class="w-full h-full object-contain" src="${product.image_384}" />
                                <p class="text-center text-sm max-w-[90%] mx-auto">${product.alias} (${product.code})</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
                <hr class="mb-10 mt-5 border-2" />
            `);
        }
    }
}

function changeFilter(id) {
    $('.material-container').addClass('hidden');
    $('#list__materials_filter button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (id == 'all') {
        $(`.material-container`).removeClass('hidden');
        $(`#btn-all`).removeClass('btn-ghost').addClass('btn-ghost-dark');
    } else {
        $(`#btn-${id}`).removeClass('btn-ghost').addClass('btn-ghost-dark');
        $(`#material__container_${id}`).removeClass('hidden');
    }
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>