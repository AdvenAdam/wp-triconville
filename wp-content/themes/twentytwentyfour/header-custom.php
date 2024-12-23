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
    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/flowbite.min.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com" />
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin />
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
          rel="stylesheet">
    <!-- ReCaptcha -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LergUEqAAAAAFzDZhNSfmvZccQssYyAQ0qugxnr"></script>
    <!-- START - We recommend to place the below code in head tag of your website html  -->
    <!-- AOS -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/aos.css"
          rel="stylesheet">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/aos.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/utils.js"></script>

    <link rel="stylesheet"
          href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <!--  END - We recommend to place the above code in head tag of your website html -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/slick.min.js "></script>
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/slick.min.css "
          rel="stylesheet">
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

    .bg-opacity-50 {
        background-color: rgba(0, 0, 0, 0.5);
    }
    </style>
</head>

<body <?php body_class(); ?>>
    <header class="header fixed w-full top-0 tracking-widest"
            style="z-index: 20;">
        <nav class="flex items-center justify-between px-5 md:px-8 2xl:px-20 w-full md:min-h-20 bg-white ">
            <div class="flex justify-center">
                <a href="<?php echo home_url(); ?>">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/Triconville%20Logo%20Primary.svg"
                         alt="Triconville logo"
                         class="h-6 will-auto min-w-20" />
                </a>
            </div>
            <div class="flex items-center justify-end lg:pt-6 gap-2 lg:gap-10 xl:gap-16">
                <div id="navbar_menu_category"
                     class='lg:flex hidden gap-1 md:gap-3 xl:gap-6'>
                </div>
                <!-- Note : Login -->
                <div class="hidden lg:flex items-center gap-1 md:gap-4 xl:gap-6">
                    <div class="pb-1 text-xs uppercase outline-none text-triconville-black hover:text-triconville-blue flex gap-1 items-center">
                        <?php echo do_shortcode('[gtranslate]') ?>
                    </div>
                    <a href="https://indospaceb2b.com/"
                       class="flex gap-1 items-center group pb-1">
                        <p class="uppercase text-xs pt-3 pb-2 group-hover:text-triconville-blue">B2B Login</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 group-hover:text-triconville-blue">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>

                    </a>
                </div>
                <!-- NOTE : Drawer -->
                <button class="group bg-transparent border-transparent outline-none flex items-center py-5 gap-1 lg:hidden "
                        type="button"
                        data-drawer-target="drawer-navigation"
                        data-drawer-placement="right"
                        data-drawer-show="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <p class="font-medium group-hover:text-triconville-blue">Menu</p>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-6 w-4 group-hover:text-triconville-blue">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    </svg>
                </button>
            </div>
        </nav>
        <nav class="w-full px-5 md:px-8 2xl:px-20 py-2 md:py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16 md:top-20 "
             style="z-index: 2;"
             id="sub-header">
            <div class="uppercase flex justify-end w-full scrollbar-none">
                <div class="hidden gap-6 overflow-x-auto"
                     id="sub-inspiration-desktop">
                </div>
                <div class="hidden gap-4 xl:gap-6 overflow-x-auto scrollbar-none"
                     id="sub-collections-desktop">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         id="sub-collections-desktop-arrow"
                         class="xl:hidden size-4 absolute top-1/2 -translate-y-1/2 z-10 right-1 rotate-180 me-2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 19.5 8.25 12l7.5-7.5" />

                    </svg>
                </div>
                <div class="hidden gap-6 overflow-x-auto scrollbar-none"
                     id="sub-products-desktop">
                </div>
            </div>
        </nav>

    </header>
    <!-- drawer component -->
    <div id="drawer-navigation"
         class="fixed top-0 right-0 outline-none bg-opacity-100 z-40 h-screen w-80 max-w-[60vw] p-5 overflow-y-auto transition-transform duration-500 ease-in-out translate-x-full bg-white"
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
                navSubMenu();
            }
        });
    });

    function showSubMenu() {
        const url = window.location.href;
        switch (true) {
            case /(products)/.test(url):
                showSubHeader(true, 'products');
                break;
            case /(news|materials|inspiration|moods)/.test(url):
                showSubHeader(true, 'inspiration');
                break;
            case /(collections)/.test(url):
                showSubHeader(true, 'collections');
                break;
            default:
                showSubHeader(false);
                break;
        }
    }

    function showSubHeader(isShow, part = '') {
        if (isShow) {
            $('#sub-header').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
            if (part === 'products') {
                $('#sub-products-desktop').removeClass('hidden').addClass('flex');

            } else if (part === 'inspiration') {
                $('#sub-inspiration-desktop').removeClass('hidden').addClass('flex');

            } else if (part === 'collections') {
                $('#sub-collections-desktop').removeClass('hidden').addClass('flex');

            }
        } else {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    function navSubMenu() {
        if ($('#sub-collections-desktop').get(0).scrollWidth > $('#sub-collections-desktop').innerWidth()) {
            $('#sub-header').addClass('!pe-10 2xl:!pe-20');
            $('#sub-collections-desktop').on('scroll', function() {
                const scrollLeft = $(this).scrollLeft();
                const clientWidth = $(this).innerWidth();
                const scrollWidth = $(this).get(0).scrollWidth;
                if (scrollLeft + clientWidth >= scrollWidth) {
                    $('#sub-collections-desktop-arrow').removeClass('rotate-180');
                } else {
                    $('#sub-collections-desktop-arrow').addClass('rotate-180');
                }
            });
            $('#sub-collections-desktop-arrow').on('click', function() {
                const scrollWidth = $('#sub-collections-desktop').get(0).scrollWidth;
                const clientWidth = $('#sub-collections-desktop').innerWidth();
                const scrollLeft = $('#sub-collections-desktop').scrollLeft();

                if (scrollLeft + clientWidth >= scrollWidth) {
                    $('#sub-collections-desktop').animate({
                        scrollLeft: 0
                    }, 500);
                } else {
                    $('#sub-collections-desktop').animate({
                        scrollLeft: scrollLeft + clientWidth
                    }, 1000);
                }
            });
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
            <a href="${menu.href}" class="flex items-center">
                <p class="uppercase text-xs hover:text-triconville-blue" id="${slugify(menu.name)}-link">${menu.name}</p>
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
                    <div class="text-end p-2" id="${subMenuId}"></div>
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
                    <p class="py-1 !text-xs hover:text-triconville-blue whitespace-nowrap" id="${slugify(item.name)}-link-mobile">${displayName}</p>
                </a>
            `;
            categoryDesktop += `
                <a href="${href}">
                    <p class="${menu === 'Inspirations' ? 'pt-1' : 'py-1'} !text-xs hover:text-triconville-blue whitespace-nowrap" id="${slugify(item.name)}-sub-link">${displayName}</p>
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
        const [, , , , parentUrl, childUrl] = url.split('/');

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
            $(linkSelectors['inspiration']).removeClass('text-gray-900').addClass('text-triconville-blue underline');
            $(inspiration[parentUrl]).removeClass('text-gray-900').addClass('text-triconville-blue underline');
        }
        // Activate specific links based on the parentUrl
        if (linkSelectors[parentUrl]) {
            $(linkSelectors[parentUrl]).removeClass('text-gray-900').addClass('text-triconville-blue underline');
        }

        // Highlight the current parent link if present
        if (parentUrl) {
            $(`#${parentUrl}-link, #${parentUrl}-link-mobile`).removeClass('text-gray-900').addClass('text-triconville-blue underline');
        }

        // Highlight the child link if present
        if (childUrl) {
            $(`#${childUrl}-link, #${childUrl}-link-mobile, #${childUrl}-sub-link`).removeClass('text-gray-900').addClass('text-triconville-blue underline');
        }
    }

    function redirectError(status = 404) {
        if (status === 404) {
            window.location.href = "<?= BASE_LINK; ?>/page-not-found";
        }
    }
    </script>