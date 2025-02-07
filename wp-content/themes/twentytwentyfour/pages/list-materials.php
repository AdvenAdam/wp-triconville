<?php
/*
Template Name: List Materials
*/
get_template_part('header-custom');
?>
<style>
.slick-dots {
    display: flex;
    position: absolute;
    justify-content: center;
    margin: 1rem 0;
    padding: 0.5rem 0.5rem;
    list-style-type: none;
    left: 50%;
    transform: translateX(-50%);
    bottom: 0px;
    background-color: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(7px);
    border-radius: 2rem;

}

.slick-dots li {
    margin: 0 0.25rem;
}

.slick-dots button {
    display: block;
    width: 0.6rem;
    height: 0.6rem;
    padding: 0;
    outline: none;
    border: none;
    border-radius: 100%;
    background-color: #b4b1b1;
    text-indent: -9999px;
}

.slick-dots li.slick-active button {
    background-color: #1f1f1f;
}
</style>
<div class="content-container overflow-hidden mt-20">
    <!-- NOTE: Banner -->
    <div class="md:pt-10 my-10 px-5 md:px-8">
        <h1 class="text-3xl lg:text-5xl text-center">Materials</h1>
        <h3 class="text-base text-center ">Each material tells a unique story, adding character, beauty, and strength to the pieces we create.</h3>
    </div>
</div>
<!-- NOTE : Material list -->
<div class="">
    <div id="list__materials_filter"
         class='flex items-center text-sm pb-8 px-5 md:px-8 justify-center flex-wrap gap-1 lg:gap-2'
         data-aos="fade-up"
         data-aos-once="true"
         data-aos-duration="500">
        <button type="button"
                class="btn-ghost-dark !py-2"
                onclick="changeFilter('all')"
                id="btn-all">All Materials</button>
    </div>
</div>
<div class="px-5 md:px-8">
    <div id="material__page"
         class="max-w-[1440px] mt-5 mx-auto">
    </div>
</div>
<div id="errorIndicator"
     class="hidden">Error</div>
<div class="fixed z-0 h-screen w-screen invisible bg-black bg-opacity-60 transition-opacity duration-500 ease-in-out top-0"
     id="page-modal">
</div>

</div>
<script>
let groupingMaterials = [];
let allMaterialProducts = [];
$(document).ready(function() {
    $.ajax({
        url: "<?= BASE_URL; ?>/?rest_route=/wp/v2/selected_materials",
        type: "GET",
        beforeSend: () => {
            $('#page-loading').show();
        },
        success: (res) => {
            groupingMaterials = res.groups;
            // ANCHOR : filter by Id
            // groupingMaterials = res.groups.filter(e => e.id === 8);
        },
        error: (xhr, status, error) => {
            $('#errorIndicator').show();
        },
        complete: () => {
            renderMaster();
        }
    })
});

async function renderMaster() {
    try {
        console.time('renderMaster');
        for (const data of groupingMaterials) {
            renderMaterialFilter(data);
            renderGroupContainer(data);
            await loadMaterials(data);
        }
    } catch (error) {
        redirectError();
        console.error(error);
    } finally {
        $('#page-loading').hide()
        console.timeEnd('renderMaster');
    }
}

function renderMaterialFilter(data) {
    $('#list__materials_filter').append(`
        <button class="btn-ghost !py-2" id="btn-${data.id}" type="button" onClick = "changeFilter(${data.id})">${data.alias}</button>
    `);
}

function renderGroupContainer(data) {
    $('#material__page').append(`
        <div class="material-container" id="material__container_${data.id}" 
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-duration="500"
        >
            <h1 class="text-3xl mb-4">${toTitleCase(data.name)}</h1>
            <img class="w-full h-auto min-h-56 mb-16 object-cover" src="${data.banner}" alt="${data.name}-banner" />
        </div>
    `)
}

