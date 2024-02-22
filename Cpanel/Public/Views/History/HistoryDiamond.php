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
                <h3>Lịch sử mua</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lịch sử mua</li>
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
                        <label class="form-label">ID Game</label>
                        <input class="form-control" id="idgame" placeholder="#ID Game" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Username</label>
                        <input class="form-control" id="username" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-control" id="status" onchange="filter_datatable()">
                            <option value="">Toàn bộ</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Thành công</option>
                            <option value="3">Thất bại</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Tên</th>
                            <th>ID Game</th>
                            <th>Số tiền</th>
                            <th>Số K/C</th>
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
    function datatable(username = '',idgame = '',status = ''){
        var dataTable = $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "searching" : false,
            "ajax" : {
                url:"/Model/Admin/HistoryDiamond",
                dataType: 'JSON',
                type:"POST",
                data: {
                    username: username,
                    idgame: idgame,
                    status: status
                },
            },
        });
        $("div.row").addClass('table-responsive');
        
    }
    function filter_datatable(){
        var username = $("#username").val();
        var idgame = $("#idgame").val();
        var status = $("#status").val();
        $('#table1').DataTable().destroy();
        datatable(username, idgame, status);
    }
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/footer.php');
?>