<style>
    /* NOTE : Custom Scroll to Top */
    .scroll-top-btn {
        position: fixed;
        bottom: 20px;
        right: 0px;
        padding: 10px 15px;
        background-color: rgba(0, 0, 0, 0.4);
        color: #fff;
        border: none;
        cursor: pointer;
        z-index: 1;
        display: block;
        /* Initially hidden */
    }
</style>

<footer class="w-full footer">
    <div class=" bg-cover bg-center bg-no-repeat snap-center snap-always"
        style="background-image: url(https://storage.googleapis.com/back-bucket/wp_triconville/images/store/footer.png)">
        <div class="py-10 md:py-20 px-5 md:px-8 bg-[#F4F6F6] bg-opacity-85">
            <div class="max-w-[1440px] mx-auto ">
                <div class="w-full flex xl:flex-row flex-col-reverse justify-center gap-3 md:gap-5 lg:gap-9 xl:gap-0">
                    <div class="xl:w-3/5 w-full">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-3 gap-y-6 md:gap-y-0 md:gap-x-5 lg:gap-x-10 max-w-2xl">
                            <!-- NOTE : About Triconville -->
                            <div class="about tracking-wider">
                                <p class='mb-3 uppercase text-sm font-bold '>Triconville</p>
                                <p class='text-sm py-1'>
                                    <a href='<?= BASE_LINK; ?>/about-us'> Brand </a>
                                </p>
                                <p class='text-sm py-1'>
                                    <a href='<?= BASE_LINK; ?>/find-a-store'> Stores </a>
                                </p>
                                <p class='text-sm py-1'>
                                    <a href='<?= BASE_LINK; ?>/inspiration'> Inspirations </a>
                                </p>
                                <p class='text-sm py-1'>
                                    <a href='<?= BASE_LINK; ?>/materials'> Materials </a>
                                </p>
                                <p class='text-sm py-1'>
                                    <a href='<?= BASE_LINK; ?>/request-catalog'> Catalog </a>
                                </p>
                            </div>
                            <div class="about tracking-wider"
                                id="moods-categories-footer">
                                <p class='mb-3 uppercase text-sm font-bold '>moods</p>
                            </div>
                            <div class="about tracking-wider"
                                id="products-categories-footer">
                                <p class='mb-3 uppercase text-sm font-bold '>products</p>
                            </div>
                            <div class="about flex flex-col md:flex-row md:col-span-3 gap-10">
                                <!-- <div class="address">
                                    <p class='mb-3 font-bold text-sm uppercase '>triconville head office</p>
                                    <p class='md:mb-3 text-sm underline'>
                                        <a href="https://maps.app.goo.gl/XGY2DAFMPpAdxmzH6"
                                           target="_blank">
                                            Sidorekso, Kaliwungu District,<br />
                                            Kudus Regency, Central Java 59332,<br />
                                            Indonesia
                                        </a>
                                    </p>
                                    <p class='text-sm mt-3 md:mb-3 md:mt-0'>+62 21 27084824</p>
                                    <p class='text-sm md:mb-3'>info@triconville.com</p>
                                </div> -->
                                <div class="">
                                    <p class='font-bold text-sm uppercase'>connect</p>
                                    <div class="flex items-center gap-4 my-3">
                                        <a href='https://www.instagram.com/triconville/'
                                            target="_blank">
                                            <img src='https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/instagram2.svg' />
                                        </a>
                                        <a href='https://www.linkedin.com/company/triconville-furniture/'
                                            target="_blank">
                                            <img src='https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/linkedin2.svg' />
                                        </a>
                                        <a href='https://www.youtube.com/@triconville-furniture'
                                            target="_blank">
                                            <img src='https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/youtube2.svg' />
                                        </a>
                                        <a href='https://www.facebook.com/triconville'
                                            target="_blank">
                                            <img src='https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/facebook2.svg' />
                                        </a>
                                        <a href='https://id.pinterest.com/triconville/'
                                            target="_blank">
                                            <img src='https://storage.googleapis.com/back-bucket/wp_triconville/images/icons/pinterest2.svg' />
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="xl:w-2/5 w-full">
                        <div class="stores">
                            <a href="<?= BASE_LINK; ?>/find-a-store/"
                                class="flex items-center w-full gap-3">
                                <h2 class="text-2xl xl:text-3xl md:text-center font-medium">
                                    Find the Nearest Store
                                </h2>
                                <svg width="101"
                                    height="16"
                                    viewBox="0 0 101 16"
                                    fill="none"
                                    class=""
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100.707 8.70711C101.098 8.31658 101.098 7.68342 100.707 7.29289L94.3431 0.928932C93.9526 0.538408 93.3195 0.538408 92.9289 0.928932C92.5384 1.31946 92.5384 1.95262 92.9289 2.34315L98.5858 8L92.9289 13.6569C92.5384 14.0474 92.5384 14.6805 92.9289 15.0711C93.3195 15.4616 93.9526 15.4616 94.3431 15.0711L100.707 8.70711ZM0 9H100V7H0V9Z"
                                        fill="#3C3E3E" />
                                </svg>

                            </a>
                        </div>
                        <div class="newsletter max-w-3xl">
                            <hr class="my-5 border-1 border-black" />
                            <p class='font-bold text-sm uppercase '>newsletter</p>
                            <p class='text-sm py-1'>Sign up to our newsletter</p>
                            <div class="form mt-5">
                                <p class=' text-xs font-bold'>Email </p>
                                <!-- START - We recommend to place the below code where you want the form in your website html  -->
                                <div class="sib-form"
                                    style="text-align: left;background-color: transparent;">
                                    <div id="sib-form-container"
                                        class="sib-form-container">
                                        <div id="error-message"
                                            class="sib-form-message-panel"
                                            style="font-size:16px; text-align:left;color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;max-width:540px;">
                                            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                <svg viewBox="0 0 512 512"
                                                    class="sib-icon sib-notification__icon">
                                                    <path d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z" />
                                                </svg>
                                                <span class="sib-form-message-panel__inner-text">
                                                    Your subscription could not be saved. Please try again.
                                                </span>
                                            </div>
                                        </div>
                                        <div></div>
                                        <div id="success-message"
                                            class="sib-form-message-panel"
                                            style="font-size:16px; text-align:left;color:#085229; background-color:#e7faf0; border-radius:3px; border-color:#13ce66;max-width:540px;">
                                            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                <svg viewBox="0 0 512 512"
                                                    class="sib-icon sib-notification__icon">
                                                    <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" />
                                                </svg>
                                                <span class="sib-form-message-panel__inner-text">
                                                    Your subscription has been successful.
                                                </span>
                                            </div>
                                        </div>
                                        <div></div>
                                        <div id="sib-container"
                                            class="sib-container--large sib-container--horizontal">
                                            <form id="sib-form"
                                                method="POST"
                                                autocomplete="off"
                                                action="https://0780b586.sibforms.com/serve/MUIFAMi7YRH22EdqkllzuONjBsHYO5aqkkrLluuyrOigP1wmecY6zQpNRSfTsSaYxAstkxYniZvK13tvVyHiE-Cf9BaMPHUrct47kXW_Vy-pzXTUf-YNHowujnEHpw2W8-rHq5Sg8OGi3gdsBOMR-cDLiPs5Y1Y2-aJwK82fkT7mXqURotVTMl9jZ7Htp-Mppe_MmIie1gGy0HOl"
                                                data-type="subscription">
                                                <div style="padding: 8px 0;">
                                                    <div class="sib-input sib-form-block">
                                                        <div class="form__entry entry_block">
                                                            <div class="flex items-center gap-2">
                                                                <div class="entry__field w-full">
                                                                    <input class="input rounded-none focus-visible:outline-none"
                                                                        autocomplete="off"
                                                                        type="text"
                                                                        id="EMAIL"
                                                                        name="EMAIL"
                                                                        data-required="true"
                                                                        required />
                                                                </div>

                                                                <div class="sib-form-block w-fit !border-black !border">
                                                                    <button class="sib-form-block__button sib-form-block__button-with-loader min-h-[40px] btn-ghost !px-3"
                                                                        form="sib-form"
                                                                        type="submit">
                                                                        <div class="flex gap-2">
                                                                            <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon size-2 h-0 w-0"
                                                                                viewBox="0 0 0 0">
                                                                                <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                                            </svg>
                                                                            <p class="uppercase text-xs font-sans">SUBSCRIBE</p>
                                                                        </div>
                                                                    </button>

                                                                </div>
                                                            </div>

                                                            <label class="entry__error entry__error--primary"
                                                                style="font-size:16px; text-align:left;color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <input type="text"
                                                    name="email_address_check"
                                                    value=""
                                                    class="input--hidden">
                                                <input type="hidden"
                                                    name="locale"
                                                    value="en">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END - We recommend to place the above code where you want the form in your website html  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a aria-label="Scroll to the top of the page"
    id="scroll-top-btn"
    class="!p-2 btn-ghost-dark fixed bottom-5 right-5 z-10 cursor-pointer invisible ">
    <svg xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-5">
        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>
