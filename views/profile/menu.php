<div class="tw-col-span-2 tw-hidden md:tw-block">
        <div class="tw-w-full md:tw-bg-transparent tw-p-2 md:tw-p-0 tw-sticky tw-top-20" style="z-index: 999;">
            <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-pr-2 tw-pb-2">
                <div class="tw-col-span-3 tw-flex tw-items-center tw-justify-content"><img class="tw-w-full tw-rounded-full tw-border" src="/assets/images/unknown-avatar.jpg" />
                </div>
                <div class="tw-col-span-9">
                    <p class="tw-flex tw-items-center">
                        <b class="tw-mr-1">ID:</b>
                        <?=$data_user[id]?>
                            <span class="tw-w-4 tw-h-4 tw-flex tw-items-center tw-justify-center tw-ml-2 tw-text-gray-600 tw-cursor-pointer" onclick="copy('<?=$data_user[id]?>')"><i class="bx bxs-copy"></i></span></p>
                    <p class="tw-text-sm"><b>Số dư:</b> <span class="tw-text-red-600 tw-font-bold"><?=number_format($data_user[amount])?>đ</span></p>
                    <!--<p class="tw-text-sm"><b>Lượt quay:</b> <span class="tw-text-red-600 tw-font-bold"><?=number_format($data_user[numrollfree])?> lượt</span></p>-->
                </div>
            </div>
            <div class="tw-mb-4 tw-w-3/4 tw-border-b tw-border-gray-200"></div>
            <div>
                <div class="tw-mb-3">
                    <div class="tw-relative tw-font-semibold tw-text-gray-800">
                        <span class="tw-h-7 tw-w-7 tw-rounded-full tw-inline-flex tw-justify-center tw-items-center tw-absolute tw-bg-red-500 tw-text-white" style="top: -2px;"><i class="tw-text-lg bx bxs-user"></i></span>
                        <span class="tw-ml-10 tw-block tw-text-red-600">Tài khoản </span>
                    </div>
                    <div class="tw-ml-11 tw-mt-1 tw-text-sm tw-font-semibold tw-text-gray-700">
                        <ul>
                            <a href="/user/profile" aria-current="page" class="tw-block tw-py-1 nuxt-link-exact-active nuxt-link-active tw-text-red-600">Thông tin chung </a>
                            <a href="/user/changepassword" class="tw-block tw-py-1">Đổi mật khẩu</a>
                        </ul>
                    </div>
                </div>
                <div class="tw-mb-3">
                    <div class="tw-relative tw-font-semibold tw-text-gray-800">
                        <span class="tw-h-7 tw-w-7 tw-rounded-full tw-inline-flex tw-justify-center tw-items-center tw-absolute tw-bg-gray-200" style="top: -2px;"><i class="tw-text-lg bx bxs-game"></i></span>
                        <span class="tw-ml-10 tw-block">Trò chơi </span>
                    </div>
                    <div class="tw-ml-11 tw-mt-1 tw-text-sm tw-font-semibold tw-text-gray-700">
                        <ul>
                            <a href="/user/diamond" class="tw-block tw-py-1">Rút vật phẩm</a>
                        </ul>
                    </div>
                </div>
                <div class="tw-mb-3">
                    <div class="tw-relative tw-font-semibold tw-text-gray-800">
                        <span class="tw-h-7 tw-w-7 tw-rounded-full tw-inline-flex tw-justify-center tw-items-center tw-absolute tw-bg-gray-200" style="top: -2px;"><i class="tw-text-lg bx bxs-wallet-alt"></i></span>
                        <span class="tw-ml-10 tw-block">Giao dịch </span>
                    </div>
                    <div class="tw-ml-11 tw-mt-1 tw-text-sm tw-font-semibold tw-text-gray-700">
                        <ul>
                            <a href="/user/recharge" class="tw-block tw-py-1">Nạp thẻ cào tự động</a>
                            <a class="tw-block tw-py-1" data-toggle="modal" data-target="#chargeModal">Nạp qua ATM/MOMO</a>
                        </ul>
                    </div>
                </div>
                <div class="tw-mb-3">
                    <div class="tw-relative tw-font-semibold tw-text-gray-800">
                        <span class="tw-h-7 tw-w-7 tw-rounded-full tw-inline-flex tw-justify-center tw-items-center tw-absolute tw-bg-gray-200" style="top: -2px;"><i class="tw-text-lg bx bxs-notepad"></i></span>
                        <span class="tw-ml-10 tw-block">Lịch sử</span>
                    </div>
                    <div class="tw-ml-11 tw-mt-1 tw-text-sm tw-font-semibold tw-text-gray-700">
                        <ul>
                            <a href="/user/history/game" class="tw-block tw-py-1">Lịch sử chơi game</a>
                            <a href="/user/history/acc" class="tw-block tw-py-1">Lịch sử mua nick</a>
                            <a href="/user/recharge" class="tw-block tw-py-1">Lịch sử nạp thẻ</a>
                            <a href="/user/diamond" class="tw-block tw-py-1">Lịch sử rút vật phẩm</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
