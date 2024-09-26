<?php
get_template_part('header-custom');

$character_slug = get_query_var('detail');
?>

<div class="content-container overflow-hidden">
    <div id="product__header"></div>
    <!-- NOTE : PRODUCT Overview -->
    <div class="lg:w-4/5 grid mx-auto md:grid-cols-3 sm:grid-cols-2 grid-cols-1 my-5">
        <div class="text p-3 border-r border-gray-300  product-overview-desc flex justify-center flex-col">
            <div class=""
                 id="product__overview"></div>
            <div class="flex flex-col gap-2 item-center align mt-6 pb-5 mb-5">
                <div class="flex gap-1"
                     id="option_1">
                    <span class="mr-3"
                          id="label_1"></span>
                </div>

                <div class="flex items-center gap-1"
                     id="option_2">
                    <span class="mr-3"
                          id="label_2"></span>
                </div>
            </div>
        </div>
        <div class="border-gray-300 p-3 border-r">
            <h3 class="text-3xl font-medium text-center tracking-wide mb-3">SPECIFICATIONS</h3>
            <table class="product__spec w-full"
                   id="table__spec"></table>
        </div>
        <div class="border-gray-300 p-3">
            <h3 class="text-3xl font-medium text-center tracking-wide mb-3">DOWNLOAD</h3>
            <div id="product__downloadable"
                 class="grid grid-cols-2 gap-4">
            </div>
        </div>
    </div>
    <!-- FIXME : DELETED SLIDER  -->
    <!-- <div class="px-5 py-24 w-1/2"
         style="cursor: auto;">
        <div class=" mx-auto flex flex-row">
            <div class="image__gallery w-full">
                <div class="grid gap-4">
                    <div id="main_slider"
                         class="slick-slider">
                    </div> -->
    <!-- Thumbnail Navigation -->
    <!-- <div id="thumbnail_slider"
                         class="slick-slider mt-2 grid grid-cols-5 gap-4">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="technical__section">
        <div class="technical__img grid grid-cols-3 gap-4"></div>
    </div> -->
    <div class="ambience__section">
        <div class="ambience__img grid grid-cols-3 gap-4"></div>
    </div>

    <div class="inthis__section">
        <div class="collection__product grid grid-cols-4 gap-4"></div>
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
    $.ajax({
        url: `<?= BASE_API; ?>/v1_products_det/<?= $character_slug ?>/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            // TODO ::SKELETON
            $('#page-loading').show();
        },
        success: (res) => {
            console.log(res);
            $('#page-loading').hide();
            // NOTE : PRODUCT HEADER 
            $('#product__header').append(
                `<div class="h-screen w-full transition-all duration-500 "
                    style="
                        background: url('${res.ambience_image[0]}'); 
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
            $('#product__name').html(res.name);
            $('#main__image').attr('src', res.product_image);
            $('#product__desc').html(res.description)

            let allImages = [...res.technical_image, ...res.ambience_image];

            allImages.forEach((url) => {
                $('#main_slider').append(`
                    <div>
                        <a href="${url}"
                            data-fancybox="gallery"
                            data-caption="Image">
                                <img src="${url}"
                                    alt="Image"
                                    class="w-full h-auto">
                        </a>
                    </div>
                `);
                $('#thumbnail_slider').append(`
                    <div>
                        <img src="${url}"
                            alt="Thumbnail"
                            class="w-40 h-auto cursor-pointer">
                    </div>
                `);
            });

            $('#main_slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '#thumbnail_slider'
            });

            $('#thumbnail_slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '#main_slider',
                focusOnSelect: true,
                arrows: false,
                centerMode: true,
                centerPadding: '0',
                variableWidth: true
            });

            if (res.option1 && Array.isArray(res.option1)) {
                $('#label_1').text(res.label1)
                res.option1.forEach(opt => {
                    $('#option_1').append(
                        `<button class="w-10 h-10 rounded-full"
                        style="background-image:url(${opt.img_link})"></button>`
                    );
                });
            }

            if (res.option2 && Array.isArray(res.option2)) {
                $('#label_2').text(res.label2)
                res.option2.forEach(opt2 => {
                    $('#option_2').append(
                        `<button class="w-10 h-10 rounded-full"
                        style="background-image:url(${opt2.img_link})"></button>`
                    );
                });
            }

            // APPEND DIMENSION
            let dimensions = res.dimension;

            // Append overall dimensions
            if (dimensions.ps_overal_dimension) {
                dimensions.ps_overal_dimension.forEach((e) => {
                    $('#table__spec').append(`
                        <tr>
                            <td>Overall - ${e.description}</td>
                            <td> : </td>
                            <td> ${e.width} x ${e.depth} x ${e.height} CM</td>
                        </tr>
                    `);
                });
            }

            // Append box dimensions
            if (dimensions.ps_box_dimension) {
                dimensions.ps_box_dimension.forEach((e) => {
                    $('#table__spec').append(`
                        <tr>
                            <td>Box - ${e.description}</td>
                            <td> : </td>
                            <td>${e.width} x ${e.depth} x ${e.height} CM</td>
                        </tr>
                    `);
                });
            }

            // Append other properties
            if (dimensions.ps_clearance_from_floor) {
                $('#table__spec').append(`
                    <tr>
                        <td>Clearance from Floor</td>
                        <td> : </td>
                        <td>${dimensions.ps_clearance_from_floor}</td>
                    </tr>
                `);
            }
            if (dimensions.ps_table_top_thickness) {
                $('#table__spec').append(`
                    <tr>
                        <td>Table Top Thickness</td>
                        <td> : </td>
                        <td>${dimensions.ps_table_top_thickness}</td>
                    </tr>
                `);
            }
            if (dimensions.ps_distance_between_legs) {
                $('#table__spec').append(`
                    <tr>
                        <td>Distance Between Legs</td>
                        <td> : </td>
                        <td>${dimensions.ps_distance_between_legs}</td>
                    </tr>
                `);
            }
            if (dimensions.ps_arm_height) {
                $('#table__spec').append(`
                    <tr>
                        <td>Arm Height</td>
                        <td> : </td>
                        <td>${dimensions.ps_arm_height}</td>
                    </tr>
                `);
            }
            if (dimensions.ps_seat_height) {
                $('#table__spec').append(`
                    <tr>
                        <td>Seat Height</td>
                        <td> : </td>
                        <td>${dimensions.ps_seat_height}</td>
                    </tr>
                `);
            }
            if (dimensions.ps_seat_depth) {
                $('#table__spec').append(`
                <tr>
                    <td>Seat Depth</td>
                    <td> : </td>
                    <td>${dimensions.ps_seat_depth}</td>
                </tr>
            `);
            }
            if (dimensions.ps_nett_weight) {
                $('#table__spec').append(`
                <tr>
                    <td>Nett Weight</td>
                    <td> : </td>
                    <td>${dimensions.ps_nett_weight}</td>
                </tr>
            `);
            }
            if (dimensions.ps_gross_weight) {
                $('#table__spec').append(`
                <tr>
                    <td>Gross Weight</td>
                    <td> : </td>
                    <td>${dimensions.ps_gross_weight}</td>
                </tr>
            `);
            }
            if (dimensions.ps_pax) {
                $('#table__spec').append(`
                <tr>
                    <td>PAX</td>
                    <td> : </td>
                    <td>${dimensions.ps_pax}</td>
                </tr>
            `);
            }
            if (dimensions.ps_20ft_container) {
                $('#table__spec').append(`
                <tr>
                    <td>20ft Container</td>
                    <td> : </td>
                    <td>${dimensions.ps_20ft_container}</td>
                </tr>
            `);
            }
            if (dimensions.ps_40hq_container) {
                $('#table__spec').append(`
                <tr>
                    <td>40HQ Container</td>
                    <td> : </td>
                    <td>${dimensions.ps_40hq_container}</td>
                </tr>
            `);
            }
            if (dimensions.cbm) {
                $('#table__spec').append(`
                <tr>
                    <td>CBM</td>
                    <td> : </td>
                    <td>${dimensions.cbm}</td>
                </tr>
            `);
            }

            $('.image__spec').append(`
                <img src="${res.spec_image}"
                    alt="specification product"
                    height="512"
                    width="512" />
            `)

            res.ambience_image.forEach((e) => {
                $('.ambience__img').append(`
                    <div>
                        <img src="${e}"
                            class="h-[350px] mx-2 w-auto object-cover" />
                    </div>
                `)
            })

            $('.ambience__img').slick({
                slidesToScroll: 1,
                variableWidth: true,
                infinite: true,
                arrows: false,
            });
            res.technical_image.forEach((e) => {
                $('.technical__img').append(`
                <img src="${e}"
                    class="mr-2" />
                `)
            })

            $('.technical__img').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
            });

            res.collection_product.forEach((e) => {
                $('.collection__product').append(`
                <div class="product__card">
                    <img src="${e.product_image}" />
                </div>
                `)
            })

            $('.collection__product').slick({
                slidesToShow: 4.1,
                slidesToScroll: 1,
                arrows: false,
            });
        },
        error: (xhr, status, error) => {
            console.error('Error fetching data:', error);
        }
    });
});

