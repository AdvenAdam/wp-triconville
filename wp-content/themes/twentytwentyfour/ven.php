<?php
/*
Template Name: ven
Template Post Type: post, page, event
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-wrapper mt-16 md:mt-20">
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
            case (strpos($url, 'contact-us') !== false):
                include(get_template_directory() . '/page-builder/contact-us.html');
                break;
            case (strpos($url, 'find-a-store') !== false):
                include(get_template_directory() . '/page-builder/find a store.html');
                break;
            case (strpos($url, 'news') !== false):
                include(get_template_directory() . '/page-builder/news-list.php');
                break;
            case (strpos($url, 'request-catalog') !== false):
                include(get_template_directory() . '/page-builder/request-catalog.php');
                break;
        }
        
    ?>
</div>

<?php
    // Include your custom footer
    get_template_part('footer-custom');

?>