<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/sidebar.php');
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
                    <h3>Cài đặt trò chơi</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thêm trò chơi</li>
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
                            <h4 class="card-title">Thêm danh mục</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="alert alert-primary">Lưu ý 1: Phần Giá Trị (Nếu chọn kiểu dữ liệu "Chọn dữ liệu" Thì chọn nhập dữ liệu vào, còn không để trống)<br>Lưu ý 2: Phần Dữ liệu được (Nếu khách hàng chưa giao dịch sản phẩm đó thì giá trị của dòng sẽ không được hiển thị với khách hàng)</div>
                                <form class="form-data" id="form-data" enctype="multipart/form-data">
                                    <input hidden name="type" value="DIAMONDBOX">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chọn danh mục hiển thị</label>
                                                <select class="form-control" name="product">
                                                    <option value="">Chọn danh mục</option>
                                                    <?php foreach ($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0'", 0) as $info) { ?>
                                                        <option value="<?= $info['key_product'] ?>"><?= $info['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá tiền</label>
                                                <input class="form-control" name="cash" type="number" placeholder="Giá tiền">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input class="form-control" name="name_product" type="text" placeholder="Tên sản phẩm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tên miền hiển thị</label>
                                                <select class="form-control" name="domain">
                                                    <option value="ALL">Tất cả tên miền trên hệ thống</option>
                                                    <?php foreach ($db->fetch_assoc("SELECT * FROM `list_domain` WHERE `id` != '0'", 0) as $info) { ?>
                                                        <option value="<?= $info['domain'] ?>"><?= $info['domain'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Chọn nhãn dán</label>
                                                <select class="form-control" name="tag">
                                                    <option value="">Không hiển thị</option>
                                                    <?php foreach ($db->fetch_assoc("SELECT * FROM `product_tag` WHERE `id` != '0'", 0) as $info) { ?>
                                                        <option value="<?= $info['image'] ?>"><?= $info['name'] ?></option>
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
                                                <img class="w-100 active" id="img_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                                <center>
                                                    <span class="btn btn-default btn-file">
                                                        <input name="thumb" type="file" class="form-control" onchange="document.getElementById('img_1').src = window.URL.createObjectURL(this.files[0])">
                                                    </span>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kiểu dữ liệu:</label>
                                                <select class="form-control" name="tyle_type[]">
                                                    <option value="KC">Kim cương</option>
                                                    <option value="PRICE">Tiền shop</option>
                                                    <option value="KCRD">Kim cương ngẫu nhiên</option>
                                                    <option value="PRICERD">Tiền shop ngẫu nhiên</option>
                                                    <option value="NO">Không trúng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phần thưởng:</label>
                                                <input class="form-control" name="tyle_value[]" type="text" placeholder="Nếu là random thì 20,25">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Thông báo</label>
                                                <div class="input-group">
                                                    <input class="form-control" name="tyle_text[]" type="text" placeholder="Bạn đã trúng ..." value="Bạn đã trúng ...">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="button" onclick="add_();"><i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="gift"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Thể Lệ</label>
                                                <textarea name="thele" id="thele" cols="50" rows="5"></textarea>
                                                <script>
                                                    CKEDITOR.replace('thele'); // tham số là biến name của textarea
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-block btn-lg shadow-lg mt-3" onclick="Upload()">Thêm ngay nào!</button>
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
        var room = 0;

        function add_() {
            room++;
            var objTo = document.getElementById('gift');
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = `<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kiểu dữ liệu:</label>
                                    <select class="form-control" name="tyle_type[]">
                                        <option value="KC">Kim cương</option>
                                        <option value="PRICE">Tiền shop</option>
                                        <option value="KCRD">Kim cương ngẫu nhiên</option>
                                        <option value="PRICERD">Tiền shop ngẫu nhiên</option>
                                        <option value="NO">Không trúng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phần thưởng:</label>
                                    <input class="form-control" name="tyle_value[]" type="text" placeholder="Nếu là random thì 20,25">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thông báo</label>
                                    <div class="input-group">
                                        <input class="form-control" name="tyle_text[]" type="text" placeholder="Bạn đã trúng ..." value="Bạn đã trúng ...">
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
            room = rid - 1;
            $('.removeclass' + rid).remove();
        }

        function Upload() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '/Model/Admin/Product/CreateDiamondBox',
                type: 'POST',
                dataType: 'JSON',
                data: new FormData($('form#form-data')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    Toast(data.status, data.msg);
                }
            });
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>