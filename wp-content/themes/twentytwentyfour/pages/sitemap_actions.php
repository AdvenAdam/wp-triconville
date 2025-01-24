<?php
$character_slug = get_query_var('sitemap');


if ($character_slug == 'sync_product') {
    syncProduct();
}

function syncProduct()  {
    $file = file_get_contents(get_template_directory() . '/api/product.json');
    $data = json_decode($file, true);
    
}
function renderAllProducts() {
    // TODO : Render All Products Each SubCategory
    if (haveSubCategories) {
        foreach (categoriesData['children'] as $data) {
            try {
                $ids = is_array($data['id']) ? $data['id'] : [$data['id']];
                $productListSelected = [];
                foreach ($ids as $id) {
                    $products = fetchProducts($id, $data['param']);
                    $productListSelected = array_merge($productListSelected, array_filter($products, function ($product) {
                        return in_array($product['status'], ['published', 'draft']);
                    }));
                }
                renderProducts($productListSelected, $data['name']);
            } catch (Exception $error) {
                error_log(sprintf('Error fetching products for %s', $data['name']), 0);
            }
        }
    } else {
        $ids = categoriesData['ids'];
        try {
            $allResult = array_map(function ($id) use ($ids) {
                return fetchProducts($id);
            }, $ids);
            $productListSelected = array_merge(...$allResult);
            $productListSelected = array_filter($productListSelected, function ($product) {
                return in_array($product['status'], ['published', 'draft']);
            });
            renderProducts($productListSelected, categoriesData['name']);
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
?>