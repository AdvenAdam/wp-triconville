<?php
$character_slug = get_query_var('detail');
echo '<title>' . ucfirst( slugToTitleCase($character_slug) ) . ' | ' . wp_kses_data( get_bloginfo( 'name', 'display' ) ) . '</title>';
get_template_part('header-custom');

?>

<div class="content-container mt-16 md:mt-20">
    <div id="product__banner"></div>
    <!-- NOTE : PRODUCT Overview & Material -->
    <div data-aos="fade-up"
         data-aos-once="true"
         data-aos-duration="1000">
        <div class=" grid grid-cols-1 md:grid-cols-2 items-center gap-10 md:gap-8 mb-10">
            <div class="">
                <div id="product__header__image"></div>
            </div>
            <div class="px-3 md:px-0 max-w-xl mt-5 md:mt-0 "
                 id="product__description">
                <div class="mb-16 "
                     id="product__overview"></div>
                <p class="mr-3 uppercase mb-2 text-xs"
                   id="label_1"></p>
                <div class="flex mb-6 flex-wrap gap-1 md:gap-4"
                     id="option_1">
                </div>
                <p class="mr-3 uppercase mb-2 text-xs"
                   id="label_2"></p>
                <div class="flex mb-6 md:mb-16 flex-wrap items-center gap-1 md:gap-4"
                     id="option_2">
                </div>

            </div>
        </div>
    </div>
    <!-- NOTE : PRODUCT Ambience Slider -->
    <div class="ambience__section relative mb-10 md:mb-20"
         data-aos="fade-up"
         data-aos-once="true"
         data-aos-duration="1000">
        <div class="ambience__img h-[350px] sm:h-[600px] lg:h-[720px]"></div>
        <button class="slick-prev prev-btn hidden md:block left-5  arrow-btn"
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
        <button class="slick-next next-btn hidden md:block right-5 arrow-btn"
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
    <div class="md:px-5 px-3 "
         id="specification__link"
         data-aos="fade-up"
         data-aos-once="true"
         data-aos-duration="1000">
        <div class="max-w-[1440px] mx-auto grid items-center gap-4 grid-cols-1 md:grid-cols-2 py-10 md:py-20 lg:py-32"
             id="specification__section">

        </div>
    </div>
    <!-- NOTE : PRODUCT IN THIS SECTION -->
    <div class="md:px-5 px-3 mb-10 md:mb-20">
        <div class="max-w-[1440px] mx-auto">
            <div class="py-10 md:pb-20">
                <h2 class='text-3xl collection__product__name'
                    data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="1000"></h2>
                <div class="collection__product grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-16"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000"></div>
                <div class="collection__product__btn text-center"></div>
            </div>
            <div class="py-10 md:pb-20 relative h-fit hidden"
                 id="releted__products">
                <h2 class='text-2xl md:text-3xl releted__products__name'></h2>
                <div class="releted__products my-10"></div>
                <div class="releted__products__btn text-center"></div>

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
let collectionData = [];
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
            console.log("🚀 ~ jQuery ~ ProductsData:", ProductsData)
        },
        error: (xhr, status, error) => {
            if (xhr.status === 404) {
                redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            renderMaster();
            metaMaster();
            $('#page-loading').hide();
        }
    });
});

function metaMaster() {
    ['title', 'description', 'keyword'].forEach(key => {
        if (ProductsData[`meta_${key}`] !== 'False') {
            $(`<meta name="${key}" content="${ProductsData[`meta_${key}`]}"/>`).appendTo('head');
        }
    });
}

function renderMaster() {
    try {
        // NOTE : PRODUCT HEADER 
        $('#product__banner').append(
            `<div class="full-screen w-full"
                style="
                    background: url('${ProductsData.ambience_image_1920[0]}'); 
                    background-position: 50% 50%;
                    background-size: cover;
                    background-repeat: no-repeat;
                ">
                <div class ='bg-black bg-opacity-10 h-full w-full flex items-center justify-center'>
                    <h1 class="text-3xl md:text-5xl font-medium text-center text-white capitalize">${filterProductName(ProductsData.name)}</h1>
                </div>
            </div>`
        );
        // NOTE :PRODUCT OVERVIEW
        renderOverview(ProductsData);
        renderMaterial(ProductsData.combineoptionvariant);
        // APPEND DIMENSION
        renderDimensions(ProductsData.dimension);
        renderDownloadable(ProductsData.asset3d, ProductsData.product_image, ProductsData.collection_sheet);
        renderImages(ProductsData);
        if (Array.isArray(ProductsData.collection_product) && ProductsData.collection_product.length > 0) {
            renderCollectionProducts(ProductsData.collection_product.slice(0, 4), ProductsData.collection_det);
        }
        // FIXME : Related Product
        if (Array.isArray(ProductsData.related_product) && ProductsData.related_product.length > 0) {
            renderRelatedProducts(ProductsData.related_product);
        }
        renderSheet(ProductsData.collection_sheet);

    } catch (error) {
        console.error("🚀 ~ renderMaster ~ error:", error)
        // redirectError()
    }
}

