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
                <h3>Lịch sử trò chơi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lịch sử trò chơi</li>
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
                        <label  class="form-label">Trò chơi</label>
                        <select class="form-control" id="type" onchange="filter_datatable()">
                        <option value="">Tên trò chơi</option>
                        <?php
                            foreach($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `type` IN ('VONGQUAY','LATHINH','BINGO3','MOQUA')", 0) as $info){
                                $detail = json_decode($info['detail'], true);
                        ?>
                        <option value="<?=$info['type_category']?>"><?=$detail['name_product']?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Danh sách tên miền</label>
                        <select class="form-control" id="domain" onchange="filter_datatable()">
                        <option value="">Chọn tên miền</option>
                        <?php
                            $sql_site = '';
                            if($data_user[type] == 2){
                                $sql_site = "";
                            }elseif($data_user[type] == 3){
                                $sql_site = "AND `domain` = '{$site}'";
                            }
                            foreach($db->fetch_assoc("SELECT * FROM `list_domain` WHERE `id` != '0' $sql_site", 0) as $info){
                        ?>
                        <option value="<?=$info['domain']?>"><?=$info['domain']?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Trò chơi</th>
                            <th>Username</th>
                            <th>Giá tiền</th>
                            <th>Nội dung</th>
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
    username = '';
    domain = '';
    type = '';
    function datatable(username = '', domain = '', type = ''){
        var dataTable = $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "searching" : false,
            "ajax" : {
                url:"/Model/Admin/HistoryMinigame",
                type:"POST",
                data:{
                    username,
                    domain,
                    type
                }
            },
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
    function test(old_cash,change_cash,new_cash){
        console.log(change_cash);
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
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Số dư cũ</th>
                                <th>Thay đổi</th>
                                <th>Số dư mới</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Số tiền</td>
                                <td class="oldcash">0</td>
                                <td class="changecash">0</td>
                                <td class="newcash">0</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Số kim cương</td>
                                <td class="olddiamond">0</td>
                                <td class="changediamond">0</td>
                                <td class="newdiamond">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
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
    var oldcash = button.data('oldcash');
    var changecash = button.data('changecash');
    var newcash = button.data('newcash');
    // get diamond
    var olddiamond = button.data('olddiamond');
    var changediamond = button.data('changediamond');
    var newdiamond = button.data('newdiamond');
    var modal = $(this)
    // truyền giá trị cash
    modal.find('.oldcash').text(oldcash);
    modal.find('.changecash').text(changecash);
    modal.find('.newcash').text(newcash);
    // truyền giá trị diamond
    modal.find('.olddiamond').text(olddiamond);
    modal.find('.changediamond').text(changediamond);
    modal.find('.newdiamond').text(newdiamond);
})
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/footer.php');
?>