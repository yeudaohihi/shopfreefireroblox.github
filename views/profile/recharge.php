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
                    <script>
                        function Tab(id){
                            var i, tabcontent, tablinks;
                            tabcontent = document.getElementsByClassName("tabcontent");
                            for (i = 0; i < tabcontent.length; i++) {
                                    tabcontent[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName("tablinks");
                            for (i = 0; i < tablinks.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" vactive", "");
                            }
                            document.getElementById(id).style.display = "block";
                            event.currentTarget.className += " vactive";
                        }
                    </script>
                    <style>
                        .vactive{
                            --tw-border-opacity: 1;
                            border-color: rgba(239,68,68,var(--tw-border-opacity));
                            --tw-bg-opacity: 1;
                            background-color: rgba(239,68,68,var(--tw-bg-opacity));
                            font-weight: 800 !important;
                            --tw-text-opacity: 1;
                            color: rgba(255,255,255,var(--tw-text-opacity));
                        }
                    </style>
                    <div class="tw-col-span-12 md:tw-col-span-8">
                        <div class="tw-bg-white tw-rounded tw-p-4 md:tw-py-4 md:tw-px-5 tw-w-full tw-mb-4">
                            <div class="tw-border-b tw-border-gray-200 tw-pb-2 tw-mb-4 tw-text-gray-800">
                                <h2 class="tw-text-lg tw-font-semibold">Nạp Thẻ Cào</h2>
                                <p class="tw-text-xs">
                                    Tự động 24/7 - Nhập sai mệnh giá sẽ mất thẻ.
                                </p>
                            </div>
                            <!---->
                            <form id="charge" class="tw-max-w-sm form_data" method="POST" >
                                <div class="tw-mb-2">
                                    <div id="msgCard" style="padding-bottom: 13px;"></div>
                                    <label class="tw-text-gray-700 tw-text-sm"> Nhà mạng <b>(Ưu tiên Viettel, Vinaphone)</b></label>
                                    <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-text-sm">
                                        <style>
                                            #charge label {
                                                display: flex;
                                                align-items: center;
                                            }
                                            [type=radio] { 
                                                position: absolute;
                                                opacity: 0;
                                                left: -9999px;
                                            }
                                            [type=radio] {
                                                cursor: pointer;
                                            }
                                            [type=radio]:checked + label {
                                                border-width: 2px;
                                                --tw-border-opacity: 1;
                                                border-color: rgba(239,68,68,var(--tw-border-opacity));
                                            }
                                            [type=radio]:checked + label>img {
                                                filter: grayscale(0%);
                                            }
                                            label>img{
                                                filter: grayscale(100%);
                                            }
                                        </style>
                                        <input type="radio" id="vt" name="type" value="Viettel" class="input-absolute" checked/>
                                        <label for="vt" class="tw-col-span-4 tw-border-gray-300 tw-h-10 tw-px-3 tw-rounded tw-font-bold">
                                            <img src="/assets/images/viettel.png" />
                                        </label>

                                        <input type="radio" id="vn" name="type" value="Vinaphone"  class="input-absolute"/>
                                        <label for="vn" class="tw-col-span-4 tw-border-gray-300 tw-h-10 tw-px-3 tw-rounded tw-font-bold">
                                            <img src="/assets/images/vinaphone.png" />
                                        </label>

                                        <input type="radio" id="mb" name="type" value="Mobifone"  class="input-absolute"/>
                                        <label for="mb" class="tw-col-span-4 tw-border-gray-300 tw-h-10 tw-px-3 tw-rounded tw-font-bold">
                                            <img src="/assets/images/mobifone.png" />
                                        </label>
                                    </div>
                                </div>
                                <div class="tw-mb-2">
                                    <label class="tw-text-gray-700 tw-text-sm"> Mệnh giá </label>
                                    <select name="amount" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none">
                                        <option disabled="disabled" value="">Chọn mệnh giá</option>
                                        <option class="tw-font-medium tw-text-red-600" value="10000">
                                            Thẻ 10,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="20000">
                                            Thẻ 20,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="30000">
                                            Thẻ 30,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="50000">
                                            Thẻ 50,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="100000">
                                            Thẻ 100,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="200000">
                                            Thẻ 200,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="300000">
                                            Thẻ 300,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="500000">
                                            Thẻ 500,000đ
                                        </option>
                                        <option class="tw-font-medium tw-text-red-600" value="1000000">
                                            Thẻ 1,000,000đ
                                        </option>
                                    </select>
                                </div>
                                <div class="tw-mb-4"><label class="tw-text-gray-700 tw-text-sm"> Mã thẻ </label> <input name="code" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none" /></div>
                    
                                <div class="tw-mb-4"><label class="tw-text-gray-700 tw-text-sm"> Serial thẻ </label> <input name="serial" class="tw-border tw-border-gray-300 tw-h-10 tw-px-3 tw-w-full tw-rounded focus:tw-outline-none" /></div>
                    
                                <button type="button" onclick="Napthe()" class="tw-text-center tw-h-10 tw-bg-red-500 tw-w-32 hover:tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded">
                                    Nạp Thẻ
                                </button>
                            </form>
                        </div>
                        <div class="tw-border-2 tw-border-amber-300 tw-bg-white tw-rounded tw-text-sm tw-leading-7 tw-px-3 tw-py-1 tw-my-2">
                            <div class="relative">
                                <p>
                       
                                    <span style="color: rgb(220, 38, 38);"><strong>Lưu ý: </strong></span>
                                </p>
                                <p>
                                    <span style="color: rgb(220, 38, 38);"><strong>- Vui lòng nạp đúng mệnh giá, sai mệnh giá sẽ không được cộng tiền vào tài khoản.</strong></span>
                                </p>
                                <p>
                                    <span style="color: rgb(220, 38, 38);"><strong>- Thẻ cào bị treo ĐANG XỬ LÝ quá 10p kể từ lúc nạp thẻ xin vui lòng liên hện page để được hỗ trợ.</strong></span>
                                </p>
                            </div>
                        </div>
                        <div class="tw-mt-4 tw-bg-white tw-rounded tw-w-full">
                            <div class="tw-border-b tw-border-gray-200 tw-pb-2 tw-text-gray-800 tw-p-3 md:tw-py-3 md:tw-px-5"><h2 class="tw-text-lg tw-font-semibold">Thẻ Nạp Gần Nhất</h2></div>
                            <div id="list" class="tw-p-2 md:tw-p-4">
                                <table class="tw-w-full tw-rounded-t">
                                    <thead>
                                        <tr class="tw-text-md tw-font-semibold tw-tracking-wide tw-text-left tw-text-gray-900 tw-border tw-border-b-0 tw-bg-gray-200">
                                            <th class="tw-px-2 tw-py-2">Thẻ Nạp</th>
                                            <th class="tw-px-2 tw-py-2"><span class="tw-hidden md:tw-block">Mã thẻ/Seri</span> <span class="tw-block md:tw-hidden">Chi tiết</span></th>
                                            <th class="tw-px-2 tw-py-2 tw-hidden md:tw-block">
                                                M.giá/T.nhận
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white tw-border tw-border-t-0 tw-rounded">
                                    <?php
    $current_page = isset($_GET['page']) ? (int)Anti_xss($_GET['page']) : 1;

    if ($current_page < 1){
        $current_page = 1;
    }

    $sql_acc = "SELECT * FROM `history_recharge` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}'";
    $total_records = $db->num_rows($sql_acc);
    $limit = 10; // giới hạn số lượng trên 1 trang
    if ($limit < 0){
        $limit = 0;
    }
    $total_page = ceil($total_records / $limit);
    if (!$total_page){
        $total_page = 1;
    }
    if ($current_page < 1){
        $current_page = 1;
    }
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    $start = ($current_page - 1) * $limit;
    $range = 3; // độ dài của nút trang
    $middle = ceil($range / 2);
    if ($total_page < $range) {
        $min = 1;
        $max = $total_page;
    } else {
        $min = $current_page - $middle + 1;
        $max = $current_page + $middle - 1;
        if ($min < 1) {
            $min = 1;
            $max = $range;
        } else if ($max > $total_page) {
            $max = $total_page;
            $min = $total_page - $range + 1;
        }
    }
    if($_SERVER['QUERY_STRING']){
        $re = '/([?])page/m';
        $str = $_SERVER['REQUEST_URI'];
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        if($matches[0][0] == '?page'){
            $link = $_SERVER['SCRIPT_URI'].'?page=';
        }else{
            $url = $_SERVER['SCRIPT_URI'].'?'.$_SERVER['QUERY_STRING'];
            $link = removeParams($url, 'page').'&page=';
        }
    }else{
        $link = $_SERVER['SCRIPT_URI'].'?page=';
    }
    function removeParams($url, $param){
        $new_Url = preg_replace('/([?&])'.$param.'[^&]+(&|$)/', '', $url);
        $url = trim($new_Url, '&');
        $url = trim($new_Url, '?');
        return $url;
    }
    $tt = new Info;
    $sql_show = "SELECT * FROM `history_recharge` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ORDER BY `id` DESC LIMIT $start, $limit";
    if($total_records > 0){
    foreach($db->fetch_assoc($sql_show, 0) as $info){
?>
                                        <tr class="tw-text-gray-700 tw-border-b">
                                            <td class="tw-px-2 tw-py-1 md:tw-py-2 tw-text-xs">
                                                <div>
                                                    <p class="tw-font-bold text-black">
                                                        <?=$info['type']?>
                                                    </p>
                                                    <p class="text-xs text-gray-600 tw-font-semibold">
                                                        <?=date('Y-m-d H:i:s',$info['created_at'])?>
                                                    </p>
                                                    <p class="tw-mt-1 text-xs text-gray-600 tw-font-semibold"><span class="tw-text-<?=status_history($info['status'])['color']?>-600"><?=status_history($info['status'])['text']?></span></p>
                                                </div>
                                            </td>
                                            <td class="tw-px-2 tw-py-2 tw-text-xs">
                                                <div class="tw-text-xs md:tw-text-sm">
                                                    <p class="tw-font-bold text-black">
                                                        Mã:  <?=$info['code']?>
                                                    </p>
                                                    <p class="tw-font-semibold text-xs">
                                                        Seri:  <?=$info['serial']?>
                                                    </p>
                                                </div>
                                                <div class="tw-block md:tw-hidden tw-border-t tw-mt-2 tw-pt-2 tw-font-semibold tw-leading-5">
                                                    <p class="tw-text-gray-800">
                                                        <i class="bx bxs-upvote tw-relative" style="top: 1px;"></i>
                                                        Gửi Thẻ:  <?=number_format($info['amount'])?>đ
                                                    </p>
                                                    <p class="tw-text-sm tw-text-<?=status_history($info['status'])['color']?>-600">
                                                        <i class="bx bxs-downvote tw-relative" style="top: 1px;"></i>
                                                        Nhận:
                                                        <?if($info['status'] == 3 || $info['status'] == 4):?>
                                                            <b>0đ</b>
                                                            <?else:?>
                                                        <b> <?=number_format($info['amount'])?>đ</b>
                                                        <?endif;?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="tw-px-2 tw-py-1 tw-text-xs tw-hidden md:tw-block">
                                            <div class="tw-block md:tw-block tw-hidden tw-pt-2 tw-font-semibold tw-leading-5">
                                                    <p class="tw-text-gray-800">
                                                        <i class="bx bxs-upvote tw-relative" style="top: 1px;"></i>
                                                        Gửi Thẻ:  <?=number_format($info['amount'])?>đ
                                                    </p>
                                                    <p class="tw-text-sm tw-text-<?=status_history($info['status'])['color']?>-600">
                                                        <i class="bx bxs-downvote tw-relative" style="top: 1px;"></i>
                                                        Nhận:
                                                        <?if($info['status'] == 3 || $info['status'] == 4):?>
                                                            <b>0đ</b>
                                                            <?else:?>
                                                        <b> <?=number_format($info['amount'])?>đ</b>
                                                        <?endif;?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <?php if($total_records > 0){ ?>
                                <div class="tw-pb-8">
                                    <div class="tw-min-w-max">
                                        <section class="tw-flex tw-justify-between tw-py-1 tw-text-gray-700 tw-font-montserrat tw-select-none">
                                            <ul class="tw-flex tw-items-center">
                                            <?php if($current_page - 3 > 1){ ?>
                                                <li href="<?=$link?>1" class="tw-pr-2">
                                                    <a class="tw-cursor-pointer">
                                                        <div
                                                            class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white"
                                                        >
                                                            <span class="transform">1</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tw-pr-2">...</li>
                                                <?php } ?>
                                                <?php
                                                    for ($i = $min; $i <= $max; $i++){
                                                        if ($current_page == $i){
                                                ?>
                                                <li href="" class="tw-pr-2">
                                                <a class="tw-cursor-pointer">
                                                    <div
                                                        class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white"
                                                    >
                                                        <span class="transform"><?=$i?></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                                            }else{
                                            ?>
                                            <li href="<?=$link.$i?>" class="tw-pr-2">
                                                <a class="tw-cursor-pointer">
                                                    <div
                                                        class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white"
                                                    >
                                                        <span class="transform"><?=$i?></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                                                }  }
                                            ?>
                                            <?php if($current_page + 3 < $total_page){ ?>
                                                <li class="tw-pr-2">...</li>
                                                <li href="<?=$link.$total_page?>" class="tw-pr-2">
                                                    <a class="tw-cursor-pointer">
                                                        <div class="tw-flex hover:tw-bg-gray-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center">
                                                            <span class="tw-transform">
                                                            <?=$total_page?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <li href="<?=$current_page==1 ? '#' : $link.($current_page + 1)?>" class="tw-pr-2">
                                                    <a class="tw-cursor-pointer">
                                                        <div class="tw-flex tw-items-center tw-justify-center hover:tw-bg-gray-200 tw-rounded-md tw-transform tw-text-sm tw-h-6 tw-px-2">
                                                            <div class="tw-transform">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tw-h-4 tw-w-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            
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