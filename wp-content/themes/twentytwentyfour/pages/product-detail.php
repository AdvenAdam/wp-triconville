<?php
get_template_part('header-custom');

$character_slug = get_query_var('detail');
?>
<style>
.slick-slider {
    max-width: 100vw;
    width: 100%;
    overflow: hidden !important;
}

.product-overview-desc ul {
    list-style-type: disc;
    list-style-position: inside;
    padding-top: 8px;
}

#main_slider img {
    border-radius: 8px;
}

#thumbnail_slider img {
    border-radius: 8px;
    border: 2px solid transparent;
    transition: border-color 0.3s ease;
}

#thumbnail_slider .slick-current img {
    border-color: #4a90e2;
}

.fancybox__container {
    z-index: 1 !important;
}
</style>

<div class="content-container  overflow-hidden">
    <div id="product__banner"></div>
    <!-- NOTE : PRODUCT Overview & Material -->
    <div class="md:p-5 p-3">
        <div class="max-w-[1440px] mx-auto">
            <div id="product__header__image"></div>
            <div class="textproduct-overview-desc mt-6 pb-5 mb-5 flex flex-col md:flex-row">
                <div id="product__overview"
                     class="md:w-3/5"></div>
                <div class="flex flex-col gap-2 item-center md:w-2/5 mt-5 md:mt-0">
                    <span class="mr-3"
                          id="label_1"></span>
                    <div class="flex flex-wrap gap-1"
                         id="option_1">
                    </div>
                    <span class="mr-3"
                          id="label_2"></span>
                    <div class="flex flex-wrap items-center gap-1"
                         id="option_2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NOTE : PRODUCT Ambience Slider -->
    <div class="ambience__section relative">
        <div class="ambience__img grid gap-4"></div>
        <button class="slick-prev prev-btn absolute top-1/2 -translate-y-1/2 z-10 left-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
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
        <button class="slick-next next-btn absolute top-1/2 -translate-y-1/2 z-10 right-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
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
    <!-- NOTE : PRODUCT Specification -->
    <div class="md:p-5 p-3">
        <div class="max-w-[1440px] mx-auto grid gap-4 grid-cols-1 md:grid-cols-2">
            <div class=""
                 id="image__spec">
            </div>
            <div class="md:p-3">
                <div class="p-3">
                    <div class="flex items-start justify-between">
                        <h3 class="text-3xl tracking-wide mb-3 line-clamp-2">SIZING</h3>
                        <div class="flex items-center sizing-btn">
                            <button class="bg-slate-800 hover:bg-slate-800/80 border border-slate-800 text-white py-2 px-8 text-sm"
                                    onClick="changeSize('metric')"
                                    id="metric">Metric</button>
                            <button class="bg-transparent hover:bg-slate-800 hover:text-white border border-slate-800 py-2 px-8 text-sm"
                                    onClick="changeSize('imperial')"
                                    id="imperial">Imperial</button>
                        </div>
                    </div>
                    <table class="product__spec w-full"
                           id="table__spec"></table>
                </div>
                <div class="p-3">
                    <h3 class="text-3xl tracking-wide mb-3 line-clamp-2">DOWNLOAD</h3>
                    <div id="product__downloadable"
                         class="grid grid-cols-2 gap-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NOTE : PRODUCT IN THIS SECTION -->
    <div class="md:p-5 p-3">
        <div class="max-w-[1440px] mx-auto">
            <div class="py-10">
                <h2 class='text-3xl collection__product__name'></h2>
                <div class="collection__product grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 my-10"></div>
                <div class="collection__product__btn text-center"></div>
            </div>
            <div class="py-10 relative"
                 id="well__with__product">
                <h2 class='text-3xl well__with__product__name'></h2>
                <div class="well__with__product my-10"></div>
                <div class="well__with__product__btn text-center"></div>

            </div>
        </div>
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
let ProductsData = [];
jQuery(document).ready(function($) {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_products_det_slug/<?= $character_slug ?>/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            // TODO ::SKELETON
            $('#page-loading').show();
        },
        success: (res) => {
            ProductsData = res;
            // NOTE : PRODUCT HEADER 
            $('#product__banner').append(
                `<div class="h-screen w-full transition-all duration-500 "
                    style="
                        background: url('${res.ambience_image_1920[0]}'); 
                        background-position: 50% 50%;
                        background-size: cover;
                        background-repeat: no-repeat;
                    ">
                    <div class ='bg-black bg-opacity-30 h-full w-full flex items-center justify-center'>
                        <h1 class="text-4xl font-extrabold text-center tracking-wider text-white uppercase">${res.name}</h1>
                    </div>
                </div>`
            );
            // NOTE :PRODUCT OVERVIEW
            renderOverview(res);
            renderMaterial(res.combineoptionvariant);
            // APPEND DIMENSION
            renderDimensions(res.dimension);
            renderDownloadable(res.asset3d);
            renderImages(res);
            if (res.collection_product) {
                renderCollectionProducts(res.collection_product.slice(0, 4), res.collection_det);
            }
            if (Array.isArray(res.goes_well_with) && res.goes_well_with.length > 0) {
                renderWellWithProducts(res.goes_well_with);
            }
        },
        error: (xhr, status, error) => {
            console.error('Error fetching data:', error);
        },
        complete: () => {
            $('#page-loading').hide();
        }
    });
});

