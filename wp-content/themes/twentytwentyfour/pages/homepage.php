<?php
/*
Template Name: Homepage
*/
get_template_part('header-custom');

// get latest 3 news
$posts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=news');
?>
<style>
.homepage-banner {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/collection/banner-list/marlow.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.news-image img {
    height: 300px !important;
    width: 100% !important;
    object-fit: cover;
}

.bg-ceramic {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/backgrounds/ifex-left-banner.jpeg');
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.right-banner {
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/backgrounds/ifex-right-banner.jpeg');
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

@media (max-width: 768px) {
    .news-image img {
        height: 230px !important;
    }
}

@media (max-width: 640px) {
    .news-image img {
        height: 130px !important;
    }
}
</style>
<div class="content-container overflow-hidden">
    <div class="homepage-banner px-5 md:px-8 mt-16 md:mt-20 py-12 full-screen w-screen max-h-[35vh] md:max-h-[calc(30vh+5rem)] lg:min-h-[720px] lg:max-h-[1020px]">
        <div class="hidden lg:flex items-center justify-center h-full w-full">
            <div class="text-center"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="100"
                 data-aos-duration="1000">
                <h1 class="text-3xl lg:text-5xl">Triconville Debuts at IFEX 2025</h1>
                <h3 class="text-base">Join us at Indonesia's premier furniture & craft exhibition!</h3>
                <div class="flex gap-3 justify-center mt-5">
                    <a href="https://ifexindonesia.com/visitor/show-preview/919"
                       target="_blank"
                       class="btn-ghost-light uppercase text-sm flex items center gap-1">find us on IFEX
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 text-xs">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>

                    </a>
                    <a href="<?= BASE_LINK ?>/news/triconville-debuts-at-ifex-2025"
                       target="_blank"
                       class="btn-ghost-dark uppercase text-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- NOTE IFEX MOBILE  -->
    <div class="px-5 md:px-8 py-10 md:py-20 lg:hidden">
        <div data-aos="fade-up"
             data-aos-once="true"
             data-aos-delay="100"
             data-aos-duration="1000">
            <div class="text-center">
                <h1 class="text-3xl lg:text-5xl">Triconville Debuts at IFEX 2025</h1>
                <h3 class="text-base">Join us at Indonesia's premier furniture & craft exhibition!</h3>
            </div>
            <div class="flex gap-3 flex-col-reverse md:flex-row justify-center md:items-center mt-5">
                <a href="https://ifexindonesia.com/visitor/show-preview/919"
                   target="_blank"
                   class="btn-ghost uppercase text-sm flex justify-center gap-1">find us on IFEX
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="size-4 text-xs">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>

                </a>
                <a href="<?= BASE_LINK ?>/news/triconville-debuts-at-ifex-2025"
                   target="_blank"
                   class="btn-ghost-dark uppercase text-sm text-center">Learn More</a>
            </div>
        </div>
    </div>
    <div class="px-5 md:px-8">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid lg:grid-cols-2 items-center pt-20 gap-8"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="txt max-w-xl py-5 order-last lg:order-first">
                    <h2 class='text-2xl lg:text-3xl'>
                        20 Years of Excellence Experience on Outdoor Living
                    </h2>
                    <p class="mt-3 mb-12">
                        For decades, Triconville has grown steadily, rooted in core values that honor tradition, quality, and integrity, and guided by a global vision—bringing timeless, handcrafted pieces to homes and spaces around the world.
                    </p>
                    <a href="<?= BASE_LINK ?>/about-us"
                       class='btn-ghost uppercase tracking-widest text-xs'>
                        learn about our Brand
                    </a>
                </div>
                <div class="image">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/home/Hompage_BrandSection.jpg"
                         alt="Triconville story"
                         class="w-full h-full object-cover" />
                </div>
            </div>
            <!-- NOTE : Collection & Inclass="text-3xl lg:text-5xl">Triconville Debuts at IFEX 2025</h1>
                 <h3 spiration & News List &Catalog -->
            <!-- ANCHOR : Collection -->
            <div class="mt-20 lg:mt-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <p class="text-center text-xs uppercase tracking-widest">Collections</p>
                <h2 class="text-center text-2xl lg:text-3xl mb-8">Signature Selections for Every Style</h2>

                <div class="block lg:grid lg:grid-cols-2 gap-3 mt-5 mb-10 collection__wrapper "
                     id="colection-selected"></div>
                <div class="text-center">
                    <a href="<?= BASE_LINK ?>/collections"
                       class='btn-ghost uppercase text-xs tracking-widest'>
                        all collections
                    </a>
                </div>
            </div>
            <!-- ANCHOR : Inspiration -->
            <div class="mt-20 lg:mt-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <p class="text-center text-xs uppercase tracking-widest">INSPIRATION</p>
                <h2 class="text-center text-2xl lg:text-3xl mb-8">The Art of Outdoor Living</h2>

                <div class="grid grid-cols-3 gap-1 sm:gap-3 mt-5 mb-10"
                     id="inspiration-selected"></div>
                <div class="text-center">
                    <a href="<?= BASE_LINK ?>/inspiration"
                       class='btn-ghost uppercase text-xs tracking-widest'>
                        Get Inspired
                    </a>
                </div>
            </div>
            <!-- ANCHOR : Moods  -->
            <div class="mt-20 lg:mt-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <div class="max-w-xl order-last lg:order-first">
                        <p class="text-xs uppercase tracking-widest mb-2">MOODS</p>
                        <h2 class="text-2xl lg:text-3xl">Your World, Your Style, Your Outdoors.</h2>
                        <p class=" mt-3 mb-10">We believe every outdoor space has a story to tell. It should be as unique as you are. Hence we've curated a diverse collection of furniture styles to complement any outdoor space and reflect your personal taste:</p>
                        <a href="<?= BASE_LINK ?>/moods"
                           class='btn-ghost uppercase text-xs tracking-widest'>
                            EXPLORE MOODS
                        </a>
                    </div>
                    <div>
                        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/moods/All-Moods.png"
                             alt="all Moods image"
                             class="w-full h-auto" />
                    </div>
                </div>
            </div>
            <!-- ANCHOR : News List -->
            <div class="pt-20 lg:pt-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="text-center mx-auto max-w-2xl mb-5">
                    <p class="uppercase tracking-widest text-xs">news </p>
                    <h4 class="text-2xl lg:text-3xl mb-8">
                        Our Latest News
                    </h4>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-6 items-start"
                     id="news-selected">
                    <?php foreach ($posts as $post): ?>
                    <div class="w-full max-w-xl order-last lg:order-first group"
                         data-aos="fade-up"
                         data-aos-once="true"
                         data-aos-duration="1000">
                        <a href="<?php the_permalink(); ?>"
                           class="">
                            <div class="relative hover:cursor-pointer w-full">
                                <?php the_post_thumbnail('full', array('class' => 'h-auto w-full min-h-[25vh] xl:min-h-[35vh] object-cover')); ?>
                                <div class="overlay absolute inset-0 bg-gradient-to-b from-transparent to-black/30 invisible group-hover:visible"></div>
                            </div>
                        </a>
                        <p class="text-xs text-gray-500 mt-4">
                            <?php the_time('F j, Y'); ?>
                        </p>
                        <h3 class="news-title my-2 text-2xl min-h-16 group-hover:underline">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                    <?php  endforeach; ?>
                </div>
                <div class="text-center mt-10 lg:mt-0">
                    <a href="<?= BASE_LINK ?>/news"
                       class="btn-ghost uppercase text-xs tracking-widest">All News</a>
                </div>
            </div>
            <!-- ANCHOR : Catalog -->
            <div class="mb-20 lg:mb-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="grid lg:grid-cols-2 gap-8 items-center pt-10 lg:pt-48">
                    <div class="max-w-xl order-last lg:order-first ">
                        <div class="request-catalog transition duration-500 ease-in-out">
                            <p class="uppercase text-xs tracking-widest mb-2">catalog</p>
                            <h2 class="text-2xl lg:text-3xl">Triconville - 2024 Catalog</h2>
                            <p class=" mt-3 mb-12">
                                Discover an unrivaled selection of luxuriant designs from Triconville. Brought to life with captivating imagery,
                                the 2024 Triconville catalogue is a go-to resource for inspiration and information. Qualified trade members can
                                reserve a copy by filling out the form below.
                            </p>
                            <a onClick="requestCatalog('form')"
                               class="btn-ghost uppercase text-xs">Request Catalog</a>
                        </div>
                        <div class="request-catalog-form invisible opacity-0 h-0 transition duration-500 ease-in-out delay-150">
                            <h2 class="text-2xl lg:text-3xl">Complete the Form to Receive Your Triconville Catalog</h2>
                            <p class=" mt-3 mb-6">
                                Please complete your company details, and once verified, we'll deliver the Triconville Catalog directly to your company email.
                            </p>
                            <?php echo do_shortcode('[contact-form-7 id="' . ( ENV === 'development' ? '56c4394' : '56c4394' ) . '" title="request catalogue"]'); ?>

                        </div>
                        <div class="request-catalog-success invisible opacity-0 h-0 transition duration-500 ease-in-out delay-100">
                            <h2 class="text-2xl lg:text-3xl">Thank You for Your Request!</h2>
                            <p class=" mt-3 mb-6">
                                We’ve received your details and are reviewing them. Once verified, your catalog will be on its way to your company email. </p>
                        </div>

                    </div>
                    <div class="">
                        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/home/Home%20Catalogue.jpg"
                             class="w-auto h-auto object-cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="errorIndicator"
     class="hidden">Error</div>
</div>
</div>
<script>
let selectedCollectionIds = [];
let filteredCollections = [];
let inspirationList = [];
let moodList = [];

$(document).ready(function() {
    const fetchData = (url, successCallback, completeCallback) => {
        $.ajax({
            url: "<?= BASE_URL; ?>" + url,
            type: "GET",
            success: successCallback,
            error: (xhr, status, error) => {
                console.error('Error fetching data:', error);
            },
            complete: completeCallback
        });
    };

    fetchData(
        "/?rest_route=/wp/v2/selected_collection",
        (res) => {
            localSelectedCollection = res?.collection.filter((e) => (res?.homePageCollection || []).includes(e.collection_id));
            selectedCollectionIds = res?.collection.filter((e) => (res?.homePageCollection || []).includes(e.collection_id)) || [];

        },
        () => {
            loadCollections();
        }
    );

    fetchData(
        "/?rest_route=/wp/v2/selected_inspirations",
        (res) => {
            inspirationList = (res?.inspirationList || []).filter((e) => (res?.selectedInspirations || []).includes(e.id));
        },
        () => {
            renderInspirations();
        }
    );
});

function loadCollections() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        success: function(res) {
            res.results.forEach((e) => {
                const localCollection = selectedCollectionIds.find(local => local.collection_id === parseInt(e.collection_id));
                if (localCollection) {
                    filteredCollections.push({
                        ...e,
                        ...localCollection
                    });
                }
            });
            // TODO : make logic for triggering next page not by baypassing
        },
        error: function(xhr, status, error) {
            $('#errorIndicator').show();
        },
        complete: () => {
            sortedCollections = filteredCollections.sort((a, b) => (b.collection_id > a.collection_id) ? 1 : -1)
            sortedCollections.slice(0, 4).forEach((colection) => renderCollections(colection));
            $(document).ready(function() {
                collectionSlick()
            })
            renderRequestCatalogForm();
        }
    });
}

