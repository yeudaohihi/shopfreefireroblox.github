<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php');
    $type = Anti_xss($_GET['type']);
    if($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `type` = 'RANDOM'") < 1){
        new Redirect('/404');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `type` = 'RANDOM'", 1);
        $detail = json_decode($query['detail'], true);
        $data_detail = $detail['data'];
    }
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

