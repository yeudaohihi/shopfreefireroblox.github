<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php'); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php'); 
    if(!@$user){
        new Redirect(DOMAIN);
        exit;
    }
?>
<style>
    .tw-fullscreen{
        min-height: auto;
    }
</style>

</div>
  <div class="tw-bg-gray-100" style="min-height: 50vh; !important">
        <div class="tw-py-6 tw-max-w-6xl tw-mx-auto tw-grid tw-grid-cols-10 tw-gap-2 tw-px-2 tw-relative">
            <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/profile/menu.php'); ?>
            <div class="tw-col-span-12 md:tw-col-span-8">
                        <div class="tw-bg-white tw-rounded tw-p-4 md:tw-py-4 md:tw-px-5 tw-w-full">
                            <div class="tw-border-b tw-border-gray-200 tw-pb-2 tw-mb-4 tw-text-gray-800">
                                <h2 class="tw-text-lg tw-font-semibold">Đổi Mật Khẩu</h2>
                                <p class="tw-text-xs">
                                    Để bảo mật tài khoản, vui lòng không chia sẻ cho người khác.
                                </p>
                            </div>

                            <form id="form-Pass" class="tw-max-w-sm">
                                <div id="msgPassword"></div>

                                <div class="tw-mb-2">
                                    <label class="tw-text-gray-700 tw-text-sm">
                                        Mật khẩu hiện tại
                                    </label>
                                    <input name="password_old" autocomplete="" type="password" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none" />
                                </div>
                    
                                <div class="tw-mb-2">
                                    <label class="tw-text-gray-700 tw-text-sm">
                                        Mật khẩu mới
                                    </label>
                                    <input name="password_new" autocomplete="" type="password" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none" />
                                </div>
                    
                                <div class="tw-mb-4">
                                    <label class="tw-text-gray-700 tw-text-sm">
                                        Nhập lại mật khẩu mới
                                    </label>
                                    <input name="re_password" type="password" autocomplete="" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none" />
                                </div>
                    
                                <button type="button" onclick="changePassword()" class="tw-px-8 tw-h-10 tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded">
                                    Xác Nhận
                                </button>
                            </form>
                        </div>
                    </div>

            <!--- here -->
        </div>
    </div>
</div>
<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/profile/menumobile.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); 
?>