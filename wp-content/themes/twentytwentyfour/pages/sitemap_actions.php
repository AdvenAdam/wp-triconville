<?php
$character_slug = get_query_var('sitemap');

echo '<title>'. esc_attr('Sync Product') . '</title>';


if ($character_slug == 'sync_product') {
    syncProduct();
}

function syncProduct()  {
    try {
        $sitemap = [
            'products' => [],
        ];
        $file = json_decode(file_get_contents(get_template_directory() . '/api/product.json'), true);
        // header('Content-Type: application/json');
        foreach ($file as $value) {
            renderAllProducts($value, $sitemap);
        }
    } catch (\Throwable $th) {
        dd($th);
    } finally {        
        file_put_contents(get_template_directory() . '/api/sitemap2.json', json_encode($sitemap, JSON_PRETTY_PRINT));
        if (file_exists(get_template_directory() . '/api/sitemap2.json')) {
            unlink(get_template_directory() . '/api/sitemap.json');
            rename(get_template_directory() . '/api/sitemap2.json', get_template_directory() . '/api/sitemap.json');
        }
        alert('Sitemap Updated');
    }
}


function renderAllProducts($data, &$sitemap) {
    // TODO : Render All Products Each SubCategory
    $haveSubCategories = count($data['children']) > 2;
    if ($haveSubCategories) {
        foreach ($data['children'] as $value) {
            try {
                $ids = is_array($value['id']) ? $value['id'] : [$value['id']];
                $productListSelected = [];
                foreach ($ids as $id) {
                    $products = fetchProducts($id, $value['param']);
                    $productListSelected = array_merge($productListSelected, array_filter($products, function ($product) {
                        return in_array($product['status'], ['published', 'draft']);
                    }));
                }
                renderProducts($productListSelected, $sitemap);
            } catch (Exception $error) {
                error_log(sprintf('Error fetching products for %s', $data['name']), 0);
            }
        }
    } else {
        $ids = $data['ids'];
        try {
            $allResult = array_map(function ($id) use ($ids) {
                return fetchProducts($id);
            }, $ids);
            $productListSelected = array_merge(...$allResult);
            $productListSelected = array_filter($productListSelected, function ($product) {
                return in_array($product['status'], ['published', 'draft']);
            });
            renderProducts($productListSelected, $sitemap);
        } catch (Exception $err) {
            error_log("Error fetching products: " . $err->getMessage(), 0);
        }
    }
}

function fetchProducts($id, $param = null) {
    try {
        $res = wp_remote_get(sprintf('%s/v1_categories_det/%s/', BASE_API, $id), [
            'headers' => [
                'Authorization' => API_KEY,
            ],
        ]);
        if (is_wp_error($res)) {
            throw new Exception($res->get_error_message());
        }
        $res = json_decode($res['body'], true);
        $filteredProduct = [];
        // NOTE : Get Triconville Product by listed collection
        // REVIEW - this code still hard code

        $filteredProduct = array_filter($res['product_list'], function ($product) {
            return $product['brand'] === 3;
        });
        $filteredProduct = array_map(function ($selectedData) {
            return $selectedData;
        }, $filteredProduct);

        if (!$param) {
            return $filteredProduct;
        }

        $products = array_filter($filteredProduct, function ($product) use ($param) {
            $keywords = explode(',', $param);
            return array_reduce($keywords, function ($carry, $keyword) use ($product) {
                $isExclude = strpos($keyword, '!') === 0;
                $keywordValue = $isExclude ? substr($keyword, 1) : $keyword;
                return $carry && (
                    $isExclude ?
                    !strpos(strtolower($product['name']), $keywordValue) :
                    strpos(strtolower($product['name']), $keywordValue)
                );
            }, true);
        });
        return array_values($products);
    } catch (Exception $error) {
        throw $error;
    }
}

function renderProducts($productListSelected, &$sitemap) {
    $sitemap['products'] = array_merge($sitemap['products'] ?? [], array_column($productListSelected, 'name'));
}
function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}


function alert($message) {
    echo '<script>alert("' . $message . '"); window.location.href="' . home_url() . '/sitemap";</script>';
}
?>