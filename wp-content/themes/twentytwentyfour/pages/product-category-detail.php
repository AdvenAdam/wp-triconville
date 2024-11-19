<?php
$character_slug = get_query_var('product');
echo '<title>' . ucfirst( slugToTitleCase($character_slug) )  . ' | ' . wp_kses_data( get_bloginfo( 'name', 'display' ) ) . '</title>';
get_template_part('header-custom');

?>
<style>
.product-detail-banner {
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container overflow-hidden mt-20">
    <!-- NOTE: Banner -->
    <div class="product-detail-banner mt-10">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-35">
            <h1 class="text-3xl md:text-5xl font-medium text-center text-white uppercase"
                id="category__name"></h1>
        </div>
    </div>
    <!-- NOTE: filter product by category -->
    <div class="max-w-[1440px] mt-5 mb-10 md:mb-20 mx-auto">
        <h3 class="text-2xl md:text-3xl text-center mt-10 md:mt-20"
            id="category__name-title">CATEGORY</h3>
        <div id='filter__product'
             class="flex items-center my-10 text-sm justify-center gap-3 flex-wrap"></div>
    </div>

    <!-- NOTE : PRODUCT LIST -->
    <div class="max-w-[1440px] my-10 mx-auto "
         id="product__list">

    </div>
</div>
<div id="page-loading">
    <div class="three-balls">
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
    </div>
</div>
<script>
let categoriesData;
let haveSubCategories = false;
let productListSelected = [];
let selectedCollectionId = [];

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/product_service",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            const filteredCategory = res.filter(cat => cat.slug === '<?= $character_slug ?>')
            categoriesData = filteredCategory[0];
        },
        error: (xhr, status, error) => {
            if (xhr.status === 404) {
                redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            $('#page-loading').hide();
            haveSubCategories = categoriesData.children.length;
            renderMaster()
            metaMaster()
        }
    })
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
        type: "GET",
        success: (res) => {
            selectedCollectionId = res.collection;
        },
    })
})

function metaMaster() {
    ['title', 'description', 'keywords'].forEach(key => {
        if (categoriesData.meta[`${key}`] !== 'False') {
            $(`<meta name="${key}" content="${categoriesData.meta[`${key}`]}"/>`).appendTo('head');
        }
    });
}

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
                const res = await fetchProducts(data.id, data.param);
                renderProducts(res, data.name);
            } catch (error) {
                console.error(`Error fetching products for ${data.name}:`, error);
            }
        }
    } else {
        const ids = categoriesData.ids;
        const fetchAllProduct = async () => {
            const allPromise = ids.map(id => fetchProducts(id, ''));
            const allResult = await Promise.all(allPromise);
            return allResult.flat();
        }
        fetchAllProduct().then(res => {
            productListSelected = [...new Set([...productListSelected, ...res])];
            renderProducts(productListSelected, categoriesData.name);
        }).catch(err => {
            console.error("🚀 ~ renderAllProducts ~ err:", err)
        })
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
        // NOTE : Get Triconville Product by listed collection
        // REVIEW - this code still hard code
        filteredCollection = res.product_list.filter(data => selectedCollectionId.some(element => element.collection_id === parseInt(data.collection)) || parseInt(data.collection) === 258).map(selectedData => {
            return {
                ...selectedData
            };
        });
        const products = param !== '' ?
            filteredCollection.filter(({
                name
            }) => param.split(",").some(p => name.toLowerCase().includes(p))) :
            filteredCollection;

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
        <button type="button" id="${slugify(name)}-btn" class="${classes}" ${action}>
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
        return;
    } else {
        $(`#product__${name}`).removeClass('hidden');
    }
}

function renderProducts(data, headerTitle = 'All Types') {
    $('#product__list').append(`
        <!-- NOTE: ${headerTitle} -->
        <div id="product__${slugify(headerTitle)}" class="product-list mb-20">
            <div class="-mb-5">
                <h3 class="text-2xl md:text-3xl md:ps-5" id="category__name-label">
                    ${headerTitle}
                </h3>
                <hr style="border-width: 2px;" />
            </div>
            <div id="product__list__${slugify(headerTitle)}" class ="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-10">
            </div>
        </div>
    `);

    data.sort((a, b) => a.name.localeCompare(b.name)).forEach(e => {
        $(`#product__list__${slugify(headerTitle)}`).append(`
            <a href= "<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">
                <div class='flex justify-center items-center flex-col p-3'>
                    <img class="w-auto md:h-[384px] h-[204px] object-contain" src="${e.product_image_384}" />
                    <p class="text-center text-xs md:mt-[-30px] max-w-[90%] capitalize">${e.name}</p>
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