async function loadMaterials(data) {
    try {
        for (const slug of data.slugs) {
            const res = await $.ajax({
                url: `<?= BASE_API; ?>/v1_swatchparent_det_slug/${slug}/`,
                type: 'GET',
                headers: {
                    Authorization: '<?= API_KEY; ?>',
                }
            })
            //TODO FILTER Product that use TPU code
            //TODO add the filter on JSON instead here so it will optional filtering 
            //TODO Refactor filter so it will use multi filter ex : code and slug   
            allMaterialProducts.push(res);
        }
    } catch (error) {
        console.error(error);
    } finally {
        const subGroups = {
            id: data.id,
            name: data.name,
            materials: allMaterialProducts,
            subGroupFilter: data.subGroups
        }
        renderSubGroups(subGroups);
    }
}

function renderSubGroups(data) {
    const materials = data.materials;

    for (const subGroup of data.subGroupFilter) {
        const materialData = materials.find(e => e.slug === subGroup.filters.slug);
        if (materialData) {
            const filteredMaterials = filterProduct({
                filters: subGroup.filters
            }, materialData);
            $('#material__container_' + data.id).append(`
                <div class="material-products material-products_${data.id}" id="material__products_${slugify(subGroup.name)}" 
                    data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="500"
                >
                    <h2 class="text-2xl mb-2">${toTitleCase(subGroup.name)}</h2>
                    <p class="text-sm">${filteredMaterials[0].material_information}</p>
                    <div class=" max-h-0 opacity-0 invisible transition-all duration-500 ease-out" id="care_instruction_${slugify(subGroup.name)}">
                        <p class="text-sm font-medium">Care Instruction</p>
                        <span class="triconville-paragraph">${filteredMaterials[0].care_instruction}</span>
                    </div>
                    <p class="text-sm mb-6 text-[#798F98] cursor-pointer hover:underline" onClick="showCareInstruction('${slugify(subGroup.name)}')" id="care_instruction_btn_${slugify(subGroup.name)}">
                        more
                    </p>
                    <div id="material__list__${slugify(subGroup.name)}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 2xl:gap-10">
                        ${filteredMaterials.map(material => {
                            return (
                                `<div class="cursor-pointer inline-flex flex-col items-center" onclick='materialClick("${materialData.slug}", "${material.code}")'>
                                    <img class="w-full h-auto object-contain" src="${material.image_384}" />
                                    <p class="text-center max-w-[90%] mx-auto mt-2">${material.alias} (${material.code})</p>
                                </div>
                            `)
                        }).join('')}
                    </div>
                </div>
                <hr class="my-16 border border-[#bcbcbc]" />
            `);
        }
    }
}

function filterProduct({
    filters: {
        keywords,
        codes
    }
}, materials) {
    let products = materials.swatch_options;

    if (keywords) {
        const keywordsArray = Array.isArray(keywords) ? keywords : [keywords];
        products = products.filter(option => {
            const optionSlug = option.name.toLowerCase();
            return keywordsArray.every(keyword => {
                const isExclusion = keyword.startsWith('!');
                const filter = keyword.replace('!', '').toLowerCase();
                return isExclusion ? !optionSlug.includes(filter) : optionSlug.includes(filter);
            });
        });
    }

    if (codes) {
        const codesArray = Array.isArray(codes) ? codes : [codes];
        products = products.filter(option => {
            const optionSlug = option.code.toLowerCase();
            return codesArray.every(code => {
                const isExclusion = code.includes('!');
                const filter = code.replace('!', '').toLowerCase();
                return isExclusion ? !optionSlug.includes(filter) : optionSlug.includes(filter);
            });
        });
    }

    return products;
}


