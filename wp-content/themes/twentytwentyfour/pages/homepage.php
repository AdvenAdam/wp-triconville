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
    background: url('/triconville/wp-content/uploads/2024/09/home-banner.png');
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
            <h1 class="text-5xl font-extrabold text-center uppercase text-white tracking-widest"
                id="category__name">PREMIER OUTDOOR FURNITURE</h1>

        </div>
    </div>
    <div class="p-3 md:p-5">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid md:grid-cols-2 items-center my-5">
                <div class="txt max-w-2xl">
                    <p class="uppercase tracking-widest">our story</p>
                    <h2 class='text-2xl font-semibold'>
                        20 Years of Excellence Experience on Outdoor Living
                    </h2>
                    <p class='tracking-wide'>
                        In line with cutting-edge design trends, Triconville manufactures furniture that is beautiful yet functional, versatile products, for outdoors.
                        And all combined in an excellence that guides Triconville towards new solutions for the world of architecture and hospitality.
                    </p>
                </div>
                <div class="image">
                    <img src="/triconville/wp-content/uploads/2024/09/home-our-story.png"
                         class="w-full h-full object-cover" />
                </div>
            </div>
            <div class="flex items-center my-5">
                <div class="w-2/5">
                    <p class='
                       uppercase
                       tracking-widest'>
                        trusted worldwide
                    </p>
                    <h5 class='text-2xl font-semibold'>
                        25 Years of Excellence Experience on Outdoor Living
                    </h5>
                </div>
                <div class='w-3/5'>
                    <p class='tracking-wide'>
                        An outdoor sofa that hugs you with the specially built cushion designed ergonomically to improve comfort,
                        while the angular backrest makes the recline easy with books or drinks in hand.
                        An outdoor sofa that hugs you with the specially built cushion designed ergonomically to improve comfort,
                        while the angular backrest makes the recline easy with books or drinks in hand.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- NOTE : Slider -->
    <div class="relative my-10 ">
        <!-- Carousel wrapper -->
        <div class=" slider__home">
            <!-- Item 1 -->
            <div class=" duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="/triconville/wp-content/uploads/2024/09/home-slider-1.png"
                     class="object-cover w-full h-[600px]"
                     alt="Slider-1">
            </div>
            <!-- Item 2 -->
            <div class=" duration-200 ease-linear mx-2"
                 data-carousel-item>
                <img src="/triconville/wp-content/uploads/2024/09/home-slider-2.png"
                     class="object-cover w-full h-[600px]"
                     alt="Slider-2">
            </div>

        </div>
        <button class="slick-prev prev-btn absolute top-1/2 -translate-y-1/2 z-10 left-5 hover:py-10 hover:bg-slate-50/50 p-3"
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
        <button class="slick-next next-btn absolute top-1/2 -translate-y-1/2 z-10 right-5 hover:py-10 hover:bg-slate-50/50 p-3"
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
    <div class="my-10"
         id="colection-selected"></div>



    <!-- NOTE : News List -->
    <div class="p-3 md:p-5">
        <div class="max-w-[1440px] mx-auto">
            <div class="my-10">
                <div class="text-center mx-auto max-w-2xl mb-5">
                    <h4 class="text-2xl font-semibold">
                        Our Latest News
                    </h4>
                    <p>
                        Walk with us to discover news concerning events, trade fairs, latest product news and much more
                    </p>
                </div>
                <div class="grid grid-cols-3 gap-3 lg:gap-5">
                    <?php foreach ($posts as $post): ?>
                    <div class="news-card">
                        <div class="news-image">
                            <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                        </div>
                        <div class=" uppercase overflow-hidden">
                            <h2 class="text-2xl font-semibold mb-5">
                                <a href="<?php echo get_permalink($post->ID); ?>"
                                   class="text-[#2c272e] line-clamp-1">
                                    <?php echo get_the_title($post->ID); ?>
                                </a>
                            </h2>
                        </div>
                        <div class="mb-10">
                            <p class="text-[#2c272e] line-clamp-2">
                                <?php echo get_the_excerpt($post->ID); ?>
                            </p>
                        </div>
                    </div>
                    <?php  endforeach; ?>
                </div>
                <div class="    text-center">
                    <a href="/triconville/news"
                       class="btn-ghost">See All News</a>
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
$(document).ready(function() {
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections_det/76/`,
        type: 'GET',
        headers: {
            'Authorization': '<?= API_KEY; ?>',
        },
        beforeSend: () => {
            // TODO ::SKELETON
            $('#page-loading').show();
        },
        success: (data) => {
            // render Banner
            $('#colection-selected').append(`
                <div class="collection-banner" 
                    style="
                        background-image: url('${data.image_1920}');
                        object-fit: cover;
                        background-position: center;
                        height: 31.25rem;
                        width: 100vw;
                        background-repeat: no-repeat;
                        ">
                </div>
                <div class="p-3 md:p-5">
                    <div class="max-w-[1440px] mx-auto">
                        <div class="flex items-center my-5">
                            <div class="w-2/5">
                                <p class='uppercase tracking-widest'>
                                    collection
                                </p>
                                <h5 class='text-2xl font-semibold'>
                                    The Luxury of Living Outdoors
                                </h5>
                            </div>
                            <div class='w-3/5'>
                                <h1 class="text-4xl font-extrabold uppercase tracking-widest">
                                    ${data.name} collection
                                </h1>
                                <p>
                                    ${data.description}
                                </p>
                                <div class="flex gap-5 mt-5">
                                    <a href="/triconville/collections/${data.id}" class="btn-primary">${data.name} Collection</a>
                                    <a href="/triconville/collections" class="btn-ghost">View More Collections</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        },
        complete: () => {
            $('#page-loading').hide();
        }
    });
});

$('.slider__home').slick({
    slidesToShow: 1.02,
    slidesToScroll: 1,
    arrows: false,
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