function changeSize(size) {
    $('.sizing-btn button').removeClass('bg-slate-800 hover:bg-slate-800/80 text-white').addClass('bg-transparent hover:bg-slate-800 hover:text-white');

    if (size == 'metric') {
        $('#table__spec').empty();
        $('#metric').removeClass('bg-transparent hover:bg-slate-800 hover:text-white').addClass('bg-slate-800 hover:bg-slate-800/80 text-white');
        renderDimensions(ProductsData.dimension);
    } else {
        $('#table__spec').empty();
        $('#imperial').removeClass('bg-transparent hover:bg-slate-800 hover:text-white').addClass('bg-slate-800 hover:bg-slate-800/80 text-white');
        renderDimensions(ProductsData.dimension_imperial);
    }
}

function renderMaterial(res) {
    if (res.option1 && Array.isArray(res.option1)) {
        $('#label_1').text(res.label1)
        res.option1.forEach(opt => {
            $('#option_1').append(
                `<img src="${opt.img_link}" class="w-20 h-20"/>`
            );
        });
    }

    if (res.option2 && Array.isArray(res.option2)) {
        $('#label_2').text(res.label2)
        res.option2.forEach(opt2 => {
            $('#option_2').append(
                `<img src="${opt2.img_link}" class="w-20 h-20"/>`
            );
        });
    }

}

function renderOverview(res) {
    $('#product__header__image').append(`
        <div class="text-center mx-auto">
            <img src="${res.product_image}" alt="${res.name}" class="w-auto h-[350px] lg:h-[480px] mx-auto"/>
        </div>
    `)
    if (res.name) {
        $('#product__overview').append(`
            <div class='max-w-lg'>
                <h1 class="text-3xl font-semibold text-gray-900 tracking-wide line-clamp-2">${res.name}</h1>
                <p class="text-slate-500 tracking-widest text-sm mb-3">Designed by 
                    <span class="text-black font-medium hover:underline"><a href="https://indospacegroup.com/dezign-s2dio/">Dezign S2dio </a></span>
                </p>
                <p class="text-center line-clamp-4">${res.description.replace(/<li[^>]*>(.*?)<\/li>/g, '')}</p>
            </div>
        `);
    }
    if (Array.isArray(res.ambience_image) && res.ambience_image.length > 0) {
        $('#product__ambience').append(`
            <img src="${res.ambience_image[0]}" alt="${res.name}" class="w-full h-auto rounded-xl"/>
        `);
    }
}

function renderDimensions(dimensions) {
    // Append overall dimensions
    if (dimensions.ps_overal_dimension) {
        dimensions.ps_overal_dimension.forEach((e) => {
            $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>Overall - ${e.description}</td>
                    <td class='px-3'> : </td>
                    <td> ${e.width} x ${e.depth} x ${e.height}</td>
                </tr>
            `);
        });
    }
    // Append box dimensions
    if (dimensions.ps_box_dimension) {
        dimensions.ps_box_dimension.forEach((e) => {
            $('#table__spec').append(`
                        <tr>
                            <td class='w-1/2'>Box - ${e.description}</td>
                            <td class='px-3'> : </td>
                            <td>${e.width} x ${e.depth} x ${e.height}</td>
                        </tr>
                    `);
        });
    }
    // Append other properties
    if (dimensions.ps_clearance_from_floor) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2'>Clearance from Floor</td>
                        <td class='px-3'> : </td>
                        <td>${dimensions.ps_clearance_from_floor}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_table_top_thickness) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2'>Table Top Thickness</td>
                        <td class='px-3'> : </td>
                        <td>${dimensions.ps_table_top_thickness}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_distance_between_legs) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2'>Distance Between Legs</td>
                        <td class='px-3'> : </td>
                        <td>${dimensions.ps_distance_between_legs}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_arm_height) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2'>Arm Height</td>
                        <td class='px-3'> : </td>
                        <td>${dimensions.ps_arm_height}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_seat_height) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2'>Seat Height</td>
                        <td class='px-3'> : </td>
                        <td>${dimensions.ps_seat_height}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_seat_depth) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>Seat Depth</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_seat_depth}</td>
                </tr>
            `);
    }
    if (dimensions.ps_nett_weight) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>Nett Weight</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_nett_weight}</td>
                </tr>
            `);
    }
    if (dimensions.ps_gross_weight) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>Gross Weight</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_gross_weight}</td>
                </tr>
            `);
    }
    if (dimensions.ps_pax) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>PAX</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_pax}</td>
                </tr>
            `);
    }
    if (dimensions.ps_20ft_container) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>20ft Container</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_20ft_container}</td>
                </tr>
            `);
    }
    if (dimensions.ps_40hq_container) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>40HQ Container</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.ps_40hq_container}</td>
                </tr>
            `);
    }
    if (dimensions.cbm) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2'>CBM</td>
                    <td class='px-3'> : </td>
                    <td>${dimensions.cbm}</td>
                </tr>
            `);
    }

}

