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
                <h1 class="text-5xl uppercase">Moods</h1>
                <p>Emotions in Every Moments</p>
            </div>
            <div class="grid py-10 lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-5"
                 id="mood__list">

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
<script>
let moods = [];

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_moods",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            moods = res;
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        },
        complete: () => {
            renderBanner();
        }
    })
})

function renderBanner() {
    try {
        // Note : Set background
        moods.forEach(mood => {
            $('#mood__list').append(`
                <div class="h-[600px] w-auto bg-no-repeat bg-center bg-cover"
                    style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/${mood.thumb}')">
                    <a href="<?= BASE_LINK ?>/moods/${mood.slug}"
                        class="h-full w-full flex items-end justify-end p-5">
                        <h1 class="text-5xl font-semibold text-end text-white max-w-[260px]">${mood.name}</h1>
                    </a>
                </div>
            `)
        })
    } catch (error) {
        redirectError();
    } finally {
        $('#page-loading').hide();
    }

}
</script>
<?php
// Include your custom footer
get_template_part('footer-custom');
?>