// NOTE Action Function
async function materialClick(slug, code) {
    const product = allMaterialProducts.find(e => e.slug === slug);
    const swatchOption = product.swatch_options.find(option => option.code === code);
    $('#page-modal').empty();
    $('#page-modal').append(`
        <div class="w-full h-full flex items-center justify-center max-w-[95vw] mx-auto" onclick="event.stopPropagation(); $('#page-modal').addClass('invisible z-0').removeClass('z-30')">
            <div class="bg-white flex flex-col md:flex-row gap-4 md:gap-0 items-center relative" onclick="event.stopPropagation()">
                <div class="w-[46vh] sm:w-[50vh] md:w-full h-[45vh] sm:h-[50vh] md:h-full md:max-w-[45vw] lg:max-w-[450px] relative" id="material__img__${slugify(swatchOption.alias)}"></div>
                <div class="px-5 md:px-8 w-[46vh] sm:w-[50vh] md:w-[50vw] max-w-xl h-full">
                    <div class="flex items-center gap-2 pt-2 md:pt-0">
                        <img src="${swatchOption.image_384}" alt="${swatchOption.alias}" class="w-8 h-auto object-contain rounded" />
                        <h3 class="text-xl lg:text-2xl">${swatchOption.alias} (${swatchOption.code})</h3>
                    </div>
                    <div class="mt-4" id="material__list__${slugify(swatchOption.alias)}">
                    </div>
                    <div class="my-4 grid grid-cols-5 gap-4" id="material__care__${slugify(swatchOption.alias)}"></div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer absolute top-5 right-5" onclick="event.stopPropagation(); $('#page-modal').addClass('invisible z-0').removeClass('z-30')">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    `)
    const loadImages = async () => {
        if (Array.isArray(swatchOption.gallery) && swatchOption.gallery.length > 1) {
            const images = await Promise.all(swatchOption.gallery.map(image => {
                return $.ajax({
                    url: image.image_512,
                    type: 'GET'
                }).then(res => image.image_512);
            }));
            images.forEach(imageUrl => {
                $('#material__img__' + slugify(swatchOption.alias)).append(`
                    <img class="w-full h-full object-contain" src="${imageUrl}" alt="${swatchOption.alias}" />
                `)
            });
            $('#material__img__' + slugify(swatchOption.alias)).slick({
                dots: true,
                slidesToScroll: 1,
                slidesToShow: 1,
                arrows: false,
                centerMode: false,
            });
        } else {
            $('#material__img__' + slugify(swatchOption.alias)).append(`
                <img class="w-full h-full object-contain" src="${swatchOption.image_384}" alt="${swatchOption.alias}" />
            `)
        }
    }
    const loadInfo = async () => {
        $('#material__list__' + slugify(swatchOption.alias)).append(swatchOption.information.map(material => {
            return `<p class="text-sm "><span class="font-medium">${material.name}</span> : ${material.description}</p>`
        }).join(''))
        $('#material__care__' + slugify(swatchOption.alias)).append(swatchOption.care_features.map(care_feature => {
            return `
                <div class="flex flex-col items-center">
                    <img class="w-12 h-12 hidden lg:block" src="${care_feature.image}" alt="${care_feature.name}" />
                    <p class="text-center text-xs hidden lg:block">${care_feature.name}</p>
                    <div class="group option_2 cursor-pointer relative id="${care_feature.name}">
                        <div id="tooltip-${care_feature.name}" class=" absolute -top-16 -left-12 w-fit z-10 invisible group-hover:visible inline-block bg-gray-900 rounded-lg shadow-sm opacity-0 group-hover:opacity-100 ">
                            <p class="px-3 py-2 font-medium text-white w-[140px]">${care_feature.name}</p>
                        </div>
                        <img src="${care_feature.image}" class="w-12 h-12 object-contain lg:hidden"/>
                    </div>
                </div>
            `
        }).join(''))
    }
    await loadImages();
    await loadInfo();
    $('#page-modal').removeClass('invisible z-0').addClass('z-30');
}

function showCareInstruction(id) {
    $(`#care_instruction_${id}`).toggleClass('max-h-0 opacity-0 invisible ease-out max-h-screen opacity-100 visible ease-in pt-4');
    const buttonText = $(`#care_instruction_btn_${id}`).text();
    $(`#care_instruction_btn_${id}`).text(buttonText === 'less' ? 'more' : 'less');
}

function changeFilter(id) {
    $('.material-container').addClass('hidden');
    $('#list__materials_filter button').removeClass('btn-ghost-dark').addClass('btn-ghost');
    if (id == 'all') {
        $(`.material-container`).removeClass('hidden');
        $(`#btn-all`).removeClass('btn-ghost').addClass('btn-ghost-dark');
    } else {
        $(`#btn-${id}`).removeClass('btn-ghost').addClass('btn-ghost-dark');
        $(`#material__container_${id}`).removeClass('hidden').addClass('aos-animate');
        $(`.material-products_${id}`).addClass('aos-animate');
    }
}
</script>
<?php
// Conditional for footer
get_template_part('footer-custom');

?>