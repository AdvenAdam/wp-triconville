<?php
/*
Template Name: List Product
*/
get_template_part('header-custom');
?>

<style>
.product-header {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/products-banner.webp');
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container">

    <div class="product-header w-full">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-25">
            <h1 class="text-4xl font-extrabold text-center tracking-wider text-white">PRODUCTS</h1>
        </div>
    </div>
    <div class="text-center uppercase text-2xl tracking-widest my-10">
        explore our outdoor product range
    </div>
    <!-- NOTE : PRODUCT LIST -->
    <div class="p-6 my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3"
         id="product__list">

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
$(document).ready(function() {
    let category = [];

    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/product_service",
        type: "GET",
        beforeSend: () => {
            // TODO :: ADD SKELETON
            $('#page-loading').show();
        },
        success: (res) => {
            $('#page-loading').hide();
            res.forEach((e) => {
                renderProducts(e);
            });
        }
    })
})

function renderProducts(e) {
    $('#product__list').append(`
        <a href= "<?= BASE_LINK; ?>/products/${e.slug}">
            <div class="h-60 w-full transition-all duration-500 " 
                onmouseover="this.style.backgroundSize='120% ';"    
                onmouseout="this.style.backgroundSize='100%';"
                style="
                    background-position:center; 
                    background: url('${e.image}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
                <div class ='bg-black bg-opacity-25 h-full w-full flex items-center justify-center'>
                </div>
            </div>
            <p class="text-xl text-center ">${e.name}</p>
        </a>
    `);
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>