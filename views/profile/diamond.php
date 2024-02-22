<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php'); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php'); 
    if(!@$user){
        new Redirect(DOMAIN);
        exit;
    }
?>
</div>
  <div style="min-height: 50vh; !important">
        <div class="tw-max-w-6xl tw-mx-auto tw-my-8 tw-grid tw-grid-cols-10 tw-gap-2 tw-px-2 tw-relative">
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
        .checkbox-withdraw{
        display: inline-block;
        width: 1.25rem;
        height: 1.25rem;
        border: solid 2px #cd3e3e;
        border-radius: 9999px;
        }

        #xTech-GasForm input[type=radio]{
        display: none;
        }

        #xTech-GasForm input[type=radio]:checked + .checkbox-withdraw{
        background-color: #cd3e3e;
        }
</style>
                    <div class="tw-col-span-12 md:tw-col-span-8">
                        <h2 class="tw-mb-2 tw-font-bold tw-text-xl">RÚT VẬT PHẨM (GAME)</h2>
                        <div class="tw-grid tw-grid-cols-12 tw-mb-4 tw-bg-white">
                            <button class="tablinks tw-col-span-4 tw-py-2 tw-font-semibold tw-border-b-2 tw-relative tw-rounded-tl focus:tw-outline-none hover:tw-border-red-500 vactive" onclick="Tab('kc')">
                                <img class="tw-hidden md:tw-block tw-h-12 tw-absolute tw-left-2" style="top: 6px;" src="/assets/images/icon_ff.png" />
                                <span>Rút <span class="tw-hidden md:tw-inline-block">Kim Cương</span><span class="tw-inline-block md:tw-hidden">KC</span></span>
                                <p class="tw-text-xs md:tw-text-sm tw-font-semibold">
                                    (FreeFire)
                                </p>
                             </button>
                        </div>
                        <div class="tw-bg-white tw-rounded tw-p-2 md:tw-py-4 md:tw-px-5 tw-w-full tw-mb-4">
                            <div class="tw-form-withdraw">
                                <div class="tabcontent" id="kc">
                                    <div class="tw-pb-2 tw-mb-2 tw-border-b tw-border-gray-200 tw-font-bold">
                                        Hiện có:
                                        <b class="tw-text-red-500 tw-uppercase">
                                            <?=$data_user['diamond']?> kc
                                        </b>
                                    </div>
                                    <div class="tw-grid tw-grid-cols-12 tw-gap-4">
                                        <div class="tw-col-span-12 md:tw-col-span-6">
                                        <div id="msgDiamond"></div>
                                            <form  id="form-Diamond" class="tw-px-2 md:tw-px-0">
                                                <div class="tw-mb-4">
                                                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-semibold"><b>Bước 1:</b> Chọn gói rút </label>
                                                    <div>
                                                        <div class="tw-border-b tw-py-1 tw-px-2 tw-grid tw-grid-cols-12 tw-gap-2 tw-text-sm">
                                                            <div class="tw-col-span-4 tw-text-center tw-font-semibold">
                                                                Gói
                                                            </div>
                                                            <div class="tw-col-span-8 tw-text-center tw-font-semibold">
                                                                Tỉ lệ thêm
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="tw-py-2 tw-px-2 tw-grid tw-grid-cols-11 tw-gap-2 tw-text-sm tw-border-b tw-cursor-default">
                                                            <div class="tw-col-span-1 tw-flex tw-items-center" id="xTech-GasForm">
                                                                <input type="radio" name="packdiamond" id="pack1" value="1" class="tw-block tw-h-5 tw-w-5 tw-border-2 tw-border-red-600 tw-rounded-full tw-cursor-pointer" checked>
                                                                <label class="checkbox-withdraw" for="pack1"></label></div>
                                                            <div class="tw-col-span-3 tw-border-r tw-flex tw-font-semibold tw-items-center tw-uppercase">
                                                                90 💎
                                                            </div>
                                                            <div class="tw-col-span-7">   
                                                                Rút 90 KC (80% Nhận Thêm 150 KC)
                                                            </div>
                                                        </div>
                                                        <div class="tw-py-2 tw-px-2 tw-grid tw-grid-cols-11 tw-gap-2 tw-text-sm tw-border-b tw-cursor-default">
                                                            <div class="tw-col-span-1 tw-flex tw-items-center" id="xTech-GasForm">
                                                                <input type="radio" name="packdiamond" id="pack2" value="2" class="tw-block tw-h-5 tw-w-5 tw-border-2 tw-border-red-600 tw-rounded-full tw-cursor-pointer">
                                                                <label class="checkbox-withdraw" for="pack2"></label></div>
                                                            <div class="tw-col-span-3 tw-border-r tw-flex tw-font-semibold tw-items-center tw-uppercase">
                                                                230 💎
                                                            </div>
                                                            <div class="tw-col-span-7">
                                                                Rút 230 KC (50% Nhận Thêm 300 KC)
                                                            </div>
                                                        </div>
                                                        <div class="tw-py-2 tw-px-2 tw-grid tw-grid-cols-11 tw-gap-2 tw-text-sm tw-border-b tw-cursor-default">
                                                            <div class="tw-col-span-1 tw-flex tw-items-center" id="xTech-GasForm">
                                                                <input type="radio" name="packdiamond" id="pack3" value="3" class="tw-block tw-h-5 tw-w-5 tw-border-2 tw-border-red-600 tw-rounded-full tw-cursor-pointer">
                                                                <label class="checkbox-withdraw" for="pack3"></label></div>
                                                            <div class="tw-col-span-3 tw-border-r tw-flex tw-font-semibold tw-items-center tw-uppercase">
                                                                465 💎
                                                            </div>
                                                            <div class="tw-col-span-7">
                                                                Rút 465 KC (30% Nhận Thêm 2,000 KC)
                                                            </div>
                                                        </div>
                                                        <div class="tw-py-2 tw-px-2 tw-grid tw-grid-cols-11 tw-gap-2 tw-text-sm tw-border-b tw-cursor-default">
                                                            <div class="tw-col-span-1 tw-flex tw-items-center" id="xTech-GasForm">
                                                                <input type="radio" name="packdiamond" id="pack4" value="4" class="tw-block tw-h-5 tw-w-5 tw-border-2 tw-border-red-600 tw-rounded-full tw-cursor-pointer">
                                                                <label class="checkbox-withdraw" for="pack4"></label></div>
                                                            <div class="tw-col-span-3 tw-border-r tw-flex tw-font-semibold tw-items-center tw-uppercase">
                                                                950 💎
                                                            </div>
                                                            <div class="tw-col-span-7">
                                                                Rút 950 KC (15% Nhận Thêm 5,000 KC)
                                                            </div>
                                                        </div>
                                                        <div class="tw-py-2 tw-px-2 tw-grid tw-grid-cols-11 tw-gap-2 tw-text-sm tw-border-b tw-cursor-default">
                                                            <div class="tw-col-span-1 tw-flex tw-items-center" id="xTech-GasForm">
                                                                <input type="radio" name="packdiamond" id="pack5" value="5" class="tw-block tw-h-5 tw-w-5 tw-border-2 tw-border-red-600 tw-rounded-full tw-cursor-pointer">
                                                                <label class="checkbox-withdraw" for="pack5"></label></div>
                                                            <div class="tw-col-span-3 tw-border-r tw-flex tw-font-semibold tw-items-center tw-uppercase">
                                                                2375 💎
                                                            </div>
                                                            <div class="tw-col-span-7">
                                                                Rút 2375 KC (5% Nhận Thêm 10,000 KC)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tw-mb-2">
                                                    <label class="tw-block tw-mb-1 tw-text-sm tw-font-semibold"><b>Bước 2:</b> Nhập ID game (FreeFire) </label>
                                                    <input name="idgame" placeholder="Nhập ID game của bạn" class="tw-h-10 tw-px-3 tw-rounded tw-font-semibold tw-border tw-border-gray-400 tw-w-full focus:tw-outline-none" />
                                                    <p class="tw-mt-1 tw-mb-2 tw-text-sm tw-text-gray-600"><i>Ví dụ: 3098435880</i></p>
                                                </div>
                                                <!---->
                                                <!---->
                                                <div>
                                                    <button type="button" onclick="Diamond()" class="tw-h-10 tw-px-3 tw-text-center tw-font-semibold tw-bg-red-500 tw-text-white tw-w-full tw-rounded focus:tw-outline-none">
                                                        RÚT NGAY
                                                    </button>
                                                </div>
                                            </form>
                                            <a href="#" class="tw-mt-4 tw-block md:tw-hidden tw-px-1 tw-font-semibold hover:tw-text-red-600">#Xem Danh sách rút vật phẩm</a>
                                        </div>
                                        <div class="tw-col-span-12 md:tw-col-span-6 tw-text-sm">
                                            <div class="tw-border-2 tw-border-amber-300 tw-bg-white tw-rounded tw-text-sm tw-leading-7 tw-px-3 tw-py-1 tw-my-2" style="overflow-y: auto; height: 26.9rem;">
                                                <div class="relative">
                                                    <p>
                                                        <span style="color: rgb(22, 163, 74);"><strong>Lưu ý: nếu bạn gặp vấn đề khi rút vật phẩm hãy liên hệ chăm sóc khách hàng để được hỗ trợ. Trường hợp rút nhầm về tài khoản khác shop không chịu trách nhiệm</strong></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                                <!-- <div></div>
                                <div></div> -->
                            </div>
                        </div>
                        <div class="tw-bg-white tw-rounded tw-p-2 md:tw-py-4 md:tw-px-5 tw-w-full">
                            <div class="tw-border-b tw-border-gray-200 tw-pb-2 tw-mb-2 tw-flex tw-items-center tw-justify-between md:tw-mb-4 tw-text-gray-800">
                                <div class="tw-inline-block">
                                    <h2 class="tw-text-lg tw-font-semibold">
                                        Danh Sách Rút Vật Phẩm
                                    </h2>
                                    <p class="tw-text-sm">Lịch sử rút 2 tháng gần nhất.</p>
                                </div>
                                <a href="?reload=true">
                                <button type="button" class="tw-relative tw-ml-2 block tw-px-1 py-1 tw-text-white tw-bg-red-500 text-sm tw-font-semibold tw-rounded focus:tw-outline-none" style="top: -1px;">
                                    <i class="relative bx bx-revision mr-1" style="top: 1px;"></i>
                                    Làm mới
                                </button>
                                </a>
                            </div>
                            <!---->
                            <div>
                                <table id="list" class="tw-w-full">
                                    <thead>
                                        <tr class="tw-text-md tw-font-semibold tw-tracking-wide tw-text-left tw-text-gray-900 tw-border tw-border-b-0 tw-bg-gray-200">
                                            <th class="tw-px-2 tw-py-2 tw-w-28 md:tw-w-40">
                                                Thông tin
                                            </th>
                                            <th class="tw-px-2 tw-py-2"><span>Chi tiết</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white tw-border tw-border-t-0 tw-rounded">
