<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/sidebar.php');

if (!@$user || $data_user['type'] != 2) {
    new Redirect(DOMAIN);
    exit;
}

$query = $db->fetch_assoc("SELECT * FROM `config_giveaway` WHERE `type` = 'LIXI'", 1);
$detail = json_decode($query['detail'], true);

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
                    <h3>Cài đặt sự kiện nhận quà</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cài đặt sự kiện</li>
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
                            <h4 class="card-title">Cài đặt sự kiện</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form-events" id="form-events" enctype="multipart/form-data">
                                    <input hidden class="form-control" type="text" name="type" value="LIXI">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chế độ hoạt động</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="on" <?= $query[status] == 'on' ? 'selected="selected"' : '' ?>>Hoạt động</option>
                                                    <option value="off" <?= $query[status] == 'off' ? 'selected="selected"' : '' ?>>Bảo trì</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kim cương ngẫu nhiên (5,10)</label>
                                                <input class="form-control" type="text" name="diamond" value="<?= $detail[diamond] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- chọn hình ảnh -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ảnh thumb nhận quà</label>
                                                <img class="w-100 active" id="img_1" src="<?= $detail[images] ?>">
                                                <center>
                                                    <span class="btn btn-default btn-file">
                                                        <input name="images" type="file" class="form-control" onchange="document.getElementById('img_1').src = window.URL.createObjectURL(this.files[0])">
                                                    </span>
                                                </center>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="gift"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Thông báo nhận quà</label>
                                                <textarea name="noti" id="noti" cols="50" rows="3"><?= html_entity_decode($detail['noti']) ?></textarea>
                                                <script>
                                                    CKEDITOR.replace('noti'); // tham số là biến name của textarea
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-block btn-lg shadow-lg mt-3" onclick="Update()">Lưu thay đổi</button>
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
        function Update() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                url: '/Model/Admin/EditEvent',
                type: 'POST',
                dataType: 'JSON',
                data: new FormData($('form#form-events')[0]),
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