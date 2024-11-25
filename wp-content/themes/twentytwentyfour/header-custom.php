<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="profile"
          href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <title>
        <?php wp_title('|', true, 'right'); ?>
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com" />
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap"
          rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
          rel="stylesheet">
    <!-- ReCaptcha -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LergUEqAAAAAFzDZhNSfmvZccQssYyAQ0qugxnr"></script>
    <!-- START - We recommend to place the below code in head tag of your website html  -->

    <link rel="stylesheet"
          href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <!--  END - We recommend to place the above code in head tag of your website html -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js "></script>
    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css "
          rel="stylesheet">
    <!-- Fancybox -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <style>
    /* Your CSS styles */

    .content-container,
    .content-wrapper {
        overflow-x: hidden;
    }

    .gtranslate_wrapper .gt_selector {
        padding-bottom: 16px;
        padding-top: 19px;
        background-color: transparent;
        max-width: 120px;
        outline: none !important;
        border: none !important;
        width: 24px;
        text-align: center;
        -webkit-appearance: none;
    }

    .gt_selector::after {
        content: "" !important;
    }
    </style>
</head>

<body <?php body_class(); ?>>
    <header class="header fixed w-full top-0 tracking-widest"
            style="z-index: 20;">
        <nav class="flex items-center justify-between px-3 sm:px-5 lg:px-8 xl:px-20 w-full md:min-h-20 bg-white">
            <div class="flex justify-center">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/Logo-Blue-Resized-1.png"
                         alt="Triconville logo"
                         class="h-6 will-auto min-w-20" />
                </a>
            </div>
            <div class="flex items-center justify-end lg:pt-4 gap-2 lg:gap-10 xl:gap-16">
                <div id="navbar_menu_category"
                     class='lg:flex hidden gap-1 lg:gap-6'>
                </div>
                <!-- Note : Login -->
                <div class="hidden lg:flex items-center gap-6">
                    <div class="pb-1 text-xs uppercase outline-none text-[#4D4D4D] hover:text-cyan-500 flex gap-1 items-center">
                        <?php echo do_shortcode('[gtranslate]') ?>
                    </div>
                    <a href="https://indospaceb2b.com/"
                       class="flex gap-1 items-center group pb-1">
                        <p class="text-xs uppercase pt-3 pb-2 group-hover:text-cyan-500">B2B Login</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 group-hover:text-cyan-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>

                    </a>
                </div>
                <!-- NOTE : Drawer -->
                <button class="group bg-transparent border-transparent outline-none flex items-center py-5 lg:hidden "
                        type="button"
                        data-drawer-target="drawer-navigation"
                        data-drawer-placement="right"
                        data-drawer-show="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <p class="text-xs font-medium group-hover:text-cyan-500 pt-1">Menu</p>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="size-6 group-hover:text-cyan-500">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    </svg>
                </button>
            </div>
        </nav>
        <nav class="w-full px-3 sm:px-5 lg:px-8 xl:px-20 py-2 md:py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16 md:top-20"
             style="z-index: 2;"
             id="sub-header">
            <div class="uppercase text-xs">
                <div class="flex gap-4 justify-end overflow-x-auto w-full"
                     id="sub-inspiration-desktop">
                </div>
            </div>
        </nav>
        <nav class="w-full px-3 sm:px-5 lg:px-8 xl:px-20 py-2 md:py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16 md:top-20"
             style="z-index: 1;"
             id="sub-products">
            <div class="uppercase text-xs">
                <div class="flex gap-4 mjustify-end overflow-x-auto w-full"
                     id="sub-products-desktop">

                </div>
            </div>
        </nav>
        <nav class="w-full px-3 sm:px-5 lg:px-8 xl:px-20 py-2 md:py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16 md:top-20"
             style="z-index: 1;"
             id="sub-collections">
            <div class="uppercase text-xs">
                <div class="flex gap-4 mjustify-end overflow-x-auto w-full"
                     id="sub-collections-desktop">

                </div>
            </div>
        </nav>
    </header>
    <!-- drawer component -->
    <div id="drawer-navigation"
         class="fixed top-0 right-0 outline-none z-40 h-screen w-80 max-w-[60vw] p-5 overflow-y-auto transition-transform duration-500 ease-in-out translate-x-full bg-white"
         tabindex="-1"
         aria-labelledby="drawer-navigation-label">
        <div class="flex justify-end mt-5">
            <button type="button"
                    data-drawer-hide="drawer-navigation"
                    aria-controls="drawer-navigation"
                    class="text-gray-900 bg-transparent outline-none hover:bg-gray-900 p-2 hover:text-gray-200 group flex gap-2 items-center">
                <p class="text-xs group-hover:text-gray-200 ">Close</p>
                <svg class="w-2 h-2"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
        <div class="flex justify-between items-center my-5">
            <div class="text-xs px-2 uppercase outline-none"
                 id="mobile_gtranslate">
                <?php echo do_shortcode('[gtranslate]') ?>
            </div>
            <a href="https://indospaceb2b.com/">
                <p class="btn-ghost text-xs">B2B Login</p>
            </a>
        </div>

        <!-- NOTE : MENU LIST  -->
        <div class="overflow-y-auto bg-transparent ">
            <ul class="space-y-2"
                id="navbar__category">
            </ul>
        </div>
    </div>

    <script>
    const productCategories = <?php echo file_get_contents(get_template_directory() . '/api/product.json'); ?>
    $(document).ready(function() {
        $.ajax({
            url: '<?php echo BASE_URL; ?>/?rest_route=/wp/v2/top-nav',
            type: 'GET',
            success: function(menus) {
                menus.forEach((menu) => {
                    renderLink(menu);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching top navigation items:', error);
            },
            complete: function() {
                setActiveLink();
                showSubMenu();
            }
        });
    });

    function showSubMenu() {
        const url = window.location.href;
        switch (true) {
            case /(products)/.test(url):
                showSubProducts(true);
                break;
            case /(news|materials|inspiration|moods)/.test(url):
                showSubHeader(true);
                break;
            case /(collections)/.test(url):
                showSubCollections(true);
                break;
            default:
                break;
        }
    }

    function showSubHeader(isShow) {
        if (isShow) {
            $('#sub-products').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-collections').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-header').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
        } else {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    function showSubProducts(isShow) {
        if (isShow) {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-collections').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-products').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
        } else {
            $('#sub-products').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    function showSubCollections(isShow) {
        if (isShow) {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-products').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-collections').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
        } else {
            $('#sub-collections').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    /*
     * NOTE : 
     * renderLinK, AppendSubMenu and setActiveLink function used to render menu 
     */
    function renderLink(menu) {
        const mobileClass = "flex p-2 items-center justify-end text-gray-900 rounded-lg hover:bg-gray-100 active:bg-gray-100 group";

        // Append main link to the navbar menu
        $('#navbar_menu_category').append(`
            <a href="${menu.href}" class="flex py-6 items-center">
                <p class="uppercase text-xs hover:text-cyan-500" id="${slugify(menu.name)}-link">${menu.name}</p>
            </a>
        `);

        // Check if the link needs a submenu
        const hasSubMenu = ['Products', 'Inspirations', 'Collections'].includes(menu.name);
        
        const subMenuId = `sub-${slugify(menu.name)}-mobile`;

        if (hasSubMenu) {
            // Append collapsible submenu container
            $('#navbar__category').append(`
                <li>
                    <a class="${mobileClass}"
                        href="${menu.href}"
                    >
                        <h5 class="text-lg font-medium">${menu.name}</h5>
                    </a>
                    <div class="text-end text-sm" id="${subMenuId}"></div>
                </li>
            `);
            appendSubMenu(menu.name);
        } else {
            // Append regular link without submenu
            $('#navbar__category').append(`
                <li>
                    <a href="${menu.href}" class="${mobileClass}">
                        <h5 class="text-lg font-medium">${menu.name}</h5>
                    </a>
                </li>
            `);
        }
    }

    function appendSubMenu(menu) {
        let categoryMobile = ``;
        let categoryDesktop = ``;
        let submenuData = [];
        const subMenuIds = {
            'Products': 'sub-products',
            'Inspirations': 'sub-inspiration',
            'Collections': 'sub-collections'
        };

        // Fetch submenu data based on menu type
        switch (menu) {
            case 'Products':
                submenuData = productCategories;
                break;
            case 'Inspirations':
                submenuData = <?php echo file_get_contents(get_template_directory() . '/api/inspirationSubmenu.json'); ?>;
                break;
            case 'Collections':
                submenuData = <?php echo file_get_contents(get_template_directory() . '/api/collection.json'); ?>.collection;
                break;
        }

        // Generate submenu items
        submenuData.forEach((item) => {
            const href = menu === 'Products' ?
                `<?= BASE_LINK; ?>/products/${item.slug}` :
                menu === 'Inspirations' ?
                `<?= BASE_LINK; ?>/${item.slug}/` :
                `<?= BASE_LINK; ?>/collections/${slugify(item.name)}`;

            const displayName = item.display_name || item.name;
            categoryMobile += `
                <a href="${href}">
                    <p class="py-1 hover:text-cyan-500 whitespace-nowrap" id="${slugify(item.name)}-link-mobile">${displayName}</p>
                </a>
            `;
            categoryDesktop += `
                <a href="${href}">
                    <p class="py-1 hover:text-cyan-500 whitespace-nowrap" id="${slugify(item.name)}-sub-link">${displayName}</p>
                </a>
            `;
        });
        // Append generated submenu items to the respective containers
        if (menu !== 'Collections') {
            $(`#${subMenuIds[menu]}-mobile`).append(categoryMobile);
        }
        $(`#${subMenuIds[menu]}-desktop`).append(categoryDesktop);
    }

    function setActiveLink() {
        const url = window.location.href;
        const [,,,parentUrl, childUrl] = url.split('/');
        const linkSelectors = {
            'product-detail': '#products-link',
            'about-us': '#brand-link',
            'inspiration': '#inspirations-link',
            'contact-us': '#contact-link',
            'find-a-store': '#stores-link',
        };
        // special case for inspiration 
        const inspiration = {
            'inspiration': '#inspirations-sub-link',
            'news': '#news-sub-link',
            'moods': '#moods-sub-link',
            'materials': '#materials-sub-link',
        }

        if (inspiration[parentUrl]) {
            $(linkSelectors['inspiration']).removeClass('text-gray-900').addClass('text-cyan-500 underline');
            $(inspiration[parentUrl]).removeClass('text-gray-900').addClass('text-cyan-500 underline');
        }
        // Activate specific links based on the parentUrl
        if (linkSelectors[parentUrl]) {
            $(linkSelectors[parentUrl]).removeClass('text-gray-900').addClass('text-cyan-500 underline');
        }

        // Highlight the current parent link if present
        if (parentUrl) {
            $(`#${parentUrl}-link, #${parentUrl}-link-mobile`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
        }

        // Highlight the child link if present
        if (childUrl) {
            $(`#${childUrl}-link, #${childUrl}-link-mobile, #${childUrl}-sub-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
        }
    }
    </script>