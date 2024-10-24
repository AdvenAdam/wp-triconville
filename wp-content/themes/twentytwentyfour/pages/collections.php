<?php
    get_template_part('header-custom');
    $character_slug = get_query_var('collection');
?>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js "></script>
<link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css "
      rel="stylesheet">

<div id="collection__header"
     class="w-full flex flex-row gapx-5"></div>

<div id="container__<?=$character_slug ?>"></div>
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
            selectedCollection = selectedCollection.filter(data => data.collection_id == res.collection_id);
            collectionData = {
                ...res,
                ...selectedCollection[0]
            };
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
        }
    });
};

function renderMaster() {
    $('#container__<?= $character_slug ?>').append(`
        <section class="banner mb-5 relative">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/${collectionData.image_banner}" alt="${collectionData.name}" class="w-full h-screen object-cover">
            <div class='bg-black bg-opacity-25 h-full w-full absolute inset-0 flex items-center justify-center'>
                <h1 class='text-white text-3xl md:text-5xl uppercase'>${collectionData.name}</h1>
            </div>
        </section>
        <section class="collection__description my-5 flex max-w-[1440px] mx-auto justify-end p-3 md:p-5 ">
            <div class="collection__description-content w-full md:w-3/5">
                <h1 class="text-4xl hidden md:block uppercase font-medium tracking-widest">${collectionData.name}</h1>
                <p class="text-justify max-w-3xl mb-5">${collectionData.description}</p>
                ${collectionData.sheet !== 'False' ? `
                    <a href="${collectionData.sheet}" target="_blank" class='btn-ghost-dark uppercase text-sm tracking-widest '>
                        download collection sheet
                    </a>
                `:''}
            </div>
        </section>
        <section class="collection__product relative my-10 py-5">
            <h3 class="text-center uppercase text-2xl md:text-3xl tracking-wide ">PRODUCT ON ${collectionData.name} COLLECTION</h3>
            <div class=" grid grid-cols-2 md:grid-cols-4 mt-5 gap-4 justify-center container mx-auto mt-5 mb-10">
                ${collectionData.product_list.map((pr, i) => `
                    <div class='overflow-hidden '>
                        <a href="<?= BASE_LINK; ?>/product-detail/${slugify(pr.name)}" class="">
                            <img src="${pr.product_image_384}" alt="${pr.alt_text}" class="w-full h-[384px] object-contain group-hover:scale-110 transition duration-300"> 
                            <h3 class="text-center mb-5 uppercase tracking-wider line-clamp-2 max-w-xs">${pr.name}</h3>
                        </a>
                    </div>
                `).join('')}
            </div>
        </section>
    `);
}
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