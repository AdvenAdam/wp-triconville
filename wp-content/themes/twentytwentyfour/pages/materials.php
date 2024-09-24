<?php
/*

*/
$character_slug = get_query_var( 'material' );
get_template_part('header-custom');
?>
<style>
.materials-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/material-banner.jpg');
    height: 70vh;
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
            <h1 class="text-5xl font-semibold text-center text-white"
                id="category__name">Materials</h1>
        </div>
    </div>
    <!-- NOTE : Material list -->
    <div class="w-full">
        <div id="list__materials"
             class='p-5 my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4'>

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
let page = 1;
let isLoading = false;
let stop = false;

function loadCollections(page) {
    isLoading = true;
    $('#page-loading').show();
    $.ajax({
        url: `<?= BASE_API; ?>/v1_swatchparent_det/<?= $character_slug; ?>/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        success: function(res) {
            $('#page-loading').hide();

            isLoading = false;
        },
        error: function(xhr, status, error) {
            isLoading = false;
            stop = true;
            $('#page-loading').hide();
            $('#errorIndicator').show();
        }
    });
}

function renderMaterials(e) {
    $('#list__materials').append(`
        <a href= "<?= BASE_LINK; ?>/materials/${e.id}">
            <div class="h-64 w-full flex items-center justify-center" 
                style="
                    background-position:center; 
                    background-image: url('${e.image}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                    transition: 0.5s ease-in-out;
                "
            >
            </div>
            <p class="text-xl  text-center ">${e.alias}</p>
        </a>
    `);
}

loadCollections(page);
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>