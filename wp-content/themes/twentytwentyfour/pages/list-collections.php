<?php
/*
Template Name: List Collections
*/
get_template_part('header-custom');
?>
<style>

</style>
<div class="content-container">
    <!-- NOTE: Banner -->

    <h1 class="text-5xl font-semibold text-center pt-10 uppercase">triconville collections</h1>
    <p class='font-light tracking-widest text-center'>The Luxury of Living Outdoors</p>
    <!-- NOTE : Material list -->
    <div class="md:p-5 p-3">
        <div class="max-w-[1440px] mx-auto">
            <div id="list__collections"
                 class='p-5 my-5 grid grid-cols-1 sm:grid-cols-2 gap-3'>

            </div>


            <div id="errorIndicator"
                 class="hidden">Error</div>
        </div>
    </div>
</div>
<div id="page-loading">
    <div class="three-balls">
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
    </div>
</div>
<script>
let page = 1;
let isLoading = false;
let stop = false;
let count = 0;
let selectedCollectionId = [];

$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_collection",
        type: "GET",
        success: (res) => {
            selectedCollectionId = res.collection;
        }
    })
})



function loadCollections(page) {
    isLoading = true;
    $('#page-loading').show();
    $.ajax({
        url: `<?= BASE_API; ?>/v1_collections/?page=${page}`,
        type: 'GET',
        headers: {
            Authorization: '<?= API_KEY; ?>',
        },
        success: function(res) {
            const filteredCollection = [];
            res.results.forEach((e) => {
                if (selectedCollectionId.includes(parseInt(e.collection_id))) {
                    filteredCollection.push(e);
                }
            })
            filteredCollection.forEach((e, index) => renderCollections(e, index));
            // TODO : make logic for triggering next page not by baypassing
            if (res.next) {
                loadCollections(page + 1);
            } else {
                stop = true;
                $('#page-loading').hide();
            }

            isLoading = false;
        },
        error: function(xhr, status, error) {
            isLoading = false;
            stop = true;
            $('#page-loading').hide();
            $('#errorIndicator').show();
        }
    });
}

function renderCollections(e, index) {
    count += 1;
    $('#list__collections').append(`
        <a href= "<?= BASE_LINK; ?>/collections/${e.id}" class="mb-5">
            <div class="h-[365px] w-full flex items-center justify-center transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-md" 
                style="
                    background-position:center; 
                    background-image: url('${e.collection_image_768}'); 
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
            </div>
            <p class='font-extrabold mt-3'>
                ${count < 10 ? '0' + (count) : count}. 
            </p>
            <hr class='w-2/5 mt-3 border-black'/>
            <p class="text-4xl mt-3 font-extrabold tracking-wider uppercase">${e.name}</p>
            <p class='line-clamp-2 text-ellipsis'>
                ${e.description}
            </p>
        </a>
    `);
}

loadCollections(page);
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>