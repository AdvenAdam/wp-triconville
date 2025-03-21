<style>
.showroom-banner {
    background: url(https://storage.googleapis.com/magento-asset/wp_triconville/images/news-header.jpeg);
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
<div class="content-container overflow-hidden">
    <!-- SHOWROOM BANNER -->
    <!-- NEWS LIST -->
    <div class="px-5 md:px-8">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center my-10 md:pt-10">
                <h1 class="text-3xl lg:text-5xl">Spotlight News</h1>
                <h4 class="md:text-base text-serif">Discovering Possibilities, Sharing Inspiration</h4>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-6 items-start py-10">
                <?php while ($top_posts->have_posts()) : $top_posts->the_post(); ?>
                <?php if (strcmp(strtolower(get_the_title($post->ID)), strtolower('Triconville is the Creator of Moments at IFEX 2025')) == 0) : ?>
                <div class="w-full max-w-xl order-last lg:order-first group"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000">
                    <a href="<?php the_permalink(); ?>"
                       class="">
                        <div class="relative hover:cursor-pointer w-full">
                            <video autoplay
                                   muted
                                   loop
                                   class="h-auto w-full min-h-[25vh] xl:min-h-[35vh] object-cover"
                                   id="ifexVideo">
                                <source src="https://storage.googleapis.com/magento-asset/wp_triconville/videos/ifex/thumbnail_ifex_timelapse.mp4"
                                        type="video/mp4" />
                                Your browser does not support HTML5 video.
                            </video>
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
                <?php else : ?>
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
                <?php endif; ?>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>