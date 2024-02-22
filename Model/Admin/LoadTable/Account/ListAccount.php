<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php';

$type = Anti_xss($_POST['type']);
$arr_data = array();
$current_page = isset($_POST['page']) ? (int) Anti_xss($_POST['page']) : 1;
$price = isset($_POST['price']) ? Anti_xss($_POST['price']) : "";
$id = isset($_POST['id']) ? (int) Anti_xss($_POST['id']) : '';
// lấy giá trị name ở bộ lọc
$sql_query = "SELECT * FROM `list_account` WHERE `type_category` = '{$type}' AND `status` = 'on'";
$query = $db->fetch_assoc($sql_query, 1);
$detail_query = json_decode($query['detail'], true); // lấy detail
$arr_query = $detail_query['data']; // lấy data trong detail
for ($a = 0; $a < count($arr_query); $a++) { // vòng lặp data detail
    if ($arr_query[$a]['show'] == 'on') { // check hiện thị của data
        $$arr_query[$a]['name'] = Anti_xss($_POST[$arr_query[$a]['name']]); // lấy giá trị từ bên ngoại
        $arr_name = $arr_query[$a]['name']; // biến này đéo chạy nên phải ghi như thế
        $sql_detail = "";
        if ($$arr_query[$a]['name'] != null) {
            $sql[] = "AND JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(`detail`, '$.data[$a]'), '$.$arr_name')) = '{$$arr_query[$a]['name']}'"; // câu lệnh lọc giá trị array đa mảng
        }
    }
}
$implode = implode("", $sql); // nối câu lệnh
// đóng lấy bộ lọc
if ($current_page < 1) {
    $current_page = 1;
}

