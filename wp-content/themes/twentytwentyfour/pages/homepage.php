<?php
/*
Template Name: Homepage
*/
get_template_part('header-custom');

// get latest 3 news
$posts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=newsroom');

?>
<style>
.homepage-banner {
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/home-banner.png');
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div class="content-container">
    <!-- NOTE: Banner -->
    <div class="homepage-banner">
        <div class="flex items-center justify-center min-h-full bg-black bg-opacity-25">
            <h1 class="text-3xl md:text-5xl font-medium text-center uppercase text-white tracking-widest"
                id="category__name">PREMIER OUTDOOR FURNITURE</h1>

        </div>
    </div>
    <div class="p-3 md:p-5">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid md:grid-cols-2 items-center my-5">
                <div class="txt max-w-xl md:text-justify py-5">
                    <p class="uppercase text-xs tracking-widest">our story</p>
                    <h2 class='text-2xl md:text-3xl tracking-wide '>
                        20 Years of Excellence Experience on Outdoor Living
                    </h2>
                    <p class="tracking-wider text-sm my-5">
                        In line with cutting-edge design trends, Triconville manufactures furniture that is beautiful yet functional,
                        versatile products, for outdoors. And all combined in an excellence that guides Triconville towards new solutions for
                        the world of architecture and hospitality.
                    </p>
                    <a href="<?= BASE_LINK ?>/about-us"
                       class='btn-ghost uppercase tracking-widest text-xs'>
                        our story
                    </a>
                </div>
                <div class="image">
                    <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/home-our-story.png"
                         class="w-full h-full object-cover" />
                </div>
            </div>
            <div class="md:flex items-center my-5">
                <div class="md:w-2/4 w-full">
                    <p class='uppercase text-xs tracking-widest'>
                        inspiration
                    </p>
                    <h2 class='text-2xl md:text-3xl tracking-wider max-w-xl'>
                        25 Years of Excellence Experience on Outdoor Living
                    </h2>
                </div>
                <div class='md:w-2/4 w-full'>
                    <p class='tracking-wider md:text-justify text-sm my-5'>
                        An outdoor sofa that hugs you with the specially built cushion designed ergonomically to improve comfort,
                        while the angular backrest makes the recline easy with books or drinks in hand.
                        An outdoor sofa that hugs you with the specially built cushion designed ergonomically to improve comfort,
                        while the angular backrest makes the recline easy with books or drinks in hand.
                    </p>
                    <a href="<?= BASE_LINK ?>/projects"
                       class='btn-ghost uppercase tracking-widest text-xs'>
                        inspiration
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- NOTE : Slider -->
    <div class="relative my-10">
        <!-- Carousel wrapper -->
        <div class=" slider__home">
            <!-- Item 1 -->
            <div class="max-w-screen duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="https://storage.googleapis.com/pimassest1/asset/utils/collection/featured_image/Corda/1920/corda-sofa-lifestyle-2.jpg"
                     class="object-cover w-auto max-w-screen h-[600px]"
                     alt="Slider-1">
            </div>
            <!-- Item 2 -->
            <div class="max-w-screen duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="https://storage.googleapis.com/pimassest1/asset/utils/collection/featured_image/Emmilie/1920/Emmilie-sofa_piedra-coffee-table.jpg"
                     class="object-cover w-auto max-w-screen h-[600px]"
                     alt="Slider-2">
            </div>
            <!-- Item 3 -->
            <div class="max-w-screen duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="https://storage.googleapis.com/pimassest1/asset/utils/collection/featured_image/Karla/1920/Karla_2-1-1_Olefin-calasona-142-weathered-teak-.jpg"
                     class="object-cover w-auto max-w-screen h-[600px]"
                     alt="Slider-2">
            </div>
            <!-- Item 4 -->
            <div class="max-w-screen duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="https://storage.googleapis.com/pimassest1/asset/utils/collection/featured_image/Timo/1920/timo_sofa_lifestyle_06.jpg"
                     class="object-cover w-auto max-w-screen h-[600px]"
                     alt="Slider-2">
            </div>
            <!-- Item 5 -->
            <div class="max-w-screen duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="https://storage.googleapis.com/pimassest1/asset/utils/collection/featured_image/Vento%20Aluminium/1920/4._Vento_Alu_Ambiance_Fontelina_Blue_.jpg"
                     class="object-cover w-auto max-w-screen h-[600px]"
                     alt="Slider-2">
            </div>
        </div>
        <button class="slick-prev prev-btn hidden md:block absolute top-1/2 -translate-y-1/2 z-1 left-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
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
        <button class="slick-next next-btn hidden md:block absolute top-1/2 -translate-y-1/2 z-1 right-5 py-10 bg-slate-50/50 p-3 hover:bg-slate-50/80"
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
    <!-- NOTE : Collection & News List &Catalog -->
    <div class="p-3 md:p-5">
        <div class="max-w-[1440px] mx-auto">
            <!-- ANCHOR : Collection -->
            <div class="py-10">
                <p class="text-center text-xs uppercase tracking-wider mb-5">Collections</p>
                <h2 class="text-center text-3xl tracking-wider mb-5">Signature Selections for Every Style</h2>
                <!-- sm:grid sm:grid-cols-2 gap-3 my-5 -->
                <div class="block sm:grid sm:grid-cols-2 gap-3 my-5 collection__wrapper"
                     id="colection-selected"></div>
                <div class="text-center">
                    <a href="<?= BASE_LINK ?>/collections"
                       class='btn-ghost uppercase text-xs tracking-widest'>
                        more collections
                    </a>
                </div>
            </div>
            <!-- ANCHOR : News List -->
            <div class="py-10">
                <div class="text-center mx-auto max-w-2xl mb-5">
                    <p class="uppercase tracking-widest text-xs">news </p>
                    <h4 class="text-2xl md:text-3xl tracking-wider">
                        Our Latest News
                    </h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-5">
                    <?php foreach ($posts as $post): ?>
                    <div class="news-card flex items-center gap-3 md:block">
                        <div class="news-image w-1/2 md:w-auto md:h-auto sm:h-[240px] object-cover h-[124px]">
                            <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                        </div>
                        <div class="desc w-1/2 md:w-full flex flex-col justify-center">
                            <div class=" overflow-hidden">
                                <h2 class="text-2xl md:text-3xl tracking-wider md:mb-5">
                                    <a href="<?php echo get_permalink($post->ID); ?>"
                                       class="hover:underline line-clamp-2 md:line-clamp-1">
                                        <?php echo get_the_title($post->ID); ?>
                                    </a>
                                </h2>
                            </div>
                            <div class="md:mb-10">
                                <p class=" text-sm tracking-wider line-clamp-2">
                                    <?php echo get_the_excerpt($post->ID); ?>
                                </p>
                            </div>

                        </div>

                    </div>
                    <?php  endforeach; ?>
                </div>
                <div class="text-center mt-10 md:mt-5">
                    <a href="<?= BASE_LINK ?>/news"
                       class="btn-ghost uppercase text-xs tracking-widest">All News</a>
                </div>
            </div>
            <!-- ANCHOR : Catalog -->
            <div class="py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-5">
                    <div class="">
                        <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/our-story.png"
                             class="w-auto h-auto object-cover" />
                    </div>

                    <div class="flex justify-center items-center p-3 md:p-5">
                        <div class="md:p-5">
                            <p class="uppercase text-xs tracking-widest">catalog</p>
                            <h2 class="text-3xl tracking-wider">Triconville - 2024 Catalog</h2>
                            <p class="text-sm text-justify tracking-wider mb-5">
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
    var selectedCollectionIds = [];
    var filteredCollections = [];
    $(document).ready(function() {
        $.ajax({
            url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
            type: "GET",
            success: (res) => {
                selectedCollectionIds = res.homePageCollection;
            },
            complete: () => {
                loadCollections();
            }
        })
    })

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
                $('#grid-container').hide();
                sortedCollections = filteredCollections.sort((a, b) => (b.collection_id > a.collection_id) ? 1 : -1)
                sortedCollections.slice(0, 4).forEach((colection) => renderCollections(colection));
                $('#page-loading').hide();
                collectionSlick()
            }
        });
    }

    function renderCollections(collection) {
        $('#colection-selected').append(`
            <div style="background-image: url(${collection.collection_image_1024});" class="bg-cover bg-no-repeat bg-center h-[300px] sm:h-[365px] sm:mx-0 mx-2 w-auto">
                <a href= "<?= BASE_LINK; ?>/collections/${slugify(collection.name)}">
                    <div class=" sm:h-full sm:w-full h-[65vh] w-[calc(100vw-20px)] flex items-end p-5 mx-2">
                        <h1 class="text-5xl text-white line-clamp-2 max-w-xs">
                            ${collection.name}
                        </h1>
                    </div>
                </a>
            </div>
        `);


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

    <script>
    $('.slider__home').slick({
        slidesToScroll: 1,
        arrows: false,
        variableWidth: true,
        infinite: true,
        centerMode: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                infinite: false,
                centerMode: false,
                variableWidth: false,
                slidesToShow: 1.05,
            }
        }]
    });
    $(".prev-btn").click(function() {
        $(".slider__home").slick("slickPrev");
    });
    $(".next-btn").click(function() {
        $(".slider__home").slick("slickNext");
    });
    </script>

    <?php
// Conditional for footer
get_template_part('footer-custom');

?>