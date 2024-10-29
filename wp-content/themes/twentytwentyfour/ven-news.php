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
        <div class="inline-flex gap-1 items-center mb-5">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor"
                 class="size-4">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
            <a href="javascript:history.back()"
               class="text-sm">
                <h5>Back</h5>
            </a>
        </div>
        <div class="content-wrapper">
            <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="pb-5 md:py-10">
            <div class="max-w-2xl mb-5">
                <h4 class="text-3xl tracking-wider">
                    Recommended From Triconville
                </h4>
            </div>
            <?php $Latestposts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=newsroom'); ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-5">
                <?php foreach ($Latestposts as $post): ?>
                <div class="news-card flex items-center gap-3 md:block">
                    <div class="news-image w-1/2 md:w-auto md:h-auto sm:h-[240px] object-cover h-[124px]">
                        <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                    </div>
                    <div class="desc w-1/2 md:w-full flex flex-col justify-center">
                        <div class=" overflow-hidden">
                            <h2 class="text-lg md:text-2xl tracking-wider md:mb-5">
                                <a href="<?php echo get_permalink($post->ID); ?>"
                                   class="hover:underline line-clamp-2 md:line-clamp-1">
                                    <?php echo get_the_title($post->ID); ?>
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<script>
let clipboard = new ClipboardJS('.btn');
</script>
<?php
// Include your custom footer
get_template_part('footer-custom');
?>