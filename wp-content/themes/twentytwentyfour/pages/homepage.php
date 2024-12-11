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
    background: url('https://storage.googleapis.com/back-bucket/wp_triconville/images/home/home-banner.png');
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.news-image img {
    height: 300px !important;
    width: 100% !important;
    object-fit: cover;
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
    <div class="homepage-banner">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-25">
            <h1 class="text-3xl md:text-5xl font-medium text-center text-white"
                id="category__name">Triconville Debuts at IFEX 2025</h1>

        </div>
    </div>
    <div class="px-3 md:px-5">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid md:grid-cols-2 items-center mt-20"
                 data-aos="fade-up"
                 data-aos-once="true"
                 data-aos-delay="200"
                 data-aos-duration="1000">
                <div class="txt max-w-xl py-5">
                    <h2 class='text-2xl md:text-3xl'>
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
                <h2 class="text-center text-3xl mb-8">Signature Selections for Every Style</h2>

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
                <h2 class="text-center text-3xl mb-8">The Art of Living</h2>

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
                <div class="flex gap-5 lg:flex-row flex-col items-center justify-between">
                    <div class="max-w-lg">
                        <p class="text-xs uppercase tracking-widest">MOODS</p>
                        <h2 class="text-3xl">Your World, Your Style, Your Outdoors.</h2>
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
                    <h4 class="text-2xl md:text-3xl mb-8">
                        Our Latest News
                    </h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-3 lg:gap-5"
                     id="news-selected">
                    <?php foreach ($posts as $post): ?>
                    <div class="news-card flex items-center gap-3 md:block">
                        <a class="news-image w-1/2 md:w-auto md:h-auto sm:h-[240px] object-cover h-[124px] relative group hover:cursor-pointer"
                           href="<?php echo get_permalink($post->ID); ?>">
                            <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                            <div class="overlay absolute inset-0 bg-gradient-to-b from-transparent to-black/30 invisible group-hover:visible"></div>
                        </a>
                        <div class="desc w-1/2 md:w-[95%] flex flex-col justify-center">
                            <div class="h-20 overflow-hidden">
                                <h2 class="text-2xl md:mb-5 md:mt-3">
                                    <a href="<?php echo get_permalink($post->ID); ?>"
                                       class="hover:underline line-clamp-2">
                                        <?php echo get_the_title($post->ID); ?>
                                    </a>
                                </h2>
                            </div>
                            <div class="md:mb-10">
                                <p class="tracking-wider line-clamp-2 md:line-clamp-3">
                                    <?php echo get_the_excerpt($post->ID); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach; ?>
                </div>
                <div class="text-center mt-5">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-20 my-5">
                    <div class="">
                        <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/home/Home%20Catalogue.jpg"
                             class="w-auto h-auto object-cover" />
                    </div>
                    <div class="flex justify-center items-center p-3 md:p-5"
                         id="catalog-selected">
                        <div class="">
                            <p class="uppercase text-xs tracking-widest mb-2">catalog</p>
                            <h2 class="text-3xl">Triconville - 2024 Catalog</h2>
                            <p class=" mt-3 mb-12">
                                Discover an unrivaled selection of luxuriant designs from Triconville. Brought to life with captivating imagery,
                                the 2024 Triconville catalogue is a go-to resource for inspiration and information. Qualified trade members can
                                reserve a copy by filling out the form below.
                            </p>
                            <a href="<?= BASE_LINK ?>/collections"
                               class="btn-ghost uppercase text-xs tracking-widest">View Catalog</a>
                        </div>
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
                            <h1 class="text-3xl md:text-5xl text-white">
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
        if ($(window).width() <= 639) {
            $(".collection__wrapper").slick({
                slidesToScroll: 1,
                slidesToShow: 1.03,
                arrows: false,
                infinite: true,
            });
        } else {
            if ($(".collection__wrapper").hasClass("slick-initialized")) {
                $(".collection__wrapper").slick("unslick");
            }
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