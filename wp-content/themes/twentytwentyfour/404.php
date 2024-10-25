<?php
// Include your custom header
get_template_part('header-custom');
?>

<div class="content-wrapper">
    <div class="h-screen w-screen flex items-center justify-center md:gap-10 gap-5">
        <div class="hidden sm:block text-section p-5 m-5">
            <h2 class="text-3xl mb-10 ">
                Looks like you’ve lost
            </h2>
            <a href="<?= BASE_LINK; ?>"
               class="btn-primary text-sm py-4 px-10">Take me Home</a>
        </div>
        <div class="img-section m-5 md:m-10">
            <h2 class="text-3xl block sm:hidden mb-5 ">
                Looks like you’ve lost
            </h2>
            <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/404.png'
                 class="w-full h-full object-cover" />
            <a href="<?= BASE_LINK; ?>"
               class="btn-primary w-fit block mt-10 sm:hidden text-sm py-4 px-10">Take me Home</a>
        </div>
    </div>
</div>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>