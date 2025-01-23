<?php
$character_slug = get_query_var('product');

$data = json_decode(file_get_contents(get_template_directory() . '/api/product.json'), true);
$selectedCategory = array_filter($data, function($e) use ($character_slug) {
    return $e['slug'] === $character_slug;
});
$selectedCategory = array_values($selectedCategory);
if (empty($selectedCategory)) {
    wp_safe_redirect(home_url('page-not-found'));
    exit;
}
echo '<title>'. esc_attr($selectedCategory[0]['meta']['title']) . '</title>';
echo '<meta name="description" content="' . esc_attr($selectedCategory[0]['meta']['description']) . '"/>';
echo '<meta name="keywords" content="' . esc_attr($selectedCategory[0]['meta']['keywords']). '"/>';

get_template_part('header-custom');
?>
<style>
.product-detail-banner {
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container overflow-hidden mt-24 md:mt-32">
    <!-- NOTE: Banner -->
    <div class="product-detail-banner">
        <div class="flex items-center justify-center w-full full-screen-with-subMenu bg-black bg-opacity-10">
            <h1 class="text-3xl lg:text-5xl font-medium text-center text-white capitalize"
                id="category__name"></h1>
        </div>
    </div>
    <div class="px-5 md:px-8">
        <!-- NOTE: filter product by category -->
        <div class="max-w-[1440px] mt-5 mb-10 md:mb-20 mx-auto">
            <h3 class="text-2xl lg:text-3xl text-center mt-10 md:mt-20"
                id="category__name-title"
                data-aos="fade-up"
                data-aos-once="true"
                data-aos-duration="1000">CATEGORY</h3>
            <div id='filter__product'
                 class="flex items-center my-10 text-sm justify-center gap-2 flex-wrap"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-duration="1000"></div>
        </div>

        <!-- NOTE : PRODUCT LIST -->
        <div class="max-w-[1440px] my-10 mx-auto "
             id="product__list">

        </div>
    </div>
</div>
<div id="page-loading">

</div>
<script>
let localProductsData = [];
let categoriesData;
let haveSubCategories = false;
let productListSelected = [];

$(document).ready(function() {
    categoriesData = <?= json_encode($selectedCategory[0]); ?>;
    haveSubCategories = categoriesData?.children.length;
    renderMaster()
})

function renderMaster() {
    try {
        $('.product-detail-banner').css('background-image', `url("${categoriesData.image}")`);
        $('#category__name').text(categoriesData.name);
        $('#category__name-title').text(`Explore Our Outdoor ${categoriesData.name}`);

        // NOTE : Render all Filter Product
        if (haveSubCategories > 1) {
            renderFilterProduct('All Types', 0);
            categoriesData.children.forEach((e, index) => {
                renderFilterProduct(e.name, e.id);
            })
        }
        renderAllProducts();
    } catch (error) {
        console.error("🚀 ~ renderMaster ~ error:", error)
        redirectError()
    }
}

async function renderAllProducts() {
    // TODO : Render All Products Each SubCategory
    if (haveSubCategories) {
        for (const data of categoriesData.children) {
            try {
                const ids = Array.isArray(data.id) ? data.id : [data.id];
                productListSelected = [];
                for (const id of ids) {
                    const products = await fetchProducts(id, data.param);
                    productListSelected = productListSelected.concat(products.filter(data => data.status === 'published' || data.status === 'draft'));
                }
                renderProducts(productListSelected, data.name);
            } catch (error) {
                console.error(`Error fetching products for ${data.name}:`, error);
            }
        }
    } else {
        const ids = categoriesData.ids;
        try {
            const allResult = await Promise.all(ids.map(id => fetchProducts(id)));
            productListSelected = [...productListSelected, ...allResult.flat()];
            productListSelected = productListSelected.filter(data => data.status === 'published' || data.status === 'draft');
            renderProducts(productListSelected, categoriesData.name);
        } catch (err) {
            console.error("🚀 ~ renderAllProducts ~ err:", err)
        }
    }
}

async function fetchProducts(id, param) {
    try {
        $('#page-loading').show();
        const res = await $.ajax({
            url: `<?= BASE_API; ?>/v1_categories_det/${id}/`,
            type: 'GET',
            headers: {
                Authorization: '<?= API_KEY; ?>'
            }
        });
        let filteredProduct = [];
        // NOTE : Get Triconville Product by listed collection
        // REVIEW - this code still hard code

        filteredProduct = res.product_list.filter(data => data.brand === 3).map(selectedData => {
            return {
                ...selectedData
            };
        });

        if (!param) {
            return filteredProduct;
        }

        const products = filteredProduct.filter(({
            name
        }) => {
            const keywords = param.split(",");
            return keywords.every(keyword => {
                const isExclude = keyword.startsWith("!");
                // Get the keyword and remove the exclamation mark
                const keywordValue = isExclude ? keyword.substring(1) : keyword;
                return isExclude ?
                    !name.toLowerCase().includes(keywordValue) :
                    name.toLowerCase().includes(keywordValue);
            });
        });

        return [...products];
    } catch (error) {
        $('#page-loading').hide();
        throw error;
    } finally {
        $('#page-loading').hide();
    }
}

function renderFilterProduct(name, id) {
    const action = id === 0 ? `onclick="subCategoryOnClick('all-types')"` : `onclick="subCategoryOnClick('${slugify(name)}')"`;
    const classes = id === 0 ? 'btn-ghost-dark !py-2' : 'btn-ghost !py-2';
    $('#filter__product').append(`
        <button type="button" id="${slugify(name)}-btn" class="${classes} tracking-wider" ${action}>
            ${name}
        </button>
    `);
}

function subCategoryOnClick(name) {
    $('.product-list').addClass('hidden');
    $('#filter__product button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    $(`#${name}-btn`).toggleClass('btn-ghost btn-ghost-dark');
    if (name === 'all-types') {
        $('.product-list').removeClass('hidden');
        $(`.product__${slugify(name)}`).removeClass('aos-animate');
        return;
    } else {
        $(`#product__${name}`).removeClass('hidden').addClass('aos-animate');
        $(`.product__${slugify(name)}`).addClass('aos-animate');
    }
}

function renderProducts(data, headerTitle = 'All Types') {
    $('#product__list').append(`
        <!-- NOTE: ${headerTitle} -->
        <div id="product__${slugify(headerTitle)}" class="product-list mb-20" 
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="1000"
        >
            <div class="-mb-5">
                <h3 class="text-2xl lg:text-3xl ps-3 lg:ps-5 mb-2" id="category__name-label">
                    ${headerTitle}
                </h3>
                <hr style="border-width: 1px;" class="relative z-10" />
            </div>
            <div id="product__list__${slugify(headerTitle)}" class ="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-10" >
            </div>
        </div>
    `);

    data.sort((a, b) => a.name.localeCompare(b.name)).forEach((e, index) => {
        $(`#product__list__${slugify(headerTitle)}`).append(`
            <a href= "<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}"
                class="product__${slugify(headerTitle)}"
                data-aos="fade-up"
                data-aos-once="true"
                data-aos-duration="1000"
            >
                <div class='flex justify-center items-center flex-col group'>
                    <img class="w-auto lg:h-[384px] h-[240px] object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300" src="${e.product_image_384}" />
                    <p class="text-center max-w-[90%] -mt-5 sm:-mt-10 lg:-mt-16 xl:-mt-10 relative z-10 capitalize group-hover:underline">${filterProductName(e.name)}</p>
                </div>
            </a>
        `);
    })
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>