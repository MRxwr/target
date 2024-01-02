<!-- login modal -->
<div class="modal fade" id="login" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">
                    ×
                </span>
            </button>
            <div class="modal-body p-0 text-center">
                <h2><?php echo direction("Log in","تسجيل الدخول") ?></h2>
                <h3> <?php echo direction("Check your Subsicriptions","تحقق من الاشتراك") ?></h3>
                <form action="?v=Verification" method="get" class="account_form">
                    <input placeholder="Enter Mobile Number" type="tel" name="m" max="8" min="8" pattern="[0-9]{8}" step="any" required>
                        <button class="button mt_30" type="submit">
                            <?php echo direction("Log in","تسجيل الدخول") ?>
                        </button>
                    </input>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- terms -->
<div class="modal fade" id="terms" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered term_cond">
        <div class="modal-content">
            <div class="modal-body p-0">
                <h2>
                    TERMS & CONDITIONS
                </h2>
                <p>
                    This website is operated by Mode Outfits. Throughout the site, the terms “we”, “us” and “our” refer to Mode Outfits. Mode Outfits offers this website, including all information, tools and Services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies and notices stated here.
                </p>
                <p>
                    By visiting our site and/ or purchasing something from us, you engage in our “Service” and agree to be bound by the following terms and conditions (“Terms of Service”, “Terms”), including those additional terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/ or contributors of content.
                </p>
                <p>
                    Please read these Terms of Service carefully before accessing or using our website. By accessing or using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any Services. If these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of Service.
                </p>
                <p>
                    Any new features or tools which are added to the current store shall also be subject to the Terms of Service. You can review the most current version of the Terms of Service at any time on this page. We reserve the right to update, change or replace any part of these Terms of Service by posting updates and/or changes to our website. It is your responsibility to check this page periodically for changes. Your continued use of or access to the website following the posting of any changes constitutes acceptance of those changes.
                </p>
            </div>
            <div class="modal-footer">
                <button class="button_box" data-dismiss="modal" type="button">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>