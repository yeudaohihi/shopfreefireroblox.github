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
                        <div class="col-md-3">
                            <label class="form-label">ID</label>
                            <input class="form-control" id="id_acc" placeholder="ID Tài khoản" onchange="filter_datatable()" type="search">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Người mua</label>
                            <input class="form-control" id="username" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Người bán</label>
                            <input class="form-control" id="username_post" placeholder="Nhập Username" onchange="filter_datatable()" type="search">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Loại tài khoản</label>
                            <select class="form-control" id="type" onchange="select_game(this.value);">
                                <option value="">Chọn loại</option>
                                <?php
                                foreach ($db->fetch_assoc("SELECT DISTINCT `type_category`,`detail` FROM `product_game` WHERE `type` IN ('ACCOUNT','RANDOM')", 0) as $info) {
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
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>ID Tài Khoản</th>
                                <th>Loại Tài Khoản</th>
                                <th>Người Mua</th>
                                <th>Người Bán</th>
                                <th>Giá</th>
                                <th>Web</th>
                                <th>Thời Gian</th>
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

        function datatable(username_post = '', id_acc = '', type = '', username = '', data = '') {
            var dataTable = $('#table1').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "searching": false,
                "ajax": {
                    url: "/Model/Admin/HistoryBuy",
                    dataType: 'JSON',
                    type: "POST",
                    data: {
                        data: data,
                        type: type,
                        username: username,
                        id_acc: id_acc,
                        username_post: username_post
                    },
                },
            });
            $("div.row").addClass('table-responsive');

        }

        function filter_datatable() {
            var data = $("#filter_data").serializeArray();
            var username = $("#username").val();
            var type = $("#type").val();
            var id_acc = $("#id_acc").val();
            var username_post = $("#username_post").val();
            $('#table1').DataTable().destroy();
            datatable(username_post, id_acc, type, username, data);
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
                        <form>
                            <div class="row">
                                <div class="col-md-12" id="data"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
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
            var data = button.data('data');
            obj = button.context.dataset;
            $html = "";
            for (var k in obj) {
                if (obj[k] != 'modal' && obj[k] != '#info') {
                    var strArray = obj[k].split("|");
                    $html += `<div class="form-group">`;
                    $html += `<label>${strArray[0]}</label>`;
                    $html += `<input class="form-control" value="${strArray[1]}" readonly>`;
                    $html += `</div>`;
                }
            }
            $('#data').empty().append($html);
            $("#data").show();
        });

        function select_game(val) {
            $.ajax({
                type: 'POST',
                url: '/Model/Admin/LoadAjax/SelectData',
                dataType: "json",
                data: {
                    type: val
                },
                success: function(res) {
                    if (res.status != 'error') {
                        data = res.data;
                        $html = "";
                        for (let index = 0; index < data.length; index++) {
                            if (data[index]['type'] != 'password') {
                                $html += `<div class="col-md-3">`;
                                $html += `<div class="form-group">`;
                                $html += `<label>${data[index]['label']}</label>`;
                                if (data[index]['type'] == 'input') {
                                    $html += `<input class="form-control" type="text" onchange="filter_datatable()" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                } else if (data[index]['type'] == 'number') {
                                    $html += `<input class="form-control" type="number" onchange="filter_datatable()" placeholder="${data[index]['label']}" name="${data[index]['name']}">`
                                } else if (data[index]['type'] == 'select') {
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
                    } else {
                        $html = "";
                        $('#filter').empty().append($html);
                        $("#filter").show();
                    }
                    filter_datatable();
                }
            })
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>