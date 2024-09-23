<?php
// Check if a specific template should use the custom header
if (is_page_template('ven.php')) {
    get_template_part('header-custom');
} else {
    get_header(); // Use the default WordPress header
}
?>

<div class="page-content">
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php
// Conditional for footer
if (is_page_template('ven.php')) {
    get_template_part('footer-custom');
} else {
    get_footer(); // Use the default WordPress footer
}
?>