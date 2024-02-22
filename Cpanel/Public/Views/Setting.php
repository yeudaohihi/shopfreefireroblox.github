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
                    <h3>Cài đặt</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cài đặt</li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Chọn shop để cài đặt</h4>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#SettingAll">Cài đặt all shop</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form-data" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="choices form-select" onchange="select_shop(this.value);">
                                                    <option value="">Chọn tên shop</option>
                                                    <?php
                                                    foreach ($db->fetch_assoc("SELECT * FROM `list_domain`", 0) as $info) {
                                                    ?>
                                                        <option value="<?= $info['domain'] ?>"><?= $info['domain'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Tên shop mới</label>
                                            <input class="form-control" type="text" name="domain" placeholder="Tên shop mới">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="AddDomain()">Xác nhận</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic choices end -->
        <div id="new_data"></div>
    </div>
    <script type="text/javascript">
        function AddDomain() {
            var data = $(".form-data").serialize();
            $.ajax({
                url: '/Model/Admin/AddDomain',
                data: data,
                dataType: "json",
                type: "POST",
                success: function(data) {
                    if (data.status == 'success') {
                        Toast(data.status, data.msg);
                    } else {
                        Toast(data.status, data.msg);
                    }
                }
            });
        }

        function select_shop(val) {
            $.ajax({
                type: 'post',
                url: '/Model/Admin/LoadTable/SelectShop',
                data: {
                    domain: val
                },
                success: function(response) {
                    $("#new_data").html('');
                    $('#new_data').empty().append(response);
                    $("#new_data").show();
                }
            });
        }

        function Update() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '/Model/Admin/UpdateShop',
                type: 'POST',
                dataType: 'JSON',
                data: new FormData($('form#form-update')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    Toast(data.status, data.msg);
                }
            });
        }

        function UpdateAll() {
            $.ajax({
                url: '/Model/Admin/UpdateAllShop',
                type: 'POST',
                dataType: 'JSON',
                data: new FormData($('form#form-update-all')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    Toast(data.status, data.msg);
                }
            });
        }
    </script>
    <div class="modal fade" id="SettingAll" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Cài đặt tất cả shop </h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-update-all" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Số tiền cho người mới</label>
                                    <input class="form-control" name="new_cash" placeholder="Tiền cho người mới" value="10000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Khuyến mại nạp tiền</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Khuyến mại nạp tiền" name="persent_cash" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Trạng thái rút kim cương</label>
                                    <select class="form-control" name="status_diamond">
                                        <option value="on" selected="selected">Bật</option>
                                        <option value="off">Tắt</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>Background</label>
                                <img class="w-100 active" id="img_3_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="background" type="file" class="form-control" onchange="document.getElementById('img_3_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                            <div class="col-md-3">
                                <label>Mua ngay</label>
                                <img class="w-100 active" id="img_4_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="image_buy" type="file" class="form-control" onchange="document.getElementById('img_4_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                            <div class="col-md-3">
                                <label>Chơi thử</label>
                                <img class="w-100 active" id="img_5_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="image_try" type="file" class="form-control" onchange="document.getElementById('img_5_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                            <div class="col-md-3">
                                <label>Chơi ngay</label>
                                <img class="w-100 active" id="img_6_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="image_play" type="file" class="form-control" onchange="document.getElementById('img_6_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                            <div class="col-md-3">
                                <label>Nút quay</label>
                                <img class="w-100 active" id="img_7_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="btn_quay" type="file" class="form-control" onchange="document.getElementById('img_7_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                            <div class="col-md-3">
                                <label>Úp thẻ</label>
                                <img class="w-100 active" id="img_8_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                <center>
                                    <span class="btn btn-default btn-file">
                                        <input name="image_upthe" type="file" class="form-control" onchange="document.getElementById('img_8_1').src = window.URL.createObjectURL(this.files[0])">
                                    </span>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-success" onclick="UpdateAll()">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cập nhật</span>
                    </button>
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Thoát</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>