<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="profile"
          href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
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
        padding-block: 0.5rem;
        background-color: transparent;
        max-width: 120px;
    }
    </style>

</head>

<body <?php body_class(); ?>>
    <header class="header sticky top-0 "
            style="z-index: 2;">
        <div class="flex items-center justify-between md:px-8 px-5 w-full max-h-16 bg-white shadow-md">
            <div class="py-5 flex justify-center">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?= BASE_LINK ?>/wp-content/uploads/2024/09/Logo-Blue-Resized-1.png"
                         alt="Triconville logo" />
                </a>
            </div>

            <div class="flex items-center justify-end gap-2">
                <div id="navbar_menu_category"
                     class='md:flex hidden '>
                </div>
                <button class="group bg-transparent border-transparent outline-none flex items-center py-5 gap-2 md:hidden "
                        type="button"
                        data-drawer-target="drawer-navigation"
                        data-drawer-show="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="size-6 group-hover:text-gray-400">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="w-full md:px-8 py-3 px-5 bg-[#F4F6F6] invisible transition-opacity duration-500 ease-in-out fixed top-16"
             style="z-index: 2;"
             id="sub-header"
             onMouseOut="showSubHeader(false)"
             onMouseOver="showSubHeader(true)">
            <div class="flex w-full justify-end gap-3 uppercase">
                <p>Projects</p>
                <p>News</p>
                <p>Moods</p>
            </div>
        </div>
    </header>

    <!-- drawer component -->
    <div id="drawer-navigation"
         class="fixed top-0 left-0 outline-none z-40 h-screen w-80 p-10 overflow-y-auto transition-transform duration-500 ease-in-out -translate-x-full bg-white"
         tabindex="-1"
         aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label"
            class="text-gray-500 uppercase divide-y">
            Menu
        </h5>
        <button type="button"
                data-drawer-hide="drawer-navigation"
                aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent outline-none hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3"
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
        <hr class="my-5">
        <!-- NOTE : MENU LIST  -->
        <div class="overflow-y-auto bg-transparent ">
            <ul class="space-y-2 font-normal"
                id="navbar__category">
            </ul>

        </div>
        <hr class="my-5">
        <ul class="space-y-2 font-normal mb-5">
            <li><a href="<?= BASE_LINK; ?>/contact-us/"
                   class='flex p-2 items-center text-gray-900 rounded-lg hover:bg-gray-100'>Contact</a></li>
        </ul>

        <div class=" flex items-center gap-3 my-3">
            <a href='#'>
                <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/youtube.svg' />
            </a>
            <a href='#'>
                <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/pinterest.svg' />
            </a>
            <a href='#'>
                <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/instagram.svg' />
            </a>
            <a href='#'>
                <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/facebook.svg' />
            </a>
            <a href='#'>
                <img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/linkedin.svg' />
            </a>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        renderNavbar();

    });

    function showSubHeader(isShow) {
        if (isShow) {
            $('#sub-header').removeClass('invisible').addClass('visible');
        } else {
            $('#sub-header').removeClass('visible').addClass('invisible');
        }
    }

    function renderNavbar() {
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
                const url = window.location.href;
                const slug = url.split('/');
                const finalUrl = slug[4];
                const target = `#${finalUrl === 'materials' ? 'materials-038-care' : finalUrl}-link`;
                $(target).removeClass('text-gray-900').addClass('text-cyan-500 underline');
            }
        });
    }

    function renderLink(e) {
        // NOTE : Drawer
        $('#navbar__category').append(`
            <li>
                <a href="${e.href}" class="flex p-2 items-center text-gray-900 rounded-lg hover:bg-gray-100 group">${e.name}
                </a>
            </li>
        `);
        // NOTE : Desktop
        if (e.name === 'Inspiration') {
            $('#navbar_menu_category').append(`
                <a href="${e.href}" id="${slugify(e.name)}-link" onMouseOver="showSubHeader(true)" class="flex py-5 px-2 items-center text-gray-900 hover:text-cyan-500">                    
                    <p class="uppercase">${e.name}</p>
                </a>
            `);
        } else {
            $('#navbar_menu_category').append(`
                <a href="${e.href}" id="${slugify(e.name)}-link" class="flex py-5 px-2 gap-2 items-center text-gray-900 hover:text-cyan-500">
                    <p class="uppercase">${e.name}</p>
                </a>
            `);
        }
    }

    function slugify(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap  for "e", etc.
        var from = "  -_";
        var to = "  --";
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str
            .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace with -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }
    </script>