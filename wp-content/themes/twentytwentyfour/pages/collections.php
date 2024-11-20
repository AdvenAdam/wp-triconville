<?php
    get_template_part('header-custom');
    $character_slug = get_query_var('collection');
?>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js "></script>
<link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css "
      rel="stylesheet">
<div class="content-container ">
    <div id="collection__header"></div>
    <div class="px-3 md:px-5">
        <div class="max-w-[1440px] mx-auto">
            <div id="container__<?=$character_slug ?>"></div>
            <div class="my-10">
                <h1 class="text-2xl md:text-3xl mb-5">More From Our Collection</h1>
                <div id="project__slider_1"
                     class="overflow-hidden ">
                </div>
                <div class="flex justify-center mt-5">
                    <a href="<?= BASE_LINK; ?>/collections/"
                       class='btn-ghost !py-2.5 uppercase text-sm tracking-wider mt-5'> view all collections</a>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="errorIndicator"
     class="hidden">Error</div>
<div id="page-loading">
    <div class="three-balls">
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
    </div>
</div>
<script>
let selectedCollection = [];
let collectionData = [];
let moreCollections = [];
const collections = <?php echo file_get_contents(get_template_directory() . '/api/collection.json'); ?>;

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
        type: "GET",
        success: (res) => {
            selectedCollection = res.collection;
            loadCollections();
        }
    })
})

function loadCollections() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections_det_slug/<?= $character_slug ?>/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: function(res) {
            // Join Local Json Data with Rest API
            selectedCollection = selectedCollection.filter(data => data.collection_id == res.collection_id);
            collectionData = {
                ...res,
                ...selectedCollection[0]
            };
            console.log("🚀 ~ loadCollections ~ collectionData:", collectionData)
            console.log("🚀 ~ renderMaster ~ collectionData.ambience_image.length:", collectionData.ambience_image.length)

        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            $('#page-loading').hide();
            renderMaster();
            metaMaster();
        }
    });
};
// NOTE : Handling Meta
function metaMaster() {
    ['title', 'description', 'keyword'].forEach(key => {
        if (collectionData[`meta_${key}`] !== 'False') {
            $(`<meta name="${key}" content="${collectionData[`meta_${key}`]}"/>`).appendTo('head');
        }
    });
}

// NOTE : Handling Render
function renderMaster() {
    $('#collection__header').append(`
        <section class="banner mb-5 relative">
            <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/${collectionData.image_banner}" alt="${collectionData.name}" class="w-full h-screen object-cover">
            <div class='bg-black bg-opacity-25 h-full w-full absolute inset-0 flex items-center justify-center'>
                <h1 class='text-white text-3xl md:text-5xl uppercase'>${collectionData.name}</h1>
            </div>
        </section>
    `)
    $('#container__<?= $character_slug ?>').append(`
        <section class="collection__description my-5 flex max-w-[1440px] mx-auto justify-end p-3 md:p-5 ">
            <div class="collection__description-content w-full md:w-3/5">
                <h1 class="text-4xl hidden md:block uppercase font-medium">${collectionData.name}</h1>
                <p class="text-justify text-sm max-w-3xl mt-5 mb-10">${collectionData.description}</p>
                ${collectionData.sheet !== 'False' ? `
                    <a href="${collectionData.sheet}" target="_blank" class='btn-ghost-dark uppercase text-sm tracking-wider'>
                        download collection sheet
                    </a>
                `:''}
            </div>
        </section>
        <section class="collection__ambiance my-10 py-5">
        </section>
        <section class="collection__product relative my-10 py-5">
            <h3 class="text-2xl md:text-3xl tracking-wide ">Products on ${collectionData.name} Collection</h3>
            <div class=" grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 mt-5 gap-4 justify-center container mx-auto mt-5 mb-10">
                ${collectionData.product_list.map((pr, i) => `
                    <div class='overflow-hidden '>
                        <a href="<?= BASE_LINK; ?>/product-detail/${slugify(pr.name)}" class="">
                            <img src="${pr.product_image_384}" alt="${pr.alt_text}" class="w-full h-[120px] md:h-[384px] object-contain group-hover:scale-110 transition duration-300"> 
                            <p class="text-center mb-5 text-sm capitalize line-clamp-2 max-w-xs">${pr.name}</p>
                        </a>
                    </div>
                `).join('')}
            </div>
        </section>
    `);
    if (collectionData.ambience_image.length > 0) {
        $('.collection__ambiance').append(`
            ${collectionData.ambience_image.map((img, i) => `
                <img src="${img.image_1920}" alt="${collectionData.name}-${i}" class="w-fit h-auto object-contain me-2">
            `)}
        `)
        $('.collection__ambiance').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1.03,
            slidesToScroll: 1
        });
    } else {
        $('.collection__ambiance').remove();
    }

    loadMoreCollections();
}

function loadMoreCollections() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },

        success: function(res) {
            res.results.forEach((dataCollection) => {
                const localJsonData = collections.collection.slice(0, 6).find(item => item.collection_id == dataCollection.collection_id) || null;
                if (localJsonData) {
                    moreCollections.push({
                        ...dataCollection,
                        ...localJsonData
                    });
                }
            })
            // TODO : make logic for triggering next page not by baypassing
        },
        complete: () => {
            moreCollections.sort((a, b) => a.id - b.id).slice(0, 6).forEach((colection) => renderMoreCollections(colection))
            $('#page-loading').hide();
            moreCollectionSlick();
        }
    });
}


function renderMoreCollections(collection) {
    $('#project__slider_1').append(`
        <a href= "<?= BASE_LINK; ?>/collections/${slugify(collection.name)}" class="mx-1 w-full max-w-[90vw] md:max-w-2xl">
            <div class="h-[365px] w-full flex items-center justify-center" 
                style="
                    background-position:center; 
                    background-image: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/${collection.image_grid}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
            </div>
            <p class='text-sm mt-3'>
                ${collection.id < 10 ? '0' + (collection.id) : collection.id}. 
            </p>
            <hr class='w-2/5 mt-3 border-black'/>
            <h1 class="text-3xl md:text-5xl mt-3 font-medium uppercase">${collection.display_name}</h1>
            <p class='text-sm mt-3 line-clamp-2 text-ellipsis'>
                ${collection.description}
            </p>
        </a>
    `);
}

function moreCollectionSlick() {
    $("#project__slider_1").slick({
        slidesToScroll: 1,
        variableWidth: true,
        arrows: false,
        infinite: true,
    });
}
$(window).resize(function() {
    moreCollectionSlick();
})
</script>

<style>
section.banner>picture>img {
    max-height: 900px;
    object-fit: cover;
}

section.banner>h1 {
    color: white;
    font-size: 50px;
    font-weight: 300;
    letter-spacing: .30rem;
    text-align: center;
    left: 0;
    right: 0;
    z-index: 1;
    bottom: 50vh;
    line-height: 0;
    position: absolute;
}
</style>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>