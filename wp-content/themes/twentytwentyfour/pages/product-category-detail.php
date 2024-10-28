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
        <h3 class="text-2xl md:text-3xl text-center my-10"
            id="category__name-title">CATEGORY</h3>
        <div id='filter__product'
             class="flex items-center my-10 text-sm justify-center gap-3 flex-wrap"></div>
    </div>

    <!-- NOTE : PRODUCT LIST -->
    <div class="max-w-[1440px] px-3 md:px-5 my-8 mx-auto ">
        <h3 class="text-2xl md:text-3xl tracking-widest"
            id="category__name-label"></h3>
        <hr style="border-width: 2px;" />
    </div>

    <div class="max-w-[1440px] my-10 mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
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
    $('head').append(`<meta name="title" content="${categoriesData.meta.title}"/>`);
    $('head').append(`<meta name="description" content="${categoriesData.meta.description}"/>`);
    $('head').append(`<meta name="keywords" content=" ${categoriesData.meta.keywords}"/>`);
}

function renderMaster() {
    try {
        $('.product-detail-banner').css('background-image', `url("<?php echo get_stylesheet_directory_uri(); ?>/assets/images/category/banner/${categoriesData.image}")`);
        $('#category__name').text(categoriesData.name);
        $('#category__name-title').text(`Explore Our Outdoor ${categoriesData.name}`);

        renderFilterProduct('All Products', 0);
        // NOTE : Render all Filter Product
        renderFilterAllProduct();

        // TODO : Render Each SubCategory
        categoriesData.children.forEach((e, index) => {
            renderFilterProduct(e.name, e.id, e.param);
        })
    } catch (error) {
        console.error("🚀 ~ renderMaster ~ error:", error)
        redirectError()
    }
}

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
        filteredCollection = res.product_list.filter(e => selectedCollectionId.some(element => element.collection_id === parseInt(e.collection))).map(e => {
            const selectedCollection = selectedCollectionId.find(element => element.collection_id === parseInt(e.collection_id));
            return {
                ...e,
                ...selectedCollection
            };
        });
        const products = param !== '' ?
            filteredCollection.filter(({
                name
            }) => param.split(",").some(p => name.toLowerCase().includes(p))) :
            filteredCollection;

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
        <button type="button" id="${slugify(name)}" class="btn-ghost" ${classes}>
            ${name}
        </button>
    `);
}

async function subCategoryOnClick(name, id, param) {
    $('#category__name-label').text(name);
    $('#filter__product button').removeClass('btn-ghost-dark').addClass('btn-ghost')
    $(`#${slugify(name)}`).removeClass('btn-ghost').addClass('btn-ghost-dark');
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
            <a href= "<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">
                <div class='flex justify-center items-center flex-col p-3'>
                    <img class="w-auto md:h-[384px] h-[204px] object-contain" src="${e.product_image_384}" />
                    <p class="text-center text-xs md:mt-[-30px] max-w-[90%] uppercase">${e.name}</p>
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