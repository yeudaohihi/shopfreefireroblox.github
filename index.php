<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/views/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/views/navbar.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/views/banner.php');
?>

<div class="tw-mb-4 tw-text-red-500 tw-font-bold tw-px-2 tw-bg-white tw-rounded tw-py-2 tw-relative">
    <span class=" tw-absolute tw-flex tw-items-center tw-justify-center tw-text-xl tw-h-10 tw-w-10 tw-bg-white tw-rounded " style="top: 0px; left: 0px; z-index: 5"><i class="bx bxs-bell-ring"></i></span>
    <div class="tw-flex tw-w-full tw-items-center tw-notification-home">
        <div class="tw-marquee tw-w-full">
            <div class="mar">
                <marquee>
                    <a style="text-align:center;"><span style="color:#DC2626;"><strong>KHUYẾN MẠI 100% THẺ CÀO,&nbsp;</strong></span></a>
                    <a style="text-align:center;"><span style="color:#DC2626;"><strong>NẠP ATM/MOMO KHUYẾN MẠI 20%,&nbsp;</strong></span></a>
                    <a style="text-align:center;"><span style="color:#DC2626;"><strong>NHẬN TIỀN KHUYẾN MẠI MIỄN PHÍ,&nbsp;</strong></span></a>
                    <a style="text-align:center;"><span style="color:#DC2626;"><strong>SĂN ACC OĐ THEO KHUNG GIỜ VÀNG</strong></span></a>
                </marquee>
            </div>
        </div>
    </div>
</div>

<div class="tw-rounded">
    <?php foreach ($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0'", 0) as $info) { ?>
        <div class="tw-bg-white tw-mb-3 tw-rounded">
            <div class="tw-header-sub-interface tw-sticky tw-top-12 md:tw-top-14 tw-bg-white tw-p-2 md:tw-p-3 tw-block tw-text-base md:tw-text-xl tw-border-b w-max tw-rounded-t" style="z-index: 999;">
                <h3 class="tw-uppercase tw-font-bold tw-text-red-600">
                    DANH MỤC <?= $info['name'] ?>
                </h3>
            </div>
            <div class="tw-bg-gray-100 tw-p-2 md:tw-py-4">
                <div class="tw-grid tw-grid-cols-12 tw-gap-2 md:tw-gap-4">


                    <!--<div class="tw-col-span-6 sm:tw-col-span-6 md:tw-col-span-3 tw-bg-white tw-shadow-sm tw-rounded-b-sm tw-border md:tw-border-0 md:tw-rounded-b tw-relative">-->
                    <!---->
                    <!--    <a class="" data-toggle="modal" data-target="#chargeModal">-->
                    <!--        <div class="tw-col-span-5"><img class="tw-w-full tw-rounded-t-sm md:tw-rounded-t lazyLoad isLoaded" src="https://acclienquan.vn/upload/setting/napatm.gif">-->
                    <!--        </div>-->
                    <!--        <div class="tw-col-span-12 tw-px-2 tw-py-3 tw-h-28 tw-relative">-->
                    <!--            <h4 class="tw-sub-interface-title tw-uppercase tw-text-xs tw-font-semibold tw-text-gray-800 tw-mb-0">NẠP TIỀN +20% KHUYẾN MÃI</h4>-->
                    <!--            <div class="tw-my-1 tw-text-xs tw-text-gray-600 tw-sub-interface-info">-->

                    <!--            </div>-->
                    <!--            <div class="tw-absolute tw-bottom-2 tw-right-2 tw-left-2 tw-mt-2">-->
                    <!--<button class="eKJDZl tw-old tw-text-xss tw-px-1.5"><span> 38,000 </span></button>-->
                    <!--                <button class="bbXLrA">NẠP NGAY</button>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </a>-->
                    <!--</div>-->


                    <?php
                    foreach ($db->fetch_assoc("SELECT DISTINCT `type_category`,`id`,`detail`,`product`,`type`,`type_category`,`stt` FROM `product_game` WHERE `site` IN ('ALL','{$site}') AND `product` = '{$info['key_product']}' ORDER BY `stt` ASC", 0) as $query) {
                        $detail = json_decode($query['detail'], true);
                        $count_game = $db->fetch_assoc("SELECT COUNT(*) AS total FROM `history_minigame` WHERE `type_category` = '{$query['type_category']}'", 0)[0]['total'];
                        $count_account = $db->fetch_assoc("SELECT COUNT(*) AS total FROM `list_account` WHERE `type_category` = '{$query['type_category']}' AND `status` = 'on'", 0)[0]['total'];
                    ?>
                        <div class="tw-col-span-6 sm:tw-col-span-6 md:tw-col-span-3 tw-bg-white tw-shadow-sm tw-rounded-b-sm tw-border md:tw-border-0 md:tw-rounded-b tw-relative">
                            <!---->
                            <a href="/<?= to_slug($query['type']) ?>/<?= $query['type_category'] ?>" class="">
                                <div class="tw-col-span-5"><img class="tw-w-full tw-rounded-t-sm md:tw-rounded-t lazyLoad isLoaded" src="<?= $detail['thumb'] ?>"></div>
                                <div class="tw-col-span-12 tw-px-2 tw-py-3 tw-h-28 tw-relative">
                                    <h4 class="tw-sub-interface-title tw-uppercase tw-text-xs tw-font-semibold tw-text-gray-800 tw-mb-0">
                                        <?= $detail['name_product'] ?>
                                    </h4>
                                    <div class="tw-my-1 tw-text-xs tw-text-gray-600 tw-sub-interface-info">
                                        <span>
                                            <?php if ($query['product'] == 'minigame') { ?>
                                                Đã bán: <b class="tw-text-red-500"><?= number_format($count_game + 20000) ?></b>
                                            <?php } elseif ($query['product'] == 'account-game' && $query['type'] == 'DIAMONDBOX') { ?>
                                                Đã mua: <b class="tw-text-red-500"><?= number_format($count_game + 20000) ?></b>
                                            <?php } else { ?>
                                                Tài khoản hiện có: <b class="tw-text-red-500"><?= number_format($count_account) ?></b>
                                            <?php } ?>
                                        </span>
                                        <!---->
                                    </div>
                                    <?php if ($query['product'] == 'minigame') : ?>
                                        <div class="tw-absolute tw-bottom-2 tw-right-2 tw-left-2 tw-mt-2">
                                            <button class="eKJDZl tw-old tw-text-xss tw-px-1.5"><span> <?= number_format($detail['cash'] + ($detail['cash'] * $detail['sale_cash'] / 100)) ?> </span></button>
                                            <button class="bbXLrA"><?= number_format($detail['cash']) ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="tw-preview tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" style="z-index: 1002; background: rgba(93, 93, 93, 0.77); display: none;" id="modalThongBao">
    <div class="tw-relative tw-max-w-lg tw-w-full tw-mx-auto tw-bg-white tw-rounded">
        <span class="tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-rounded-full tw-text-sm tw-font-bold tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" onclick="closeModalindex()" style="top: -15px; right: -5px; z-index: 100;"><i class="bx bx-x"></i></span>
        <div class="tw-p-2 tw-bg-red-600 tw-text-white tw-font-bold tw-text-center tw-rounded-t"><i class="tw-relative bx bxs-bell-ring tw-text-xl" style="top: 3px;"></i>
            THÔNG BÁO
        </div>
        <div class="tw-p-2 tw-py-4" style="max-height: auto; overflow-y: auto;">
            <div class="relative tw-leading-7">
                <?= html_entity_decode($dataWeb['thongbao']) ?>
            </div>
        </div>
    </div>
</div>

<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/views/footer.php'); ?>