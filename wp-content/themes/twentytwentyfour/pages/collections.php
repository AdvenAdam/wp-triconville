<?php
    get_template_part('header-custom');
    $character_slug = get_query_var( 'collection' );
?>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js "></script>
<link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css "
      rel="stylesheet">

<div id="collection__header"
     class="w-full flex flex-row gapx-5"></div>

<div id="container__<?=$character_slug ?>"></div>

<script>
$(document).ready(function() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections_det/<?= $character_slug ?>/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            // TODO ::SKELETON
        },
        success: function(res) {
            console.log(res);
            $('#container__<?= $character_slug ?>').append(`
                    <section class="banner my-5 relative">
                        <img src="${res.image_1920}" alt="${res.name}" class="w-full h-[50vh] object-cover">
                        <div class='bg-black bg-opacity-25 h-full w-full absolute inset-0 flex items-center justify-center'>
                        </div>
                    </section>

                    <section class="collection__description my-5 flex max-w-[1440px] mx-auto justify-end p-3 md:p-5 ">
                        <div class="collection__description-content w-3/5">
                            <h1 class="text-4xl uppercase font-semibold tracking-widest">${res.name}</h1>
                            <p class="text-justify max-w-3xl">${res.description}</p>
                        </div>
                    </section>
                    <section class="collection__product relative my-10 py-5">
                        <h3 class="text-center uppercase text-3xl tracking-wide ">PRODUCT ON ${res.name} COLLECTION</h3>
                        <div class=" grid grid-cols-2 md:grid-cols-4 mt-5 gap-4 justify-center container mx-auto mt-5 mb-10">
                            ${res.product_list.map((pr, i) => `
                            <div class='overflow-hidden '>
                                <a href="<?= BASE_LINK; ?>/detail/${pr.id}" class="">
                                    <img src="${pr.product_image}" alt="${pr.alt_text}" class="w-full h-[384px] object-contain group-hover:scale-110 transition duration-300"> 
                                    <h3 class="text-center mb-5 uppercase tracking-wider line-clamp-2 max-w-xs">${pr.name}</h3>
                                </a>
                            </div>
                            `).join('')}
                        </div>
                    </section>
                `);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
});
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

/* .collection__product-card {
    height: auto;
    margin-left: 1rem;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
}

.collection__product-card:nth-child(1) {
    margin-left: 0.5rem;
}

.collection__product-card>img {
    height: 384px;
    width: 384px;
    object-fit: contain;
} */

/* #product__prev,
#product__next {
    height: 30px;
    width: 30px;
    position: absolute;
    margin: auto 0px;
    bottom: 0;
    top: 0;
}

#product__prev {
    background: url('https://triconville.co.id/static/version1720147324/frontend/Ammar/customtheme/en_US/css/slick/arrow-left.svg');
    left: 120px;
    background-size: cover;
}

#product__next {
    background: url('https://triconville.co.id/static/version1720147324/frontend/Ammar/customtheme/en_US/css/slick/arrow-right.svg');
    right: 120px;
    background-size: cover;
} */
</style>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>