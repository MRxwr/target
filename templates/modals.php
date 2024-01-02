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
                <form action="?v=Verification" method="post" class="account_form">
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
                <?php 
                echo $mainAcademy[0]["terms"];
                ?>
            </div>
            <div class="modal-footer">
                <button class="button_box" data-dismiss="modal" type="button">
                    <?php echo direction("Close","اغلاق") ?>
                </button>
            </div>
        </div>
    </div>
</div>