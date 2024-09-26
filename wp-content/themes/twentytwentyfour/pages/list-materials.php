<?php
/*
Template Name: List Materials
*/
get_template_part('header-custom');
?>
<style>
.materials-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/material-banner.jpg');
    height: 50vh;
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
                    class="border border-slate-800 p-3 transition duration-300  text-white bg-black hover:bg-white hover:text-black"
                    onclick="btnClick('all')"
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
let page = 1;
let isLoading = false;
let stop = false;
let selectedMaterial = [];
$(document).ready(function() {
    loadCollections(page);
});

function loadCollections(page, action = '') {
    isLoading = true;
    $('#page-loading').show();
    if (action == 'material') {
        $('#material__page').empty();
    }
    $.ajax({
        url: `<?= BASE_API; ?>/v1_swatchparent/?page=${page}`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        success: async function(res) {
            res.results.forEach(e => {
                selectedMaterial.push(e);
            })
            // TODO : make logic for triggering next page not by baypassing
            if (res.next) {
                loadCollections(page + 1, action);
            } else {
                stop = true;
                $('#page-loading').hide();
                selectedMaterial.sort((a, b) => (a.name > b.name) ? 1 : -1).forEach((e, index) => {
                    if (action != 'material') {
                        renderMaterialFilter(e);
                    }
                    renderMaterials(e.id);
                });
                selectedMaterial = [];
            }
        },
        error: function(xhr, status, error) {
            isLoading = false;
            stop = true;
            $('#page-loading').hide();
            $('#errorIndicator').show();
        },
        complete: function() {
            isLoading = false;
        }
    });
}

function renderMaterialFilter(e) {
    $('#list__materials_filter').append(`
            <button class="border border-slate-800 p-3 transition duration-300 text-black hover:bg-black hover:text-white" id="btn-${e.id}" type="button" onClick = "btnClick(${e.id})">${e.alias}</button>
    `);
}

function renderMaterial(id) {
    $('#material__page').empty();
    renderMaterials(id);
}

function renderMaterials(id) {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_swatchparent_det/${id}/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        beforeSend: function() {
            $('#page-loading').show();
        },
        success: function(res) {
            $('#page-loading').hide();
            $('#material__page').append(`
                <div class='font-medium text-2xl tracking-wider uppercase'>
                    ${res.alias}
                </div>
                <hr class='mb-3'>
                <div class='flex flex-wrap gap-3 my-5' id="material__image_${res.id}">
                    ${res.swatch_options.map(element => `
                        <div>
                            <img src='${element.image_512}' class='w-full max-h-[250px] max-w-[250px] h-full object-cover'/>
                            <p class='line-clamp-2 max-w-[250px] uppercase tracking-wider'>${element.name}</p>
                        </div>

                    `).join('')}
                </div>
            `);
        }
    })
}


function btnClick(id) {
    $('#list__materials_filter button').removeClass('text-white bg-black hover:bg-white hover:text-black').addClass('text-black hover:bg-black hover:text-white');
    if (id == 'all') {
        loadCollections(page, 'material');
        $(`#btn-all`).removeClass('text-black hover:bg-black hover:text-white').addClass('text-white bg-black');
    } else {
        $(`#btn-${id}`).removeClass('text-black hover:bg-black hover:text-white').addClass('text-white bg-black');
        renderMaterial(id);
    }
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>