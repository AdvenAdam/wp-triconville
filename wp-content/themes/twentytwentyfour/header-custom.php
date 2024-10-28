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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    .gtranslate_wrapper select {
        padding-block: 1rem;
        background-color: transparent;
        max-width: 120px;
    }
    </style>
</head>

<body <?php body_class(); ?>>
    <header class="header sticky top-0 tracking-widest"
            style="z-index: 20;">
        <div class="flex items-center justify-between md:px-5 px-3 w-full bg-white">
            <div class="flex justify-center">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/Logo-Blue-Resized-1.png"
                         alt="Triconville logo"
                         class="h-6 will-auto min-w-20" />
                </a>
            </div>

            <div class="flex items-center justify-end gap-2">
                <div id="navbar_menu_category"
                     class='md:flex hidden '>
                </div>
                <!-- Note : Login -->
                <div class="hidden md:flex items-center">
                    <div class="px-3 pb-1 text-xs uppercase outline-none">
                        <?php echo do_shortcode('[gtranslate]') ?>
                    </div>
                    <a href="https://indospaceb2b.com/">
                        <p class="px-3 text-xs uppercase hover:text-cyan-500">B2B Login</p>
                    </a>
                </div>
                <!-- NOTE : Drawer -->
                <button class="group bg-transparent border-transparent outline-none flex items-center py-5 md:hidden "
                        type="button"
                        data-drawer-target="drawer-navigation"
                        data-drawer-show="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <p class="text-xs font-medium group-hover:text-cyan-500 pt-1 ">Menu</p>
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
        </div>
        <div class="w-full md:px-5 px-3 py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16"
             style="z-index: 2;"
             id="sub-header"
             onMouseOut="showSubHeader(false)"
             onMouseOver="showSubHeader(true)">
            <div class="flex w-full justify-end uppercase text-xs"
                 id="sub-inspiration-desktop">
            </div>
        </div>
        <div class="w-full md:px-5 px-3 py-3 bg-[#F4F6F6] opacity-0 invisible transition-opacity duration-500 ease-in-out fixed top-16"
             style="z-index: 1;"
             id="sub-products"
             onMouseOut="showSubProducts(false)"
             onMouseOver="showSubProducts(true)">
            <div class="uppercase text-xs">
                <div class="flex md:justify-end overflow-x-auto w-full"
                     id="sub-products-desktop">

                </div>
            </div>
        </div>
    </header>
    <!-- drawer component -->
    <div id="drawer-navigation"
         class="fixed top-0 left-0 outline-none z-40 h-screen w-80 max-w-[60vw] p-5 overflow-y-auto transition-transform duration-500 ease-in-out -translate-x-full bg-white"
         tabindex="-1"
         aria-labelledby="drawer-navigation-label">
        <div class="flex justify-end mt-5">
            <button type="button"
                    data-drawer-hide="drawer-navigation"
                    aria-controls="drawer-navigation"
                    class="text-gray-900 bg-transparent outline-none hover:bg-gray-900 p-2 hover:text-gray-200 flex gap-2 items-center">
                <p class="text-xs">Close</p>
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
    $(document).ready(function() {
        $.ajax({
            url: '<?php echo BASE_URL; ?>/?rest_route=/wp/v2/top-nav',
            type: 'GET',
            success: function(res) {
                res.forEach((e) => {
                    renderLink(e);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching top navigation items:', error);
            },
            complete: function() {
                setActiveLink();
            }
        });


    });

    function showSubHeader(isShow) {
        if (isShow) {
            $('#sub-products').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-header').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
        } else {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    function showSubProducts(isShow) {
        if (isShow) {
            $('#sub-header').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            $('#sub-products').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
        } else {
            $('#sub-products').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
        }
    }

    /*
     * NOTE : 
     * renderLinK, AppendSubMenu and setActiveLink function used to render menu 
     */
    function renderLink(e) {
        if (e.name === 'Inspiration') {
            $('#navbar_menu_category').append(`
                <a href="${e.href}" id="${slugify(e.name)}-link" onMouseOver="showSubHeader(true)" onMouseOut="showSubHeader(false)" class="flex py-6 px-2 items-center text-gray-900 hover:text-cyan-500">                    
                    <p class="uppercase text-xs">${e.name}</p>
                </a>
            `);
            $('#navbar__category').append(`
                <li>
                    <a href="${e.href}" class="flex p-2 items-center justify-end text-gray-900 rounded-lg hover:bg-gray-100 group"><h5 class="text-lg font-medium">${e.name}</h5>
                    </a>
                    <div class="text-end text-sm" id="sub-inspiration-mobile">
                    </div>
                </li>
            `);
            appendSubMenu(e.name);
        } else if (e.name === 'Products') {
            $('#navbar_menu_category').append(`
                <a href="${e.href}" id="${slugify(e.name)}-link" onMouseOver="showSubProducts(true)" onMouseOut="showSubProducts(false)" class="flex py-6 px-2 items-center text-gray-900 hover:text-cyan-500">                    
                    <p class="uppercase text-xs">${e.name}</p>
                </a>
            `);

            $('#navbar__category').append(`
                <li>
                    <a href="${e.href}" class="p-2 flex items-center justify-end text-gray-900 rounded-lg hover:bg-gray-100 group"><h5 class="text-lg font-medium">${e.name}</h5>
                    </a>
                </li>
                <div class="text-end text-sm" id="sub-products-mobile">
                </div>
            `);
            appendSubMenu(e.name);
        } else {
            $('#navbar_menu_category').append(`
                <a href="${e.href}" id="${slugify(e.name)}-link" class="flex py-6 px-2 gap-2 items-center text-gray-900 hover:text-cyan-500">
                    <p class="uppercase text-xs">${e.name}</p>
                </a>
            `);

            $('#navbar__category').append(`
                <li>
                    <a href="${e.href}" class="flex p-2 items-center justify-end text-gray-900 rounded-lg hover:bg-gray-100 group"><h5 class="text-lg font-medium">${e.name}</h5>
                    </a>
                </li>
            `);
        }
    }

    function appendSubMenu(menu) {
        if (menu === 'Products') {
            let categoryMobile = ``;
            let categoryDesktop = ``;
            const products = <?php echo file_get_contents(get_template_directory() . '/api/product.json'); ?>;
            products.forEach((e) => {
                categoryMobile += `
                    <a href="<?= BASE_LINK; ?>/products/${e.slug}">
                        <p class="px-3 py-1 hover:text-cyan-500 whitespace-nowrap"
                            id="${e.slug}-link-mobile">${e.name}</p>
                    </a>
                `
                categoryDesktop += `
                    <a href="<?= BASE_LINK; ?>/products/${e.slug}">
                        <p class="px-3 py-1 hover:text-cyan-500 whitespace-nowrap"
                            id="${e.slug}-link">${e.name}</p>
                    </a>
                `
            })
            $('#sub-products-mobile').append(categoryMobile)
            $('#sub-products-desktop').append(categoryDesktop)
            setActiveLink()
        } else if (menu === 'Inspiration') {
            let categoryMobile = ``;
            let categoryDesktop = ``;
            const inspirationSubMenu = <?php echo file_get_contents(get_template_directory() . '/api/inspirationSubmenu.json'); ?>;
            inspirationSubMenu.forEach((e) => {
                categoryMobile += `
                    <a href="<?= BASE_LINK; ?>/${e.slug}/">
                        <p class="px-3 py-1 hover:text-cyan-500"
                        id="${e.slug}-link-mobile">${e.name}</p>
                    </a>
                `
                categoryDesktop += `
                    <a href="<?= BASE_LINK; ?>/${e.slug}/">
                        <p class="px-3 py-1 hover:text-cyan-500"
                        id="${e.slug}-link">${e.name}</p>
                    </a>
                `
            })
            $('#sub-inspiration-mobile').append(categoryMobile)
            $('#sub-inspiration-desktop').append(categoryDesktop)
            setActiveLink()
        }
    }

    function setActiveLink() {
        const url = window.location.href;
        const slug = url.split('/');
        const parentUrl = slug[4];
        const childUrl = slug[5];
        switch (parentUrl) {
            case 'product-detail':
                $(`#products-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                break;
            case 'about-us':
                $(`#brand-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                break;
            case 'news':
            case 'materials':
            case 'projects':
            case 'moods':
                $(`#inspiration-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                $(`#${parentUrl}-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                $(`#${parentUrl}-link-mobile`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                break;
            default:
                $(`#${parentUrl}-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
                break;
        }

        if (childUrl) {
            $(`#${childUrl}-link`).removeClass('text-gray-900').addClass('text-cyan-500 underline');
            $(`#${childUrl}-link-mobile`).removeClass('text-gray-900').addClass('text-cyan-500 underline');

        }

    }
    </script>