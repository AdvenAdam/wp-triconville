<div class="content-container px-5 md:px-8 overflow-hidden">
    <div class="max-w-[1440px] mx-auto">
        <div class="py-20 lg:py-48">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div class="max-w-xl order-last lg:order-first">
                    <div class="request-catalog-form duration-500 ease-in-out">
                        <h2 class="text-2xl lg:text-3xl">Complete the Form to Receive Your Triconville Catalog</h2>
                        <p class="mt-3 mb-6">
                            Please complete your company details, and once verified, we'll deliver the Triconville Catalog directly to
                            your company email.
                        </p>
                        <?php echo do_shortcode('[contact-form-7 id="' . ( ENV === 'development' ? 'ff7ee87' : '56c4394' ) . '" title="request catalogue"]'); ?>
                    </div>
                    <div class="request-catalog-success invisible opacity-0 h-0 transition duration-500 ease-in-out delay-100">
                        <h2 class="text-2xl lg:text-3xl">Thank You for Your Request!</h2>
                        <p class="mt-3 mb-6">
                            We’ve received your details and are reviewing them. Once verified, your catalog will be on its way to your
                            company email.
                        </p>
                        <div class="flex sm:flex-row flex-col gap-2 mt-10">
                            <a href="<?= BASE_LINK; ?>"
                               class='btn-ghost-dark uppercase text-sm flex items-center gap-2 w-fit'>
                                back to home
                            </a>
                            <a href="<?= BASE_LINK; ?>/find-a-store/"
                               class="btn-ghost flex items-end justify-center uppercase">
                                <p class="text-xs">Find a Store</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <img src="https://storage.googleapis.com/back-bucket/wp_triconville/images/home/Home%20Catalogue.jpg"
                         class="w-auto h-auto object-cover" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('wpcf7mailsent', function(event) {
    if (event.detail.status === 'mail_sent') {
        requestCatalog("success");
    }
}, true);

function requestCatalog(action) {
    if (action === "success") {
        $(".request-catalog-success").removeClass("invisible opacity-0 h-0").addClass("visible opacity-100 h-auto");
        $(".request-catalog-form").removeClass("visible opacity-100 h-auto").addClass("invisible opacity-0 h-0");
    }
}
</script>