function renderOverview(res) {
    if (res.name) {
        $('#product__overview').append(`
            <h1 class="text-3xl font-semibold text-gray-900 tracking-wide mb-3">${res.name}</h1>
            <p class="text-center"> ${res.description}</p>
        `);
    }
    if (Array.isArray(res.ambience_image) && res.ambience_image.length > 0) {
        $('#product__ambience').append(`
            <img src="${res.ambience_image[0]}" alt="${res.name}" class="w-full h-auto rounded-xl"/>
        `);
    }
    if (res.asset3d !== null) {
        if (res.asset3d.drawing_3d_dwg) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${res.asset3d.drawing_3d_dwg}" class="text-slate-500 hover:text-slate-400">DWG</a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (res.asset3d.drawing_3d_obj) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${res.asset3d.drawing_3d_obj}" class="text-slate-500 hover:text-slate-400">OBJ</a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (res.asset3d.drawing_3d_3dmax) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${res.asset3d.drawing_3d_3dmax}" class="text-slate-500 hover:text-slate-400">3DMAX</a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (res.asset3d.drawing_3d_sketchup) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${res.asset3d.drawing_3d_sketchup}" class="text-slate-500 hover:text-slate-400">SKETCHUP</a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
        if (res.asset3d.file_3d_glb) {
            $('#product__downloadable').append(`
                <div>
                    <a href="${res.asset3d.file_3d_glb}" class="text-slate-500 hover:text-slate-400">GLB</a>
                    <hr class="my-1 me-6 border-slate-300 "/>
                </div>
            `);
        }
    }
}
</script>

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

<?php
// Conditional for footer
get_template_part('footer-custom');

?>