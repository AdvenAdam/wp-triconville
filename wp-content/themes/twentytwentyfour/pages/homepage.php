<?php
/*
Template Name: Homepage
*/
get_template_part('header-custom');
?>
<style>
.homepage-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home-banner.png');
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
    <div class="homepage-banner">
        <div class="flex items-center justify-center min-h-full">
            <h1 class="text-5xl font-extrabold text-center uppercase text-white tracking-wider"
                id="category__name">PREMIER OUTDOOR FURNITURE</h1>
        </div>
    </div>

    <div id="page-loading"
         style="display:none;">
        <div class="three-balls">
            <div class="ball ball1"></div>
            <div class="ball ball2"></div>
            <div class="ball ball3"></div>
        </div>
    </div>
    <div id="errorIndicator"
         class="hidden">Error</div>
</div>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>