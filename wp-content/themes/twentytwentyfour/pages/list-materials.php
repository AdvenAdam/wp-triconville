<?php
/*
Template Name: List Materials
*/
get_template_part('header-custom');
?>
<style>
.materials-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/material-banner.png');
    height: 60vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container">
    <!-- NOTE: Banner -->
    <div class="materials-banner">
        <div class="flex items-center justify-center min-h-full">
            <h1 class="text-5xl font-semibold text-center uppercase text-white"
                id="category__name">Materials & Care</h1>
        </div>
    </div>
    <!-- NOTE : Material list -->
    <div class="mt-8">
        <div id="list__materials_filter"
             class='flex items-center p-8 justify-center flex-wrap gap-3'>
            <button type="button"
                    class="btn-ghost-dark"
                    onclick="changeFilter('all')"
                    id="btn-all">All Materials</button>
        </div>
    </div>
    <div id="material__page"
         class="max-w-[1440px] mt-5 mx-auto">

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
let readyToRenderMaterial = [];
$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_materials",
        type: "GET",
        success: (res) => {
            selectedMaterialIds = res.selectedMaterial;
            loadMaterials();
        }
    })

});

function loadMaterials() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_swatchparent/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        cache: true,
        beforeSend: function() {
            $('#page-loading').show();
        },
        success: async function(res) {
            res.results.forEach(e => {
                if (selectedMaterialIds.includes(parseInt(e.id))) {
                    readyToRenderMaterial.push(e);
                }
            })
        },
        error: function(xhr, status, error) {
            $('#errorIndicator').show();
        },
        complete: function() {
            readyToRenderMaterial = readyToRenderMaterial.sort((a, b) => (a.name > b.name) ? 1 : -1)
            renderMaster();
        }
    });
}

async function renderMaster() {
    try {
        await readyToRenderMaterial.reduce(async (promise, e) => {
            await promise;
            renderMaterialFilter(e);
            await renderMaterials(e.id);
        }, Promise.resolve());
    } catch (error) {
        redirectError();
        console.error(error);
    } finally {
        $('#page-loading').hide();
    }
}

function renderMaterialFilter(e) {
    $('#list__materials_filter').append(`
            <button class="btn-ghost" id="btn-${e.id}" type="button" onClick = "changeFilter(${e.id})">${e.alias}</button>
    `);
}

async function renderMaterials(id) {
    try {
        const res = await $.ajax({
            url: `<?= BASE_API; ?>/v1_swatchparent_det/${id}/`,
            type: 'GET',
            headers: {
                Authorization: '<?= API_KEY; ?>',
            },
            cache: true,
        })

        $('#material__page').append(`
            <div id="material__page_${res.id}" class='material-page'>
                <div class='text-2xl tracking-wider uppercase'>
                    ${res.alias}
                </div>
                <hr class='mb-3'>
                <div class='flex flex-wrap gap-3 my-5' id="material__image_${res.id}">
                    ${res.swatch_options.map(element => `
                        <div>
                            <img src='${element.image_512}' class='w-full max-h-[250px] max-w-[250px] h-full object-cover'/>
                            <p class='line-clamp-2 max-w-[250px] uppercase text-center tracking-wider'>${element.name}</p>
                        </div>

                    `).join('')}
                </div>
            </div>
        `);
    } catch (error) {
        console.error(error);
    }
}

function changeFilter(id) {
    $('.material-page').addClass('hidden');
    $('#list__materials_filter button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (id == 'all') {
        $(`.material-page`).removeClass('hidden').addClass('block');
        $(`#btn-all`).removeClass('btn-ghost').addClass('btn-ghost-dark');
    } else {
        $(`#btn-${id}`).removeClass('btn-ghost').addClass('btn-ghost-dark');
        $(`#material__page_${id}`).removeClass('hidden');
    }
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>