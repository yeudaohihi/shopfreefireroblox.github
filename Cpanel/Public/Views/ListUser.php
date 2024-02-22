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
                    <h3>Danh sách thành viên</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thành viên</li>
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
                        <div class="col-md-4">
                            <label class="form-label">Username</label>
                            <input class="form-control" id="username" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Loại thành viên</label>
                            <select class="form-control" id="type" onchange="filter_datatable()">
                                <option value="">Chọn loại thành viên</option>
                                <option value="1">Thành viên</option>
                                <option value="2">Quản trị viên</option>
                                <option value="3">Người quảng cáo</option>
                                <!--<option value="4">Cộng tác viên</option>-->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Danh sách tên miền</label>
                            <select class="form-control" id="domain" onchange="filter_datatable()">
                                <option value="">Chọn tên miền</option>
                                <?php
                                foreach ($db->fetch_assoc("SELECT * FROM `list_domain`", 0) as $info) {
                                ?>
                                    <option value="<?= $info['domain'] ?>"><?= $info['domain'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Tên</th>
                                <th>Loại thành viên</th>
                                <th>Số tiền</th>
                                <th>Số kim cương</th>
                                <th>Shop</th>
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

        function datatable(username = '', domain = '', type = '') {
            var dataTable = $('#table1').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "searching": false,
                "ajax": {
                    url: "/Model/Admin/ListUser",
                    type: "POST",
                    data: {
                        username,
                        domain,
                        type
                    }
                }
            });
            $("div.row").addClass('table-responsive');
        }

        function filter_datatable() {
            var username = $("#username").val();
            var domain = $("#domain").val();
            var type = $("#type").val();
            $('#table1').DataTable().destroy();
            datatable(username, domain, type);
        }
    </script>
    <div class="modal-info me-1 mb-1 d-inline-block">
        <!--info theme Modal -->
        <div class="modal fade text-left" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title white" id="myModalLabel130">Thông tin chi tiết</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-data">
                            <div class="form-group">
                                <label>Username:</label>
                                <input class="form-control" type="text" name="username" readonly>
                            </div>
                            <div class="form-group">
                                <label>Số tiền:</label>
                                <input class="form-control" type="number" name="cash">
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label>Lượt quay miễn phí:</label>-->
                            <!--    <input class="form-control" type="number" name="turn_wheel">-->
                            <!--</div>-->
                            <div class="form-group">
                                <label>Số kim cương:</label>
                                <input class="form-control" type="number" name="diamond">
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" name="type">
                                    <option value="1">Thành viên</option>
                                    <option value="2">Quản trị viên</option>
                                    <option value="3">Người quảng cáo</option>
                                    <option value="4">Cộng tác viên</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="on">Hoạt động</option>
                                    <option value="off">Dừng hoạt động</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="update_()">Cập nhật</button>
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#info').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // get cash
            var cash = button.data('cash');
            var diamond = button.data('diamond');
            var username = button.data('username');
            var type = button.data('type');
            var status = button.data('status');
            // var turn_wheel = button.data('turn_wheel');
            var modal = $(this)
            // truyền giá trị cash
            modal.find('input[name=username]').val(username);
            modal.find('input[name=diamond]').val(diamond);
            modal.find('input[name=cash]').val(cash);
            modal.find('select[name=type]').val(type);
            modal.find('select[name=status]').val(status);
            // modal.find('input[name=turn_wheel]').val(turn_wheel);
        });

        function update_() {
            var data = $(".form-data").serialize();
            $.ajax({
                url: '/Model/Admin/EditUser',
                data: data,
                dataType: "json",
                type: "POST",
                success: function(data) {
                    Toast(data.status, data.msg);
                    filter_datatable();
                }
            });
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>