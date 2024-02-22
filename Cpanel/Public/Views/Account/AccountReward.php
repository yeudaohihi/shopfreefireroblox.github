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
                    <h3>Tài khoản trả thưởng</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tài khoản trả thưởng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tài khoản</label>
                                <input class="form-control" id="username" type="text" placeholder="Tài khoản" onchange="datatable()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Loại tài khoản</label>
                            <select class="form-control" id="type" onchange="datatable()">
                                <option value="">Chọn loại</option>
                                <?php
                                foreach ($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `id` != '0' AND `type` IN ('VONGQUAY', 'BINGO3', 'LATHINH', 'MOQUA')", 0) as $info) {
                                    $detail = json_decode($info['detail'], true);
                                ?>
                                    <option value="<?= $info['type_category'] ?>"><?= $detail['name_product'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <form id="filter_data" class="mt-1">
                        <div class="row" id="filter"></div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="align-items-center justify-content-between mb-1" style="text-align: right;">
                        <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#AddAccount"><i class="fas fa-plus fa-sm text-white-50"></i> Thêm tài khoản</a>
                    </div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loại tài khoản</th>
                                <th>Người đăng</th>
                                <th>Tài khoản</th>
                                <th>Mật khẩu</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
    <script>
        // Simple Datatable
        datatable();

        function datatable() {
            var username = $("#username").val();
            var type = $("#type").val();
            $('#table1').DataTable().destroy();
            var dataTable = $('#table1').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "searching": false,
                "ajax": {
                    url: "/Model/Admin/LoadAjax/Account/AccountReward",
                    dataType: 'JSON',
                    type: "POST",
                    data: {
                        type: type,
                        username: username,
                    },
                },
            });
            $("div.row").addClass('table-responsive');
        }
    </script>
    <script>
        function Upload() {
            var data = $(".form-data").serialize();
            $.ajax({
                url: '/Model/Admin/Account/UploadReward',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    Toast(data.status, data.msg);
                    datatable();
                }
            });
        }

        function delete_id(id) {
            let text = "Bạn có chắc muốn thực hiện thao tác này không?";
            if (confirm(text) == true) {
                $.ajax({
                    url: '/Model/Admin/Account/UploadReward',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id,
                        type: 'delete'
                    },
                    success: function(data) {
                        Toast(data.status, data.msg);
                        datatable();
                    }
                });
            }
        }
    </script>
    <div class="modal fade" id="AddAccount" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Đăng tài khoản </h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-data">
                        <input hidden name="type" value="upload">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Loại tài khoản</label>
                                    <select class="form-control" name="type_category">
                                        <option value="">Chọn loại tài khoản</option>
                                        <?php
                                        foreach ($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `id` != '0' AND `type` IN ('VONGQUAY', 'BINGO3', 'LATHINH', 'MOQUA')", 0) as $info) {
                                            $detail = json_decode($info['detail'], true);
                                        ?>
                                            <option value="<?= $info['type_category'] ?>"><?= $detail['name_product'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thông tin tài khoản</label>
                                    <textarea class="form-control" type="text" name="info" placeholder="Tài khoản|Mật khẩu|Code&#10;Mỗi dòng là 1 tài khoản" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success ml-3" onclick="Upload()"><i class="fa fa-check"></i> Thêm ngay nào!</button>
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