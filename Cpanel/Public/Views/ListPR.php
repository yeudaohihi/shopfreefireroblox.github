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
                <h3>Danh sách tài khoản quảng cáo</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tài khoản quảng cáo</li>
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
                        <label class="form-label">Username</label>
                        <input class="form-control" id="username" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Danh sách tên miền</label>
                        <select class="form-control" id="domain" onchange="filter_datatable()">
                        <option value="">Chọn tên miền</option>
                        <?php
                            foreach($db->fetch_assoc("SELECT * FROM `list_domain`", 0) as $info){
                        ?>
                        <option value="<?=$info['domain']?>"><?=$info['domain']?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="align-items-center justify-content-between mb-1" style="text-align: right;">
                    <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#AddPR"><i class="fas fa-plus fa-sm text-white-50"></i> Thêm tài khoản</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Tên</th>
                            <th>Đã rút</th>
                            <th>Giới hạn</th>
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
    function datatable(username = '', domain = ''){
        var dataTable = $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "searching" : false,
            "ajax" : {
                url:"/Model/Admin/ListPR",
                type:"POST",
                data:{
                    username,
                    domain
                }
            }
        });
        $("div.row").addClass('table-responsive');
    }
    function filter_datatable(){
        var username = $("#username").val();
        var domain = $("#domain").val();
        var type = $("#type").val();
        $('#table1').DataTable().destroy();
        datatable(username,domain,type);
    }
</script>
<div class="modal-info me-1 mb-1 d-inline-block">
    <!--info theme Modal -->
    <div class="modal fade text-left" id="info" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel130" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title white" id="myModalLabel130">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form class="form-data">
                        <div class="form-group">
                            <label>Username:</label>
                            <input class="form-control" type="text" name="username" readonly>
                        </div>
                        <div class="form-group">
                            <label>Giới hạn rút kim cương:</label>
                            <input class="form-control" type="number" name="max_diamond">
                        </div>
                        <div class="form-group">
                            <label><small>on - Bình thường | off - Bị chặn</small></label>
                            <input class="form-control" name="status" type="text">
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
$('#info').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    // get cash
    var username = button.data('username');
    var max_diamond = button.data('max_diamond');
    var status = button.data('status');
    var modal = $(this)
    // truyền giá trị cash
    modal.find('input[name=username]').val(username);
    modal.find('input[name=max_diamond]').val(max_diamond);
    modal.find('input[name=status]').val(status);
});
function update_(){
    var data = $(".form-data").serialize();
    $.ajax({
        url: '/Model/Admin/EditPR',
        data: data,
        dataType: "json",
        type: "POST",
        success: function(data) {
            Toast(data.status,data.msg);
            filter_datatable();
        }
    });
}
function UploadPR(){
    $.ajax({
        url: '/Model/Admin/UploadPR',
        type: 'POST',
        dataType: 'JSON',
        data: new FormData($('form#form-pr')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            Toast(data.status,data.msg);
            filter_datatable();
        }
    });
}
</script>

<div class="modal fade" id="AddPR" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Thêm tài khoản PR </h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-pr" id="form-pr">
                    <input hidden="" name="type_category" value="free-fire"><div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label>Username</label>
                                <input class="form-control" type="text" placeholder="Tài khoản" name="username">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giới hạn KC rút</label>
                                <input class="form-control" type="text" placeholder="Giới hạn số KC rút" name="max_diamond">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="block">
                                    <option value="on">Mở rút KC</option>
                                    <option value="off">Chặn rút KC</option>
                                </select>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="button"></div>
                <button type="button" class="btn btn-success ml-3" onclick="UploadPR()">
                    <svg class="svg-inline--fa fa-check fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                    </svg>
                    Thêm ngay nào!
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
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/footer.php');
?>