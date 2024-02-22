<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/sidebar.php');


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
                    <h3>Rút tiền</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Rút tiền CTV</li>
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
                            <h4 class="card-title">Rút tiền CTV - Số dư hiện tại <b id="cash"><?= number_format($data_user['cash']) ?></b><strong>đ</strong></h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ngân hàng</label>
                                                <select name="bank" id="bank" class="form-control">
                                                    <option value="VIETCOMBANK">VIETCOMBANK -NH TMCP NGOAI THUONG VIET NAM (VCB)</option>
                                                    <option value="BIDV">BIDV - NH DAU TU VA PHAT TRIEN VIET NAM</option>
                                                    <option value="VIETINBANK">VIETINBANK - NH TMCP CONG THUONG VIET NAM</option>
                                                    <option value="MOMO">MOMO - VÍ ĐIỆN TỬ</option>
                                                    <option value="AGRIBANK">AGRIBANK - NH NN - PTNT VIET NAM</option>
                                                    <option value="SACOMBANK">SACOMBANK - NH TMCP SAI GON THUONG TIN</option>
                                                    <option value="DONGABANK">DONGABANK -NH TMCP DONG A (EAB)</option>
                                                    <option value="VPBANK">VPBANK - NH TMCP VIET NAM THINH VUONG</option>
                                                    <option value="TPBANK">TPBANK - NH TMCP TIEN PHONG</option>
                                                    <option value="SHINHANBANK">SHINHANBANK - NH TNHH SHINHAN VIET NAM</option>
                                                    <option value="ACB">ACB - NH TMCP A CHAU</option>
                                                    <option value="MBBANK">MB BANK - NH TMCP QUAN DOI</option>
                                                    <option value="SCB">SCB - NH TMCP SAI GON</option>
                                                    <option value="SHB">SHB - NH TMCP SAI GON HA NOI</option>
                                                    <option value="MSB">MSB - Ngân Hàng TMCP Hàng Hải Việt Nam</option>
                                                    <option value="EXIMBANK">EXIMBANK - NH TMCP XUAT NHAP KHAU VIET NAM (EIB)</option>
                                                    <option value="SEABANK">SEABANK - NH TMCP DONG NAM A</option>
                                                    <option value="BAOVIETBANK">BAOVIETBANK - NH TMCP BAO VIET (BVB)</option>
                                                    <option value="GPBANK">GPBANK - NH TMCP DAU KHI TOAN CAU (GPB)</option>
                                                    <option value="HDBANK">HDBANK - NH TMCP PHAT TRIEN TP.HCM (HDB)</option>
                                                    <option value="KIENLONGBANK">KIENLONGBANK - NH TMCP KIEN LONG</option>
                                                    <option value="LIENVIETPOSTBANK">LIENVIETPOSTBANK - NH TMCP LIEN VIET</option>
                                                    <option value="NAMABANK">NAMABANK - NHTMCP NAM A (NAB)</option>
                                                    <option value="OCB">OCB - NH TMCP PHUONG DONG</option>
                                                    <option value="OCEANBANK">OCEANBANK - NH TMCP DAI DUONG (OJB)</option>
                                                    <option value="VIB">VIB - NH TMCP QUOC TE VIET NAM</option>
                                                    <option value="VIETABANK">VIETABANK - NH TMCP VIET A</option>
                                                    <option value="TCB">TECHCOMBANK - NH TMCP KY THUONG VIET NAM (TCB)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Số tài khoản</label>
                                                <input class="form-control" type="number" name="stk" placeholder="Số tài khoản">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Chủ tài khoản</label>
                                                <input class="form-control" type="text" name="ctk" placeholder="Tên chủ tài khoản">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Số tiền rút</label>
                                                <input class="form-control" type="number" name="amount" placeholder="Số tiền muốn rút">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea class="form-control" name="note" type="text" placeholder="Ghi chú" rows="3"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-block btn-lg shadow-lg mt-3" onclick="Withdraw()">Tạo lệnh rút tiền</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h4>Lịch sử rút tiền</h4>
                    </center>
                    <hr>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Ngân hàng</th>
                                <th>Chủ tài khoản</th>
                                <th>Số tài khoản</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                                <?php if ($data_user['type'] == '2') { ?>
                                    <th>Thao tác</th>
                                <?php } ?>
                                <th>Ghi chú</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic choices end -->
    </div>
    <script>
        // Simple Datatable
        datatable();

        function datatable() {
            $('#table1').DataTable().destroy();
            var dataTable = $('#table1').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "searching": false,
                "ajax": {
                    url: "/Model/Admin/LoadAjax/History/HistoryWithdraw",
                    dataType: 'JSON',
                    type: "POST",
                },
            });
            $("div.row").addClass('table-responsive');
        }

        function Withdraw() {
            var data = $(".form-data").serialize();
            $.ajax({
                url: '/Model/Admin/CTV/Withdraw',
                data: data,
                dataType: "json",
                type: "POST",
                success: function(data) {
                    Toast(data.status, data.msg);
                    datatable();
                    $("#cash").text(data.cash);
                }
            });
        }
    </script>
    <div class="modal-info me-1 mb-1 d-inline-block">
        <!--info theme Modal -->
        <div class="modal fade text-left" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title white" id="myModalLabel130">Duyệt lệnh rút tiền</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-update">
                            <div class="form-group">
                                <label>Mã đơn:</label>
                                <input class="form-control" type="text" name="id" readonly>
                            </div>
                            <div class="form-group">
                                <label>Số tiền:</label>
                                <input class="form-control" type="text" name="amount" readonly>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="2">Thành công</option>
                                    <option value="3">Thất bại</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" name="note" type="text" placeholder="Ghi chú" rows="2"></textarea>
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
            var modal = $(this)
            // truyền giá trị cash
            modal.find('input[name=id]').val(button.data('id'));
            modal.find('input[name=amount]').val(button.data('amount'));
            modal.find('textarea[name=note]').text(button.data('note'));
        });

        function update_() {
            var data = $(".form-update").serialize();
            $.ajax({
                url: '/Model/Admin/CTV/EditWithdraw',
                data: data,
                dataType: "json",
                type: "POST",
                success: function(data) {
                    Toast(data.status, data.msg);
                    datatable();
                }
            });
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>