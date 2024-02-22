<div class="tw-max-w-6xl tw-mx-auto">
    <div class="tw-grid tw-grid-cols-12 tw-gap-2 md:tw-gap-4 tw-mt-4 tw-mb-2 tw-px-2 md:tw-px-0">
        <div class="tw-col-span-12 md:tw-col-span-8">
            <div class="tw-relative">
                <div class="tw-relative slick-slider slick-initialized">
                    <div class="slick-list">
                        <img class="tw-object-center tw-object-fill tw-h-48 md:tw-h-80 tw-w-full tw-rounded" src="<?=$dataWeb['banner']?>"/>
                    </div>
                </div>
                <span class="pagination tw-absolute tw-inline-block tw-px-1 tw-rounded tw-text-white tw-font-bold tw-text-xs" style="bottom: 10px; right: 5px;">1/1</span>
            </div>
        </div>
        <script>
            function Tab(id){
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(id).style.display = "block";
                event.currentTarget.className += " active";
            }
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <div class="tw-col-span-12 md:tw-col-span-4">
        <div class="bg-white w-full" style="min-height: 360px;">
            <div class="tw-flex tw-font-bold">
                <div class="tw-transition tw-duration-200 tw-cursor-pointer tw-w-full tw-rounded-tl tw-text-gray-800 tw-bg-gray-200 hover:tw-bg-gray-300 tablinks active" onclick="Tab('top')">
                    <div class="tw-py-2 tw-text-center tw-px-2 tw-font-bold tw-text-lg tw-relative">
                        <span class="tw-absolute tw-text-base" style="top: 0px; left: 20%;">TOP NẠP T.<?=date('m')?></span>
                        <div class="tw-text-xs tw-flex tw-justify-center tw-relative" style="top: 16px;">
                            <button class="tw-mr-1 tw-font-bold tw-px-2 tw-h-4 tw-bg-amber-500 tw-rounded tw-flex tw-items-center tw-text-white tw-relative tw-active">
                                <small>THẺ CÀO</small>
                            </button>
                            <!-- <button class="tw-font-bold tw-px-2 tw-h-4 tw-bg-amber-500 tw-rounded tw-flex tw-items-center tw-text-white tw-relative"><small>ATM / MOMO</small></button> -->
                        </div>
                    </div>
                </div>
                <div class="tw-transition tw-duration-200 tw-cursor-pointer tw-rounded-tr tw-text-gray-800 tw-bg-gray-200 hover:tw-bg-gray-300 tablinks" onclick="Tab('gift')">
                    <h2 class="tw-py-2 tw-px-3 tw-w-48 tw-text-center tw-font-bold tw-text-lg">
                        PHẦN THƯỞNG
                    </h2>
                </div>
            </div>
            <style>
                .active{
                    --tw-bg-opacity: 1;
                    background-color: rgba(255,255,255,var(--tw-bg-opacity));
                    --tw-text-opacity: 1;
                    color: rgba(220,38,38,var(--tw-text-opacity));
                }
            </style>
            <div class="tw-bg-white tw-py-2 tw-rounded-b" style="min-height: 275px;">
                <div class="tw-px-3 tabcontent" id="top">
                    <div class="v-list-top-card py-1">
                        <div class="tw-overflow-y-auto" style="max-height: 10.9rem;">

                            <?php
      							$i = 1;
                                 $day = date('m-Y');
                                 $top = $db->fetch_assoc("SELECT SUM(amount) as total,username,name FROM `top` WHERE `site` = '{$site}' AND DATE_FORMAT(FROM_UNIXTIME(top.created_at), '%m-%Y') = '{$day}' GROUP BY `username`,`name` ORDER BY `total` DESC LIMIT 5", 0);
                                 if($top){
                                   foreach($top as $info){
                                     if($info['total'] >= 10000){                                                                      
                             ?>

                            <div class="tw-flex tw-items-center tw-justify-between tw-px-2 tw-py-0" style="height: 2.2rem;">
                                <div class="tw-flex tw-items-center">
                                    <div class="v-star tw-relative">
                                    <i class="bx tw-text-3xl tw-text-<?=color_top($i)[color]?> bxs-<?=color_top($i)[icon]?>"></i>
                                    <span class="tw-absolute tw-text-sm tw-font-bold tw-text-white" style="top: 5px; left: 10.5px;"><?=$i?></span>
                                    </div>
                                    <span class="tw-relative tw-ml-1 tw-text-gray-800 tw-w-full tw-font-bold tw-truncate tw-text-sm" style="max-width: 8rem; top: -2px;">
                                        <?=$info['name']?>                                      
                                    </span>
                                </div>
                                <div class="tw-font-bold tw-text-lg">
                                        <span class="tw-bg-red-600 tw-w-32 tw-py-1 tw-text-white tw-rounded tw-text-center tw-inline-block tw-text-sm">
                                            <?=number_format($info['total'])?><span class="tw-text-xs"><small>đ</small>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <?php $i++; } }} ?>

                        </div>
                        <!---->
                        <div>
                            <div class="tw-mx-auto tw-w-2/3 tw-border-t tw-border-l-none tw-border-r-none tw-border-b-none tw-border-gray-300 tw-my-1 tw-mb-2"></div>
                            <div>
                                <span class="tw-inline-block tw-text-base tw-font-medium tw-border-yellow-500 tw-rounded tw-bg-yellow-100 tw-px-2 tw-py-1" style="margin-bottom: 0.4rem;">
                                    Sắp tới sẽ có <b class="tw-text-red-600">sự kiện hot</b>, hãy chờ nhé!!!
                                </span>
                            </div>
                            <!---->
                            <div class="tw-flex tw-justify-center tw-text-lg">
                                <a href="/user/recharge" class="cta tw-rounded tw-h-10 tw-cursor-pointer tw-flex tw-items-center tw-justify-center"><span class="tw-inline-block">NẠP THẺ NGAY</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-pl-3 tabcontent" id="gift" style="display: none;">
                    <div class="tw-overflow-auto tw-px-1" style="max-height: 260px;">
                        <div class="relative">
                            <p>
                                <span style="background-color: transparent;"><strong>ĐUA TOP NẠP THẺ HÀNG THÁNG</strong></span>
                            </p>
                            <p><strong>NHẬN NGAY QUÀ CỰC KHỦNG</strong></p>
                            <p><strong>TOP 1: 5 triệu tiền shop + 50.000 KC</strong></p>
                            <p><strong>TOP 2: 3 triệu tiền shop + 30.000 KC</strong></p>
                            <p><strong>TOP 3: 2 triệu tiền shop + 20.000 KC</strong></p>
                            <p><strong>TOP 4-5: 1.5 triệu tiền shop + 10.000 KC</strong></p>
                            <p><strong>TOP 6-10: 1 triệu tiền shop + 5.000 KC</strong></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
