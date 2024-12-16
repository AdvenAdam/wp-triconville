<?php
    $character_slug = get_query_var('collection');

    $url = BASE_API . '/v1_collections_det_slug/' . $character_slug . '/';
    $headers = array(
        'Authorization' => API_KEY,
    );
    $response = wp_remote_get($url, array(
        'headers' => $headers,
    ));

    if (is_wp_error($response)) {
        echo 'Error fetching data: ' . $response->get_error_message();
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    echo '<title>' . esc_attr($data['meta_title']) . '</title>';
    echo '<meta name="description" content="' . esc_attr($data['meta_description']) . '"/>';
    echo '<meta name="keywords" content="' . esc_attr($data['meta_keyword']) . '"/>';
    get_template_part('header-custom');

?>
<div class="content-container ">
    <div id="collection__header"></div>
    <div id="container__<?=$character_slug ?>"></div>
    <div class="mb-10 md:mb-20 lg:mb-36 px-5 md:px-8">
        <div class="max-w-[1440px] mx-auto"
             data-aos="fade-up"
             data-aos-once="true"
             data-aos-duration="1000">
            <h1 class="text-2xl md:text-3xl mb-5 ms-1">More From Our Collection</h1>
            <div class="relative group h-fit"
                 id="project__slider__wrapper">
                <div id="project__slider_1"
                     class=" ">
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-5">
            <a href="<?= BASE_LINK; ?>/collections/"
               class='btn-ghost uppercase text-sm mt-5'> view all collections</a>
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
    try {
        $('#page-loading').show();
        const res = <?php echo json_encode($data); ?>;
        selectedCollection = selectedCollection.filter(data => data.collection_id == res.collection_id);
        collectionData = {
            ...res,
            ...selectedCollection[0]
        };
    } catch (error) {
        if (error.status === 404) {
            redirectError(404)
        }
        console.error('Error fetching data:', error);
    } finally {
        $('#page-loading').hide();
        renderMaster();
    }
};

// NOTE : Handling Render
function renderMaster() {
    $('#collection__header').append(`
        <section class="banner mb-5 relative">
            <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/${collectionData.image_banner}" alt="${collectionData.display_name}" class="w-full h-screen object-cover">
            <div class='bg-black bg-opacity-25 h-full w-full absolute inset-0 flex items-center justify-center'>
                <h1 class='text-white text-3xl lg:text-5xl pt-16 font-medium capitalize'>${collectionData.display_name}</h1>
            </div>
        </section>
    `)
    $('#container__<?= $character_slug ?>').append(`
        <div class="px-5 md:px-8">
            <div class="max-w-[1440px] mx-auto">
                <section class="collection__description my-5 md:my-10 lg:my-28" 
                    data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="1000"
                >
                    <div class="collection__description-content max-w-3xl mx-auto lg:text-center">
                        <h1 class="text-3xl lg:text-5xl mx-auto capitalize">${collectionData.display_name}</h1>
                        <p class="text-sm mt-2 mb-10">${collectionData.description}</p>
                        ${collectionData.sheet !== 'False' ? `
                            <a href="${collectionData.sheet}" target="_blank" class='btn-ghost-dark uppercase text-sm flex items-center gap-2 w-fit lg:mx-auto'>
                                download collection sheet
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pb-1 group-hover:text-slate-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                        `:''}
                    </div>
                </section>
            </div>
        </div>
        <div class="ambience__section relative mb-10 md:mb-20 lg:mb-36 group cursor-pointer"
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="1000"
        >
            <div class="ambience__img"></div>
            <button class="slick-prev ambiance-prev hidden lg:block invisible group-hover:visible opacity-0 group-hover:opacity-100 left-5 arrow-btn"
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
            <button class="slick-next ambiance-next hidden lg:block invisible group-hover:visible opacity-0 group-hover:opacity-100 right-5 arrow-btn"
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
        
        <div class="px-5 md:px-8">
            <div class="max-w-[1440px] mx-auto">
                <section class="collection__product relative mt-10 mb-10 md:mb-20 lg:mb-36">
                    <h3 class="text-2xl md:text-3xl tracking-wide"
                        data-aos="fade-up"
                        data-aos-once="true"
                        data-aos-duration="1000"
                    >
                        Products on ${collectionData.display_name} Collection
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 mt-5 gap-4 justify-center container mt-5 mb-10">
                        ${collectionData.product_list.map((pr, i) => `
                            <a href="<?= BASE_LINK; ?>/product-detail/${slugify(pr.name)}" class='flex justify-center items-center flex-col group'
                                data-aos="fade-up"
                                data-aos-once="true"
                                data-aos-duration="1000"
                            >
                                <img class="w-auto md:h-[384px] h-[240px] object-contain group-hover:scale-[.97] group-hover:brightness-110 transition duration-300" src="${pr.product_image_384}" />
                                <p class="text-center text-sm md:mt-[-30px] max-w-[90%] -mt-5 sm:-mt-10 lg:-mt-16 xl:-mt-10 relative z-10 capitalize group-hover:underline">${filterProductName(pr.name)}</p>
                            </a>
                        `).join('')}
                    </div>
                </section>
            </div>
        </div>
    `);
    renderImages()
    loadMoreCollections();
}

