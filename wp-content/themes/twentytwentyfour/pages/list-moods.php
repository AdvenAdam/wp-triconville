<?php
/*
Template Name: List Moods
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-container">
    <div class="px-3 md:px-5 mb-10">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center pt-10">
                <h1 class="text-5xl font-medium uppercase">Moods</h1>
                <p>Emotions in Every Moments</p>
            </div>
            <div class="grid py-10 lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-5">
                <div class="h-[600px] w-auto bg-no-repeat bg-center bg-cover"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/moods/Serenity-Dunes.png')">
                    <a href="#"
                       class="h-full w-full flex items-end justify-end p-5">
                        <h1 class="text-5xl font-medium text-end text-white max-w-[260px]">Serenity Dunes</h1>
                    </a>
                </div>
                <div class="h-[600px] w-auto bg-no-repeat bg-center bg-cover"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/moods/Rhythmic-Oasis.png')">
                    <a href="#"
                       class="h-full w-full flex items-end justify-end p-5">
                        <h1 class="text-5xl font-medium text-end text-white max-w-[260px]">Rhythmic Oasis</h1>
                    </a>
                </div>
                <div class="h-[600px] w-auto bg-no-repeat bg-center bg-cover"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/moods/Whispering-Ocean.png')">
                    <a href="#"
                       class="h-full w-full flex items-end justify-end p-5">
                        <h1 class="text-5xl font-medium text-end text-white max-w-[260px]">Whispering Ocean</h1>
                    </a>
                </div>
                <div class="h-[600px] w-auto bg-no-repeat bg-center bg-cover"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/moods/Chilling-Fall.png')">
                    <a href="#"
                       class="h-full w-full flex items-end justify-end p-5">
                        <h1 class="text-5xl font-medium text-end text-white max-w-[260px]">Chilling Fall</h1>
                    </a>
                </div>
            </div>
            <div class="py-10 flex flex-col justify-between items-center sm:flex-row gap-3">
                <div class="p-3 max-w-xl">
                    <h2 class="text-3xl ">
                        Our skilled designers find their inspiration in the allure, beauty and vibrancy of everyday environments.
                    </h2>
                    <p class="py-5 text-justify text-sm">
                        Based on our most inspiring settings, we have crafted a series of moods in materials, colours and designs to match
                        your fancy, from urban to rustic, poolside to seaside. Savour your outdoor space with furniture designed to fit
                        right in.
                    </p>
                </div>
                <div class="p-3">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/moods/hero.png"
                         alt="">
                </div>

            </div>
        </div>
    </div>
</div>

<?php
// Include your custom footer
get_template_part('footer-custom');
?>