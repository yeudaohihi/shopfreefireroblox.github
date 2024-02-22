<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/header.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/sidebar.php');
if ($data_user['type'] == '2') {
    $total_day = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%d-%m-%Y') = '" . date('d-m-Y') . "'", 0)[0]['total'];
    $total_month = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%m-%Y') = '" . date('m-Y') . "'", 0)[0]['total'];
    $total = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4')", 0)[0]['total'];
} elseif ($data_user['type'] == '3') {
    $total_day = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND `site` = '{$site}' AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%d-%m-%Y') = '" . date('d-m-Y') . "'", 0)[0]['total'];
    $total_month = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND `site` = '{$site}' AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%m-%Y') = '" . date('m-Y') . "'", 0)[0]['total'];
    $total = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND `site` = '{$site}'", 0)[0]['total'];
} elseif ($data_user['type'] == '4') {
    $total_day = $db->fetch_assoc("SELECT SUM(cash) as total FROM `history_buy` WHERE DATE_FORMAT(FROM_UNIXTIME(history_buy.created_at), '%d-%m-%Y') = '" . date('d-m-Y') . "'", 0)[0]['total'];
    $total_month = $db->fetch_assoc("SELECT SUM(cash) as total FROM `history_buy` WHERE DATE_FORMAT(FROM_UNIXTIME(history_buy.created_at), '%m-%Y') = '" . date('m-Y') . "'", 0)[0]['total'];
    $total = $db->fetch_assoc("SELECT SUM(cash) as total FROM `history_buy`", 0)[0]['total'];
}
?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Trang chủ</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <?php
                    if ($data_user['type'] == '2' || $data_user['type'] == '3') {
                        if ($data_user['type'] == '2') {
                            $count = $db->num_rows("SELECT * FROM `users`");
                        } elseif ($data_user['type'] == '3') {
                            $count = $db->num_rows("SELECT * FROM `users` WHERE `site` = '{$site}'");
                        }
                    ?>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Thành viên</h6>
                                            <h6 class="font-extrabold mb-0"><?= number_format($count) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-dollar-sign text-white fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Doanh thu ngày</h6>
                                        <h6 class="font-extrabold mb-0"><?= number_format($total_day) ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="fas fa-dollar-sign text-white fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Doanh thu tháng</h6>
                                        <h6 class="font-extrabold mb-0"><?= number_format($total_month) ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="fas fa-dollar-sign text-white fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Doanh thu tổng</h6>
                                        <h6 class="font-extrabold mb-0"><?= number_format($total) ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Thống kê ngày</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Comments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img class="lazyLoad" data-src="assets/images/faces/5.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img class="lazyLoad" data-src="assets/images/faces/2.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Wow amazing design! Can you make another tutorial for
                                                    this design?</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img class="lazyLoad" data-src="assets/images/faces/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= $arr_user['name'] ?></h5>
                                <h6 class="text-muted mb-0">@<?= $data_user['username'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Thành viên mới</h4>
                    </div>
                    <div class="card-content pb-4">
                        <?php
                        foreach ($db->fetch_assoc("SELECT * FROM `users` WHERE `id` != '0' ORDER BY `id` DESC LIMIT 4", 0) as $info) {
                            $detail = json_decode($info['detail'], true);
                        ?>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img class="lazyLoad" data-src="assets/images/faces/<?= rand(1, 8) ?>.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1"><?= $detail['name'] ?></h5>
                                    <h6 class="text-muted mb-0">@<?= $info['username'] ?></h6>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Cpanel/Public/footer.php');
    ?>