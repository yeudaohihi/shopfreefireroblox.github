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
                    <h3>Cài đặt</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cài đặt</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic choices start -->
        <section class="basic-choices">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Chọn loại apikey để cài đặt</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form-data" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="choices form-select" onchange="select_autobank(this.value);">
                                                    <option value="">Chọn apikey</option>
                                                    <option value="bank">Ngân hàng</option>
                                                    <option value="momo">Momo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic choices end -->
        <div id="new_data"></div>
    </div>
    <script type="text/javascript">
        function select_autobank(val) {
            $.ajax({
                type: 'post',
                url: '/Model/Admin/LoadTable/SelectAutoBank',
                data: {
                    type_api: val
                },
                success: function(response) {
                    $("#new_data").html('');
                    $('#new_data').empty().append(response);
                    $("#new_data").show();
                }
            });
        }

        function Update() {
            $.ajax({
                url: '/Model/Admin/UpdateAutoBank',
                type: 'POST',
                dataType: 'JSON',
                data: new FormData($('form#form-update')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    Toast(data.status, data.msg);
                }
            });
        }
    </script>

    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>