<?php
/*
Template Name: ven
Template Post Type: post, page, event
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-wrapper">
    <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>