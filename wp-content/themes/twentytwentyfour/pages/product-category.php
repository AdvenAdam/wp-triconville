<?php
/*
Template Name: List Product
*/
get_template_part('header-custom');
?>

<style>
.product-header {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/products-banner.webp');
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container mt-24 md:mt-32">
    <div class="product-header w-full full-screen ">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-10 ">
            <h1 class="text-3xl md:text-5xl font-medium text-center text-white">Products</h1>
        </div>
    </div>
    <!-- NOTE : PRODUCT LIST -->
    <div class="md:p-5 p-3 mb-20 mt-10">
        <h2 class="text-center text-2xl md:text-3xl my-10"
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="1000">
            Explore Our Outdoor
            Product Range
        </h2>
        <div class="max-w-[1440px] mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-y-9 mb-20"
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
            res.forEach((e, id) => {
                renderProducts(e, id);
            });
        }
    })
})

function renderProducts(e, id) {
    $('#product__list').append(`
        <a href= "<?= BASE_LINK; ?>/products/${e.slug}" class="group" 
            data-aos="fade-up"
            data-aos-delay="${(id +1) * 100}"
            data-aos-duration="500">
            <div>
                <img class="w-full h-full object-cover md:object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300" src="${e.thumb}" />
            </div>
            <p class="text-xs md:text-sm capitalize text-center md:-mt-5 group-hover:underline">${e.name}</p>
        </a>
    `);
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>