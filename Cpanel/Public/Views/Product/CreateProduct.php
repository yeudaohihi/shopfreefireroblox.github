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
                    <h3>Cài đặt danh mục</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cài đặt danh mục</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic choices start -->
        <section class="basic-choices">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm danh mục</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form-data" id="form-data" enctype="multipart/form-data">
                                    <input hidden name="type" value="upload">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên danh mục</label>
                                                <input class="form-control" name="name" type="text" placeholder="Tên danh mục">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input name="image" type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-block btn-lg shadow-lg mt-3" onclick="Upload()">Xác nhận</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Hình ảnh</th>
                                            <th>Tên</th>
                                            <th>Thời gian</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($db->num_rows("SELECT * FROM `product` WHERE `id` != '0'") > 0) {
                                            foreach ($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0'", 0) as $info) {
                                        ?>
                                                <tr>
                                                    <td><?= $info['id'] ?></td>
                                                    <td><img width="100" height="30" src="<?= $info['image'] ?>"></td>
                                                    <td><?= $info['name'] ?></td>
                                                    <td><?= date('H:i d-m-Y', $info['created_at']) ?></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="Delete('delete','<?= $info['id'] ?>')">X</button></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-sm text-center">
                                                    Không có dữ liệu
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic choices end -->
    </div>
    <script>
        function Upload() {
            $.ajax({
                url: '/Model/Product/CreateProduct',
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

        function Delete(type, id) {
            $.ajax({
                url: '/Model/Product/CreateProduct',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    type,
                    id
                },
                success: function(data) {
                    Toast(data.status, data.msg);
                }
            });
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>