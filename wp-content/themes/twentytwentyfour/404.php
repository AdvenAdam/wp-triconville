<?php
// Include your custom header
echo '<title>'. esc_attr('Triconvile | 404') . '</title>';
get_template_part('header-custom');
?>

<div class="content-wrapper">
    <div class="h-screen w-screen flex items-center justify-center md:gap-10 gap-5">
        <div class="hidden sm:block text-section p-5 m-5">
            <h2 class="text-3xl mb-10 ">
                Looks like you’ve lost
            </h2>
            <a href="<?= BASE_URL; ?>"
               class="btn-ghost-dark text-sm py-4 px-10 uppercase">back to Home</a>
        </div>
        <div class="img-section m-5 md:m-10">
            <h2 class="text-3xl block sm:hidden mb-5 ">
                Looks like you’ve lost
            </h2>
            <img src='https://storage.googleapis.com/magento-asset/wp_triconville/images/404.jpg'
                 class="w-full h-auto object-cover" />
            <a href="<?= BASE_URL; ?>"
               class="btn-ghost-dark w-fit block mt-10 sm:hidden uppercase text-sm py-4 px-10">back to Home</a>
        </div>
    </div>
</div>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>