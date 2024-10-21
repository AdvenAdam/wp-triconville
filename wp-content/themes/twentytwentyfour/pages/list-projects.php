<?php
/*
Template Name: List Projects
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-container">
    <div id="Slider__Container"
         class="overflow-hidden">
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
let projects = [];
$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_projects",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            projects = res;
        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            renderMaster();
        }
    })
})

// ANCHOR RENDERER SLIDER
function renderMaster() {
    try {
        // NOTE : Init Slider First
        projects.forEach(project => {
            $('#Slider__Container').append(`
                <div class="relative"
                id="${project.slug}__Container">
                    <div class="h-[90vh] md:h-screen w-auto" id="${project.slug}__slider">
                    </div>
                </div>
            `)
            renderSliderPages(project)
            renderButton(project.slug)
            initSlick(project.slug)
        })
    } catch (error) {
        redirectError()
        console.error("Error Rendering data:", error)
    } finally {
        $('#page-loading').hide();
    }

}

function renderSliderPages(project) {
    //    NOTE : BANNER SLIDER 
    $(`#${project.slug}__slider`).append(`
        <div class="banner mx-2 max-w-screen relative">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>${project.banner}"
                    alt=""
                    class="h-[90vh] md:h-screen w-screen object-cover">
            <div class="absolute bottom-10 right-10 sm:bottom-32 lg:bottom-48 lg:right-48">
                <div class="p-5 text-white flex flex-col sm:justify-end sm:items-end">
                    <h1 class='text-5xl tracking-wider text-white uppercase'>${project.name}</h1>
                    <p>${project.country}</p>
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
    `)
    // NOTE : DESCRIPTION SLIDER
    $(`#${project.slug}__slider`).append(`
        <div class="text w-screen md:w-auto max-w-screen bg-white mx-5 ">
            <div class=" h-[90vh] md:h-screen  w-full flex flex-col justify-end max-w-xl md:pb-40 pb-20 md:mx-40 mx-3">
                <h2 class="text-3xl md:text-5xl tracking-wider uppercase ">${project.name}</h2>
                <p>Malaysia</p>
                <p class="text-sm pt-10 pe-3">
                    ${project.description}
                </p>    
            </div>
        </div>
    `)
    // NOTE : GALLERIES SLIDER
    project.galleries.forEach(gallery => {
        $(`#${project.slug}__slider`).append(`
            <div class="image max-w-screen mx-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>${gallery}"
                    alt="${project.name}"
                    class="h-[90vh] md:h-screen w-auto object-cover">
            </div>
        `)
    })
    // NOTE : PRODUCTS SLIDER
    $(`#${project.slug}__slider`).append(`
        <div class="products w-screen max-w-screen mx-2 ">
            <div class=" h-[90vh] md:h-screen flex flex-col items-center justify-center">
                <h3 class="text-3xl tracking-wider ">
                    Featured Products
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-1 overflow-y-auto"
                        id="${project.slug}__products">

                </div>
            </div>
        </div>
    `)
    project.products_sku.forEach(sku => {
        loadProduct(project.slug, sku)
    })
}

function renderButton(slug) {
    $(`#${slug}__Container`).append(`
        <button class="slick-prev absolute top-1/2 -translate-y-1/2 z-10 left-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
            aria-label=""
            id="${slug}__prev-btn"
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
        <button class="slick-next absolute top-1/2 -translate-y-1/2 z-10 right-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
                aria-label=""
                id="${slug}__next-btn"
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
    `)
}

function initSlick(slug) {
    $(`#${slug}__slider`).slick({
        variableWidth: true,
        infinite: true,
        slidesToScroll: 1,
        arrows: false,
    });
    $(`#${slug}__prev-btn`).click(function() {
        $(`#${slug}__slider`).slick("slickPrev");
    });

    $(`#${slug}__next-btn`).click(function() {
        $(`#${slug}__slider`).slick("slickNext");
    });
}

function loadProduct(slug, sku) {
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
            $(`#${slug}__products`).append(`
                <a href= "<?= BASE_LINK; ?>/product-detail/${slugify(res.name)}">
                    <div class='flex justify-center items-center flex-col p-3'>
                        <img class="w-auto md:h-[384px] h-[250px] object-contain" src="${res.product_image}" />
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