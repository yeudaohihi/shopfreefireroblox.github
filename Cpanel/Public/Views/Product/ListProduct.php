<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/sidebar.php');
?>
<style>
    .switch {
        font-size: 40px;
    }

    .title {
        font-weight: bold;
    }

    .center-x {
        display: flex;
        align-items: center;
    }

    .thumb {
        width: 120px;
        height: 60px;
        overflow: hidden;
    }

    .img_doanhmuc {
        display: block;
        max-width: 230px;
        max-height: 95px;
        width: auto;
        height: auto;
    }

    .header-title {
        text-align: center;
        font-size: 14px;
    }

    .description {
        text-align: center;
        /*margin-bottom: 35px;*/
    }

    .header-title::after {
        left: 44%;
    }
</style>
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
                    <h3>Cài đặt danh mục</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cài đặt danh mục</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic choices start -->
        <section class="basic-choices">
            <div class="row">
                <?php
                foreach ($db->fetch_assoc("SELECT * FROM `product` WHERE `id` != '0' ", 0) as $info) {
                ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <img class="lazyLoad" data-src="<?= $info['image'] ?>" style="width:60%;">
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="container d-flex justify-content-center mt-50 mb-50">
                        <div class="row">
                            <?php
                            foreach ($db->fetch_assoc("SELECT * FROM `product_game` WHERE `id` != '0' AND `product` = '{$info['key_product']}'", 0) as $query) {
                                $detail = json_decode($query['detail'], true);
                            ?>
                                <div class="col-md-12">
                                    <div class="card card-body">
                                        <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row" style="display: flex;justify-content: center;align-items: center;">
                                            <div class="mr-2 mb-2 mb-lg-0"> <img class="lazyLoad" data-src="<?= $detail['thumb'] ?>" width="250" height="150" alt=""> </div>
                                            <div class="media-body">
                                                <h6 class="media-title font-weight-semibold"> <a href="#"><?= $detail['name_product'] ?></a> </h6>
                                                <p class="mb-3">
                                                    <?php
                                                    for ($i = 0; $i < count($detail['data']); $i++) {
                                                        if ($query['type'] == 'ACCOUNT' || $query['type'] == 'RANDOM') {
                                                            echo $detail['data'][$i]['label'];
                                                            echo ', ';
                                                        } else {
                                                            $kc = $detail['data'][$i]['tyle_value'];
                                                            echo str_replace('...', $kc, $detail['data'][$i]['tyle_text']);
                                                            echo ', ';
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                                <h3 class="mb-0 font-weight-semibold"><?= number_format($detail['cash']) ?><sup>đ</sup></h3>
                                                <?php if ($query['type'] == 'ACCOUNT' || $query['type'] == 'RANDOM') { ?>
                                                    <a href="/Cpanel/Product/EditAccountGame/<?= $query['id'] ?>" class="btn btn-warning mt-2 text-white"><i class="fas fa-pen"></i></a>
                                                <?php } elseif ($query['type'] == 'DIAMONDBOX') { ?>
                                                    <a href="/Cpanel/Product/EditDiamondBox/<?= $query['id'] ?>" class="btn btn-warning mt-2 text-white"><i class="fas fa-pen"></i></a>
                                                <?php } else { ?>
                                                    <a href="/Cpanel/Product/EditMinigame/<?= $query['id'] ?>" class="btn btn-warning mt-2 text-white"><i class="fas fa-pen"></i></a>
                                                <?php } ?>
                                                <button type="button" class="btn btn-danger mt-2 text-white" onclick="delete_id(<?= $query['id'] ?>)"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- Basic choices end -->
    </div>
    <script>
        function delete_id(id) {
            let text = "Bạn có chắc muốn thực hiện thao tác này không?";
            if (confirm(text) == true) {
                $.ajax({
                    url: '/Model/Product/Delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id
                    },
                    success: function(data) {
                        Toast(data.status, data.msg);
                    }
                });
            }
        }
    </script>
    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>