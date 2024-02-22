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
<div class="tw-bg-gray-100" style="min-height: 50vh; !important;">
        <div class="tw-py-6 tw-max-w-6xl tw-mx-auto tw-grid tw-grid-cols-10 tw-gap-2 tw-px-2 tw-relative">
            <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/profile/menu.php'); ?>
            <div class="tw-col-span-12 md:tw-col-span-8">
                <div class="tw-grid tw-grid-cols-12 tw-gap-4">
                    <div class="tw-block tw-col-span-12 md:tw-hidden md:tw-col-span-4">
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-p-2 tw-bg-white tw-rounded">
                            <div class="tw-col-span-3 tw-flex tw-items-center tw-justify-content"><img class="tw-w-full tw-rounded-full tw-border" src="/assets/images/unknown-avatar.jpg" /></div>
                            <div class="tw-col-span-9 tw-flex tw-items-center">
                                <div class="tw-ml-2">
                                    <p><b>ID:</b> <?=$data_user['id']?></p>
                                    <p><b>User:</b> <?=$data_user['username']?></p>
                                    <p class="tw-text-base"><b>Số dư:</b> <span class="tw-text-red-600 tw-font-bold"><?=number_format($data_user['cash'])?>đ</span></p>
                                    <p class="tw-text-base"><b>Số dư kim cương:</b> <span class="tw-text-red-600 tw-font-bold"><?=number_format($data_user['diamond'])?>💎</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw-col-span-12">
                        <!---->
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5">Tên tài khoản</div>
                            <div class="tw-col-span-7">
                            <?=$data_user['username']?>
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5">Số dư</div>
                            <div class="tw-col-span-7">
                                <?=number_format($data_user['cash'])?>đ
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5">Số dư kim cương</div>
                            <div class="tw-col-span-7">
                                <?=number_format($data_user['diamond'])?>💎
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5">Nhóm tài khoản</div>
                            <div class="tw-col-span-7">
                                <?=type_user($data_user['type'])?>
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5">Ngày tham gia</div>
                            <div class="tw-col-span-7">
                                <?=date('H:i:s - d/m/Y',$data_user['created_at'])?>
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-rounded tw-p-2 tw-px-3 tw-mb-1 tw-font-semibold">
                            <div class="tw-col-span-5 tw-flex tw-items-center">Thoát</div>
                            <div class="tw-col-span-7">
                                <a href="/user/logout">
                                <button class="tw-text-xs focus:tw-outline-none tw-px-2 tw-py-1 tw-bg-red-500 tw-rounded tw-text-white tw-font-bold">
                                    Đăng xuất
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/profile/menumobile.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); 
?>