<?php
/*
Template Name: List Projects
*/

// Include your custom header
get_template_part('header-custom');
?>
<script>
const projects = [{
    id: 1,
    products_sku: [
        "VENTO-01",
        "TORA-01",
        "BRIE-01",
        "TIMO-01",
        "ALP-01",
        "KRL-1S",
        "SNIX-01",
        "COR-01"
    ]
}]
</script>
<div class="content-container">
    <div class="relative"
         id="project-1">
        <div class="h-screen w-auto project__slider_1 ">
            <div class="banner mx-2 max-w-screen relative">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/projects/Project-1/banner1.png"
                     alt=""
                     class="h-screen w-screen object-cover">
                <div class="absolute bottom-10 right-10 sm:bottom-32 lg:bottom-48 lg:right-48">
                    <div class="p-5 text-white flex flex-col sm:justify-end sm:items-end">
                        <h1 class='text-5xl tracking-wider text-white uppercase'>the danna langkawi</h1>
                        <p>Malaysia</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="size-11 text-end">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>

                    </div>
                </div>
            </div>
            <div class="text w-auto max-w-screen bg-white mx-2 ">
                <div class=" h-screen w-auto flex flex-col justify-end max-w-xl md:pb-40 pb-20 md:mx-40 mx-20">
                    <h2 class="text-5xl tracking-wider uppercase ">the danna langkawi</h2>
                    <p>Malaysia</p>
                    <p class="text-sm pt-10">
                        Wandering the westernmost tip of Mallorca, dense pine trees unveil a hidden gem. La Trapa is a 430-square-metre
                        family home designed by architect Joan Miquel Seguí and the Terraza Balear team. Organically shaped to its
                        triangular plot, this retreat is a tribute to Mallorca’s wild beauty. Every corner has been crafted to foster a deep
                        connection to the lush outdoors. Glass walls invite the surroundings to become part of daily life.
                    </p>
                </div>
            </div>
            <div class="image max-w-screen mx-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/projects/Project-1/image.png"
                     alt=""
                     class="h-screen w-auto object-cover">
            </div>
            <div class="image max-w-screen mx-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/projects/Project-1/image-1.png"
                     alt=""
                     class="h-screen w-auto object-cover">
            </div>
            <div class="image max-w-screen mx-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/projects/Project-1/image-2.png"
                     alt=""
                     class="h-screen w-auto object-cover">
            </div>
            <div class="products w-screen max-w-screen mx-2 ">
                <div class=" h-screen flex flex-col items-center justify-center">
                    <h3 class="text-3xl tracking-wider ">
                        Featured Products
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-1"
                         id="project_1__products">

                    </div>
                </div>
            </div>
        </div>
        <button class="slick-prev prev-btn-1 absolute top-1/2 -translate-y-1/2 z-10 left-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
                aria-label="Previous"
                type="button">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor"
                 class="size-6">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>
        <button class="slick-next next-btn-1 absolute top-1/2 -translate-y-1/2 z-10 right-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
                aria-label="Next"
                type="button">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor"
                 class="size-6">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
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
jQuery(document).ready(function($) {
    projects.forEach(project => {
        project.products_sku.forEach(sku => {
            loadProduct(sku)
        })
    })
})

function loadProduct(sku) {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_products_det_sku/${sku}/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            $('#project_1__products').append(`
                <a href= "<?= BASE_LINK; ?>/product-detail/${slugify(res.name)}">
                    <div class='flex justify-center items-center flex-col p-3'>
                        <img class="w-auto md:h-[384px] h-[250px] object-cover md:object-contain" src="${res.product_image}" />
                        <p class="text-center md:mt-[-30px] max-w-[90%]">${res.name}</p>
                    </div>
                </a>
            `)
        },
        complete: () => {
            $('#page-loading').hide();
        }
    })
}
</script>
<script>
$('.project__slider_1').slick({
    variableWidth: true,
    infinite: true,
    slidesToScroll: 1,
    arrows: false,
})
$(".prev-btn-1").click(function() {
    $(".project__slider_1").slick("slickPrev");
});

$(".next-btn-1").click(function() {
    $(".project__slider_1").slick("slickNext");
});
</script>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>