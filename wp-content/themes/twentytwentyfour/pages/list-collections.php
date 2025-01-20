<?php
/*
Template Name: List Collections
*/
get_template_part('header-custom');
?>
<style>
body {
    overscroll-behavior-y: contain;
}

::-webkit-scrollbar {
    display: none;
}
</style>
<div class="content-container scroll-smooth overflow-x-hidden h-[calc(100vh-5rem)] md:h-[calc(100vh-8rem)] mt-20 md:mt-32"
     id="magnetic__container">
    <!-- NOTE: Banner -->
    <div class="flex flex-col justify-center pt-14 pb-5 md:pt-20 md:pb-20 px-5 md:px-8 snap-always snap-start">
        <h1 class="text-3xl lg:text-5xl font-medium text-center capitalize ">triconville collections</h1>
        <h3 class='text-center'>The Luxury of Living Outdoors</h3>
        <div class="flex gap-2 justify-center md:mt-10 view-button invisible">
            <button class="btn-ghost-dark  flex gap-2 items-center text-sm uppercase"
                    id="list-button"
                    onClick="changeView('list')">
                Gallery <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="size-5">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>

            </button>
            <button class="btn-ghost  flex gap-2 items-center text-sm uppercase"
                    id="grid-button"
                    onClick="changeView('grid')">
                Grid View
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="size-5">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>

            </button>
        </div>
    </div>
    <!-- NOTE : Material list -->
    <div class="md:p-5 p-3 mb-10"
         id="grid-container">
        <div class="max-w-[1440px] mx-auto">
            <div id="grid__collections"
                 class='mb-5 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-12'>
            </div>
        </div>
    </div>
    <div id="list__collections"
         class=' '>
    </div>
    <div id="page-loading">

    </div>
    <?php
    // Conditional for footer
    get_template_part('footer-custom');

    ?>
</div>
<script>
let stop = false;
let count = 0;
let selectedCollectionId = [];
let sortedCollection = [];
let filteredCollection = [];
let timeout;
let isMobile = window.matchMedia("(max-width: 767px)").matches;
$(document).ready(function() {
    isMobile = window.matchMedia("(max-width: 767px)").matches;
    checkIsMobile(isMobile);
})
window.addEventListener("resize", () => {
    isMobile = window.matchMedia("(max-width: 767px)").matches;
    checkIsMobile(isMobile);
});

function checkIsMobile(isMobile) {
    if (!isMobile) {
        $('.view-button').removeClass('invisible');
        changeView('list');
    }
    if (isMobile) {
        $('.view-button').addClass('invisible');
        changeView('grid');
    }
}

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
        type: "GET",
        success: (res) => {
            selectedCollectionId = res.collection;
            loadCollections();
        }
    })
})

function loadCollections() {
    isLoading = true;
    $('#page-loading').show();
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections/`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        success: function(res) {
            filteredCollection = res.results.filter(e => selectedCollectionId.some(element => element.collection_id === parseInt(e.collection_id))).map(e => {
                const selectedCollection = selectedCollectionId.find(element => element.collection_id === parseInt(e.collection_id));
                return {
                    ...e,
                    ...selectedCollection
                };
            });
        },
        error: function(xhr, status, error) {
            $('#page-loading').hide();
            $('#errorIndicator').show();
        },
        complete: () => {
            sortedCollection = filteredCollection.sort((a, b) => (a.id > b.id) ? 1 : -1)
            if (isMobile) {
                changeView('grid');
            } else {
                changeView('list');
            }
            sortedCollection.forEach((e, index) => renderCollections(e, index, 'grid'));
            count = 0;
            sortedCollection.forEach((e, index) => renderCollections(e, index, 'list'));
            $('#page-loading').hide();
        }
    });
}

function changeView(type) {
    count = 0;
    $('.view-button button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (type == 'grid') {
        $('.content-container').removeClass('snap-y snap-mandatory overflow-y-scroll')
        $('#grid-container').show();
        $('#list__collections').hide();
        $('#grid-button').removeClass('btn-ghost').addClass('btn-ghost-dark');
    } else if (type == 'list') {
        $('.content-container').addClass('snap-y snap-mandatory overflow-y-scroll')
        $('#grid-container').hide();
        $('#list__collections').show();
        $('#list-button').removeClass('btn-ghost').addClass('btn-ghost-dark');
    }
}

function renderCollections(e, index, type = 'grid') {
    count += 1;
    if (type == 'grid') {
        $('.content-container').off('wheel', onscrollHandler);
        $('#grid__collections').append(`
            <a href= "<?= BASE_LINK; ?>/collections/${slugify(e.name)}" >
                <img src="${e.image_grid || e.collection_image_768}" class="h-auto max-h-[365px] w-full hover:brightness-110 transition duration-300 ease-in-out transform" >
                <h4 class='text-sm mt-4 mb-2'>
                    ${count < 10 ? '0' + (count) : count}. 
                </h4>
                <hr class='w-2/5 border-black'/>
                <h1 class="text-3xl lg:text-5xl font-medium capitalize my-2">${e.display_name}</h1>
                <h3 class='text-base line-clamp-2 text-ellipsis'>
                    ${e.description}
                </h3>
            </a>
        `);
    } else if (type == 'list') {
        $('.content-container').addClass('snap-y snap-mandatory transition duration-500 ease-in-out overflow-y-scroll')
        $('.content-container').on('wheel', onscrollHandler);
        $('#list__collections').append(`
            <div class="full-screen-with-subMenu w-screen relative text-white snap-always snap-start" 
                style="
                    background-position:center; 
                    background-image: url('${e.image_banner || e.collection_image_1920}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
                <a href= "<?= BASE_LINK; ?>/collections/${slugify(e.name)}">
                    <div class=" bg-gradient-to-b from-black/15 to-transparent h-full w-full absolute top-0 left-0 p-8 md:p-5 lg:p-20">
                        <div class="max-w-[1440px] ">
                            <h4 class='text-white text-sm mt-4 mb-2'>
                                ${count < 10 ? '0' + (count) : count}. 
                            </h4>
                            <hr class='w-1/5 border-white'/>
                            <h1 class="text-3xl lg:text-5xl text-white font-medium capitalize my-2">${e.display_name}</h1>
                            <h3 class='text-base line-clamp-2 md:w-1/2 text-white'>
                                ${e.description.length > 150 ? e.description.substring(0, 150) + '...' : e.description}
                            </h3>
                        </div>
                    </div>
                </a>
           </div>
        `);
    }
}

function onscrollHandler(event) {
    if (timeout) return;
    timeout = setTimeout(() => (timeout = null), 20);

    const direction = event.deltaY > 0 ? "nextElementSibling" : "previousElementSibling";
    const scrollTarget = event.target.closest(".snap-always")[direction] || null;

    if (scrollTarget) {
        event.preventDefault();
        event.target.scrollTo({
            top: scrollTarget.offsetTop,
            behavior: "smooth",
        });
    }
}
</script>