function renderDownloadable(asset3d) {
    if (asset3d !== null) {
        if (asset3d.drawing_3d_dwg) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${asset3d.drawing_3d_dwg}"
                    class="text-slate-500 hover:text-slate-400">
                        <div class='flex gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-slate-500">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>DWG
                        </div>
                    </a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (asset3d.drawing_3d_obj) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${asset3d.drawing_3d_obj}"
                    class="text-slate-500 hover:text-slate-400">
                        <div class='flex gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-slate-500">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>3D OBJ
                        </div>
                    </a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (asset3d.drawing_3d_3dmax) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${asset3d.drawing_3d_3dmax}"
                    class="text-slate-500 hover:text-slate-400">
                        <div class='flex gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-slate-500">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>3D MAX
                        </div>
                    </a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (asset3d.drawing_3d_sketchup) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${asset3d.drawing_3d_sketchup}"
                    class="text-slate-500 hover:text-slate-400">
                        <div class='flex gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-slate-500">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>SKETCHUP
                        </div>
                    </a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (asset3d.file_3d_glb) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${asset3d.file_3d_glb}"
                    class="text-slate-500 hover:text-slate-400">
                        <div class='flex gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-slate-500">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>GLB
                        </div>
                    </a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
    }
}

function renderImages(images) {
    images.ambience_image.forEach((e) => {
        $('.ambience__img').append(`
            <div>
                <img src="${e}"
                    class="h-[350px] sm:h-[600px] lg:h-[700px] mx-2 w-screen md:w-auto object-cover" />
            </div>
        `)
    })
    $('.ambience__img').slick({
        slidesToScroll: 1,
        variableWidth: true,
        centerMode: true,
        infinite: true,
        arrows: false,
    });
    $(".prev-btn").click(function() {
        $(".ambience__img").slick("slickPrev");
    });
    $(".next-btn").click(function() {
        $(".ambience__img").slick("slickNext");
    });

    // Spec image
    $('#image__spec').append(`
        <img src="${images.spec_image}"
            alt="specification product"
            height="512"
            width="512" />
    `)
}

function renderCollectionProducts(products, name) {
    // Collection product
    $('.collection__product__name').text(`in ${name} Collection`);
    products.forEach((e) => {
        $('.collection__product').append(`
            <a href="<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">     
                <div class="product__card">
                    <img src="${e.product_image}" class="h-[350px] mx-2 w-auto object-cover" />
                    <div class="text-center">
                        <p class="line-clamp-2">
                            ${e.name}
                        </p>
                    </div>
                </div>
            </a>
        `)
    })

    $('.collection__product__btn').append(`
        <a href="<?= BASE_LINK ?>/collections/${slugify(name)}"
            class='btn-ghost uppercase tracking-widest text-xs py-5'>
            discover ${name} collection
        </a>
    `)

}

function renderWellWithProducts(products) {
    // Goes Well with product
    $('.well__with__product__name').text(`Goes well with `);
    products.forEach((e) => {
        $('.well__with__product').append(`
            <a href="<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">     
                <div class="product__card">
                    <img src="${e.product_image}" class="h-[350px] mx-2 w-auto object-cover" />
                    <div class="text-center">
                        <p class="line-clamp-2">
                            ${e.name}
                        </p>
                    </div>
                </div>
            </a>
        `)
    })
    $('#well__with__product').append(`
        <button class="gww-prev absolute top-1/2 -translate-y-1/2 z-10 left-5 py-10 bg-slate-200/50 p-3 hover:bg-slate-200/80"
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
        <button class="gww-next absolute top-1/2 -translate-y-1/2 z-10 right-5 py-10 bg-slate-200/50 p-3 hover:bg-slate-200/80"
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
    `)
    $('.well__with__product').slick({
        variableWidth: true,
        infinite: true,
        slidesToScroll: 1,
        arrows: false,
    });
    $(".gww-prev").click(function() {
        $(".well__with__product").slick("slickPrev");
    });

    $(".gww-next").click(function() {
        $(".well__with__product").slick("slickNext");
    });
}
</script>
<script>

</script>


<?php
// Conditional for footer
get_template_part('footer-custom');

?>