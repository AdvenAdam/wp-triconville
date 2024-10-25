<?php
/*
Template Name: ven-news
Template Post Type: post, page, event
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="px-3 md:px-5">
    <div class="max-w-[1440px] mx-auto">
        <div class="content-wrapper">
            <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="pt-10">
            <div class="max-w-2xl mb-5">
                <h4 class="text-3xl tracking-wider">
                    Recommended From Triconville
                </h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-5">
                <?php $Latestposts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=newsroom'); ?>
                <?php foreach ($Latestposts as $post): ?>
                <div class="news-card">
                    <div class="news-image">
                        <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                    </div>
                    <div class=" overflow-hidden">
                        <h2 class="text-2xl font-serif tracking-wider my-5">
                            <a href="<?php echo get_permalink($post->ID); ?>"
                               class="line-clamp-1">
                                <?php echo get_the_title($post->ID); ?>
                            </a>
                        </h2>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php
// Include your custom footer
get_template_part('footer-custom');
?>