function renderSheet(sheet) {
    $('#product__description').append(`
        <div class="flex gap-2">
            ${sheet !== 'False' || sheet !== null ?
            `<a href="${sheet}"
                class="btn-ghost-dark uppercase flex items-end gap-2"> <p class="text-white text-xs">download collection sheet</p> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
    
            </a>`
            :''}
            <a href="<?= BASE_LINK; ?>/find-a-store/"
                class="btn-ghost flex items-end uppercase"><p class="text-xs">Find Store</p></a>
        </div>
    `);
}

function changeSize(size) {
    $('.sizing-btn button').removeClass('btn-ghost-dark').addClass('btn-ghost');

    if (size == 'metric') {
        $('#table__spec').empty();
        $('#metric').removeClass('btn-ghost').addClass('btn-ghost-dark');
        renderDimensions(ProductsData.dimension, "only size");
    } else {
        $('#table__spec').empty();
        $('#imperial').removeClass('btn-ghost').addClass('btn-ghost-dark');
        renderDimensions(ProductsData.dimension_imperial, "only size");
    }
}

function renderMaterial(res) {
    if (res.option1 && Array.isArray(res.option1)) {
        $('#label_1').text(res.label1)
        res.option1.forEach(opt => {
            $('#option_1').append(
                `<div class="group cursor-pointer relative" id="${opt.code}">
                    <div id="tooltip-${opt.code}" class=" absolute -top-16 sm:-left-10 w-fit z-10 invisible group-hover:visible inline-block bg-gray-900 rounded-lg shadow-sm opacity-0 group-hover:opacity-100 ">
                        <p class="px-3 py-2 font-medium text-white w-[180px] line-clamp-2">${opt.name}</p>
                    </div>
                    <img src="${opt.img_link}" class="w-16 md:w-20 h-16 md:h-20 object-contain"/>
                </div>`
            );
        });

    }

    if (res.option2 && Array.isArray(res.option2)) {
        $('#label_2').text(res.label2)
        res.option2.forEach(opt => {
            $('#option_2').append(
                `<div class="group cursor-pointer relative" id="${opt.code}">
                    <div id="tooltip-${opt.code}" class=" absolute -top-16 sm:-left-10 w-fit z-10 invisible group-hover:visible inline-block bg-gray-900 rounded-lg shadow-sm opacity-0 group-hover:opacity-100 ">
                        <p class="px-3 py-2 font-medium text-white w-[180px] line-clamp-2">${opt.name}</p>
                    </div>
                    <img src="${opt.img_link}" class="w-16 md:w-20 h-16 md:h-20 object-contain"/>
                </div>`
            );
        });

    }

}

function renderOverview(res) {
    // TODO : make init the img Prod image base on Variant
    const baseImgUrl = `https://storage.googleapis.com/pimassest1/configurator/${res.sku}/1024/`

    const swatchOpt = ProductsData.combineoptionvariant
    const isTwoSwatch = swatchOpt.option2.length > 0


    $('#product__header__image').append(`
        <div class="text-center mx-auto ">
            <img src="${res.product_image}" alt="${res.name}" class="w-auto h-[350px] lg:h-[720px] xl:h-[870px] m-2 object-contain"/>
        </div>
    `)
    if (res.name) {
        const desc = res.description.replace(/<\/?p[^>]*>/g, '').replace(/<li[^>]*>(.*?)<\/li>/g, '')
        $('#product__overview').append(`
            <div class='max-w-xl'>
                <h1 class="text-2xl md:text-3xl text-gray-900 line-clamp-2">${filterProductName(res.name)}</h1>
                <p class="text-slate-500 mb-4">Designed by 
                    <span class="text-black font-medium underline"><a href="https://indospacegroup.com/indospace-rnd/" target="_blank">Indospace R&D </a></span>
                </p>
                <p class="line-clamp-4">${desc}</p>
            </div>
        `);
    }
    if (Array.isArray(res.ambience_image) && res.ambience_image.length > 0) {
        $('#product__ambience').append(`
            <img src="${res.ambience_image[0]}" alt="${res.name}" class="w-full h-auto rounded-xl"/>
        `);
    }
}

