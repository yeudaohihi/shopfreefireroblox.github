<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php');
    $type = Anti_xss($_GET['type']);
    if($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `type` = 'VONGQUAY'") < 1){
        new Redirect('/404');
    }else{
        $query = $db->fetch_assoc("SELECT detail FROM `product_game` WHERE `type_category` = '{$type}'", 1);
        $detail = json_decode($query['detail'], true);
    }
?>

<div class="tw-max-w-6xl tw-mx-auto md:tw-px-2 tw-my-8">
    <div class="tw-grid tw-grid-cols-12 tw-gap-4 tw-w-full tw-mb-8 tw-rounded tw-p-0 md:tw-p-2">
        <div class="tw-col-span-12 md:tw-col-span-8">
            <div class="tw-py-6 tw-bg-white tw-rounded" style="background: url('/assets/images/image-80b4d779-df50-4cd3-ae4d-e1bef2222efc.jpeg') center bottom / cover no-repeat;">
                <h2 class="tw-game__title tw-uppercase tw-font-bold tw-text-2xl md:tw-text-3xl tw-px-2 md:tw-px-5 tw-text-center md:tw-text-left tw-mb-2">
                    <?=$detail['name_product']?>
                </h2>
                <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                    <div class="tw-col-span-5 md:tw-col-span-4 tw-py-2 md:tw-py-0 tw-pl-3 md:tw-pl-5 tw-roboto tw-text-sm tw-font-semibold">
                        <span class="tw-game__user-online tw-relative tw-inline-block tw-border-2 tw-border-green-400 tw-bg-green-100 tw-rounded tw-text-green-600 tw-px-2 tw-shadow">
                            Đang chơi: <?=rand(000,999)?>
                            <i class="tw-relative bx bxs-user" style="top: 1px;"></i>
                        </span>
                    </div>
                    <div class="tw-col-span-7 md:tw-col-span-8 tw-pr-3 md:tw-px-5 tw-roboto tw-text-sm tw-font-semibold tw-flex tw-items-center tw-justify-end">
                        <div>
                            <button data-toggle="modal" data-target="#theleModal" class="thele tw-game__rule tw-relative tw-inline-block tw-border-2 tw-border-red-400 tw-bg-red-100 tw-rounded tw-text-red-600 tw-px-3 tw-mr-1 tw-uppercase tw-font-semibold tw-shadow">
                                Thể lệ
                            </button>
                            <button type="button" onclick="location.href='/user/history/game';" class="tw-game__history tw-relative tw-inline-block tw-border-2 tw-border-red-400 tw-bg-red-100 tw-rounded tw-text-red-600 tw-px-3 tw-uppercase tw-font-semibold tw-shadow">
                                Lịch sử
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tw-mb-8">
                    <div class="tw-receiver tw-px-3 md:tw-px-5">
                        <marquee class="tw-game__winner tw-relative tw-top-0 md:tw-top-2 tw-flex tw-items-center">
                            <span class="tw-game__list-winner-1 tw-mr-2 tw-text-sm tw-font-bold">
                                Danh sách trúng thưởng:
                            </span>
                            <?php
                                $sql_show = "SELECT * FROM `log_wheel` WHERE `type` = '{$type}' ORDER BY `id` DESC LIMIT 14";
                                foreach($db->fetch_assoc($sql_show, 0) as $info){
                                    $arr_history = json_decode($info['detail'], true);
                                    $name = mb_substr($arr_history['name'], 5);
                            ?>
                            <span class="tw-inline-block tw-text-sm tw-font-medium tw-text-gray-700">
                                <b class="tw-game__list-winner-2 tw-text-red-600"><i class="tw-relative bx bxs-user" style="top: 1px;"></i> 
                                    <?='*****'.$name?></b>
                                - <?=$arr_history['msg']?> (<?=time_ago(date('H:i:s d-m-Y', ($info['created_at'])))?>)
                                <span class="tw-mx-3">
                                    -
                                </span>
                            </span>
                            <?php } ?>
                        </marquee>
                    </div>
                </div>
                <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                    <div class="tw-col-span-12 md:tw-col-span-6"><!----></div>
                    <div class="tw-col-span-12 md:tw-col-span-6"><!----></div>
                </div>
                <div class="v-luckywheel w-full tw-relative tw-overflow-x-hidden">
                    <div class="tw-flex tw-justify-center">
                        <div class="wheel-wrapper">
                            <a class="wheel-pointer tw-cursor-pointer tw-opacity-75 hover:tw-opacity-100"></a>
                            <img  id="rotate-play" src="<?=$detail['vongquay']?>">
                        </div>
                    </div>
                    <div class="tw-mt-10 tw-mb-6">
                        <div class="tw-flex tw-justify-center">
                            <select id="numrolllop" class="tw-game__price-play tw-w-56 tw-block tw-border-2 tw-bg-white tw-border-yellow-500 tw-h-10 tw-px-3 tw-rounded focus:tw-outline-none">
                                <option value="1">Quay 1 lần - Giá <?=number_format($detail['cash'])?>đ</option>
                                <option value="3">Quay 3 lần - Giá <?=number_format($detail['cash']*3)?>đ</option>
                                <option value="5">Quay 5 lần - Giá <?=number_format($detail['cash']*5)?>đ</option>
                                <option value="7">Quay 7 lần - Giá <?=number_format($detail['cash']*7)?>đ</option>
                                <option value="10">Quay 10 lần - Giá <?=number_format($detail['cash']*10)?>đ</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw-my-2 tw-flex tw-justify-center tw-items-center">
                        <button type="button" id="try" class="start-played tw-rounded tw-text-white tw-transition tw-duration-200 hover:tw-border-blue-700 hover:tw-bg-blue-700 tw-border-2 tw-bg-blue-600 tw-border-blue-600 focus:tw-outline-none tw-py-1 tw-px-4 tw-font-bold tw-mr-2">
                            Chơi thử
                        </button>
                        <button type="button" id="play" class="start-played tw-transition tw-duration-200 hover:tw-bg-red-700 hover:tw-border-red-700 tw-bg-red-600 tw-py-1 tw-text-white tw-border-2 tw-border-red-600 tw-block tw-font-bold focus:tw-outline-none tw-w-36 tw-rounded">
                            <span class="relative" style="top: 1px;"><i class="tw-relative bx bxs-right-arrow" style="top: 2px;"></i> Quay Ngay </span>
                        </button>
                    </div>
                    <div>
                        <style>
                            .wheel-pointer {
                                background-image: url(/assets/images/image-3fb302e3-ea9b-49d4-9db3-c41a0e93cbeb.png) !important;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-col-span-12 md:tw-col-span-4 tw-px-2">
            <!---->
            <div class="tw-mb-5">
                <div class="tw-bg-red-500 tw-text-white tw-font-semibold tw-py-2 tw-h-12 tw-rounded tw-uppercase tw-w-full tw-relative tw-text-center tw-flex tw-px-3 tw-justify-between tw-items-center">
                    <span class="tw-ml-1"> Nạp tiền </span>
                    <div>
                        <button onclick = "location.href='/user/recharge'" class="tw-font-semibold tw-px-2 tw-py-1 tw-rounded tw-bg-white tw-text-gray-600 tw-text-sm tw-inline-flex tw-items-center">
                            <i class="tw-relative tw-text-base bx bxs-dollar-circle tw-mr-1" style="top: 0px; left: -1px;"></i>
                            Thẻ cào
                        </button>
                        <button class="tw-font-semibold tw-px-2 tw-py-1 tw-rounded tw-bg-white tw-text-gray-600 tw-text-sm tw-inline-flex tw-items-center" data-toggle="modal" data-target="#chargeModal">
                            <i class="tw-relative tw-text-base bx bxs-bank tw-mr-1" style="top: 0px; left: -1px;"></i>
                            Bank/Momo
                        </button>
                    </div>
                </div>
            </div>
            <div class="tw-mb-2">
                <h2 class="tw-text-xl tw-font-bold">CÓ THỂ BẠN QUAN TÂM</h2>
                <div class="tw-rounded">
                    <div class="tw-bg-gray-100 tw-py-2 md:tw-pb-4">
                        <div class="tw-grid tw-grid-cols-12 tw-gap-y-4">

                        <?php 
                        foreach($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0'", 0) as $info_w){ 
                            foreach($db->fetch_assoc("SELECT DISTINCT `type_category`,`id`,`detail`,`product`,`type`,`type_category`,`stt` FROM `product_game` WHERE `site` IN ('ALL','{$site}') AND `product` = '{$info_w['key_product']}' AND `product` = 'minigame' ORDER BY RAND() LIMIT 2", 0) as $query_w){
                                $detail_w = json_decode($query_w['detail'], true);
                                $count_game_w = $db->fetch_assoc("SELECT COUNT(*) AS total FROM `history_minigame` WHERE `type_category` = '{$query_w['type_category']}'",0)[0]['total'];
                        ?>
                            
                            <div class="tw-col-span-12 tw-bg-white tw-shadow-sm tw-rounded-b-sm tw-border md:tw-border-0 md:tw-rounded-b">
                                <a href="/<?=to_slug($query_w['type'])?>/<?=$query_w['type_category']?>" class="">
                                    <div class="tw-col-span-5"><img class="tw-w-full tw-rounded-t-sm md:tw-rounded-t lazyLoad isLoaded" src="<?=$detail_w['thumb']?>" /></div>
                                    <div class="tw-col-span-12 tw-px-2 tw-py-3 tw-h-28 tw-relative">
                                        <h4 class="tw-sub-interface-title tw-uppercase tw-text-sm tw-font-semibold tw-text-gray-800 tw-mb-0">
                                            <?=$detail_w['name_product']?>
                                        </h4>
                                        <div class="tw-my-1 tw-text-xs tw-text-gray-600 tw-sub-interface-info">
                                            <!---->
                                            <p>
                                                <span>
                                                    Đã chơi:
                                                    <b class="tw-text-red-500"><?=number_format($count_game+20000)?></b>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tw-absolute tw-bottom-2 tw-right-2 tw-left-2 tw-mt-2">
                                            <button class="eKJDZl tw-new tw-text-xs tw-border tw-px-1.5"><span> Dùng xu khóa để thử vận may nào ! </span></button>
                                            <!---->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } } ?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal nạp -->
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="theleModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-red-600 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span
                class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800"
                style="top: -15px; right: -5px; z-index: 100;" 
                data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"class="close" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-col-span-12 tw-py-3 tw-rounded-t tw-font-bold">
                Thể lệ
            </div>
        </div>
        
        <div class="tw-p-3 tw-py-4 md:tw-p-4 tw-pb-8 md:tw-pb-8">
            <div class="tw-mt-4">
                <div class="tw-text-sm tw-font-semibold tw-text-gray-700">
                    <span><?=$detail['thele']?></span>
                </div>
            </div>

        </div>
    </div>                    
</div>

<script type="text/javascript">

$(document).ready(function(e){
    var roll_check = true;
    var num_loop = 4;
    var angle_gift = '';
    var num_gift = 8;
    var gift_detail = '';
    var num_roll_remain = 0;
    var angles = 0;
    //Click nút quay
    $('body').delegate('.start-played', 'click', function(){
        if(roll_check){
            typeRoll = this.id;
			numrolllop = $("#numrolllop").val();
            type = '<?=$type?>';
            roll_check = false;
            $.ajax({
                 url: '/Minigame/Whell',
                datatype:'json',
                data:{
                    numrolllop,
                    typeRoll,
                    type
                },
                type: 'post',
                success: function (data) {
                    if(data.status=='error'){
                        roll_check = true;
                        $('#rotate-play').css({"transform": "rotate(0deg)"});
                        $('.content-popup').text(data.msg);
                        $('#modalMinigame').modal('show');
                        return;
                    }
                    if(data.status=='login'){
                       $('.content-popup').text(data.msg);
                        $('#modalMinigame').modal('show');
                        return;
                    }
                    gift_detail = data.msg;
                    gift_revice = data.arr_gift;
                    gift_total = data.total;
                    gift_price = data.price;
                    num_roll_remain = gift_detail.num_roll_remain;
                    $('#rotate-play').css({"transform": "rotate(0deg)"});
                    angles = 0;
                    angle_gift = gift_detail.pos*(360/num_gift);
                    loop();
                },
                error: function(){
                    $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                    $('#modalMinigame').modal('show');
                }
            })
        }
    });
    

    function loop() {
        $('#rotate-play').css({"transform": "rotate("+angles+"deg)"});
        
        if((parseInt(angles)-10)<=-(((num_loop*360)+angle_gift))){
            angles = parseInt(angles) - 2;
        }else{
            angles = parseInt(angles) - 10;
        }
        
        if(angles >= -((num_loop*360)+angle_gift)){
            requestAnimationFrame(loop);
        }else{
            roll_check = true;
            if (gift_revice.length > 0) {
                $html = "";
                if (typeRoll == "play") {
                    $html += "<p>Kết quả <span class='text-red-600' style='font-weight:bold'>( Quay Thật ):</span> Quay " + gift_revice.length + " lần - giá " + gift_price + "đ</p>";
                    $html += "<div><b>Mua X" + gift_revice.length + ": Tổng Trúng <span class='text-md uppercase inline-block rounded border-2 border-red-500 px-2 text-red-500 mr-1'>" + gift_total + " KC</span></b></div>";
                    $html += "<div class='h-2'></div>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        $html += "<p class='text-md'>- Quay lần " + ($i + 1) + ": " + gift_revice[$i]["title"];
                    }
                } else {
                    $html += "<p>Kết quả <span class='text-red-600' style='font-weight:bold'>( Quay Thử ):</span> Quay " + gift_revice.length + " lần - giá " + gift_price + "đ</p>";
                    $html += "<div><b>Mua X" + gift_revice.length + ": Tổng Trúng <span class='text-md uppercase inline-block rounded border-2 border-red-500 px-2 text-red-500 mr-1'>" + gift_total + " KC</span></b></div>";
                    $html += "<div class='h-2'></div>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        $html += "<p class='text-md'>- Quay lần " + ($i + 1) + ": " + gift_revice[$i]["title"];
                    }
                }
            }
            $('.content-popup').html($html);
            $('#modalMinigame').modal('show');
            $('.num-play span').text(num_roll_remain);
            if(num_roll_remain==0){
                $('.deposit-btn').show();
            }else{
                $('.deposit-btn').hide();
            }
        }
    }
});
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); ?>