<div class="w-full footer py-10 md:px-5 px-3 snap-start">
    <div class="max-w-[1440px] mx-auto ">
        <div class="w-full border-b border-black md:flex">
            <div class="md:w-1/2 w-full">
                <div class="grid grid-cols-2 gap-3">
                    <div class="about p-3">
                        <p class='font-semibold mb-3 uppercase tracking-wider'>About</p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/about-us'> About Us </a>
                        </p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/news'> News </a>
                        </p>
                    </div>
                    <div class="about p-3">
                        <p class='font-semibold mb-3 uppercase tracking-wider'>customer service</p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/contact-us'>Contact Us</a>
                        </p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/find-a-store'
                               class='flex items-center py-2    '>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor"
                                     class="size-6">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Find a Store
                            </a>
                        </p>
                    </div>
                    <div class="about p-3">
                        <p class='font-semibold mb-3 uppercase tracking-wider'>browse</p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/collections'> Collections </a>
                        </p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/products'> Products </a>
                        </p>
                        <p>
                            <a href='<?= BASE_LINK; ?>/materials'> Materials & Care </a>
                        </p>
                    </div>
                    <div class="about p-3">
                        <p class='font-semibold mb-3 uppercase tracking-wider'>connect</p>
                        <div class="flex items-center gap-3 my-3">
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
                </div>
            </div>
            <div class="md:w-1/2 w-full p-3">
                <p class='font-semibold uppercase tracking-wider'>newsletter</p>
                <p>Sign up to our newsletter</p>
                <div class="form mt-5">
                    <p class='uppercase tracking-wider'>EMAIL </p>
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
                                      action="https://0780b586.sibforms.com/serve/MUIFAMi7YRH22EdqkllzuONjBsHYO5aqkkrLluuyrOigP1wmecY6zQpNRSfTsSaYxAstkxYniZvK13tvVyHiE-Cf9BaMPHUrct47kXW_Vy-pzXTUf-YNHowujnEHpw2W8-rHq5Sg8OGi3gdsBOMR-cDLiPs5Y1Y2-aJwK82fkT7mXqURotVTMl9jZ7Htp-Mppe_MmIie1gGy0HOl"
                                      data-type="subscription">
                                    <div style="padding: 8px 0;">
                                        <div class="sib-input sib-form-block">
                                            <div class="form__entry entry_block">
                                                <div class="grid grid-cols-2 items-baseline gap-4">
                                                    <div class="entry__field">
                                                        <input class="input outline-none"
                                                               type="text"
                                                               id="EMAIL"
                                                               name="EMAIL"
                                                               autocomplete="off"
                                                               data-required="true"
                                                               required />
                                                    </div>

                                                    <div class="sib-form-block">
                                                        <button class="sib-form-block__button sib-form-block__button-with-loader min-h-[40px] hover:text-white hover:bg-black"
                                                                style="border:1px solid black;"
                                                                form="sib-form"
                                                                type="submit">
                                                            <div class="flex gap-2">
                                                                <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon size-2 h-0 w-0"
                                                                     viewBox="0 0 0 0">
                                                                    <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                                </svg>
                                                                SUBSCRIBE
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
        <div class="flex gap-3 p-3">
            <p class=' hover:underline'>
                <a href='<?= BASE_LINK; ?>/warranty'>
                    Warranty
                </a>
            </p>
            <p class='hover:underline'>
                <a href='<?= BASE_LINK; ?>/privacy-policy'>
                    Privacy Policy & Protection
                </a>
            </p>

        </div>
    </div>
</div>
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