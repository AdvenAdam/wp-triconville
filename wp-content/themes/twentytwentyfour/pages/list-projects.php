<?php
/*
Template Name: List Projects
*/

// Include your custom header
get_template_part('header-custom');
?>
<style>
/* Hide scrollbar for Chrome, Safari and Opera */
body {
    overscroll-behavior-y: none;
}

::-webkit-scrollbar {
    display: none;
}

.slick-dots {
    display: flex;
    justify-content: center;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10%;
    list-style-type: none;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(40%);

    li {
        margin: 0 0.25rem;
    }

    button {
        display: block;
        width: 0.5rem;
        height: 0.5rem;
        padding: 0;
        border: none;
        border-radius: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        text-indent: -9999px;
    }

    li.slick-active button {
        background-color: black;
    }

}
</style>

<div class="content-container snap-y snap-mandatory h-screen overflow-y-auto scrollbar-none">
    <div id="main__container"></div>
    <?php
    // Include your custom footer
    get_template_part('footer-custom');
    ?>
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
            $('#main__container').append(`
                <div class="-ms-1 flex flex-no-wrap h-screen md:h-[95vh] overflow-x-scroll overflow-y-hidden snap-x snap-mandatory scrolling-touch cursor-pointer snap-start snap-always" id="${project.slug}__main">
                    <div class="flex-none snap-start snap-always">
                        <div class="flex md:flex-row flex-col w-screen items-center">          
                            <div class="relative h-[50vh] md:h-full w-full md:w-3/5" id="${project.slug}__Container">
                                <div class="h-full w-full" id="${project.slug}__galleries__slider">
                                </div>
                            </div>
                            <div class="h-[50vh] md:h-full w-full md:w-2/5" id="${project.slug}__desc">
                                <div class="flex flex-col justify-center p-3 mx-auto max-w-md">
                                    <h3 class="text-3xl ">
                                        ${toTitleCase(project.name)}
                                    </h3>
                                    <p class="text-sm mb-5">
                                        ${project.country}
                                    </p>
                                    <p class="text-sm mb-5">
                                        ${project.description}
                                    </p>
                                    <a class="text-sm font-medium flex items-baseline gap-1 mt-5" onClick="slideProjectHandler('${project.slug}__main', 'next')">
                                        <p>View featured products</p>
                                        <svg width="101" height="10" viewBox="0 0 101 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100.707 8.20711C101.098 7.81658 101.098 7.18342 100.707 6.79289L94.3431 0.428932C93.9526 0.0384078 93.3195 0.0384078 92.9289 0.428932C92.5384 0.819457 92.5384 1.45262 92.9289 1.84315L98.5858 7.5L92.9289 13.1569C92.5384 13.5474 92.5384 14.1805 92.9289 14.5711C93.3195 14.9616 93.9526 14.9616 94.3431 14.5711L100.707 8.20711ZM0 8.5H100V6.5H0V8.5Z" fill="#4D4D4D"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-none snap-start md:snap-center snap-always" id="${project.slug}__products__Container">
                        
                    </div>
                </div>
            `)
            renderPerProject(project)
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

function renderPerProject(project) {
    // NOTE : GALLERIES SLIDER
    project.galleries.forEach(gallery => {
        $(`#${project.slug}__galleries__slider`).append(`
            <div class="image max-w-screen me-2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>${gallery}"
                    alt="${project.name}"
                    class="h-[50vh] md:h-screen w-auto object-cover">
            </div>
        `)
    })

    // NOTE : PRODUCTS SLIDER
    $(`#${project.slug}__products__Container`).append(`
        <div class="products w-screen h-full overflow-y-auto">
            <div class="flex flex-col items-center justify-center ">
                <div class="px-3 md:px-5">
                    <div class="max-w-[1440px] relative">
                        <div class="flex items-center justify-between mt-16">
                            <div class="flex items-center gap-2" onClick="slideProjectHandler('${project.slug}__main', 'prev')">
                                <svg width="41" height="10" viewBox="0 0 41 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.646447 4.14645C0.451184 4.34171 0.451184 4.65829 0.646447 4.85355L3.82843 8.03553C4.02369 8.2308 4.34027 8.2308 4.53553 8.03553C4.7308 7.84027 4.7308 7.52369 4.53553 7.32843L1.70711 4.5L4.53553 1.67157C4.7308 1.47631 4.7308 1.15973 4.53553 0.964466C4.34027 0.769204 4.02369 0.769204 3.82843 0.964466L0.646447 4.14645ZM1 5H41V4H1V5Z" fill="#4D4D4D"/>
                                </svg>
                                <p class="text-sm font-medium">back</p>
                            </div>
                            <div>
                                <h3 class="text-lg md:text-3xl tracking-wider text-end">
                                    Featured Products
                                </h3>
                                <p class="text-sm text-end">${toTitleCase(project.name)}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-1" id="${project.slug}__products">
                        </div>
                    </div>
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
        <button class="slick-prev absolute top-1/2 -translate-y-1/2 z-10 left-0 py-10 bg-slate-50/50 px-2 hover:bg-slate-50/80"
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
        <button class="slick-next absolute top-1/2 -translate-y-1/2 z-10 right-0 py-10 bg-slate-50/50 px-2 hover:bg-slate-50/80"
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
    $(`#${slug}__galleries__slider`).slick({
        variableWidth: true,
        infinite: true,
        dots: true,
        slidesToScroll: 1,
        arrows: false,
    });
    $(`#${slug}__prev-btn`).click(function() {
        $(`#${slug}__galleries__slider`).slick("slickPrev");
    });

    $(`#${slug}__next-btn`).click(function() {
        $(`#${slug}__galleries__slider`).slick("slickNext");
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
                        <img class="w-auto md:h-[350px] h-[250px] object-contain" src="${res.product_image}" />
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
let timeout;

function onscrollHandler(event) {
    if (timeout) return;
    timeout = setTimeout(() => (timeout = null), 20);

    const direction = event.deltaY > 0 ? "nextElementSibling" : "previousElementSibling";
    const scrollTarget = event.target.closest(".snap-always")[direction];

    if (scrollTarget) {
        event.preventDefault();
        event.target.scrollTo({
            top: scrollTarget.offsetTop,
            behavior: "smooth",
        });
    }
}

function slideProjectHandler(id, direction) {
    document.querySelector(`#${id}`).scrollBy({
        left: direction === "next" ? 500 : -500,
        behavior: "smooth",
    });
}
</script>