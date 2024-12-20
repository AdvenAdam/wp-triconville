<?php
/*
Template Name: Homepage
*/
get_template_part('header-custom');

// get latest 3 news
$posts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=news');
?>
<style>
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
<div class="content-container">
    <!-- NOTE: Banner -->
    <div class="homepage-banner px-5 md:px-8 pt-20 pb-6 lg:h-screen lg:max-h-[1020px]">
        <div class="flex lg:flex-row flex-col gap-2 lg:gap-6 w-full max-w-[1920px] mx-auto h-full overflow-hidden">
            <div class="w-full lg:w-2/5 p-6 lg:p-16 flex flex-col items-start justify-between gap-3 md:gap-6 bg-ceramic"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay=""
                 data-aos-duration="1000">
                <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/LOGO%20IFEX-02%201.png"
                     alt="IFEX"
                     class="w-auto h-full max-h-16 lg:max-h-24 object-contain">

                <div class="max-w-md lg:max-w-lg">
                    <h1 class="text-3xl lg:text-8xl font-medium max-w-sm">
                        IFEX 2025
                    </h1>
                    <hr class="border-ifex-red border-2 lg:border-4 max-w-24 my-4 lg:my-8">
                    <div class="desc">
                        <h3 class="text-sm lg:text-base mb-2">Be part of our first step and join us at Indonesia's premier furniture & craft exhibition!</h3>
                        <p class="hidden lg:block">We are thrilled to announce our inaugural appearance at IFEX 2025!  We'll spotlight our latest outdoor furniture collections in this largest and
                            finest International trade show alongside 500+ exhibitors from 117 countries.</p>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/5 flex flex-col items-start justify-between gap-4 xl:gap-8">
                <div class="right-banner min-h-64 lg:h-2/3 2xl:h-3/4 w-full flex lg:items-end lg:justify-end"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-delay="200"
                     data-aos-duration="1000">
                    <div class="max-w-sm lg:max-w-lg p-4 lg:p-8">
                        <h3 class="text-sm text-white lg:text-base mb-1 hidden lg:block">Come and Say Hello!</h3>
                        <h1 class="text-3xl text-white lg:text-5xl mb-1">Booth No: M-17</h1>
                        <h3 class="text-sm text-white lg:text-base mb-1">North Entrance - Convention Centre & Theatre</h3>
                    </div>
                </div>
                <div class="xl:flex gap-3 xl:gap-10 lg:h-1/3 2xl:h-1/4"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-delay="400"
                     data-aos-duration="1000">
                    <div class="mb-4 lg:mb-0 border-l-[6px] lg:border-l-[13px] border-ifex-red w-full xl:max-w-40 flex items-center">
                        <h1 class="text-2xl xl:text-3xl ps-4 lg:ps-8 text-end">
                            Don’t Miss The Chance
                        </h1>
                    </div>
                    <div class="h-full">
                        <div class="flex overflow-x-auto snap-x snap-mandatory space-x-2 lg:space-x-0 lg:grid lg:grid-cols-3 lg:gap-3 scrollbar-none">
                            <div class="snap-end shrink-0 bg-ceramic max-w-[85vw] w-fit p-4">
                                <div class="max-w-sm ">
                                    <h3 class="text-base font-medium mb-1">
                                        01. <br /> Witness —
                                    </h3>
                                    <p>Our new launches and groundbreaking materials up close firsthand.</p>
                                </div>
                            </div>
                            <div class="snap-end shrink-0 bg-ceramic max-w-[85vw] w-fit p-4">
                                <div class="max-w-sm ">
                                    <h3 class="text-base font-medium mb-1">
                                        02. <br /> Experience —
                                    </h3>
                                    <p>The latest trends and innovation in the outdoor furniture industry.</p>
                                </div>
                            </div>
                            <div class="snap-end shrink-0 bg-ceramic max-w-[85vw] w-fit p-4">
                                <div class="max-w-sm ">
                                    <h3 class="text-base font-medium mb-1">
                                        03. <br /> Experience —
                                    </h3>
                                    <p>To connect with our experts to discuss your specific needs.</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ceramic mt-3 px-4 py-2 flex justify-center flex-col">
                            <a class="flex items-center gap-3 cursor-not-allowed select-none">
                                <p class="text-[#798F98]">Find us on ifexindonesia.com</p>
                                <svg width="101"
                                     height="9"
                                     viewBox="0 0 101 9"
                                     fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100.354 4.85355C100.549 4.65829 100.549 4.34171 100.354 4.14645L97.1716 0.964466C96.9763 0.769204 96.6597 0.769204 96.4645 0.964466C96.2692 1.15973 96.2692 1.47631 96.4645 1.67157L99.2929 4.5L96.4645 7.32843C96.2692 7.52369 96.2692 7.84027 96.4645 8.03553C96.6597 8.2308 96.9763 8.2308 97.1716 8.03553L100.354 4.85355ZM0 5H100V4H0V5Z"
                                          fill="#798F98" />
                                </svg>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-5 md:px-8">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid lg:grid-cols-2 items-center mt-20 gap-8"
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
                    <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/home-our-story.png"
                         class="w-full h-full object-cover" />
                </div>
            </div>
            <!-- NOTE : Collection & Inspiration & News List &Catalog -->
            <!-- ANCHOR : Collection -->
            <div class="mt-20 lg:mt-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <p class="text-center text-xs uppercase tracking-widest">Collections</p>
                <h2 class="text-center text-2xl lg:text-3xl mb-8">Signature Selections for Every Style</h2>

                <div class="block sm:grid sm:grid-cols-2 gap-3 mt-5 mb-10 collection__wrapper "
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
                        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/moods/All%20Moods.png"
                             alt="all Moods image"
                             class="w-full h-auto" />
                    </div>
                </div>
            </div>
            <!-- ANCHOR : News List -->
            <div class="mt-20 lg:mt-48"
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-3 lg:gap-5"
                     id="news-selected">
                    <?php foreach ($posts as $post): ?>
                    <div class="news-card flex items-center gap-3 md:block">
                        <a class="news-image w-1/2 md:w-auto lg:h-auto sm:h-[240px] object-cover h-[124px] relative group hover:cursor-pointer"
                           href="<?php echo get_permalink($post->ID); ?>">
                            <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                            <div class="overlay absolute inset-0 bg-gradient-to-b from-transparent to-black/30 invisible group-hover:visible"></div>
                        </a>
                        <div class="desc w-1/2 md:w-[95%] flex flex-col justify-center">
                            <div class="h-20 overflow-hidden">
                                <h4 class="text-2xl md:mb-5 md:mt-3">
                                    <a href="<?php echo get_permalink($post->ID); ?>"
                                       class="hover:underline line-clamp-2">
                                        <?php echo get_the_title($post->ID); ?>
                                    </a>
                                </h4>
                            </div>
                            <div class="md:mb-10">

                            </div>
                        </div>
                    </div>
                    <?php  endforeach; ?>
                </div>
                <div class="text-center mt-10 lg:mt-0">
                    <a href="<?= BASE_LINK ?>/news"
                       class="btn-ghost uppercase text-xs tracking-widest">All News</a>
                </div>
            </div>
            <!-- ANCHOR : Catalog -->
            <div class="my-20 lg:my-48"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="grid lg:grid-cols-2 gap-8 items-center ">
                    <div class="max-w-xl order-last lg:order-first">
                        <p class="uppercase text-xs tracking-widest mb-2">catalog</p>
                        <h2 class="text-2xl lg:text-3xl">Triconville - 2024 Catalog</h2>
                        <p class=" mt-3 mb-12">
                            Discover an unrivaled selection of luxuriant designs from Triconville. Brought to life with captivating imagery,
                            the 2024 Triconville catalogue is a go-to resource for inspiration and information. Qualified trade members can
                            reserve a copy by filling out the form below.
                        </p>
                        <a href="<?= BASE_LINK ?>/collections"
                           class="btn-ghost uppercase text-xs">View Catalog</a>
                    </div>
                    <div class="">
                        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/home/Home%20Catalogue.jpg"
                             class="w-auto h-auto object-cover" />
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
        <div id="errorIndicator"
             class="hidden">Error</div>
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
                selectedCollectionIds = res?.homePageCollection || [];
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
            beforeSend: () => {
                $('#page-loading').show();
            },
            success: function(res) {
                res.results.forEach((e) => {
                    if (selectedCollectionIds.includes(parseInt(e.collection_id))) {
                        filteredCollections.push(e);
                    }
                })
                // TODO : make logic for triggering next page not by baypassing
            },
            error: function(xhr, status, error) {
                $('#page-loading').hide();
                $('#errorIndicator').show();
            },
            complete: () => {
                sortedCollections = filteredCollections.sort((a, b) => (b.collection_id > a.collection_id) ? 1 : -1)
                sortedCollections.slice(0, 4).forEach((colection) => renderCollections(colection));
                $('#page-loading').hide();
                collectionSlick()
            }
        });
    }

    function renderCollections(collection) {
        $('#colection-selected').append(`
            <div style="background-image: url(${collection.collection_image_1024});"
                class="bg-cover bg-no-repeat bg-center h-[300px] sm:h-[365px] sm:mx-0 mx-2 w-auto overflow-hidden">
                <a href="<?= BASE_LINK; ?>/collections/${slugify(collection.name)}">
                    <div class="sm:h-full w-full h-[65vh] flex group items-end md:hover:bg-gradient-to-b from-transparent to-black/40 p-5">
                        <div class="max-w-md transition duration-300 translate-y-14 md:group-hover:translate-y-0 ease-in-out">
                            <h1 class="text-3xl lg:text-5xl text-white">
                                ${filterProductName(collection.name)}
                            </h1>
                            <div class="line-clamp-2">
                                <p class="text-white invisible md:group-hover:visible duration-300">
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
        if ($(window).width() <= 639 && $(".collection__wrapper").length) {
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
    $(window).resize(function() {
        collectionSlick();
    })
    </script>

    <?php
// Conditional for footer
get_template_part('footer-custom');

?>