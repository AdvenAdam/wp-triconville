<?php
/*
Template Name: List Moods
*/

// Include your custom header
get_template_part('header-custom');
?>

<div class="content-container mt-20 overflow-hidden">
    <div class="px-3 md:px-5 my-10">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center md:pt-10 ">
                <h1 class="text-3xl md:text-5xl">Moods</h1>
                <p class="md:text-base">Emotions in Every Moments</p>
            </div>
            <div class="grid py-10 lg:grid-cols-4 grid-cols-2 gap-2 md:gap-5"
                 id="mood__list">

            </div>
            <div class="py-10 flex flex-col justify-between items-center sm:flex-row gap-5 md:gap-12 lg:gap-36">
                <div class=" max-w-xl "
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000">
                    <h2 class="text-2xl md:text-3xl ">
                        Moods
                    </h2>
                    <p class="py-5">
                        We believe every outdoor space has a story to tell. It should be as unique as you are. Hence we've curated a diverse collection of furniture styles to complement any outdoor space and reflect your personal taste
                    </p>
                </div>
                <div class=""
                     data-aos="fade-up"
                     data-aos-once="true"
                     data-aos-duration="1000">
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
                    style="background-image: url('<?php echo esc_attr(get_template_directory_uri()); ?>/assets/${mood.thumb}')"
                    data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="1000"
                    >
                    <a href="<?= BASE_LINK ?>/moods/${mood.slug}"
                        class="h-full w-full flex flex-col items-end justify-end p-5 transition duration-300 md:translate-y-14 md:group-hover:translate-y-0 ease-in-out md:group-hover:bg-gradient-to-b from-transparent to-black/40">
                        <h1 class="text-2xl md:text-3xl xl:text-5xl !leading-none font-medium text-end text-white max-w-[260px] md:mb-6">${mood.name}</h1>
                        <div class="text-end h-0 md:h-8">
                            <p class="text-white invisible md:group-hover:visible duration-300 md:mb-6">${mood.subName}</p>
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