<?php
/*
Template Name: sitemap
*/

header("Content-Type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

$products = json_decode(file_get_contents(get_template_directory() . '/api/sitemap.json'), true)[0];
$products = $products[0]['products'];

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc><?= BASE_URL; ?>/</loc>
        <lastmod>2025-01-23T08:56:26+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <!-- NOTE List Of Collection -->
    <url>
        <loc><?= BASE_URL; ?>/collections/alpha/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/timo/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/vento-teak/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/vento-aluminium/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/corda/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/marlow/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/tora/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/emmilie/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/dexa/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/ara/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/brie/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/vino/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/gera-tables-benches/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/planka-tables/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/gazelig/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/collections/dorus/</loc>
        <lastmod>2024-09-19T04:32:37+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <!-- NOTE List Of Product - Category -->
    <url>
        <loc><?= BASE_URL; ?>/products/sofas/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/armchairs/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/coffee-low-tables/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/loungers-daybeds/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/chairs/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/tables/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/products/accessories/</loc>
        <lastmod>2024-09-19T04:55:40+00:00</lastmod>
    </url>

    <!-- NOTE List Of Product - Detail -->
    <?php 
        foreach ($products as $product) {
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/product-detail/{$product}/</loc>\n";
            echo "<lastmod>" . date('c') . "</lastmod>\n";
            echo "</url>\n";
        }
    ?>
    <url>
        <loc><?= BASE_URL; ?>/materials/</loc>
        <lastmod>2024-09-23T06:50:54+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/moods/</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <!-- NOTE List Of Mood -->
    <url>
        <loc><?= BASE_URL; ?>/moods/dune-essence</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/moods/leafscape</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/moods/coastal-bliss</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/moods/bare-essence</loc>
        <lastmod>2024-10-08T02:45:14+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/contact-us/</loc>
        <lastmod>2024-11-19T03:18:44+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/inspiration/</loc>
        <lastmod>2024-11-25T04:09:12+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/find-a-store/</loc>
        <lastmod>2024-12-06T03:56:10+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/news/</loc>
        <lastmod>2024-12-09T04:06:22+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/request-catalog/</loc>
        <lastmod>2025-01-23T09:00:41+00:00</lastmod>
    </url>
    <url>
        <loc><?= BASE_URL; ?>/about-us/</loc>
        <lastmod>2025-01-23T09:57:59+00:00</lastmod>
    </url>
</urlset>