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
<div class="content-container scroll-smooth overflow-x-hidden">
    <!-- NOTE: Banner -->
    <h1 class="text-5xl font-semibold text-center pt-10 uppercase snap-start">triconville collections</h1>
    <p class='font-light tracking-widest text-center'>The Luxury of Living Outdoors</p>
    <div class="flex gap-2 justify-center my-5 view-button">
        <button class="btn-ghost-dark flex gap-2 items-center"
                id="list-button"
                onClick="changeView('list')">
            List View <svg xmlns="http://www.w3.org/2000/svg"
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
        <button class="btn-ghost flex gap-2 items-center"
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
    <!-- NOTE : Material list -->
    <div class="md:p-5 p-3"
         id="grid-container">
        <div class="max-w-[1440px] mx-auto">
            <div id="grid__collections"
                 class='p-5 mb-5 grid grid-cols-1 sm:grid-cols-2 gap-3'>
            </div>
        </div>
    </div>
    <div id="list__collections"
         class='mt-16 scrollbar-none'>
    </div>
    <div id="errorIndicator"
         class="hidden">Error</div>
    <div id="page-loading">
        <div class="three-balls">
            <div class="ball ball1"></div>
            <div class="ball ball2"></div>
            <div class="ball ball3"></div>
        </div>
    </div>
    <?php
    // Conditional for footer
    get_template_part('footer-custom');

    ?>
</div>
<script>
let page = 1;
let isLoading = false;
let stop = false;
let count = 0;
let selectedCollectionId = [];
let filteredCollection = [];

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
            isLoading = false;
        },
        error: function(xhr, status, error) {
            isLoading = false;
            stop = true;
            $('#page-loading').hide();
            $('#errorIndicator').show();
        },
        complete: () => {
            $('#grid-container').hide();
            sortedCollection = filteredCollection.sort((a, b) => (a.name > b.name) ? 1 : -1)
            sortedCollection.forEach((e, index) => renderCollections(e, index, 'list'));
            stop = true;
            $('#page-loading').hide();
        }
    });
}

function changeView(type) {
    count = 0;
    $('.view-button button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (type == 'grid') {
        $('.content-container').removeClass('snap-y snap-mandatory overflow-y-scroll h-screen scrollbar-none')
        $('#grid-container').show();
        $('#grid-button').removeClass('btn-ghost').addClass('btn-ghost-dark');
        sortedCollection.forEach((e, index) => renderCollections(e, index, 'grid'));
    } else if (type == 'list') {
        $('#grid-container').hide();
        $('#list-button').removeClass('btn-ghost').addClass('btn-ghost-dark');
        sortedCollection.forEach((e, index) => renderCollections(e, index, 'list'));
    }
}

function renderCollections(e, index, type = 'grid') {
    count += 1;
    if (type == 'grid') {
        $('#list__collections').empty();
        $('#grid__collections').append(`
            <a href= "<?= BASE_LINK; ?>/collections/${slugify(e.name)}" class="mb-5">
                <div class="h-[365px] w-full flex items-center justify-center transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-md" 
                    style="
                        background-position:center; 
                        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/${e.image_grid}'); 
                        background-repeat: no-repeat;
                        background-size: cover;
                    "
                >
                </div>
                <p class='text-sm mt-3'>
                    ${count < 10 ? '0' + (count) : count}. 
                </p>
                <hr class='w-2/5 mt-3 border-black'/>
                <h1 class="text-5xl mt-3 font-medium tracking-wider uppercase">${e.name}</h1>
                <p class='text-sm mt-3 line-clamp-2 text-ellipsis'>
                    ${e.description}
                </p>
            </a>
        `);
    } else if (type == 'list') {
        $('.content-container').addClass('snap-y snap-mandatory transition duration-500 ease-in-out overflow-y-scroll h-screen scrollbar-none')
        $('#grid__collections').empty();
        $('#list__collections').append(`
            <div class="h-screen w-screen relative text-white snap-start" 
                style="
                    background-position:center; 
                    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/${e.image_banner}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
                <a href= "<?= BASE_LINK; ?>/collections/${slugify(e.name)}">
                    <div class="bg-black/25 h-full w-full absolute top-0 left-0 p-3 md:p-5 lg:p-10">
                        <div class="max-w-[1440px] mx-auto">
                            <p class='font-medium mt-3 md:mt-5 lg:mt-10 '>
                            ${count < 10 ? '0' + (count) : count}. 
                            </p>
                            <hr class='w-1/5 mt-3 border-white'/>
                            <h1 class="text-5xl text-white mt-3 font-medium tracking-wider uppercase">${e.name}</h1>
                            <p class='line-clamp-2 text-ellipsis md:w-1/2'>
                            ${e.description}
                            </p>
                        </div>
                    </div>
                </a>
           </div>
        `);
    }
}
</script>