<?php
    $current_page = isset($_GET['page']) ? (int)Anti_xss($_GET['page']) : 1;

    if ($current_page < 1){
        $current_page = 1;
    }

    $sql_acc = "SELECT * FROM `withdraw` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}'";
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
    $sql_show = "SELECT * FROM `withdraw` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ORDER BY `id` DESC LIMIT $start, $limit";
    if($total_records > 0){
    foreach($db->fetch_assoc($sql_show, 0) as $info){

?>
                                    <tr class="tw-text-gray-700 tw-border-b">
                                            <td class="tw-px-2 tw-py-1 md:tw-py-2 tw-text-xs">
                                                <div>
                                                    <p class="tw-font-bold text-black">
                                                        Gói: <?=number_format($info['diamond'])?> KC
                                                    </p>
                                                    <p class="text-xs text-gray-600 tw-font-semibold">
                                                        <?=date('Y-m-d H:i:s',$info['created_at'])?>
                                                    </p>
                                                    <p class="tw-mt-1 text-xs text-gray-600 tw-font-semibold"><span class="tw-text-<?=status_history($info['status'])['color']?>-600"><?=status_history($info['status'])['text']?></span></p>
                                                </div>
                                            </td>
                                            <td class="tw-px-2 tw-py-2 tw-text-xs md:tw-hidden">
                                                <div class="tw-block md:tw-hidden tw-border-t tw-mt-2 tw-pt-2 tw-font-semibold tw-leading-5">
                                                    <p class="tw-text-gray-800">
                                                        ID Game:  <?=$info['info']?>
                                                    </p>
                                                    <p class="tw-text-sm tw-text-<?=status_history($info['status'])['color']?>-600">
                                                        <i class="bx bxs-downvote tw-relative" style="top: 1px;"></i>
                                                        Nhận:
                                                        <b> <?=number_format($info['diamond'])?> KC</b>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="tw-px-2 tw-py-1 tw-text-xs tw-hidden md:tw-block">
                                            <div class="tw-block md:tw-block tw-hidden tw-pt-2 tw-font-semibold tw-leading-5">
                                            <p class="tw-text-gray-800">
                                                        ID Game:  <?=$info['idgame']?>
                                                    </p>
                                                    <p class="tw-text-sm tw-text-<?=status_history($info['status'])['color']?>-600">
                                                        <i class="bx bxs-downvote tw-relative" style="top: 1px;"></i>
                                                        Nhận:
                                                        <b> <?=number_format($info['diamond'])?> KC</b>
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