function renderImages() {
    $(document).ready(function() {
        collectionData.ambience_image.forEach((img) => {
            $('.ambience__img').append(`
                <img src="${img.image_1920}"
                    class="!h-[350px] sm:!h-[600px] lg:!h-[720px] me-2 mx-2 w-screen md:w-auto object-cover" />
            `)
        })
        if (collectionData.ambience_image.length > 1) {
            // Init Slick
            $('.ambience__img').slick({
                slidesToScroll: 1,
                variableWidth: true,
                arrows: false,
                centerMode: false,
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
            $(".ambiance-prev").click(function() {
                $(".ambience__img").slick("slickPrev");
            });
            $(".ambiance-next").click(function() {
                $(".ambience__img").slick("slickNext");
            });
        } else {
            $('.ambience__img').addClass('flex justify-center');
            $('.ambiance-prev').remove();
            $(".ambiance-next").remove();
        }
    })
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
        <a href= "<?= BASE_LINK; ?>/collections/${slugify(collection.name)}" class="mx-1 md:mx-2 ">
            <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/${collection.image_grid}" 
                class="w-auto h-auto object-cover hover:brightness-110 transition duration-300" />
            <h4 class='text-sm mt-4 mb-2'>
                ${collection.id < 10 ? '0' + (collection.id) : collection.id}. 
            </h4>
            <hr class='w-2/5 border-black'/>
            <h1 class="text-3xl lg:text-5xl font-medium capitalize my-2">${collection.display_name}</h1>
            <h3 class='text-base line-clamp-2 text-ellipsis'>
                ${collection.description}
            </h3>
        </a>
    `);
}

function moreCollectionSlick() {
    $(document).ready(function() {
        $("#project__slider__wrapper").append(`
            <button class="slick-prev prev-btn hidden lg:block invisible group-hover:visible opacity-0 group-hover:opacity-100 left-5 !bg-slate-50/80 !hover:bg-slate-50/100 arrow-btn"
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
            <button class="slick-next next-btn hidden lg:block invisible group-hover:visible opacity-0 group-hover:opacity-100 right-5 !bg-slate-50/80 hover:!bg-slate-50/100 arrow-btn"
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
        $("#project__slider_1").slick({
            slidesToScroll: 1,
            slidesToShow: 2,
            arrows: false,
            infinite: false,
            responsive: [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1.02,
                }
            }, {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 2.02,
                }
            }, ]

        });
        $(".prev-btn").click(function() {
            $("#project__slider_1").slick("slickPrev");
        });
        $(".next-btn").click(function() {
            $("#project__slider_1").slick("slickNext");
        });
    });
}
</script>

<?php
// Conditional for footer
get_template_part('footer-custom');

?>