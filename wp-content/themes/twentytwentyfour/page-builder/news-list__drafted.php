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

.news-title-bottom a {
    line-clamp: 3;
    -webkit-line-clamp: 3;
    display: -webkit-box !important;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.news-description p {
    line-clamp: 3;
    -webkit-line-clamp: 3;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.news-title {
    line-clamp: 2;
    -webkit-line-clamp: 2;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 32px !important;
}

.news-img img {
    height: 300px !important;
    overflow: hidden;
    object-fit: cover;
}

.news-image img {
    height: 400px !important;
    overflow: hidden;
    object-fit: cover;
}

@media (max-width: 768px) {
    .news-title {
        font-size: 24px !important;
    }

    .news-image img {
        height: 300px !important;
    }

    .news-img img {
        height: 150px !important;
    }
}
</style>
<?php
  // Query for the top 3 posts
  $args_top = array(
    'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' ); $top_posts = new WP_Query($args_top); if ($top_posts->have_posts()) :
?>
<div class="content-container mt-6 md:mt-10 overflow-hidden">
    <!-- SHOWROOM BANNER -->
    <!-- <div class="showroom-banner">
        <div class="h-full w-full bg-black bg-opacity-25 flex items-center justify-center">
            <h1 class="text-white text-4xl font-semibold">News</h1>
        </div>
    </div> -->

    <!-- NEWS LIST -->
    <div class="px-5 md:px-8mt-20">
        <div class="max-w-[1440px] mx-auto">

            <div class="wp-block-query">
                <?php while ($top_posts->have_posts()) : $top_posts->the_post(); ?>
                <div class="grid lg:grid-cols-2 gap-8 items-center my-10 pb-10"
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000">
                    <div class="w-full max-w-xl order-last lg:order-first">
                        <h3 class="news-title my-2 text-2xl">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="news-description mb-10 text-sm">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>"
                           class="btn-ghost mt-20 text-sm uppercase">Read More</a>
                    </div>

                    <div class="relative group hover:cursor-pointer w-full">
                        <a href="<?php the_permalink(); ?>"
                           class="">
                            <?php the_post_thumbnail('full', array('class' => 'h-full w-auto min-h-[45vh] object-cover')); ?>
                        </a>
                        <div class="overlay absolute inset-0 bg-gradient-to-b from-transparent to-black/30 invisible group-hover:visible"></div>
                    </div>

                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

            <?php
        // Query for the next 6 posts
        $args_bottom = array(
          'posts_per_page' =>
      6, 'offset' => 3, 'order' => 'DESC', 'orderby' => 'date' ); $bottom_posts = new WP_Query($args_bottom); if
      ($bottom_posts->have_posts()) : ?>
            <div class="wp-block-query mb-10 md:mb-20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-5">
                    <?php while ($bottom_posts->have_posts()) : $bottom_posts->the_post(); ?>
                    <div class="grid grid-cols-2 md:grid-cols-1 items-center md:gap-0 gap-3"
                         data-aos="fade-up"
                         data-aos-once="true"
                         data-aos-duration="1000">
                        <a href="<?php the_permalink(); ?>"
                           class="">
                            <?php the_post_thumbnail('full', array('class' => 'h-auto w-full min-h-[30vh] object-cover')); ?>
                        </a>
                        <h2 class="news-title-bottom my-2"
                            style="font-size: 24px; line-height: 2.25rem; color: #2c272e">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>