function renderDimensions(dimensions, render = "all") {
    if (dimensions && render == "all") {
        $('#specification__section').append(`
            <div class=""
                 id="image__spec">
            </div>
            <div class="lg:ps-3 xl:ps-5">
                <div >
                    <div class="flex md:flex-row flex-col items-start justify-between mb-6">
                        <h3 class="text-2xl md:text-3xl line-clamp-2">Sizing</h3>
                        <div class="flex items-center sizing-btn">
                            <button class="btn-ghost-dark !py-2 uppercase text-sm"
                                onClick="changeSize('metric')"
                                id="metric">Metric</button>
                            <button class="btn-ghost !py-2 uppercase text-sm"
                                onClick="changeSize('imperial')"
                                id="imperial">Imperial</button>
                        </div>
                    </div>
                    <table class="product__spec w-full md:text-sm text-xs tracking-wider text-[#4D4D4D] mb-16"
                           id="table__spec"></table>
                </div>
                <div id="product__download__container">
                    <h3 class="text-2xl md:text-3xl mb-6 line-clamp-2">Downloads</h3>
                    <div id="product__downloadable"
                         class="grid grid-cols-2 gap-4">
                    </div>
                    <p class="text-[#798F98] mt-5">Please <span class="underline"><a href="https://indospaceb2b.com/"" target="_blank">login</a></span> to access all downloadable contents</p>
                </div>
            </div>
        `)
    }
    // Append overall dimensions
    if (dimensions.ps_overal_dimension) {
        dimensions.ps_overal_dimension.forEach((e) => {
            $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>Overall - ${e.description}</td>
                    <td class='md:px-3'> : </td>
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
                    <td class='w-1/2 pt-2'>Box - ${e.description}</td>
                    <td class='md:px-3'> : </td>
                    <td>${e.width} x ${e.depth} x ${e.height}</td>
                </tr>
            `);
        });
    }
    // Append other properties
    if (dimensions.ps_clearance_from_floor) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2 pt-2'>Clearance from Floor</td>
                        <td class='md:px-3'> : </td>
                        <td>${dimensions.ps_clearance_from_floor}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_table_top_thickness) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2 pt-2'>Table Top Thickness</td>
                        <td class='md:px-3'> : </td>
                        <td>${dimensions.ps_table_top_thickness}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_distance_between_legs) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2 pt-2'>Distance Between Legs</td>
                        <td class='md:px-3'> : </td>
                        <td>${dimensions.ps_distance_between_legs}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_arm_height) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2 pt-2'>Arm Height</td>
                        <td class='md:px-3'> : </td>
                        <td>${dimensions.ps_arm_height}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_seat_height) {
        $('#table__spec').append(`
                    <tr>
                        <td class='w-1/2 pt-2'>Seat Height</td>
                        <td class='md:px-3'> : </td>
                        <td>${dimensions.ps_seat_height}</td>
                    </tr>
                `);
    }
    if (dimensions.ps_seat_depth) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>Seat Depth</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_seat_depth}</td>
                </tr>
            `);
    }
    if (dimensions.ps_nett_weight) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>Nett Weight</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_nett_weight}</td>
                </tr>
            `);
    }
    if (dimensions.ps_gross_weight) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>Gross Weight</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_gross_weight}</td>
                </tr>
            `);
    }
    if (dimensions.ps_pax) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>PAX</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_pax}</td>
                </tr>
            `);
    }
    if (dimensions.ps_20ft_container) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>20ft Container</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_20ft_container}</td>
                </tr>
            `);
    }
    if (dimensions.ps_40hq_container) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>40HQ Container</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.ps_40hq_container}</td>
                </tr>
            `);
    }
    if (dimensions.cbm) {
        $('#table__spec').append(`
                <tr>
                    <td class='w-1/2 pt-2'>CBM</td>
                    <td class='md:px-3'> : </td>
                    <td>${dimensions.cbm}</td>
                </tr>
            `);
    }

}

function renderDownloadable(asset3d, product_image, collection_sheet) {
    if (product_image) {
        $('#product__downloadable').append(`
            <div>
                <a href="${product_image}"
                    target="_blank"
                    class="text-slate-700 text-sm">
                    <div class='flex group items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1 group-hover:text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <p class="group-hover:text-slate-400">HD Images</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (collection_sheet) {
        $('#product__downloadable').append(`
            <div>
                <a href="${collection_sheet}"
                    target="_blank"
                    class="text-slate-700  text-sm">
                    <div class='flex group items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1 group-hover:text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <p class="group-hover:text-slate-400">Collection Sheet</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (asset3d.drawing_3d_dwg) {
        $('#product__downloadable').append(`
            <div>
                <div class="text-[#798F98] cursor-not-allowed text-sm">
                    <div class='flex items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p class="text-[#798F98]">DWG</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (asset3d.drawing_3d_obj) {
        $('#product__downloadable').append(`
            <div>
                <div class="text-[#798F98] cursor-not-allowed text-sm">
                    <div class='flex items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p class="text-[#798F98]">3D OBJ</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (asset3d.drawing_3d_3dmax) {
        $('#product__downloadable').append(`
            <div>
                <div class="text-[#798F98] cursor-not-allowed text-sm">
                    <div class='flex items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p class="text-[#798F98]">3D MAX</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (asset3d.drawing_3d_sketchup) {
        $('#product__downloadable').append(`
            <div>
                <div class="text-[#798F98] cursor-not-allowed text-sm">
                    <div class='flex items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p class="text-[#798F98]">SKETCHUP</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
    if (asset3d.file_3d_glb) {
        $('#product__downloadable').append(`
            <div>
                <div class="text-[#798F98] cursor-not-allowed text-sm">
                    <div class='flex items-center gap-2'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p class="text-[#798F98]">GLB</p>
                    </div>
                </a>
                <hr class="mt-3 me-6 border-slate-300 "/>
            </div>
        `);
    }
}

function renderImages(images) {
    if (images.ambience_image_1920.length > 0) {
        images.ambience_image_1920.forEach((e) => {
            $('.ambience__img').append(`
                <img src="${e}"
                    class="h-full me-2 mx-2 w-screen md:w-auto object-cover" />
            `)
        })
        $('.ambience__img').slick({
            slidesToScroll: 1,
            variableWidth: true,
            arrows: false,
            centerMode: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    centerMode: false,
                    slidesToShow: 1.02,
                    slidesToScroll: 1,
                    variableWidth: false,
                }
            }]
        });
        $(".prev-btn").click(function() {
            $(".ambience__img").slick("slickPrev");
        });
        $(".next-btn").click(function() {
            $(".ambience__img").slick("slickNext");
        });
    } else {
        $('.ambience__section').hide();
    }
    if (images.spec_image) {
        // Spec image
        $('#image__spec').append(`
            <img src="${images.spec_image}"
                alt="specification product"
                class="h-auto w-full"
                />
        `)
    }
}

function renderCollectionProducts(products, name) {
    // Collection product
    $('.collection__product__name').text(`In ${filterProductName(name)} Collection`);
    products.forEach((e) => {
        $('.collection__product').append(`
            <a href="<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">     
                <div class="product__card group">
                    <img src="${e.product_image}" class="md:h-[384px] h-[204px] object-contain w-auto object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300" />
                    <p class="text-center w-full md:-mt-3 mx-auto capitalize group-hover:underline">
                        ${filterProductName(e.name)}
                    </p>
                </div>
            </a>
        `)
    })

    $('.collection__product__btn').append(`
        <a href="<?= BASE_LINK ?>/collections/${slugify(name)}"
            class='btn-ghost uppercase text-xs'>
            discover ${name} collection
        </a>
    `)

}

function renderRelatedProducts(products) {
    // Goes Well with product
    $('#releted__products').removeClass('hidden');
    $('.releted__products__name').text(`Related Products`);
    products.forEach((e) => {
        $('.releted__products').append(`
            <a href="<?= BASE_LINK; ?>/product-detail/${slugify(e.name)}">     
                <div class="product__card group">
                    <img src="${e.product_image}" class="md:h-[384px] h-[204px] object-contain w-auto object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300" />
                    <p class="text-center w-full md:-mt-3 mx-auto capitalize group-hover:underline">
                        ${filterProductName(e.name)}
                    </p>
                </div>
            </a>
        `)
    })
    $('#releted__products').append(`
        <button class="gww-prev left-5 arrow-btn"
                aria-label="Previous"
                type="button">
            <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-w1.5"1.5"
                    stroke="currentColor"
                    class="h-10 w-10">
                <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>
        <button class="gww-next right-5 arrow-btn"
                aria-label="Next"
                type="button">
            <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-w1.5"1.5"
                    stroke="currentColor"
                    class="h-10 w-10">
                <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    `)
    $('.releted__products').slick({
        variableWidth: true,
        infinite: true,
        slidesToScroll: 1,
        arrows: false,
    });
    $(".gww-prev").click(function() {
        $(".releted__products").slick("slickPrev");
    });

    $(".gww-next").click(function() {
        $(".releted__products").slick("slickNext");
    });
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>