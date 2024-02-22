<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/sidebar.php');
$id = Anti_xss($_GET['id']);
if(!@$user){
    new Redirect('/Login');
}elseif($data_user['type'] != '2'){
    new Redirect('/');
}elseif($db->num_rows("SELECT * FROM `product_game` WHERE `id` = '{$id}' AND `type` IN ('ACCOUNT','RANDOM')") < 1){
    new Redirect($_SERVER['HTTP_REFERER']);
}else{
    $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `id` = '{$id}' AND `type` IN ('ACCOUNT','RANDOM')", 1);
    $detail = json_decode($query['detail'], true);
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
                <h3>Chỉnh sửa trò chơi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa trò chơi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic choices start -->
    <section class="basic-choices">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh sửa [<?=$detail['name_product']?>]</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <div class="alert alert-primary">Lưu ý 1: Phần Giá Trị (Nếu chọn kiểu dữ liệu "Chọn dữ liệu" Thì chọn nhập dữ liệu vào, còn không để trống)<br>Lưu ý 2: Phần Dữ liệu được (Nếu khách hàng chưa giao dịch sản phẩm đó thì giá trị của dòng sẽ không được hiển thị với khách hàng)</div>
                            <form class="form-data" id="form-data" enctype="multipart/form-data">
                                <input hidden name="id" value="<?=$id?>">
                                <?php if($query['type'] == 'RANDOM'): ?>
                                <input hidden name="price" value="<?=$detail['cash']?>">
                                <?php else: ?>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục hiển thị</label>
                                            <select class="form-control" name="product">
                                                <option value="">Chọn danh mục</option>
                                                <?php foreach($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0'", 0) as $info){ ?>
                                                    <option value="<?=$info['key_product']?>" <?=$info['key_product'] == $query['product'] ? 'selected="selected"' : ''?>><?=$info['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại tài khoản</label>
                                            <select class="form-control" name="type">
                                                <option value="ACCOUNT" <?=$query['type'] == 'ACCOUNT' ? 'selected="selected"' : ''?>>Tài khoản</option>
                                                <option value="RANDOM" <?=$query['type'] == 'RANDOM' ? 'selected="selected"' : ''?>>Vận may</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <input class="form-control" name="name_product" type="text" placeholder="Tên sản phẩm" value="<?=$detail['name_product']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tên miền hiển thị</label>
                                            <select class="form-control" name="domain">
                                                <option value="ALL" <?=$query['site'] == 'ALL' ? 'selected="selected"' : ''?>>Tất cả tên miền trên hệ thống</option>
                                                <?php foreach($db->fetch_assoc("SELECT * FROM `list_domain` WHERE `id` != '0'", 0) as $info){ ?>
                                                    <option value="<?=$info['domain']?>" <?=$query['site'] == $info['domain'] ? 'selected="selected"' : ''?>><?=$info['domain']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Chọn nhãn dán</label>
                                            <select class="form-control" name="tag">
                                                <option value="">Không hiển thị</option>
                                                <?php foreach($db->fetch_assoc("SELECT * FROM `product_tag` WHERE `id` != '0'", 0) as $info){ ?>
                                                    <option value="<?=$info['image']?>" <?=$info['image'] == $detail['tag'] ? 'selected="selected"' : ''?>><?=$info['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- chọn hình ảnh -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ảnh thumb</label>
                                            <img class="w-100 active lazyLoad" id="img_1" data-src="<?=$detail['thumb']?>">
                                            <center>
                                                <span class="btn btn-default btn-file">
                                                    <input name="thumb" type="file" class="form-control" onchange="document.getElementById('img_1').src = window.URL.createObjectURL(this.files[0])">
                                                </span>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <!-- // -->
                                <?php
                                    for ($i=0; $i < count($detail['data']); $i++) {
                                ?>
                                <div class="removeclass<?=$i+1?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kiểu dữ liệu:</label>
                                                <select class="form-control" name="data_type[]">
                                                    <option value="input" <?=$detail['data'][$i]['type'] == 'input' ? 'selected="selected"' : ''?>>Nhập dữ liệu số & chữ</option>
                                                    <option value="select" <?=$detail['data'][$i]['type'] == 'select' ? 'selected="selected"' : ''?>>Chọn dữ liệu</option>
                                                    <option value="number" <?=$detail['data'][$i]['type'] == 'number' ? 'selected="selected"' : ''?>>Nhập dữ liệu số</option>
                                                    <option value="password" <?=$detail['data'][$i]['type'] == 'password' ? 'selected="selected"' : ''?>>Nhập mật khẩu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tên hiển thị:</label>
                                                <input class="form-control" name="data_name[]" type="text" placeholder="Tên hiển thị" value="<?=$detail['data'][$i]['label']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Giá trị</label>
                                                <input class="form-control" type="text" name="data_value[]" placeholder="Phân cách dữ liệu bằng ký tự |" value="<?=$detail['data'][$i]['value']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Dữ liệu được</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="data_show[]">
                                                        <option value="on" <?=$detail['data'][$i]['show'] == 'on' ? 'selected="selected"' : ''?>>Hiển thị cho người dùng</option>
                                                        <option value="off" <?=$detail['data'][$i]['show'] == 'off' ? 'selected="selected"' : ''?>>Không hiển thị cho người dùng</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <?php if($i == '0'){ ?>
                                                            <button class="btn btn-success" type="button" onclick="add_();"><i class="fa fa-plus"></i></button>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-danger" type="button" onclick="remove(<?=$i+1?>);"><i class="fa fa-minus"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div id="gift"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Thể Lệ</label>
                                            <textarea name="thele" id="thele" cols="50" rows="5"><?=$detail['thele']?></textarea>
                                            <script>
                                                CKEDITOR.replace('thele');// tham số là biến name của textarea
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-block btn-lg shadow-lg mt-3" onclick="Upload()">Chỉnh sửa!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic choices end -->
</div>
<script>
var room = <?=count($detail['data'])?>;
function add_() {
    room++;
    var objTo = document.getElementById('gift');
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = `<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kiểu dữ liệu:</label>
                                    <select class="form-control" name="data_type[]">
                                        <option value="input">Nhập dữ liệu số & chữ</option>
                                        <option value="select">Chọn dữ liệu</option>
                                        <option value="number">Nhập dữ liệu số</option>
                                        <option value="password">Nhập mật khẩu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tên hiển thị:</label>
                                    <input class="form-control" name="data_name[]" type="text" placeholder="Tên hiển thị">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Giá trị</label>
                                    <input class="form-control" type="text" name="data_value[]" placeholder="Phân cách dữ liệu bằng ký tự |">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dữ liệu được</label>
                                    <div class="input-group">
                                        <select class="form-control" name="data_show[]">
                                            <option value="on">Hiển thị cho người dùng</option>
                                            <option value="off">Không hiển thị cho người dùng</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" onclick="remove(${room});"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
    objTo.appendChild(divtest);
}
function remove(rid) {
    room = rid-1;
    $('.removeclass' + rid).remove();
}
function Upload(){
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $.ajax({
        url: '/Model/Admin/Product/EditAccountGame',
        type: 'POST',
        dataType: 'JSON',
        data: new FormData($('form#form-data')[0]),
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