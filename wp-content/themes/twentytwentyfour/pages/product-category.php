<?php
/*
Template Name: List Product
*/
get_template_part('header-custom');

$productsCategory =  json_decode(file_get_contents(get_template_directory() . '/api/product.json'), true);
?>

<style>
.product-header {
    background: url('https://storage.googleapis.com/magento-asset/wp_triconville/images/products-banner.webp');
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container mt-24 md:mt-32">
    <div class="product-header w-full full-screen-with-subMenu ">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-10">
            <h1 class="text-3xl lg:text-5xl font-medium text-center text-white"
                data-aos="fade-up"
                data-aos-once="true"
                data-aos-duration="1000">Products</h1>
        </div>
    </div>
    <!-- NOTE : PRODUCT LIST -->
    <div class="px-5 md:px-8 p-3 mb-20 mt-10">
        <h2 class="text-center text-2xl lg:text-3xl my-10"
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="1000">
            Explore Our Outdoor
            Product Range
        </h2>
        <div class="max-w-[1440px] mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-y-9 mb-20"
             id="product__list">
            <?php foreach ($productsCategory as $id => $product): ?>
            <a href="<?= get_base_link(); ?>products/<?= slugify($product['name']); ?>/"
               class="group"
               data-aos="fade-up"
               data-aos-once="true"
               data-aos-delay="<?= ($id +1) * 100 ?>"
               data-aos-duration="500">
                <div>
                    <img class="w-full h-full object-cover md:object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300"
                         src="<?= $product['thumb']; ?>"
                         alt="<?= $product['name']; ?>" />
                </div>
                <p class="capitalize text-center md:-mt-5 group-hover:underline"><?= $product['name']; ?></p>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>