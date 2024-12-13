<style>
.showroom-banner {
    background: url(https://storage.googleapis.com/back-bucket/wp_triconville/images/news-header.jpeg);
    height: 50vh;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<?php
  // Query for the top 3 posts
  $args_top = array(
    'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' ); $top_posts = new WP_Query($args_top); if ($top_posts->have_posts()) :
?>
<div class="content-container mt-6 md:mt-10 overflow-hidden">
    <!-- SHOWROOM BANNER -->
    <!-- NEWS LIST -->
    <div class="px-5 md:px-8 mt-20">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center md:pt-10 ">
                <h1 class="text-3xl lg:text-5xl">Moods</h1>
                <p class="md:text-base">Emotions in Every Moments</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-center py-10">
                <?php while ($top_posts->have_posts()) : $top_posts->the_post(); ?>
                <div class="w-full max-w-xl order-last lg:order-first"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000">
                    <div class="relative group hover:cursor-pointer w-full">
                        <a href="<?php the_permalink(); ?>"
                           class="">
                            <?php the_post_thumbnail('full', array('class' => 'h-full w-auto min-h-[35vh] object-cover')); ?>
                        </a>
                        <div class="overlay absolute inset-0 bg-gradient-to-b from-transparent to-black/30 invisible group-hover:visible"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-4">
                        <?php the_time('F j, Y'); ?>
                    </p>
                    <h3 class="news-title my-2 text-2xl min-h-16">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>