<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$domain = Anti_xss($_POST['domain']);
if(!@$user || $data_user['type'] != '2'){
    new Redirect(DOMAIN);
    exit;
}else{
    $query = $db->fetch_assoc("SELECT * FROM `list_domain` WHERE `domain` = '{$domain}'", 1);
    $detail = json_decode($query['detail'], true);
}
?>
<?php if($db->num_rows("SELECT * FROM `list_domain` WHERE `domain` = '{$domain}'") < 1){?>
    <div class="alert alert-danger">Tên miền này không tồn tại</div>
<?php }else{ ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cầu hình hệ thống shop: <?=$domain?></h4>
            </div>
            <div class="card-body">
                <form id="form-update" enctype="multipart/form-data">
                    <input hidden name="domain" value="<?=$domain?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tiền cho người mới</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Tiền cho người mới" name="new_cash" value="<?=$detail['new_cash']?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Khuyến mại nạp tiền</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Khuyến mại nạp tiền" name="persent_cash" value="<?=$detail['persent_cash']?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tiêu đề trang</label>
                                <input class="form-control" type="text" name="title" placeholder="Tiêu đề trang" value="<?=$detail['title']?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả trang</label>
                                <input class="form-control" name="mota" type="text" placeholder="Mô tả trang" value="<?=$detail['mota']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- trạng thái web -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trạng thái trang</label>
                                <select class="form-control" name="status_web">
                                    <option value="on" <?=$detail['status_web'] == 'on' ? 'selected="selected"' : ''?>>Bật</option>
                                    <option value="off" <?=$detail['status_web'] == 'off' ? 'selected="selected"' : ''?>>Tắt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trạng thái nạp thẻ</label>
                                <select class="form-control" name="status_card">
                                    <option value="on" <?=$detail['status_card'] == 'on' ? 'selected="selected"' : ''?>>Bật</option>
                                    <option value="off" <?=$detail['status_card'] == 'off' ? 'selected="selected"' : ''?>>Tắt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trạng thái rút kim cương</label>
                                <select class="form-control" name="status_diamond">
                                    <option value="on" <?=$detail['status_diamond'] == 'on' ? 'selected="selected"' : ''?>>Bật</option>
                                    <option value="off" <?=$detail['status_diamond'] == 'off' ? 'selected="selected"' : ''?>>Tắt</option>
                                </select>
                            </div>
                        </div>
                        <!-- // -->
                        <!-- setting APIKEY -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner ID: (lấy tại <a href="https://gachthe1s.com/">Gachthe1s.com</a>)</label>
                                <input class="form-control" type="text" name="partner_id" placeholder="Partner ID Nạp thẻ" value="<?=$detail['partner_id']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner Key: (lấy tại <a href="https://gachthe1s.com/">Gachthe1s.com</a>)</label>
                                <input class="form-control" type="text" name="partner_key" placeholder="Partner Key Nạp thẻ" value="<?=$detail['partner_key']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>APIKEY Rút kim cương(lấy tại <a href="https://napcard.vn">Napcard.Vn</a>)</label>
                                <input class="form-control" type="text" name="apikey_diamond" placeholder="APIKEY Rút kim cương" value="<?=$detail['apikey_diamond']?>">
                            </div>
                        </div>
                        <!-- // -->
                        <!-- setting API Facebook -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>APP_ID (Lấy tại Facebook)</label>
                                <input class="form-control" type="text" name="APP_ID" placeholder="APP_ID (Lấy tại Facebook)" value="<?=$detail['APP_ID']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>APP_SECRET (Lấy tại Facebook)</label>
                                <input class="form-control" type="text" name="APP_SECRET" placeholder="APP_SECRET (Lấy tại Facebook)" value="<?=$detail['APP_SECRET']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Fanpage</label>
                                <input class="form-control" type="number" name="id_fanpage" placeholder="ID Fanpage" value="<?=$detail['id_fanpage']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>EMAIL_SMTP</label>
                                <input class="form-control" type="text" name="email_smtp" placeholder="Tài khoản Email SMTP" value="<?=$detail['email_smtp']?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>PASS_EMAIL_SMTP</label>
                                <input class="form-control" type="password" name="pass_email_smtp" placeholder="Mật khẩu Email SMTP" value="<?=$detail['pass_email_smtp']?>">
                            </div>
                        </div>
                        <!-- // -->
                        <!-- setting thông báo -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bảng thông báo</label>
                                <select class="form-control" name="status_noti">
                                    <option value="on" <?=$detail['status_noti'] == 'on' ? 'selected="selected"' : ''?>>Bật</option>
                                    <option value="off" <?=$detail['status_noti'] == 'off' ? 'selected="selected"' : ''?>>Tắt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Thông báo</label>
                            <textarea name="thongbao" id="thongbao" cols="50" rows="5"><?=html_entity_decode($detail['thongbao'])?></textarea>
                            <script>
                                CKEDITOR.replace('thongbao');// tham số là biến name của textarea
                            </script>
                        </div>
                        <!-- // -->
                    </div>
                    <!-- setting hình ảnh -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Logo</label>
                            <img class="w-100 active" id="img_1" src="<?=$detail['logo']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="logo" type="file" class="form-control" onchange="document.getElementById('img_1').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Banner</label>
                            <img class="w-100 active" id="img_2" src="<?=$detail['banner']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="banner" type="file" class="form-control" onchange="document.getElementById('img_2').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Background</label>
                            <img class="w-100 active" id="img_3" src="<?=$detail['background']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="background" type="file" class="form-control" onchange="document.getElementById('img_3').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Mua ngay</label>
                            <img class="w-100 active" id="img_4" src="<?=$detail['image_buy']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="image_buy" type="file" class="form-control" onchange="document.getElementById('img_4').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Chơi thử</label>
                            <img class="w-100 active" id="img_5" src="<?=$detail['image_try']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="image_try" type="file" class="form-control" onchange="document.getElementById('img_5').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Chơi ngay</label>
                            <img class="w-100 active" id="img_6" src="<?=$detail['image_play']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="image_play" type="file" class="form-control" onchange="document.getElementById('img_6').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Nút quay</label>
                            <img class="w-100 active" id="img_7" src="<?=$detail['btn_quay']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="btn_quay" type="file" class="form-control" onchange="document.getElementById('img_7').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <label>Úp thẻ</label>
                            <img class="w-100 active" id="img_8" src="<?=$detail['image_upthe']?>">
                            <center>
                                <span class="btn btn-default btn-file">
                                    <input name="image_upthe" type="file" class="form-control" onchange="document.getElementById('img_8').src = window.URL.createObjectURL(this.files[0])">
                                </span>
                            </center>
                        </div>
                    </div>
                    <!-- // -->
                    <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="Update()">Cập nhật</button>
                </form>
            </div>
        </div>
    </section>
<?php } ?>