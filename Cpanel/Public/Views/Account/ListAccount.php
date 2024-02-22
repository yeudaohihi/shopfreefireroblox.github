<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Cpanel/Public/sidebar.php');
if($data_user['type'] == '2'){
    $sql_type = "AND `type` IN ('ACCOUNT','RANDOM')";
}elseif($data_user['type'] == '4'){
    $sql_type = "AND `type` = 'ACCOUNT'";
}
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
                <h3>Danh sách tài khoản</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
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
                        <label  class="form-label">Loại tài khoản</label>
                        <select class="form-control" id="type" onchange="select_game(this.value);">
                        <option value="">Chọn loại</option>
                        <?php
                            foreach($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `id` != '0' $sql_type", 0) as $info){
                                $detail = json_decode($info['detail'], true);
                        ?>
                        <option value="<?=$info['type_category']?>"><?=$detail['name_product']?></option>
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
                            <th>Giá tiền</th>
                            <th>Khuyến mại</th>
                            <th>Trạng thái</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
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
    function datatable(type = '', username = '', data = ''){
        var dataTable = $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "searching" : false,
            "ajax" : {
                url:"/Model/Admin/ListAccount",
                dataType: 'JSON',
                type:"POST",
                data: {
                    data: data,
                    type: type,
                    username: username,
                },
            },
        });
        $("div.row").addClass('table-responsive');
        
    }
    function filter_datatable(){
        var data = $("#filter_data").serializeArray();
        var username = $("#username").val();
        var type = $("#type").val();
        $('#table1').DataTable().destroy();
        datatable(type, username, data);
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
                            <tr>
                                <td colspan="4" class="text-sm text-center ip">IP</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-sm text-center browser">Browser</td>
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
    var ip = button.data('ip');
    var browser = button.data('browser');
    var modal = $(this)
    // truyền giá trị cash
    modal.find('.oldcash').text(oldcash);
    modal.find('.changecash').text(changecash);
    modal.find('.newcash').text(newcash);
    // truyền giá trị diamond
    modal.find('.olddiamond').text(olddiamond);
    modal.find('.changediamond').text(changediamond);
    modal.find('.newdiamond').text(newdiamond);
    modal.find('.ip').text('IP: '+ip);
    modal.find('.browser').text('Thiết bị: '+browser);
});
function Upload(){
    $("#button").html('<button type="button" class="btn btn-success ml-3" disabled> Đang xử lý <i class="fas fa-spinner fa-pulse"></i></button>');
    $.ajax({
        url: '/Model/Product/Account/Upload',
        type: 'POST',
        dataType: 'JSON',
        data: new FormData($('form#form-data')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data.status == 'success'){
                $("#button").html('<button type="button" class="btn btn-success ml-3" onclick="Upload()"><i class="fa fa-check"></i> Thêm ngay nào!</button>');
                Toast(data.status,data.msg);
                filter_datatable();
                document.getElementById("form-data").reset();
                $("#img_1").attr("src", "https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png");
            }else{
                Toast(data.status,data.msg);
            }
        }
    });
}
function delete_id(id){
    let text = "Bạn có chắc muốn thực hiện thao tác này không?";
    if (confirm(text) == true) {
        $.ajax({
            url: '/Model/Admin/Account/Delete',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id
            },
            success: function(data) {
                Toast(data.status,data.msg);
                filter_datatable();
            }
        });
    }
}
function select_game(val) {
    $.ajax({
        type: 'POST',
        url: '/Model/Admin/LoadAjax/SelectData',
        dataType: "json",
        data: {
            type: val
        },
        success: function (res) {
            if(res.status != 'error'){
                data = res.data;
                $html = "";
                for (let index = 0; index < data.length; index++) {
                    if(data[index]['type'] != 'password'){
                        $html += `<div class="col-md-3">`;
                            $html += `<div class="form-group">`;
                                $html += `<label>${data[index]['label']}</label>`;
                                if(data[index]['type'] == 'input'){
                                    $html += `<input class="form-control" type="text" onchange="filter_datatable()" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                }else if(data[index]['type'] == 'number'){
                                    $html += `<input class="form-control" type="number" onchange="filter_datatable()" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                }else if(data[index]['type'] == 'select'){
                                    $html += `<select class="form-control" name="${data[index]['name']}" onchange="filter_datatable()">`;
                                        $html += `<option value="">Chọn ${data[index]['label']}</option>`
                                        let value = data[index]['value'];
                                        const ArrrayValue = value.split("|");
                                        for (let i = 0; i < ArrrayValue.length; i++) {
                                            $html += `<option value="${ArrrayValue[i]}">${ArrrayValue[i]}</option>`
                                        }
                                    $html += `</select>`;
                                }
                            $html += `</div>`;
                        $html += `</div>`;
                    }
                }
                $('#filter').empty().append($html);
                $("#filter").show();
            }else{
                $html = "";
                $('#filter').empty().append($html);
                $("#filter").show();
            }
            filter_datatable();
        }
    })
}
function select_type(val){
    $.ajax({
        type: 'POST',
        url: '/Model/Admin/LoadAjax/SelectData',
        dataType: "json",
        data: {
            type: val
        },
        success: function (response) {
            if(response.status == 'error'){
                $("#new_data").html('');
                $html = `<div class="alert alert-danger">${response.msg}</div>`;
                $('#button').hide();
                $('#new_data').empty().append($html);
                $("#new_data").show();
            }else{
                data = response.data;
                $html = "";
                $html += `<hr>`;
                $html += `<form class="form-data" id="form-data">`;
                    $html += `<input hidden name="type_category" value="${val}">`;
                    $html += `<div class="row">`;
                    if(response.type == 'RANDOM'){
                        $html += `<div class="col-md-12">`;
                            $html += `<div class="form-group">`;
                                $html += `<label>Nhập dữ liệu</label>`;
                                placeholder = "";
                                for (let index = 0; index < data.length; index++) {
                                    placeholder += data[index]['label'];
                                    if(index < data.length-1){
                                        placeholder += '|';
                                    }
                                }
                                $html += `<textarea type="text" class="form-control" name="data" placeholder="${placeholder}"></textarea>`;
                            $html += `</div>`;
                        $html += `</div>`;
                    }else{
                        for (index = 0; index < data.length; index++) {
                            $html += `<div class="col-md-6">`;
                                $html += `<div class="form-group">`;
                                    $html += `<label>${data[index]['label']}</label>`;
                                    if(data[index]['type'] == 'input' || data[index]['type'] == 'password'){
                                        $html += `<input class="form-control" type="text" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                    }else if(data[index]['type'] == 'number'){
                                        $html += `<input class="form-control" type="number" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                    }else if(data[index]['type'] == 'select'){
                                        $html += `<select class="form-control" name="${data[index]['name']}">`;
                                            let value = data[index]['value'];
                                            const ArrrayValue = value.split("|");
                                            for (let i = 0; i < ArrrayValue.length; i++) {
                                                $html += `<option value="${ArrrayValue[i]}">${ArrrayValue[i]}</option>`
                                            }
                                        $html += `</select>`;
                                    }
                                $html += `</div>`;
                            $html += `</div>`;
                        }
                        $html += `<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Giá tiền</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="cash" class="form-control" placeholder="Giá tiền">
                                            <div class="input-group-append">
                                                <span class="input-group-text">đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        $html += `<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Khuyến mại</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="sale" class="form-control" placeholder="Khuyến mại" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        $html += `<div class="col-md-7">
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <img class="w-100 active" id="img_1" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png">
                                        <center>
                                            <span class="btn btn-default btn-file">
                                                <input name="image[]" type="file" class="form-control" onchange="document.getElementById('img_1').src = window.URL.createObjectURL(this.files[0])" multiple>
                                            </span>
                                        </center>
                                    </div>
                                </div>`;
                        $html += `</div>`;
                    }
                $button = `<button type="button" class="btn btn-success ml-3" onclick="Upload()"><i class="fa fa-check"></i> Thêm ngay nào!</button>`;
                $html += `</form>`;
                $('#new_data').empty().append($html);
                $('#button').show();
                $('#button').html($button);
                $("#new_data").show();
            }
        }
    });
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
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Loại tài khoản</label>
                                <select class="form-control" name="type" onchange="select_type(this.value);">
                                    <option value="">Chọn loại tài khoản</option>
                                    <?php
                                        foreach($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `id` != '0' $sql_type", 0) as $info){
                                            $detail = json_decode($info['detail'], true);
                                    ?>
                                    <option value="<?=$info['type_category']?>"><?=$detail['name_product']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="new_data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="button"></div>
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