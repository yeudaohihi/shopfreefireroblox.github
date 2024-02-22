<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php');
    $id = Anti_xss($_GET['id']);
    if(empty($id)){
        new Redirect('/404');
    }elseif($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}'") < 1){
        new Redirect('/404');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` = '{$id}'", 1);
        $detail = json_decode($query['detail'], true);
        $arr_img = json_decode($query['image'], true);
        $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$query['type_category']}'", 1);
        $detail_product = json_decode($query_product['detail'], true);
    }
?> 

<link rel="stylesheet" href="https://transvelo.github.io/electro-html/2.0/assets/vendor/slick-carousel/slick/slick.css">
<style>
    .d-flex {
        display: flex;
    }
    
    .slick-current img {
        --tw-border-opacity: 1;
        border-color: rgba(220, 38, 38, var(--tw-border-opacity));
    }
    
    .slick-active {
        display: block;
    }
    
    .u-slick--transform-off.slick-transform-off .slick-track {
        -webkit-transform: none !important;
        transform: none !important;
    }
</style>
<div class="tw-max-w-6xl tw-mx-auto tw-px-2">
    <div class="md:tw-bg-white tw-grid tw-grid-cols-12 tw-gap-4 md:tw-p-3 tw-rounded">
        <div class="tw-col-span-12 md:tw-col-span-6">
            <div>
                <div class="tw-relative">
                    <span class="tw-absolute tw-inline-block tw-px-2 tw-rounded tw-text-sm tw-cursor-pointer tw-font-semibold tw-text-white tw-bg-gray-800" style="bottom: 5px; left: 5px;z-index:2;"> Click để phóng to</span>
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick tw-relative" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block" data-arrow-left-classes="bx bx-chevron-left d-flex tw-arrow-left tw-absolute tw-h-8 tw-w-8 tw-rounded tw-inline-flex tw-text-lg tw-text-gray-800 tw-items-center tw-justify-center tw-cursor-pointer" data-arrow-right-classes="bx bx-chevron-right d-flex tw-arrow-right tw-absolute tw-h-8 tw-w-8 tw-rounded tw-inline-flex tw-text-lg tw-text-gray-800 tw-items-center tw-justify-center tw-cursor-pointer" data-nav-for="#sliderSyncingThumb">
                        <?php if($query['type'] == 'ACCOUNT'){ ?>
                            <?php for ($i=0; $i < count($arr_img); $i++) { ?>
                                <div class="js-slide">
                                    <img class="tw-h-56 md:tw-h-72 tw-w-full tw-object-fill tw-object-center tw-rounded tw-cursor-pointer" src="<?=$arr_img[$i]?>">
                                </div>
                            <?php } ?>
                        <?php }elseif($query['type'] == 'RANDOM'){?>
                                <div class="js-slide">
                                    <img class="tw-h-56 md:tw-h-72 tw-w-full tw-object-fill tw-object-center tw-rounded tw-cursor-pointer" src="<?=$detail_product['thumb']?>">
                                </div>
                        <?php } ?> 
                    </div>
                </div>
                <div class="tw-relative tw-px-10 tw-mt-4">
                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="5" data-is-thumbs="true" data-nav-for="#sliderSyncingNav">
                        <?php if($query['type'] == 'ACCOUNT'){ ?>
                            <?php for ($i=0; $i < count($arr_img); $i++) { ?>
                                <div class="js-slide tw-rounded tw-h-12 tw-text-white tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer tw-select-none">
                                    <img class="tw-w-full tw-h-12 tw-object-fill tw-object-center tw-rounded tw-border-2" src="<?=$arr_img[$i]?>">
                                </div>
                            <?php } ?>
                        <?php }elseif($query['type'] == 'RANDOM'){?>
                            <div class="js-slide tw-rounded tw-h-12 tw-text-white tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer tw-select-none">
                                <img class="tw-w-full tw-h-12 tw-object-fill tw-object-center tw-rounded tw-border-2" src="<?=$detail_product['thumb']?>">
                            </div>
                        <?php } ?>
                    
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal view -->
        <div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="viewModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
            <div class="modal-dialog tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-12 tw-gap-2 tw-bg-white tw-p-2 tw-rounded">
                <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-rounded-full tw-text-sm tw-font-bold tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800 " style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"class="close" data-dismiss="modal" aria-label="Close"></i>
                </span>

                <div class="tw-relative tw-col-span-8">
                    <div id="sliderLarge" class="js-slick-carousel2 u-slick tw-relative" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block" data-arrow-left-classes="bx bx-chevron-left d-flex tw-arrow-left tw-absolute tw-h-8 tw-w-8 tw-rounded tw-inline-flex tw-text-lg tw-text-gray-800 tw-items-center tw-justify-center tw-cursor-pointer" data-arrow-right-classes="bx bx-chevron-right d-flex tw-arrow-right tw-absolute tw-h-8 tw-w-8 tw-rounded tw-inline-flex tw-text-lg tw-text-gray-800 tw-items-center tw-justify-center tw-cursor-pointer" data-nav-for="#sliderSmall">
                        
                        <?php if($query['type'] == 'ACCOUNT'){ ?>
                            <?php for ($i=0; $i < count($arr_img); $i++) { ?>
                                <div class="js-slide">
                                    <img class="tw-h-full tw-w-full tw-object-fill tw-object-center tw-rounded" src="<?=$arr_img[$i]?>">
                                </div>
                            <?php } ?>
                        <?php }elseif($query['type'] == 'RANDOM'){?>
                                <div class="js-slide">
                                    <img class="tw-h-full tw-w-full tw-object-fill tw-object-center tw-rounded" src="<?=$detail_product['thumb']?>">
                                </div>
                        <?php } ?> 
                    
                    </div>
                </div>
                <div class="tw-relative tw-col-span-4">
                    <div class=" tw-my-3 md:tw-mb-3 md:tw-mt-0 tw-bg-red-700 tw-text-white tw-py-1 tw-px-2 tw-rounded">
                        <div class="tw-uppercase tw-font-bold tw-text-xl">
                            Mã Số: <?=$id?> </div>
                        <div class="tw-text-xs tw-text-red-100 tw-relative tw-font-medium tw-uppercase">
                            <?=$detail_product['name_product']?>
                        </div>
                    </div>
                    <style>
                        #sliderSmall .slick-track {
                            width: auto !important;
                        }
                        
                        #sliderSmall.u-slick--slider-syncing-size .slick-slide {
                            width: 5rem !important;
                        }
                    </style>
                    <div id="sliderSmall" class="js-slick-carousel2 u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="<?=$i?>" data-is-thumbs="true" data-nav-for="#sliderLarge" style="max-height: 46vh; overflow-y: auto;">
                        
                        <?php if($query['type'] == 'ACCOUNT'){ ?>
                            <?php for ($i=0; $i < count($arr_img); $i++) { ?>
                                <div class="js-slide tw-col-span-3 tw-cursor-pointer">
                                    <img class="tw-w-full tw-h-16 tw-border-2 tw-object-fill tw-object-center tw-rounded hover:tw-border-red-500 tw-border-transparent" src="<?=$arr_img[$i]?>">
                                </div>
                            <?php } ?>
                        <?php }elseif($query['type'] == 'RANDOM'){?>
                                <div class="js-slide tw-col-span-3 tw-cursor-pointer">
                                    <img class="tw-w-full tw-h-16 tw-border-2 tw-object-fill tw-object-center tw-rounded hover:tw-border-red-500 tw-border-transparent" src="<?=$detail_product['thumb']?>">
                                </div>
                        <?php } ?> 
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-col-span-12 md:tw-col-span-6">
            <div class="tw-my-3 md:tw-mb-3 md:tw-mt-0 tw-bg-red-700 tw-text-white tw-py-1 tw-px-2 tw-rounded">
                <div class="tw-uppercase tw-font-bold tw-text-xl">
                    Mã Số: <?=$id?> </div>
                <div class="tw-text-xs tw-text-red-100 tw-relative tw-font-medium tw-uppercase">
                    <?=$detail_product['name_product']?>
                </div>
            </div>
            
            <div class="tw-rounded-t tw-bg-red-100 tw-py-2 tw-px-2 tw-flex tw-justify-between tw-items-center tw-relative">
                <div class="tw-text-red-600">
                    <div class="tw-relative tw-text-sm tw-font-semibold" style="top: 2px;">
                        <small><b class="tw-font-bold">THẺ CÀO</b></small>
                    </div>
                    <b class="tw-text-2xl"><?=number_format($query['cash'])?><small>đ</small></b>
                </div>
                <div class="tw-text-xs tw-font-bold tw-text-red-400"><small>hoặc</small></div>
                <div class="tw-text-red-600">
                    <div class="tw-relative tw-text-sm tw-font-semibold" style="top: 2px"><small><b class="tw-font-bold">ATM/MOMO</b> chỉ cần</small>
                    </div> <b class="tw-text-2xl"><?=number_format($query['cash']*80/100)?><small>đ</small></b>
                </div>
            </div>
            <div>
                <div class="tw-mb-3 tw-border tw-rounded-b">
                    <?php
                        for ($i=0; $i < count($detail['data']); $i++) {
                            if($detail['data'][$i]['show'] == 'on'){
                    ?>
                    <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-border-b tw-p-2">
                        <div class="tw-col-span-12">
                            <p>
                                <i class="tw-relative bx bx-caret-right" style="top: 1px;"></i> <?=$detail['data'][$i]['label']?>:
                                <b class="tw-text-gray-800"> <?=$detail['data'][$i]['value']?> </b>
                            </p>
                        </div>
                    </div>

                    <?php } } ?>
                    
                    <!---->
                </div>
                <!---->
                <!---->
            </div>
            <!---->
            <style>
                .fade {
                    display: none;
                }
                
                .fade.show:not(#champModal,
                #skinModal,
                #infoModal) {
                    display: flex !important;
                }
            </style>
            <button class="tw-sticky tw-top-14 tw-my-3 tw-px-3 tw-rounded tw-py-2 tw-text-xl tw-text-white tw-font-bold tw-bg-red-600 hover:tw-bg-red-500 tw-rounded tw-w-full tw-z-50" data-toggle="modal" data-target="#buyModal">
                <span class="tw-relative tw-pl-8">
                    <i class="tw-absolute tw-text-3xl bx bxs-cart-add tw-mr-1" style="top: -4px; left: -8px"></i> MUA NGAY
                </span>
            </button>
  
            

            <!--Buy modal-->
            <div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="buyModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
                <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
                    <div class="tw-relative tw-bg-red-600 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
                        <small><span>XÁC NHẬN MUA </span>TÀI KHOẢN</small>
                        <p class="tw-text-2xl">#<?=$id?></p>
                        <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"class="close" data-dismiss="modal" aria-label="Close"></i>
                        </span>
                    </div>
                    
                    <div class="tw-p-2 md:tw-p-4">
                        <div>
                            <div class="tw-mb-3 tw-border tw-rounded-b">
                            <?php
                                for ($i=0; $i < count($detail['data']); $i++) {
                                    if($detail['data'][$i]['show'] == 'on'){
                            ?>
                            <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-border-b tw-p-2">
                                <div class="tw-col-span-12">
                                    <p>
                                        <i class="tw-relative bx bx-caret-right" style="top: 1px;"></i> <?=$detail['data'][$i]['label']?>:
                                        <b class="tw-text-gray-800"> <?=$detail['data'][$i]['value']?> </b>
                                    </p>
                                </div>
                            </div>

                            <?php } } ?>
                                <!---->
                            </div>
                            <!---->
                            <!---->
                        </div>
                        <div class="tw-mb-4">
                        <?php if(!@$user):?>
                            <div class="tw-gap-2 tw-mb-2 tw-text-gray-700">
                                <span>VUI LÒNG ĐĂNG NHẬP ĐỂ MUA TÀI KHOẢN</span>
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                            <div class="tw-col-span-8">
                                <div>
                                    <button type="button" class="tw-bg-red-500 tw-border tw-border-red-500 tw-px-2 tw-py-2 tw-rounded tw-text-white tw-font-bold tw-w-full" data-toggle="modal" data-target="#loginModal">
                                        ĐĂNG NHẬP
                                    </button>
                                </div>
                            </div>
                            <div class="tw-col-span-4">
                                <button class="tw-py-2 tw-px-3 tw-text-center tw-border tw-rounded tw-w-full">
                                    Đóng
                                </button>
                            </div>
                        </div>      
                    </div>
                    <?php else:?>
                        <div id="msgBuy"></div></br>
                            <div class="tw-grid tw-grid-cols-12 tw-gap-2 tw-mb-2 tw-text-gray-700">
                                <div class="tw-relative tw-col-span-6 tw-font-semibold tw-text-base"><span>Số dư của bạn</span></div>
                                <div class="tw-col-span-6 tw-text-right tw-font-bold">
                                    <?=number_format($data_user['cash'])?>đ
                                    <a href="/user/recharge"><button class="tw-px-1"><i class="tw-text-red-500 tw-relative tw-text-xl bx bxs-plus-square" style="top: 3px;"></i></button></a>
                                </div>
                            </div>
                            <!---->
                            <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                                <div class="tw-col-span-6 tw-font-semibold tw-text-base tw-relative tw-text-red-600"><span class="tw-relative" style="top: 2px;">GIÁ TÀI KHOẢN</span></div>
                                <div class="tw-col-span-6 tw-text-right tw-font-bold tw-text-xl tw-text-red-600">
                                <?=number_format($query['cash'])?>đ
                                </div>
                            </div>
                        </div>
                        <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                            <div class="tw-col-span-8">
                                <div>
                                    <button type="button" onclick="buyacc(<?=$id?>)" class="tw-bg-red-500 tw-border tw-border-red-500 tw-px-2 tw-py-2 tw-rounded tw-text-white tw-font-bold tw-w-full">
                                        XÁC NHẬN MUA
                                    </button>
                                </div>
                            </div>
                            <div class="tw-col-span-4">
                                <button class="tw-py-2 tw-px-3 tw-text-center tw-border tw-rounded tw-w-full" data-dismiss="modal">
                                    Đóng
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

<div class="tw-mt-10 tw-text-xl tw-font-bold">TÀI KHOẢN ĐỒNG GIÁ</div>
    <div class="tw-grid tw-grid-cols-12 tw-gap-3 tw-py-2">
<?php $sql_show_1 = "SELECT * FROM `list_account` WHERE `type_category` = '{$query['type_category']}' AND `status` = 'on' AND `cash` = '{$query['cash']}' ORDER BY RAND() LIMIT 4";
    foreach ($db->fetch_assoc($sql_show_1, 0) as $info_1) {
        $check_1 = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$info_1['type_category']}' ", 1); // lấy dữ liệu từ product
        $detail_product_1 = json_decode($check_1['detail'], true); // get detail product
        $arr_img_1 = json_decode($info_1['image'], true); // ảnh ở list_account
        $detail_1 = json_decode($info_1['detail'], true); // detail list_account
?>
    <div class="tw-col-span-12 md:tw-col-span-3 tw-bg-white tw-relative tw-border tw-border-transparent hover:tw-border-red-500 tw-transition tw-duration-200 tw-rounded">
        <a href="/views/account/<?=$info_1['id']?>" class="">
            <div class="tw-relative tw-mb-20">
                <span class="tw-new-id tw-absolute tw-inline-flex tw-items-center tw-px-2 tw-h-6 tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded tw-text-sm" style="top: 8px; left: 8px;">
                    MS <?=$info_1['id']?>                                    
                </span>
            <?php if ($check_1['type'] == 'ACCOUNT') {?>
                <img class="tw-h-56 md:tw-h-40 tw-w-full tw-object-fill tw-object-center tw-rounded-t-sm lazyLoad isLoaded" src="<?=$arr_img_1[0];?>">
            <?php } else {?>
                <img class="tw-h-56 md:tw-h-40 tw-w-full tw-object-fill tw-object-center tw-rounded-t-sm lazyLoad isLoaded" src="<?=$detail_product_1['thumb']?>">
            <?php }?>
                <div class="tw-my-2 tw-py-1 tw-px-2 tw-relative">
                <div class="tw-grid tw-grid-cols-12 tw-gap-y-1 tw-leading-6 tw-text-gray-700 tw-text-xs" style="font-size: 15px; font-weight: 500;">
                <?php
                    for ($i = 0; $i < count($detail_1['data']); $i++) {
                        if ($detail_1['data'][$i]['show'] == 'on') { ?>
                            <div class="tw-col-span-12 tw-text-base md:tw-text-sm">
                                <p>
                                    <i class="tw-relative bx bx-caret-right" style="top: 1px;"></i> <?=$detail_1['data'][$i]['label']?>:
                                    <b class="tw-text-gray-800"> <?=$detail_1['data'][$i]['value']?> </b>
                                </p>
                            </div>
                <?php }}?>
                        
                    </div>
                </div>
            </div>
            <div class="tw-absolute tw-right-0 tw-bottom-0 tw-left-0">
                <div class="tw-border-t tw-rounded-b-sm tw-border-gray-100 tw-px-2 tw-py-1">
                    <ul class="tw-rounded-sm tw-w-full tw-font-medium">
                        <span class="tw-w-full tw-text-center tw-inline-block tw-px-2">
                        <span class="tw-text-gray-600 tw-inline-block tw-text-xs tw-line-through"> <?=number_format($info_1['cash'] * 2)?><small>đ</small></span>
                        <span class="tw-text-red-500 tw-text-lg tw-font-extrabold"> <?=number_format($info_1['cash'])?><small>đ</small></span>
                        </span>
                    </ul>
                </div>
                <div class="tw-w-full tw-text-center tw-cursor-pointer tw-border tw-rounded-b-sm tw-border-red-500 hover:tw-border-red-600 tw-bg-red-500 tw-transition tw-duration-200 hover:tw-bg-red-600 tw-text-white tw-uppercase tw-font-semibold tw-py-1 tw-px-3">
                    Xem chi tiết
                </div>
            </div>
        </a>
    </div>
<?php } ?>

</div>

<script>
function buyacc(id){
	$.ajax({
		url : '/confirm/buyacc',
		dataType : 'json',
		type : 'POST',
		data: {id : id},
		success: function(data){
			if(data.status == 'success'){
                $('#msgBuy').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">'+data.msg+'</div>');
				setTimeout(function(){
					window.location = "/user/history/acc";
				}, 2000);
			}else{
				$('#msgBuy').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">'+data.msg+'</div>');
			}
		}
	})
}
</script>


<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); ?>