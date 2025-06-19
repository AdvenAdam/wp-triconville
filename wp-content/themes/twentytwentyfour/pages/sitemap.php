<?php
/*
Template Name: sitemap
*/

header("Content-Type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<?php
$products = json_decode(file_get_contents(get_template_directory() . '/api/sitemap.json'), true);
$products = $products['products'];
$categoryProducts = json_decode(file_get_contents(get_template_directory() . '/api/product.json'), true);
$collections = json_decode(file_get_contents(get_template_directory() . '/api/collection.json'), true);
$moods = json_decode(file_get_contents(get_template_directory() . '/api/moods.json'), true);
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc><?= BASE_URL; ?>/</loc>
        <lastmod>2025-01-23T08:56:26+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/products/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <!-- NOTE List Of Product - Category -->
    <?php 
        foreach ($categoryProducts as $category) {
            $category = str_replace('-', ' ', $category['slug']);
            $category = slugify($category);
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/products/{$category}/</loc>\n";
            echo "<lastmod>" . date('c') . "</lastmod>\n";
            echo "</url>\n";
        }
    ?>
    <!-- NOTE : Collection -->
    <?php 
        foreach ($collections['collection'] as $collection) {
            $collection = str_replace('-', ' ', $collection['name']);
            $collection = slugify($collection);
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/collections/{$collection}/</loc>\n";
            echo "<lastmod>" . date('c') . "</lastmod>\n";
            echo "</url>\n";
        }
    
    ?>

    <!-- NOTE List Of Product - Detail -->
    <?php 
        foreach ($products as $product) {
            $product = str_replace('-', ' ', $product);
            $product = slugify($product);
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/product-detail/{$product}/</loc>\n";
            echo "<lastmod>" . date('c') . "</lastmod>\n";
            echo "</url>\n";
        }
    ?>

    <url>
        <loc><?= BASE_URL; ?>/news/</loc>
        <lastmod>2024-12-09T04:06:22+00:00</lastmod>
    </url>
    <?php 
        $args_top = array(
            'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' ); $top_posts = new WP_Query($args_top); if ($top_posts->have_posts()) :
             while ($top_posts->have_posts()) : $top_posts->the_post();
                echo "<url>\n";
                echo "<loc>" . get_the_permalink() . "</loc>\n";
                echo "<lastmod>" . get_the_time('c') . "</lastmod>\n";
                echo "</url>\n";
             endwhile; wp_reset_postdata(); endif;
    ?>
    <url>
        <loc><?= BASE_URL; ?>/moods/</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <!-- NOTE List Of Mood -->
    <?php 
        foreach ($moods as $mood) {
            $mood = str_replace('-', ' ', $mood['slug']);
            $mood = slugify($mood);
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/moods/{$mood}/</loc>\n";
            echo "<lastmod>" . date('c') . "</lastmod>\n";
            echo "</url>\n";
        }
    ?>

    <url>
        <loc><?= BASE_URL; ?>/materials/</loc>
        <lastmod>2024-09-23T06:50:54+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/inspiration/</loc>
        <lastmod>2024-11-25T04:09:12+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/about-us/</loc>
        <lastmod>2025-01-23T09:57:59+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/contact-us/</loc>
        <lastmod>2024-11-19T03:18:44+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/find-a-store/</loc>
        <lastmod>2024-12-06T03:56:10+00:00</lastmod>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/request-catalog/</loc>
        <lastmod>2025-01-23T09:00:41+00:00</lastmod>
    </url>

</urlset>