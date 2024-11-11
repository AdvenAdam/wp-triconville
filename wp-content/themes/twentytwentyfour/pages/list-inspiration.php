<?php
/*
Template Name: List Inspiration
*/

// Include your custom header
get_template_part('header-custom');
?>
<style>
/* Hide scrollbar for Chrome, Safari and Opera */
body {
    overscroll-behavior-y: contain;
    height: 100%;
}

/* ::-webkit-scrollbar {
    display: none;
} */

.slick-dots {
    display: flex;
    justify-content: center;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10%;
    list-style-type: none;
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 16px;
    backdrop-filter: blur(4px);

    li {
        margin: 0 0.25rem;
    }

    button {
        display: block;
        width: 0.5rem;
        height: 0.5rem;
        padding: 0;
        border: none;
        border-radius: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        text-indent: -9999px;
    }

    li.slick-active button {
        background-color: black;
    }

}
</style>

<div class="content-container mt-20">
    <div id="main__container"
         class="mt-20 px-3 md:px-5">

        <h1 class="text-3xl md:text-5xl font-medium text-center tracking-wider">Inspiration</h1>
        <h3 class="text-base tracking-wider text-center">Moments in Every Lifestyle</h3>

        <div id="inspiration__container"
             class="max-w-[1440px] my-10 mx-auto grid grid-cols-3 gap-1 sm:gap-3">
        </div>
    </div>
    <?php
    // Include your custom footer
    get_template_part('footer-custom');
    ?>
</div>
<div id="page-loading">
    <div class="three-balls">
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
    </div>
</div>
<script>
let inspirations = [];
let timeout;

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_inspirations ",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            inspirations = res.inspirationList;
        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                // redirectError(404)
            }
            console.error('Error fetching data:', error);
        },
        complete: () => {
            renderMaster();
        }
    })
})

function renderMaster() {
    try {
        renderInspirations()
    } catch (error) {
        // redirectError()
        console.error("Error Rendering data:", error)
    } finally {
        $('#page-loading').hide();

    }
}

function renderInspirations() {
    inspirations.forEach(inspiration => {
        $('#inspiration__container').append(`
            <a class="inspiration__card relative" href="${inspiration.link}" target="_blank">
                <div class="inspiration__card__overlay absolute inset-0 bg-black bg-opacity-0 group hover:bg-opacity-20 transition duration-300 flex flex-col items-center justify-center">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/Instagram-white.svg" alt="Triconville" class="w-10 h-10 hidden group-hover:block">
                    <h3 class="text-white font-medium text-center hidden group-hover:block">@triconville</h3>
                </div>
                <img src="${inspiration.img}" alt="${inspiration.alt}" class="w-full h-full object-contain" />
            </a>
        `)
    })
}
</script>