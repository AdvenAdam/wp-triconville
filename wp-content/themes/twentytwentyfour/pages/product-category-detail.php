<?php
get_template_part('header-custom');

$character_slug = get_query_var('product');
?>
<style>
.product-detail-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/category-detail-banner.jpg');
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container overflow-hidden">

    <!-- NOTE: Banner -->
    <div class="product-detail-banner">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-35">
            <h1 class="text-4xl font-extrabold text-center tracking-wider text-white uppercase"
                id="category__name"></h1>
        </div>
    </div>
    <!-- NOTE: filter product by category -->
    <div class="max-w-[1440px] my-5 mx-auto">
        <h3 class="text-xl font-semibold tracking-widest text-center uppercase my-5">CATEGORY</h3>
        <div id='filter__product'
             class="flex items-center justify-center gap-3 flex-wrap"></div>
    </div>

    <!-- NOTE : PRODUCT LIST -->
    <div class="max-w-[1440px] my-8 mx-auto border-b border-black">
        <h3 class="text-xl font-semibold tracking-widest uppercase"
            id="category__name-label"></h3>
    </div>

    <div class="max-w-[1440px] my-10 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
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
            $('#page-loading').hide();

            const filteredCategory = res.filter(cat => cat.slug === '<?= $character_slug ?>')
            categoriesData = filteredCategory[0];
            $('.product-detail-banner').css('background-image', `url("${categoriesData.image}")`);
            $('#category__name').text(categoriesData.name);
            renderFilterProduct('All Products', 0);
            // NOTE : Render all Filter Product
            renderFilterAllProduct();

            // TODO : Render Each SubCategory
            categoriesData.children.forEach((e, index) => {
                renderFilterProduct(e.name, e.id, e.param);
            })
        }
    })
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            $('#page-loading').hide();
            selectedCollectionId = res.collection;
        }
    })
})

async function renderFilterAllProduct() {
    subCategoryOnClick('All Products', 0);
    // TODO : Render All Products Each SubCategory
    if (categoriesData.children.length > 0) {
        const fetchAllProduct = async () => {
            const allPromise = categoriesData.children.map(e => fetchProducts(e.id, e.param));
            const allResult = await Promise.all(allPromise);
            return allResult.flat();
        }
        fetchAllProduct().then(res => {
            productListSelected = [...new Set([...productListSelected, ...res])];
            renderProducts(productListSelected)
        }).catch(err => {
            console.error("🚀 ~ renderFilterAllProduct ~ err:", err)
        })
    } else {
        const ids = categoriesData.ids;
        const fetchAllProduct = async () => {
            const allPromise = ids.map(id => fetchProducts(id, ''));
            const allResult = await Promise.all(allPromise);
            return allResult.flat();
        }
        fetchAllProduct().then(res => {
            productListSelected = [...new Set([...productListSelected, ...res])];
            renderProducts(productListSelected)
        }).catch(err => {
            console.error("🚀 ~ renderFilterAllProduct ~ err:", err)
        })
    }
}

async function fetchProducts(id, param) {
    try {
        $('#page-loading').show();
        productListSelected = [];
        const res = await $.ajax({
            url: `<?= BASE_API; ?>/v1_categories_det/${id}/`,
            type: 'GET',
            headers: {
                Authorization: '<?= API_KEY; ?>'
            }
        });
        // NOTE : Get Triconville Product by id == 3
        let triconvilleProduct = res.product_list.filter(product => product.brand === 3 && selectedCollectionId.includes(product.collection));
        const products = param !== '' ?
            triconvilleProduct.filter(({
                name
            }) => param.split(",").some(p => name.toLowerCase().includes(p))) :
            triconvilleProduct;

        return [...productListSelected, ...products];
    } catch (error) {
        $('#page-loading').hide();
        throw error;
    } finally {
        $('#page-loading').hide();
    }
}


function renderFilterProduct(name, id, param = '') {
    const classes = id === 0 ? 'onclick="renderFilterAllProduct()"' : `onclick="subCategoryOnClick('${name}', ${id}, '${param}')"`;
    $('#filter__product').append(`
        <button type="button" id="${slugify(name)}" class="border border-slate-800 p-3 transition duration-300 text-black hover:bg-black hover:text-white" ${classes}>
            ${name}
        </button>
    `);
}


async function subCategoryOnClick(name, id, param) {
    $('#category__name-label').text(name);
    $('#filter__product button').removeClass('text-white bg-black');
    $(`#${slugify(name)}`).removeClass('text-black hover:bg-black hover:text-white').addClass('text-white bg-black');
    if (id !== 0) {
        try {
            const data = await fetchProducts(id, param);
            renderProducts(data);
        } catch (error) {
            console.error(error);
        }
    }
}

function renderProducts(data) {
    $('#product__list').empty();
    data.sort((a, b) => a.name.localeCompare(b.name)).forEach(e => {
        $('#product__list').append(`
            <a href= "<?= BASE_LINK; ?>/detail/${e.id}">
                <img class="w-full md:h-[384px] h-[250px] object-cover md:object-contain" src="${e.product_image}" />
                <p class="text-xl text-center md:mt-[-30px] max-w-[90%]">${e.name}</p>
            </a>
        `);
    })
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>