function renderCollections(collection) {
    $('#colection-selected').append(`
        <div style="background-image: url(${collection.image_grid});"
            class="bg-cover bg-no-repeat bg-center h-[300px] sm:h-[365px] lg:mx-0 mx-2 w-auto overflow-hidden">
            <a href="<?= BASE_LINK; ?>/collections/${slugify(collection.name)}">
                <div class="h-[25vh] lg:h-full w-full md:h-[35vh] flex group items-end md:hover:bg-gradient-to-b from-transparent to-black/40 p-5">
                    <div class="max-w-md transition duration-300 translate-y-14 md:group-hover:translate-y-0 ease-in-out">
                        <h1 class="text-3xl lg:text-5xl text-white p-3 lg:p-0">
                            ${filterProductName(collection.name)}
                        </h1>
                        <div class="line-clamp-2">
                            <p class="text-white invisible md:group-hover:visible duration-300  p-3 lg:p-0">
                                ${collection.description}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    `);
}

function renderInspirations() {
    inspirationList.forEach((inspiration) => {
        $('#inspiration-selected').append(`
            <a class="inspiration__card relative" href="${inspiration.link}">
                <div class="inspiration__card__overlay absolute inset-0 bg-black bg-opacity-0 group hover:bg-opacity-20 transition duration-300 flex flex-col items-center justify-center">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/Instagram-white.svg" alt="Triconville" class="w-11 h-11 hidden group-hover:block">
                    <h3 class="text-white font-medium text-center hidden group-hover:block">@triconville</h3>
                </div>
                <img src="${inspiration.img}" alt="${inspiration.alt}" class="w-full h-full object-contain" />
            </a>
        `);
    })
}

