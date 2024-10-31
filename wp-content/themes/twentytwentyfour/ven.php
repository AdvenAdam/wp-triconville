<?php
/*
Template Name: ven
Template Post Type: post, page, event
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-wrapper">
    <?php 
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        // NOTE : use it for static pages
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        switch (true) {
            case (strpos($url, 'about-us') !== false):
                include(get_template_directory() . '/page-builder/about-us.html');
                break;
        }
        
    ?>
</div>

<?php
if(!strpos($url, 'about-us') !== false) {
    // Include your custom footer
    get_template_part('footer-custom');
}
?>