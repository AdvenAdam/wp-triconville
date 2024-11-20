<?php
/*
Template Name: List Moods
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-container mt-20">
    <div class="px-3 md:px-5 my-10">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center pt-10 md:pt-20">
                <h1 class="text-3xl md:text-5xl uppercase">Moods</h1>
                <p class="text-sm md:text-base">Emotions in Every Moments</p>
            </div>
            <div class="grid py-10 lg:grid-cols-4 grid-cols-2 gap-2 md:gap-5"
                 id="mood__list">

            </div>
            <div class="py-10 flex flex-col justify-between items-center sm:flex-row gap-3">
                <div class="md:p-3 max-w-xl ">
                    <h2 class="text-2xl md:text-3xl ">
                        Our skilled designers find their inspiration in the allure, beauty and vibrancy of everyday environments.
                    </h2>
                    <p class="py-5 text-sm tracking-wider">
                        Based on our most inspiring settings, we have crafted a series of moods in materials, colours and designs to match
                        your fancy, from urban to rustic, poolside to seaside. Savour your outdoor space with furniture designed to fit
                        right in.
                    </p>
                </div>
                <div class="md:p-3">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/moods/hero.png"
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
                <div class="h-[322px] md:h-[600px] w-auto bg-no-repeat bg-center bg-cover group overflow-hidden"
                    style="background-image: url('<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${mood.thumb}')">
                    <a href="<?= BASE_LINK ?>/moods/${mood.slug}"
                        class="h-full w-full flex flex-col items-end justify-end p-5 transition duration-300 md:translate-y-14 md:group-hover:translate-y-0 ease-in-out md:group-hover:bg-gradient-to-b from-transparent to-black/40">
                        <h1 class="text-2xl md:text-5xl !leading-none font-medium text-end text-white max-w-[260px] md:mb-6">${mood.name}</h1>
                        <div class="text-end h-0 md:h-16">
                            <p class="text-white text-sm invisible md:group-hover:visible duration-400 md:mb-6">${mood.subName}</p>
                        </div>
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