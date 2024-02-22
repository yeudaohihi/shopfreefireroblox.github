<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/sidebar.php');
$id = Anti_xss($_GET['id']);
if(!@$user){
    new Redirect('/Login');
}elseif($data_user['type'] == '1'){
    new Redirect('/');
}else{
    if($data_user['type'] == '4'){
        if($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'") > 0){
            $query = $db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'", 1);
        }else{
            new Redirect($_SERVER['HTTP_REFERER']);
        }
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` = '{$id}'", 1);
    }
    $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$query['type_category']}'", 1);
    $detail_product = json_decode($query_product['detail'], true);
    $detail = json_decode($query['detail'], true);
    $arr_data = $detail['data'];
}
?>
<div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Chỉnh sửa tài khoản</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa tài khoản</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic choices start -->
    <section class="basic-choices">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh sửa tài khoản [<?=$id?>]</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-data" id="form-update">
                                <input hidden name="id" value="<?=$id?>">
                                <input hidden name="type_category" value="<?=$query['type_category']?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại tài khoản</label>
                                            <select class="form-control" name="type">
                                                <option value="ACCOUNT" <?=$query['type'] == 'ACCOUNT' ? 'selected="selected"' : ''?>>Tài khoản</option>
                                                <option value="RANDOM" <?=$query['type'] == 'RANDOM' ? 'selected="selected"' : ''?>>Vận may</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại trò chơi</label>
                                            <select class="form-control" name="type_category" disabled>
                                            <?php
                                                foreach($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `type` IN ('ACCOUNT','RANDOM')", 0) as $info){
                                                    $detail = json_decode($info['detail'], true);
                                            ?>
                                            <option value="<?=$info['type_category']?>" <?=$info['type_category'] == $query['type_category'] ? 'selected="selected"' : ''?>><?=$detail['name_product']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giá tiền</label>
                                            <input class="form-control" name="cash" type="number" placeholder="Giá tiền" value="<?=$query['cash']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khuyến mại</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" placeholder="Khuyến mại" name="sale" value="<?=$query['sale']?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="status">
                                                <option value="on" <?=$query['status'] == 'on' ? 'selected="selected"' : ''?>>Chưa bán</option>
                                                <option value="off" <?=$query['status'] == 'off' ? 'selected="selected"' : ''?>>Đã bán</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php for ($i=0; $i < count($arr_data); $i++) { ?>
                                        <?php if($arr_data[$i]['type'] == 'password'){?>
                                            <?php if($data_user['type'] == '3'){?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><?=$arr_data[$i]['label']?></label>
                                                        <input class="form-control" type="text" value="*********" disabled>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=$arr_data[$i]['label']?></label>
                                                <?php if($arr_data[$i]['type'] == 'input' || $arr_data[$i]['type'] == 'number' || $arr_data[$i]['type'] == 'password'){?>
                                                    <input class="form-control" name="<?=$arr_data[$i]['name']?>" placeholder="<?=$arr_data[$i]['label']?>" type="text" value="<?=$arr_data[$i]['value']?>">
                                                <?php }elseif($arr_data[$i]['type'] == 'select'){ ?>
                                                <select class="form-control" name="<?=$arr_data[$i]['name']?>">
                                                    <?php 
                                                        $explode = explode('|', $detail_product['data'][$i]['value']);
                                                        for ($a=0; $a < count($explode); $a++) {
                                                    ?>
                                                    <option value="<?=$explode[$a]?>" <?=$arr_data[$i]['value'] == $explode[$a] ? 'selected="selected"' : ''?>><?=$explode[$a]?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nội dung bằng hình ảnh</label>
                                            <center>
                                                <span class="btn-file">
                                                    <input name="image[]" type="file" class="form-control" multiple>
                                                </span>
                                                <br>
                                            </center>
                                            <?php 
                                                $arr_image = json_decode($query['image'], true);
                                                for ($i=0; $i < count($arr_image); $i++) {
                                            ?>
                                            <img class="w-15 active lazyLoad" data-src="<?=$arr_image[$i]?>" height="80px" width="128px">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="Update()">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic choices end -->
</div>
<script type="text/javascript">
    function Update(){
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url: '/Model/Admin/Account/Edit',
            type: 'POST',
            dataType: 'JSON',
            data: new FormData($('form#form-update')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                Toast(data.status,data.msg);
            }
        });
    }
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/footer.php');
?>