$sql_id = "";
if ($id) {
    $sql_id = " AND `id` = '{$id}'";
}
//sql search price
$sql_price = "";
if ($price == 'duoi-50k') {
    $sql_price = "AND `cash` < 50000 ";
} elseif ($price == 'tu-50k-200k') {
    $sql_price = "AND `cash` BETWEEN 50000 AND 200000 ";
} elseif ($price == 'tu-200k-500k') {
    $sql_price = "AND `cash` BETWEEN 200000 AND 500000 ";
} elseif ($price == 'tu-500k-1-trieu') {
    $sql_price = "AND `cash` BETWEEN 500000 AND 1000000 ";
} elseif ($price == 'tren-1-trieu') {
    $sql_price = "AND `cash` >= 1000000 ";
} elseif ($price == 'tren-5-trieu') {
    $sql_price = "AND `cash` >= 5000000 ";
} elseif ($price == 'tren-10-trieu') {
    $sql_price = "AND `cash` >= 10000000 ";
} else {
    $sql_price = '';
}
$sql_acc = "SELECT * FROM `list_account` WHERE `type_category` = '{$type}' AND `status` = 'on' $sql_detail $sql_id $sql_price $implode";
$total_records = $db->num_rows($sql_acc);
$limit = 16; // giới hạn số lượng trên 1 trang
if ($limit < 0) {
    $limit = 0;
}
$total_page = ceil($total_records / $limit);
if (!$total_page) {
    $total_page = 1;
}
if ($current_page < 1) {
    $current_page = 1;
}
if ($current_page > $total_page) {
    $current_page = $total_page;
}
$start = ($current_page - 1) * $limit;
$range = 3; // độ dài của nút trang
$middle = ceil($range / 2);
if ($total_page < $range) {
    $min = 1;
    $max = $total_page;
} else {
    $min = $current_page - $middle + 1;
    $max = $current_page + $middle - 1;
    if ($min < 1) {
        $min = 1;
        $max = $range;
    } else if ($max > $total_page) {
        $max = $total_page;
        $min = $total_page - $range + 1;
    }
}
$sql_show = "SELECT * FROM `list_account` WHERE `type_category` = '{$type}' AND `status` = 'on' $sql_detail $sql_id $sql_price $implode  ORDER BY `id` ASC LIMIT $start, $limit";
if ($total_records > 0) {
    foreach ($db->fetch_assoc($sql_show, 0) as $info) {
        $check = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$info['type_category']}'", 1); // lấy dữ liệu từ product
        $detail_product = json_decode($check['detail'], true); // get detail product
        $arr_img = json_decode($info['image'], true); // ảnh ở list_account
        $detail = json_decode($info['detail'], true); // detail list_account
?>
        <div class="tw-col-span-12 md:tw-col-span-3 tw-bg-white tw-relative tw-border tw-border-transparent hover:tw-border-red-500 tw-transition tw-duration-200 tw-rounded">
            <a href="/views/account/<?= $info['id'] ?>" class="">
                <div class="tw-relative tw-mb-20">
                    <span class="tw-new-id tw-absolute tw-inline-flex tw-items-center tw-px-2 tw-h-6 tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded tw-text-sm" style="top: 8px; left: 8px;">
                        MS <?= $info['id'] ?>
                    </span>
                    <?php if ($check['type'] == 'ACCOUNT') { ?>
                        <img class="tw-h-56 md:tw-h-40 tw-w-full tw-object-fill tw-object-center tw-rounded-t-sm lazyLoad isLoaded" src="<?= $arr_img[0]; ?>">
                    <?php } else { ?>
                        <img class="tw-h-56 md:tw-h-40 tw-w-full tw-object-fill tw-object-center tw-rounded-t-sm lazyLoad isLoaded" src="<?= $detail_product['thumb'] ?>">
                    <?php } ?>
                    <div class="tw-my-2 tw-py-1 tw-px-2 tw-relative">
                        <div class="tw-grid tw-grid-cols-12 tw-gap-y-1 tw-leading-6 tw-text-gray-700 tw-text-xs" style="font-size: 15px; font-weight: 500;">

                            <?php
                            for ($i = 0; $i < count($detail['data']); $i++) {
                                if ($detail['data'][$i]['show'] == 'on') {
                            ?>
                                    <div class="tw-col-span-12 tw-text-base md:tw-text-sm">
                                        <p>
                                            <i class="tw-relative bx bx-caret-right" style="top: 1px;"></i> <?= $detail['data'][$i]['label'] ?>:
                                            <b class="tw-text-gray-800"> <?= $detail['data'][$i]['value'] ?> </b>
                                        </p>
                                    </div>

                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>


                <div class="tw-absolute tw-right-0 tw-bottom-0 tw-left-0">
                    <div class="tw-border-t tw-rounded-b-sm tw-border-gray-100 tw-px-2 tw-py-1">
                        <ul class="tw-rounded-sm tw-w-full tw-font-medium">
                            <span class="tw-w-full tw-text-center tw-inline-block tw-px-2">
                                <?php if ($check['type'] == 'ACCOUNT') : ?>
                                    <span class="tw-text-gray-600 tw-inline-block tw-text-xs tw-line-through"> <?= number_format($info['cash'] * 2) ?><small>đ</small></span>
                                    <span class="tw-text-red-500 tw-text-lg tw-font-extrabold"> <?= number_format($info['cash']) ?><small>đ</small></span></span>
                        <?php else : ?>
                            <span class="tw-text-red-500 tw-text-lg tw-font-extrabold"> <?= number_format($info['cash']) ?><small>đ</small></span></span>
                        <?php endif; ?>
                        </ul>
                    </div>

                    <?php if ($check['type'] == 'ACCOUNT') : ?>

                        <div class="tw-w-full tw-text-center tw-cursor-pointer tw-border tw-rounded-b-sm tw-border-red-500 hover:tw-border-red-600 tw-bg-red-500 tw-transition tw-duration-200 hover:tw-bg-red-600 tw-text-white tw-uppercase tw-font-semibold tw-py-1 tw-px-3">
                            Xem chi tiết
                        </div>

                    <?php else : ?>

                        <div class="tw-w-full tw-text-center tw-cursor-pointer tw-border tw-rounded-b-sm tw-border-red-500 hover:tw-border-red-600 tw-bg-red-500 tw-transition tw-duration-200 hover:tw-bg-red-600 tw-text-white tw-uppercase tw-font-semibold tw-py-1 tw-px-3">
                            <i class="tw-text-2xl bx bxs-cart-add"></i>
                        </div>

                    <?php endif; ?>

                </div>
            </a>
        </div>


    <?php }
} else { ?>
    <div class="tw-col-span-12 tw-flex tw-justify-center tw-h-48 tw-items-center tw-font-semibold tw-text-gray-700">
        Không tìm thấy tài khoản hoặc đã được bán hết. Vui lòng liên hệ
        Fanpage ở dưới để được bổ sung, Xin cám ơn!
    </div>
<?php } ?>

</div>
<!-- qua trang -->
<div class="tw-col-span-12 tw-flex tw-justify-center tw-h-48 tw-items-center tw-font-semibold tw-text-gray-700">
    <div class="tw-pb-8 tw-mb-8">
        <div class="tw-min-w-max">
            <?php if ($total_records > 0) { ?>
                <section class="tw-flex tw-justify-between tw-py-1 tw-text-gray-700 tw-font-montserrat tw-select-none">
                    <ul class="tw-flex tw-items-center">
                        <?php if ($current_page - 3 > 1) { ?>
                            <li class="tw-pr-2">
                                <a href="javascript:void(0)" onclick="page=1;load_account()" class="tw-cursor-pointer">
                                    <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white">
                                        <span class="transform">1</span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php for ($i = $min; $i <= $max; $i++) {
                            if ($current_page == $i) {
                        ?>
                                <li class="tw-pr-2">
                                    <a href="javascript:void(0)" onclick="page=1;load_account()" class="tw-cursor-pointer">
                                        <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white">
                                            <span class="transform"><?= $i ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="tw-pr-2">
                                    <a href="javascript:void(0)" onclick="page=<?= $i ?>;load_account()" class="tw-cursor-pointer">
                                        <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center ">
                                            <span class="transform"><?= $i ?></span>
                                        </div>
                                    </a>
                                </li>
                        <?php }
                        } ?>
                        <li class="tw-pr-2">
                            <a href="<?= $current_page == 1 ? '#' : $link . ($current_page + 1) ?>" class="tw-cursor-pointer">
                                <div class="tw-flex tw-items-center tw-justify-center hover:tw-bg-gray-200 tw-rounded-md tw-transform tw-text-sm tw-h-6 tw-px-2">
                                    <div class="tw-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tw-h-4 tw-w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </section>
        </div>
    </div>
</div>
</div>
<!-- kết thúc else qua trang -->