<?php
// Include your custom header
get_template_part('header-custom');
?>

<div class="content-wrapper">
    <div class="h-screen w-screen flex items-center justify-center md:gap-10 gap-5">
        <div class="text-section p-5 m-5">
            <h2 class="text-3xl mb-10 ">
                Looks like you’ve lost
            </h2>
            <a href="<?= BASE_LINK; ?>"
               class="btn-primary text-sm py-4 px-10">Take me Home</a>
        </div>
        <div class="img-section">
            <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/404.png' />
        </div>
    </div>
</div>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>