function collectionSlick() {
    if ($(window).width() <= 1023 && $(".collection__wrapper").length) {
        $(".collection__wrapper").slick({
            slidesToScroll: 1,
            slidesToShow: 1.03,
            arrows: false,
            infinite: true,
        });
    } else if ($(".collection__wrapper").hasClass("slick-initialized")) {
        $(".collection__wrapper").slick("unslick");
    }

}

function renderRequestCatalogForm() {
    $('.country-dropdown').attr('placeholder', 'Select a Country*');
}

$(window).resize(function() {
    setTimeout(() => {
        $(".collection__wrapper").slick('refresh');
    }, 2000);
    collectionSlick();

})
</script>
<script>
document.addEventListener('wpcf7mailsent', function(event) {
    if (event.detail.status === 'mail_sent') {
        requestCatalog("success");
    }
}, true);

function requestCatalog(action) {
    if (action === "success") {
        $(".request-catalog-success").removeClass("invisible opacity-0 h-0").addClass("visible opacity-100 h-auto");
        $(".request-catalog-form").removeClass("visible opacity-100 h-auto").addClass("invisible opacity-0 h-0");
    } else {
        $(".request-catalog-form").removeClass("invisible opacity-0 h-0").addClass("visible opacity-100 h-auto");
        $(".request-catalog").removeClass("visible opacity-100 h-auto").addClass("invisible opacity-0 h-0");
    }
}
</script>


<?php
// Conditional for footer
get_template_part('footer-custom');

?>