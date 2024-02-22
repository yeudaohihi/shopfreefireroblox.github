<div id="element">
    <!-- <section class="tw-fullscreen"> -->
    <section>
        <div class="tw-sticky tw-top-0 tw-bg-white tw-border-b tw-border-gray-100" style="z-index: 1000;">
            <div class="tw-max-w-6xl tw-mx-auto tw-flex tw-justify-between tw-items-center tw-px-2 tw-py-1 md:tw-py-2">
                <div class="tw-menu-left tw-flex tw-items-center">
                    <a href="/"><img class="tw-h-11" src="<?=$dataWeb['logo']?>" /></a>
                    <a href="/user/recharge" class="hidden-cs md:tw-flex tw-ml-10 tw-font-bold tw-text-red-600 hover:tw-text-red-500 tw-px-3 tw-text-sm tw-items-center tw-cursor-pointer"><span class=" tw-inline-flex tw-items-center tw-justify-center tw-h-6 tw-w-7 tw-rounded tw-bg-red-100 tw-mr-2"><i class="tw-text-lg bx bx-dollar"></i></span>
                            NẠP THẺ
                    </a>
                    <?php if($user):?>
                    <a class="hidden-cs md:tw-flex tw-ml-10 tw-font-bold tw-text-red-600  hover:tw-text-red-500 tw-px-3 tw-text-sm tw-items-center tw-cursor-pointer" data-toggle="modal" data-target="#chargeModal"><span class=" tw-inline-flex tw-items-center tw-justify-center tw-h-6 tw-w-7 tw-rounded tw-bg-red-100 tw-mr-2"><i class="tw-text-lg bx bx-credit-card-front"></i></span>
                            NẠP ATM/MOMO
                    </a>
                    <?php else: endif; ?> 
                </div>
                <div class="tw-menu-right tw-flex tw-flex-wrap tw-items-center tw-justify-right">
                    <button class="tw-mr-1 md:tw-mr-2 tw-bg-gray-200 tw-items-center tw-flex tw-justify-center tw-border tw-border-gray-200 tw-w-8 md:tw-w-10 tw-rounded-full tw-text-red-600 tw-text-lg md:tw-text-2xl tw-h-8 md:tw-h-10">
                    <a href="https://www.facebook.com/<?=$dataWeb['id_fanpage']?>">
                        <i class="bx bxl-facebook"></i>
                    </a>
                    </button>
                    <?php if(!$user):?>
                        <button class="tw-bg-red-500 hover:tw-bg-red-600 tw-transition tw-duration-200 tw-text-white tw-text-sm tw-px-4 tw-rounded-full tw-font-semibold tw-h-8 md:tw-h-10 tw-relative" data-toggle="modal" data-target="#loginModal">
                            <span class="tw-hidden md:tw-inline-block"><i class="tw-absolute tw-text-lg bx bxs-user" style="top: 10px;"></i></span> 
                            <span class="md:tw-ml-6">ĐĂNG NHẬP</span>
                        </button>
                    <?php else: ?>  
                    <div class="tw-relative dropdown-profile">
                        <button class="tw-bg-red-500 hover:tw-bg-red-600 tw-transition tw-duration-200 tw-text-white tw-text-sm tw-flex tw-items-center tw-pr-8 tw-pl-2 md:tw-pl-3 tw-rounded-full tw-font-semibold tw-h-8 md:tw-h-10 tw-relative"
                            style="min-width: 4rem;">
                            <span><img class="tw-hidden md:tw-block tw-w-6 tw-rounded-full tw-border" src="/assets/images/unknown-avatar.jpg" /></span>
                            <span class="tw-hidden md:tw-block tw-relative tw-ml-1" style="top: -1px;">|</span>
                            <span class="tw-ml-1 tw-font-bold"> <?=number_format($data_user['cash'])?>đ</span> 
                            <i class="tw-top-1.5 md:tw-top-2.5 tw-text-lg tw-absolute bx bx-caret-down-circle" style="right: 8px;"></i>
                        </button>
                        <div class="tw-absolute tw-max-w-md tw-w-64 tw-rounded tw-bg-white tw-shadow-lg dropdown-content" style="display: none; top: 46px; z-index: 2; right: 0px;">
                            <div class="tw-w-64">
                                <div class="tw-border-b tw-border-gray-100 tw-grid tw-grid-cols-12 tw-gap-2 tw-p-2">
                                    <div class="tw-col-span-2 tw-flex tw-items-center tw-justify-content"><img class="tw-w-full tw-rounded-full" src="/assets/images/unknown-avatar.jpg" /></div>
                                    <div class="tw-col-span-9">
                                        <p><b>ID:</b> <?=$data_user['id']?></p>
                                        <p><b>User:</b> <?=$arr_user['name']?></p>
                                        <p><b>Số dư:</b> <span class="tw-text-red-600 tw-font-bold"><?=number_format($data_user['cash'])?>đ</span></p>
                                    </div>
                                </div>
                                <div class="tw-text-sm">
                                    
                                    <?php if($data_user['type'] == '2'):?>   
                                    <span class="tw-mt-2 tw-text-red-500 tw-font-bold tw-text-sm tw-block tw-px-3">
                                        HỆ THỐNG
                                    </span>    
                                        
                                    <div class="tw-px-2">
                                        <a href="/Cpanel" class="tw-font-semibold hover:tw-text-gray-800 hover:tw-bg-gray-100 tw-block tw-py-1 tw-px-3"><i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Admin Dashboard</a>
                                    </div>
                                        
                                    <?php endif;?>
                                    <span class="tw-mt-2 tw-text-red-500 tw-font-bold tw-text-sm tw-block tw-px-3">
                                        TÀI KHOẢN
                                    </span>
                                    <div class="tw-px-2">
                                        <a href="/user/profile" class="tw-font-semibold hover:tw-text-gray-800 hover:tw-bg-gray-100 tw-block tw-py-1 tw-px-3"><i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Thông tin chung</a>
                                    </div>
                                    <span class="tw-text-red-500 tw-font-bold tw-text-sm tw-my-1 tw-block tw-px-3">
                                        <i class="tw-relative bx bxs-dollar-circle" style="top:1px;"></i>
                                        NẠP TIỀN & RÚT VẬT PHẨM
                                    </span>
                                    <div class="tw-px-2">
                                        <a href="/user/recharge" class="tw-font-semibold hover:tw-bg-gray-100 hover:tw-text-gray-800 tw-block tw-py-1 tw-px-3">
                                            <i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Nạp thẻ cào (tự động)
                                        </a>
                                        <a href="/user/diamond" class="tw-font-semibold hover:tw-bg-gray-100 hover:tw-text-gray-800 tw-block tw-py-1 tw-px-3">
                                            <i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Rút kim cương
                                        </a>
                                    </div>
                                    <span class="tw-text-red-500 tw-font-bold tw-text-sm tw-my-1 tw-block tw-px-3">
                                        LỊCH SỬ
                                    </span>
                                    <div class="tw-px-2">
                                        <a href="/user/history/game" class="tw-font-semibold hover:tw-text-gray-800 hover:tw-bg-gray-100 tw-block tw-py-1 tw-px-3"><i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Lịch sử chơi game</a>
                                        <a href="/user/history/acc" class="tw-font-semibold hover:tw-text-gray-800 hover:tw-bg-gray-100 tw-block tw-py-1 tw-px-3"><i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Lịch sử mua nick</a>
                                        <a href="/user/recharge" class="tw-font-semibold hover:tw-text-gray-800 hover:tw-bg-gray-100 tw-block tw-py-1 tw-px-3"><i class="tw-relative bx bx-chevron-right" style="top: 1px;"></i> Lịch sử nạp thẻ</a>
                                    </div>
                                    <div class="tw-p-2">
                                        <a href="/user/logout">
                                        <button class="tw-py-1 tw-rounded tw-text-center tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-font-semibold tw-w-full">
                                            Đăng xuất
                                        </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>