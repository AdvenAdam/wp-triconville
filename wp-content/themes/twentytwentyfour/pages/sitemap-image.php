<?php

header("Content-Type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<?php
$products = json_decode(file_get_contents(get_template_directory() . '/api/sitemap.json'), true);
$categoryProducts = json_decode(file_get_contents(get_template_directory() . '/api/product.json'), true);
$collections = json_decode(file_get_contents(get_template_directory() . '/api/collection.json'), true);
$moods = json_decode(file_get_contents(get_template_directory() . '/api/moods.json'), true);
$inspirations = json_decode(file_get_contents(get_template_directory() . '/api/inspirations.json'), true);
$materials = json_decode(file_get_contents(get_template_directory() . '/api/materials.json'), true);


$materials = $materials['groups'];
$inspirations = $inspirations['inspirationList'];
$collections = $collections['collection'];
$products = $products['products'];
?>
<?php
function slugify($str) {
    $str = trim($str);
    $str = strtolower($str);

    // remove accents, swap  for "e", etc.
    $from = array(' ', '-', '_');
    $to = array(' ', '-', '-');
    $str = str_replace($from, $to, $str);

    $str = preg_replace('/[^a-z0-9-]/', ' ', $str);
    $str = preg_replace('/\s+/', '-', $str);

    return $str;
}

function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}

?>

<?php 
    function getCollectionAmbience($id) {
        try {
            $res = wp_remote_get(sprintf('%s/v1_collections_det_slug/%s/', BASE_API, $id), [
                'headers' => [
                    'Authorization' => API_KEY,
                ],
            ]);
            if (is_wp_error($res)) {
                throw new Exception('Error fetching data: ' . $res->get_error_message());
            }    
            
            $data = json_decode(wp_remote_retrieve_body($res), true);
            if ($data === null) {
                throw new Exception('Error decoding JSON response');
            }
            return $data['ambience_image'];
        } catch (Exception $error) {
            echo 'This page contains the following errors: ', 'error on line 155 at column 40: xmlParseEntityRef: no name', PHP_EOL;
            echo 'Below is a rendering of the page up to the first error.', PHP_EOL;
            return [];
        }
    }

    function getProductAmbience($id) {
        try {
            $res = wp_remote_get(sprintf('%s/v1_products_det_slug/%s/', BASE_API, $id), [
                'headers' => [
                    'Authorization' => API_KEY,
                ],
            ]);
            if (is_wp_error($res)) {
                throw new Exception('Error fetching data: ' . $res->get_error_message());
            }    
            
            $data = json_decode(wp_remote_retrieve_body($res), true);
            if ($data === null) {
                throw new Exception('Error decoding JSON response');
            }
            return [
                "product_image" => $data['product_image'],
                'ambience_image' => $data['ambience_image']
            ];
        } catch (Exception $error) {
            echo 'This page contains the following errors: ', 'error on line 155 at column 40: xmlParseEntityRef: no name', PHP_EOL;
            echo 'Below is a rendering of the page up to the first error.', PHP_EOL;
            return [];
        }
    }

    
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc><?= BASE_URL; ?>/</loc>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/home/Hompage_BrandSection.jpg</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/moods/All-Moods.png</image:loc>
        </image:image>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/products/</loc>
    </url>
    <!-- NOTE List Of Product - Category -->
    <?php 
        foreach ($categoryProducts as $category) {
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/products/" . $category['slug'] . "/</loc>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $category['thumb'] . "</image:loc>\n";
                echo "</image:image>\n";
            echo "</url>\n";
        }
    ?>
    <!-- NOTE List Of Collection -->

    <url>
        <loc><?= BASE_URL; ?>/collections/</loc>
        <?php 
        foreach ($collections as $collection) {
            echo "<image:image>\n";
            echo "<image:loc>" . $collection['image_grid'] . "</image:loc>\n";
            echo "</image:image>\n";
        }
    ?>
    </url>
    <?php 
        foreach ($collections as $collection) {
            $collectionName = str_replace('-', ' ', $collection['name']);
            $collectionName = slugify($collectionName);
            $data = getCollectionAmbience($collectionName);

            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/collections/" . $collectionName . "/</loc>\n";
            foreach ($data as $ambiance) {
                echo "<image:image>\n";
                echo "<image:loc>" . $ambiance['image_1920'] . "</image:loc>\n";
                echo "</image:image>\n";
            }
            echo "</url>\n";
        }
    ?>

    <!-- NOTE List Of Product - Detail -->
    <?php 
        foreach ($products as $product) {
            $product = str_replace('-', ' ', $product);
            $product = slugify($product);
            // FIXME : am here bitces
            $data = getProductAmbience($product);
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/product-detail/{$product}/</loc>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $data['product_image'] . "</image:loc>\n";
                echo "</image:image>\n";
                foreach ($data['ambience_image'] as $ambiance) {
                    echo "<image:image>\n";
                    echo "<image:loc>" . $ambiance . "</image:loc>\n";
                    echo "</image:image>\n";
                }
                
            echo "</url>\n";
        }
    ?>

    <url>
        <loc><?= BASE_URL; ?>/news/</loc>
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
    </url>
    <!-- NOTE List Of Mood -->
    <?php 
        foreach ($moods as $mood) {
            echo "<url>\n";
            echo "<loc>" . BASE_URL . "/moods/" . $mood['slug'] . "/</loc>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $mood['thumb'] . "</image:loc>\n";
                echo "</image:image>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $mood['subTitle']['subImage'] . "</image:loc>\n";
                echo "</image:image>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $mood['materials']['image'] . "</image:loc>\n";
                echo "</image:image>\n";
                echo "<image:image>\n";
                echo "<image:loc>" . $mood['catalogueImage'] . "</image:loc>\n";
                echo "</image:image>\n";
            echo "</url>\n";
        }
    ?>

    <url>
        <loc><?= BASE_URL; ?>/materials/</loc>
        <?php 
            foreach ($materials as $material) {
                echo "<image:image>\n";
                echo "<image:loc>" . $material['banner'] . "</image:loc>\n";
                echo "</image:image>\n";
            }
        ?>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/inspiration/</loc>
        <?php 
            foreach ($inspirations as $inspiration) {
                echo "<image:image>\n";
                echo "<image:loc>" . $inspiration['img'] . "</image:loc>\n";
                echo "</image:image>\n";
            }
        ?>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/about-us/</loc>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/brand-page/Craft%20With%20Passion.jpg</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/brand-page/earth-jewel.png</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/brand-page/story_in_every_grain.png</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/brand-page/art-of-our-craft_banner.jpg</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://storage.googleapis.com/magento-asset/wp_triconville/images/moods/All-Moods.png</image:loc>
        </image:image>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/contact-us/</loc>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/find-a-store/</loc>
    </url>

    <url>
        <loc><?= BASE_URL; ?>/request-catalog/</loc>
    </url>

</urlset>