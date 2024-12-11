<?php
/*
Template Name: ven-news
Template Post Type: post, page, event
*/

// Include your custom header
get_template_part('header-custom');
?>
<style>
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
<div class="px-5 md:px-8 mt-28 md:mt-36">
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
            <a href="<?= BASE_LINK ?>/news"
               aria-label="Back"
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
                <h2 class="text-3xl">
                    Recommended From Triconville
                </h2>
            </div>
            <?php $Latestposts = query_posts('post_type=post&posts_per_page=3&order=DESC&orderby=date&category_name=news'); ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-5">
                <?php foreach ($Latestposts as $post): ?>
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
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    const baseUrl = window.location.href;
    const title = $("title").text();
    $(".link-share").click(function(e) {
        e.preventDefault();
        const $temp = $("<input>");
        $("body").append($temp);
        $temp.val(baseUrl).select();
        document.execCommand("copy");
        $temp.remove();
    });
    $(".x-share").attr("href", `http://twitter.com/intent/tweet?text=${title}&url=${baseUrl}`);
    $(".linkedin-share").attr("href", `https://www.linkedin.com/shareArticle?mini=true&url=${baseUrl}`);
    $(".fb-share").attr("href", `https://www.facebook.com/sharer.php?u=${baseUrl}`);
});
</script>
<?php
// Include your custom footer
get_template_part('footer-custom');
?>