</a>

<script>
    window.addEventListener('load', function() {
        AOS.init();
    });
</script>

<script>
    $(document).ready(function() {
        const Moods = <?php echo file_get_contents(get_template_directory() . '/api/moods.json'); ?>
        productCategories.forEach((category) => {
            $('#products-categories-footer').append(`
            <p class='text-sm py-1'>
                <a href='<?= BASE_LINK; ?>/products/${category.slug}'>${category.name}</a>
            </p>
        `)
        })
        Moods.forEach((mood) => {
            $('#moods-categories-footer').append(`
            <p class='text-sm py-1'>
                <a href='<?= BASE_LINK; ?>/moods/${mood.slug}'>${mood.name}</a>
            </p>
        `)
        })
    })
    $(document).ready(function() {
        const select = document.querySelector(".gt_selector");
        const selectMobile = document.querySelector("#mobile_gtranslate select");
        const options = select.options;
        const optionsMobile = selectMobile.options;
        select.removeChild(options[0]);
        selectMobile.removeChild(optionsMobile[0]);

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            // if (i === 0) {
            //     select.removeChild(option);
            // }
            const value = option.getAttribute("value").split("|")[1]
            option.innerHTML = value || option.innerHTML;
            option.classList.add('gtranslate-option-class'); // Add the class here

        }

        for (let i = 0; i < optionsMobile.length; i++) {
            const option = optionsMobile[i];
            // if (i === 0) {
            //     select.removeChild(option);
            // }
            const value = option.getAttribute("value").split("|")[1]
            option.innerHTML = value || option.innerHTML;
            option.classList.add('gtranslate-option-class'); // Add the class here

        }
    });
    // NOTE : Scroll to Top
    const url = window.location.href;
    const magnetic__container = document.getElementById("magnetic__container");
    const isMagnetic = (url.includes("about-us") || url.includes("collections")) && magnetic__container;

    var scrollTopButton = document.getElementById("scroll-top-btn");
    if (isMagnetic) {
        magnetic__container.addEventListener("scroll", function() {
            scrollTopButton.style.visibility = this.scrollTop > 0 ? "visible" : "hidden";
        });
        scrollTopButton.addEventListener("click", function() {
            magnetic__container.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            this.style.visibility = "hidden";
        });
    } else {
        window.addEventListener("wheel", function() {
            scrollTopButton.style.visibility = window.scrollY > 0 ? "visible" : "hidden";
        });
        scrollTopButton.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            this.style.visibility = "hidden";
        });
    }
</script>

<!-- START - We recommend to place the below code in footer or bottom of your website html  -->
<script>
    window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
    window.LOCALE = 'en';
    window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

    window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

    window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

    window.translation = {
        common: {
            selectedList: '{quantity} list selected',
            selectedLists: '{quantity} lists selected'
        }
    };

    var AUTOHIDE = Boolean(0);
</script>

<script defer
    src="https://sibforms.com/forms/end-form/build/main.js"></script>
<!-- END - We recommend to place the above code in footer or bottom of your website html  -->
<?php wp_footer(); ?>
</body>

</html>