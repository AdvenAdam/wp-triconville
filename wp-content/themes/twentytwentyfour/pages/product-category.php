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
            <h1 class="text-3xl md:text-4xl font-medium text-center tracking-wider text-white">PRODUCTS</h1>
        </div>
    </div>
    <h2 class="text-center uppercase text-2xl tracking-wider my-10">
        Explore Our Outdoor
        Product Range
    </h2>
    <!-- NOTE : PRODUCT LIST -->
    <div class="md:p-5 p-3 my-10">
        <div class="max-w-[1440px] mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-3"
             id="product__list">

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
            <img class="w-full h-full object-cover md:object-contain" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/category/${e.thumb}" />
            <p class="text-xs md:text-sm uppercase font-medium text-center md:-mt-5">${e.name}</p>
        </a>
    `);
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>