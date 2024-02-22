<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$type_api = strtoupper(Anti_xss($_POST['type_api']));
if(!@$user || $data_user['type'] != '2'){
    new Redirect(DOMAIN);
    exit;
}else{
    $query = $db->fetch_assoc("SELECT * FROM `setting_apibank` WHERE `type` = '{$type_api}'", 1);
    $detail = json_decode($query['detail'], true);
}
?>
<?php if($type_api == NULL){?>
    <div class="alert alert-danger">Vui lòng chọn loại Api</div>
<?php }elseif($type_api == 'MOMO'){ ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cấu hình nạp tự động <?=$type_api?></h4>
            </div>
            <div class="card-body">
                <form id="form-update" method="POST" enctype="multipart/form-data">
                    <input hidden name="type" value="<?=$type_api?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Số điện thoại Momo</label>
                                <input class="form-control" type="number" name="phone_momo" placeholder="Số điện thoại momo" value="<?=$detail['phone']?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mật khẩu Momo</label>
                                <input class="form-control" type="password" name="password_momo" placeholder="Mật khẩu momo" value="<?=$detail['password']?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chủ tài khoản</label>
                                <input class="form-control" type="text" name="ctk_momo" placeholder="Tên chủ tài khoản" value="<?=$detail['ctk']?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apikey Momo</label>
                                <input class="form-control" type="text" name="apikey_momo" placeholder="Apikey momo bên web2m" value="<?=$detail['apikey']?>">
                            </div>
                        </div>
                    </div>
                    <!-- // -->
                    <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="Update()">Cập nhật</button>
                </form>
            </div>
        </div>
    </section>
<?php }elseif($type_api == 'BANK'){ ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cấu hình nạp tự động <?=$type_api?></h4>
            </div>
            <div class="card-body">
                <form id="form-update" method="POST" enctype="multipart/form-data">
                    <input hidden name="type" value="<?=$type_api?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Số tài khoản bank</label>
                                <input class="form-control" type="number" name="stk_bank" placeholder="Số tài khoản ngân hàng" value="<?=$detail['stk']?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chủ tài khoản</label>
                                <input class="form-control" type="text" name="name" placeholder="Tên chủ tài khoản" value="<?=$detail['ctk']?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password Bank</label>
                                <input class="form-control" type="password" name="password" placeholder="Password bank bên web2m" value="<?=$detail['password']?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apikey Bank</label>
                                <input class="form-control" type="text" name="apikey_bank" placeholder="Apikey bank bên web2m" value="<?=$detail['apikey']?>">
                            </div>
                        </div>
                    </div>
                    <!-- // -->
                    <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="Update()">Cập nhật</button>
                </form>
            </div>
        </div>
    </section>
<?php } ?>