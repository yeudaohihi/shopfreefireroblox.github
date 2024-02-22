<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php');
    $type = Anti_xss($_GET['type']);
    if($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `type` = 'ACCOUNT'") < 1){
        new Redirect('/404');
    }else{
        $query = $db->fetch_assoc("SELECT detail FROM `product_game` WHERE `type_category` = '{$type}' AND `type` = 'ACCOUNT'", 1);
        $detail = json_decode($query['detail'], true);
        $data_detail = $detail['data'];
    }
    $url = $_SERVER['REQUEST_URI'];
    
?>

<div class="tw-rounded tw-bg-gray-100">
    <div class="tw-max-w-6xl tw-mx-auto tw-bg-white tw-px-2" style="min-height: 100vh;">
        <span class="tw-text-sm tw-relative" style="top: 1px;">DANH MỤC: </span>
        <h2 class="tw-mb-2 tw-text-red-500 tw-text-lg tw-font-bold tw-uppercase">
            <?=$detail['name_product']?>
        </h2>
        <div class="tw-mb-2">
            <div class="text-overflow">
                <div class="text-overflow-content" style="--nlines: 5; --lineHeight: 24px;">
                    <div class="relative tw-bg-white tw-py-2 tw-px-3 tw-rounded">
                        <?=$detail['thele']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-grid tw-grid-cols-12 tw-gap-3 tw-py-2">
            <div class="tw-col-span-12 tw-mb-4">
                <div>
                    <div class="tw-mb-1">
                        <b class="tw-text-xs"> BỘ LỌC TÌM KIẾM </b>
                        <!-- <button type="button" onclick="fitler()" class="tw-block md:tw-hidden focus:tw-outline-none tw-px-2 tw-h-8 tw-rounded tw-border-2 tw-border-red-500 tw-bg-red-500 tw-text-white tw-w-full tw-text-sm tw-font-semibold hover:tw-bg-red-600 hover:tw-border-red-600 tw-transition tw-duration-200 tw-mb-4">
                            <i class="tw-relative tw-text-lg bx tw-mr-1 bxs-filter-alt" style="top: 2.5px;"></i> Tìm kiếm
                        </button>
                        <button type="button" onclick="location.href='#';" class="tw-hidden focus:tw-outline-none tw-px-2 tw-h-8 tw-rounded tw-border-2 tw-border-red-500 tw-bg-red-500 tw-text-white tw-w-full tw-text-sm tw-font-semibold hover:tw-bg-red-600 hover:tw-border-red-600 tw-transition tw-duration-200 tw-mb-4">
                            <i class="tw-relative tw-text-lg bx tw-mr-1 bx bx-x" style="top: 2.5px;"></i> Đóng bộ lọc
                        </button> -->
                    </div>
                    <form method="get">
                        <div class="md:tw-grid tw-grid-cols-12 tw-gap-3">

                            <div class="tw-col-span-12 md:tw-col-span-3">
                                <div class="tw-w-full tw-relative">
                                <label class="tw-inline-block tw-text-gray-500 tw-absolute tw-text-xs tw-font-medium" style="left: 10px; top: 6px">
                                    Mã số tài khoản
                                </label> 
                                    <div class="el-input">
                                        <input type="text" id="id" autocomplete="off" placeholder="ID - ví dụ: 1759383" class="el-input__inner" >
                                    </div>
                            </div>
                        </div>
                            
                            <div class="tw-col-span-12 md:tw-col-span-3">
                                <div class="tw-w-full tw-relative">
                                    <div class="el-select tw-block tw-w-full el-select--large">
                                        <div class="el-input el-input--large el-input--suffix">
                                            <select class="el-input__inner" id="price">
                                                <option value="">-- Giá tiền --</option>
                                                <option value="duoi-50k">Dưới 50K</option>
                                                <option value="tu-50k-200k">Từ 50K - 200K</option>
                                                <option value="tu-200k-500k">Từ 200K - 500K</option>
                                                <option value="tu-500k-1-trieu">Từ 500K - 1 Triệu</option>
                                                <option value="tren-1-trieu">Trên 1 Triệu</option>
                                                <option value="tren-5-trieu">Trên 5 Triệu</option>
                                                <option value="tren-10-trieu">Trên 10 Triệu</option>
                                            </select>
                                            <span class="el-input__suffix">
                                                <span class="el-input__suffix-inner">
                                                    <i class="el-select__caret el-input__icon el-icon-arrow-up"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                for ($i=0; $i < count($data_detail); $i++) { 
                                    if($data_detail[$i]['show'] == 'on'){
                            ?>

                           <!-- <div class="tw-col-span-12 md:tw-col-span-3">
                                <div class="tw-w-full tw-relative">
                                    <?php if($data_detail[$i]['type'] == 'input'){ ?>
                                        <div class="el-input">
                                            <input type="text" id="<?=$data_detail[$i]['name']?>" autocomplete="off" placeholder="<?=$data_detail[$i]['label']?>" class="el-input__inner" >
                                        </div>
                                    <?php } elseif($data_detail[$i]['type'] == 'number'){ ?>
                                        <div class="el-input">
                                            <input type="text" id="<?=$data_detail[$i]['name']?>" autocomplete="off" placeholder="<?=$data_detail[$i]['label']?>" class="el-input__inner" >
                                        </div>
                                    <?php }elseif($data_detail[$i]['type'] == 'select'){ ?>
                                        <div class="el-select tw-block tw-w-full el-select--large">
                                            <div class="el-input el-input--large el-input--suffix">
                                                <select class="el-input__inner" id="<?=$data_detail[$i]['name']?>">
                                                    <option value="">-- <?=$data_detail[$i]['label']?> --</option>
                                                    <?php 
                                                        $explode = explode('|', $data_detail[$i]['value']);
                                                        for ($a=0; $a < count($explode); $a++) {
                                                    ?>
                                                    <option value="<?=$explode[$a]?>"><?=$explode[$a]?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="el-input__suffix">
                                                    <span class="el-input__suffix-inner">
                                                        <i class="el-select__caret el-input__icon el-icon-arrow-up"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div> -->     
                            <?php } } ?>                     

                            <div class="tw-col-span-12 md:tw-col-span-3">
                                <div class="tw-w-full tw-relative">
                                    <button type="button" onclick="fitler()" class="focus:tw-outline-none tw-px-2 tw-h-10 tw-rounded tw-border-2 tw-border-red-500 tw-bg-red-500 tw-text-white tw-w-full tw-text-sm tw-font-semibold hover:tw-bg-red-600 hover:tw-border-red-600 tw-transition tw-duration-200">
                                        <i class="tw-relative tw-text-xl bx bxs-filter-alt tw-mr-1" style="top: 2px;"></i> Lọc
                                    </button>
                                </div>
                            </div>

                            <div class="tw-col-span-12 md:tw-col-span-3">
                                <div class="tw-w-full tw-relative">
                                    <button type="button" onclick="load_account()" class="focus:tw-outline-none tw-px-2 tw-h-10 tw-rounded tw-border-2 tw-border-gray-700 tw-bg-gray-700 tw-text-white tw-w-full tw-text-sm tw-font-semibold hover:tw-bg-gray-800 hover:tw-border-gray-800 tw-transition tw-duration-200">
                                        Xóa lọc
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>

<div id="list_account" class="tw-grid tw-grid-cols-12 tw-gap-3 tw-py-2"></div>
</div>
<script>
    page = 1;
    id = "";
	price = "";
    <?php
    for($i=0; $i < count($data_detail); $i++){
    	if($data_detail[$i]['show'] == 'on'){
    ?>
        <?=$data_detail[$i]['name']?> = "";
    <?php } } ?>
    type = "<?=$type?>";

	function load_account(){
		$("#list_account").hide();
		$.ajax({
			type: 'POST',
			url: '/List/Account',
			data: {
				page: page,
                id: id,
				price: price,
                <?php
                    for($i=0; $i < count($data_detail); $i++){
                        if($data_detail[$i]['show'] == 'on'){
                ?>
                <?=$data_detail[$i]['name']?>: <?=$data_detail[$i]['name']?>,
                <?php } } ?>
                type: type
			},
			success: function (response) {
				$("#list_account").html('');
                $('#list_account').empty().append(response);
                $("#list_account").show();
			}
		});
	} 

    function fitler() {
        id = $("#id").val();
		price = $("#price").val();
        <?php
            for($i=0; $i < count($data_detail); $i++){
                if($data_detail[$i]['show'] == 'on'){
        ?>
            <?=$data_detail[$i]['name']?> = $("#<?=$data_detail[$i]['name']?>").val();
        <?php } } ?>
        load_account();
    }
    load_account();
</script>

<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); ?>

