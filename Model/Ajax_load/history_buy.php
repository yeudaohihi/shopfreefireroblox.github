<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
?>

<table class="tw-w-full tw-rounded-t">
    <thead>
        <tr class="tw-text-md tw-font-semibold tw-tracking-wide tw-text-left tw-text-gray-900 tw-border tw-border-b-0 tw-bg-gray-200">
            <th class="tw-px-2 tw-py-2">Thông tin</th>
            <th class="tw-px-2 tw-py-2"><span class="tw-hidden md:tw-block">Chi tiết</span> <span class="tw-block md:tw-hidden">Chi tiết</span>
            </th>
            <th class="tw-px-2 tw-py-2 tw-hidden md:tw-block">
                Mệnh giá
            </th>
        </tr>
    </thead>
    <tbody class="bg-white tw-border tw-border-t-0 tw-rounded">

        <?php
        $current_page = isset($_POST['page']) ? (int)Anti_xss($_POST['page']) : 1;

        if ($current_page < 1) {
            $current_page = 1;
        }

        $sql_acc = "SELECT * FROM `history_buy` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ";
        $total_records = $db->num_rows($sql_acc);
        $limit = 10; // giới hạn số lượng trên 1 trang
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
        if ($_SERVER['QUERY_STRING']) {
            $re = '/([?])page/m';
            $str = $_SERVER['REQUEST_URI'];
            preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
            if ($matches[0][0] == '?page') {
                $link = $_SERVER['SCRIPT_URI'] . '?page=';
            } else {
                $url = $_SERVER['SCRIPT_URI'] . '?' . $_SERVER['QUERY_STRING'];
                $link = removeParams($url, 'page') . '&page=';
            }
        } else {
            $link = $_SERVER['SCRIPT_URI'] . '?page=';
        }

        function removeParams($url, $param)
        {
            $new_Url = preg_replace('/([?&])' . $param . '[^&]+(&|$)/', '', $url);
            $url = trim($new_Url, '&');
            $url = trim($new_Url, '?');
            return $url;
        }

        $sql_show = "SELECT * FROM `history_buy` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ORDER BY `id` DESC LIMIT $start, $limit";
        if ($total_records > 0) {
            foreach ($db->fetch_assoc($sql_show, 0) as $info) {
                $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$info['type_category']}'", 1);
                $detail_product = json_decode($query_product['detail'], true);
                $detail = json_decode($info['detail'], true);
                $arr_detail = $detail['data'];
        ?>

                <tr class="tw-text-gray-700 tw-border-b">
                    <td class="tw-px-2 tw-py-1 md:tw-py-2 tw-text-xs">
                        <div>
                            <p class="tw-font-bold text-black"> <?= $detail_product['name_product'] ?> </p>
                            <p class="text-xs text-gray-600 tw-font-semibold"> <?= date('Y-m-d H:i:s', $info['created_at']) ?> </p>
                            <p class="tw-mt-1 text-xs text-gray-600 tw-font-semibold"><span class="tw-text-red-600">ID: <?= $info['id'] ?></span></p>
                        </div>
                    </td>
                    <td class="tw-px-2 tw-py-2 tw-text-xs">
                        <div class="tw-text-xs md:tw-text-sm">
                            <p class="tw-font-bold text-black"><?= $arr_detail[0]['tentaikhoan'] ?>|<?= $arr_detail[1]['matkhau'] ?> </p>
                            <p class="tw-font-semibold text-xs">Code: <?= $arr_account[2]['thongtinbosung'] ?></p>
                        </div>
                        <div class="tw-block md:tw-hidden tw-border-t tw-mt-2 tw-pt-2 tw-font-semibold tw-leading-5">
                            <p class="tw-text-sm tw-text-red-600">Thanh toán: <b> - <?= number_format($info['cash']) ?>đ</b></p>
                            <p class="tw-text-sm tw-text-green-600"><b>Thành công</b></p>
                        </div>
                    </td>
                    <td class="tw-px-2 tw-py-1 tw-text-xs tw-hidden md:tw-block">
                        <div class="tw-mt-2 tw-font-semibold tw-leading-5">
                            <p class="tw-text-sm tw-text-red-600">Thanh toán:<b> - <?= number_format($info['cash']) ?>đ</b></p>
                            <p class="tw-text-sm tw-text-green-600"><b> Thành công</b></p>
                        </div>
                    </td>
                </tr>
        <?php }
        } ?>

    </tbody>
</table>

<div class="tw-pb-8">
    <div class="tw-min-w-max">
        <?php if ($total_records > 0) { ?>
            <section class="tw-flex tw-justify-between tw-py-1 tw-text-gray-700 tw-font-montserrat tw-select-none">
                <ul class="tw-flex tw-items-center">
                    <?php if ($current_page - 3 > 1) { ?>
                        <li class="tw-pr-2">
                            <a href="javascript:void(0)" onclick="page=1;load_his()" class="tw-cursor-pointer">
                                <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white">
                                    <span class="transform">1</span>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    for ($i = $min; $i <= $max; $i++) {
                        if ($current_page == $i) {
                    ?>
                            <li class="tw-pr-2">
                                <a href="#" class="tw-cursor-pointer">
                                    <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center tw-bg-red-500 tw-text-white">
                                        <span class="transform"><?= $i ?></span>
                                    </div>
                                </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="tw-pr-2">
                                <a href="javascript:void(0)" onclick="page=<?= $i ?>;load_his()" class="tw-cursor-pointer">
                                    <div class="tw-flex hover:tw-bg-red-600 hover:tw-text-white tw-transition tw-duration-200 tw-rounded-md tw-transform tw-h-6 tw-px-2 tw-text-sm tw-items-center tw-justify-center ">
                                        <span class="transform"><?= $i ?></span>
                                    </div>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    <li class="tw-pr-2">
                        <a href="javascript:void(0)" onclick="page=<?= ($current_page + 1) ?>;load_his()" class="tw-cursor-pointer">
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