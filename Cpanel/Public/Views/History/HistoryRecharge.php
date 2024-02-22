<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/sidebar.php');
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
                <h3>Lịch sử nạp thẻ cào</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lịch sử nạp thẻ cào</li>
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
                    <div class="col-md-3">
                        <label class="form-label">Serial</label>
                        <input class="form-control" id="serial" placeholder="Nhập serial thẻ cào" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Mã thẻ</label>
                        <input class="form-control" id="code" placeholder="Nhập mã thẻ cào" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Username</label>
                        <input class="form-control" id="username" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-control" id="status" onchange="filter_datatable()">
                            <option value="">Toàn bộ</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Thành công</option>
                            <option value="3">Thất bại</option>
                            <option value="4">Sai mệnh giá</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="align-items-center justify-content-between mb-1" style="text-align: right;">
                    <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#Add_top"><i class="fas fa-plus fa-sm text-white-50"></i> Thêm top ảo</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Tên</th>
                            <th>Loại thẻ</th>
                            <th>Serial</th>
                            <th>Mã thẻ</th>
                            <th>Mệnh giá</th>
                            <th>Trạng thái</th>
                            <th>Shop</th>
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
    function datatable(username = '', serial = '', code = '', status = ''){
        var dataTable = $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "searching" : false,
            "ajax" : {
                url:"/Model/Admin/HistoryRecharge",
                dataType: 'JSON',
                type:"POST",
                data: {
                    username: username,
                    serial: serial,
                    code: code,
                    status: status
                },
            },
        });
        $("div.row").addClass('table-responsive');
        
    }
    function filter_datatable(){
        var username = $("#username").val();
        var serial = $("#serial").val();
        var code = $("#code").val();
        var status = $("#status").val();
        $('#table1').DataTable().destroy();
        datatable(username, serial, code, status);
    }
    function upload_top(){
        $.ajax({
            url: '/Model/Admin/Upload_top',
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
<div class="modal fade" id="Add_top" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Đăng tài khoản </h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-data" id="form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input class="form-control" type="text" placeholder="Tên người dùng" name="name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số tiền</label>
                                <input class="form-control" type="number" placeholder="Số tiền" name="amount">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên shop</label>
                                <select class="form-control" name="shop" onchange="select_type(this.value);">
                                    <option value="">Chọn shop muốn thêm</option>
                                    <?php
                                        foreach($db->fetch_assoc("SELECT DISTINCT `domain` FROM `list_domain` WHERE `id` != '1' ", 0) as $info){
                                    ?>
                                    <option value="<?=$info['domain']?>"><?=$info['domain']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="button"></div>
                <button type="button" class="btn btn-success ml-3" onclick="upload_top()"><i class="fa fa-check"></i> Thêm ngay nào!</button>
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Thoát</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/footer.php');
?>