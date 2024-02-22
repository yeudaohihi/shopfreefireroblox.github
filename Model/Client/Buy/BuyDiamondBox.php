<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$type = Anti_xss($_POST['type']);
$qty = Anti_xss($_POST['qty']);
$query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type}'", 1);
$detail = json_decode($query['detail'], true);
$gia = $detail['cash'] * $qty;
if ($dataWeb['status_web'] == 'off') {
    echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
} elseif (!@$user) {
    echo JsonMsg('error', 'Bạn chưa đăng nhập');
} elseif ($arr_user['status'] == 'off') {
    echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
} elseif (empty($type)) {
    echo JsonMsg('error', 'Vui lòng chọn hòm kim cương muốn mua');
} elseif ($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}'") < 1) {
    echo JsonMsg('error', 'Không tìm thấy dữ liệu game bạn muốn giao dịch');
} elseif ($qty < 1) {
    echo JsonMsg('error', 'Vui lòng nhập số lượng muốn mua');
} elseif ($arr_user['status'] == 'off') {
    echo JsonMsg('error', 'Bạn đã bị chặn vui lòng liên hệ admin');
} elseif ($data_user['cash'] < $gia) {
    echo JsonMsg('error', 'Bạn không đủ tiền để thực hiện giao dịch này');
} else {
    for ($i = 0; $i < $qty; $i++) {
        $rand = rand(0, count($detail['data']) - 1);
        $kc = 0;
        $price = 0;
        if ($detail['data'][$rand]['tyle_type'] == 'KCRD') {
            $data_array = explode(',', $detail['data'][$rand]['tyle_value']);
            $kc = rand($data_array[0], $data_array[1]);
            $msg = str_replace('...', $kc, $detail['data'][$rand]['tyle_text']);
        } elseif ($detail['data'][$rand]['tyle_type'] == 'PRICERD') {
            $data_array = explode(',', $detail['data'][$rand]['tyle_value']);
            $price = rand($data_array[0], $data_array[1]);
            $msg = str_replace('...', $price, $detail['data'][$rand]['tyle_text']);
        } elseif ($detail['data'][$rand]['tyle_type'] == 'KC') {
            $kc = $detail['data'][$rand]['tyle_value'];
            $msg = str_replace('...', $kc, $detail['data'][$rand]['tyle_text']);
        } elseif ($detail['data'][$rand]['tyle_type'] == 'PRICE') {
            $price = $detail['data'][$rand]['tyle_value'];
            $msg = str_replace('...', $price, $detail['data'][$rand]['tyle_text']);
        } else {
            $msg = $detail['data'][$rand]['tyle_text'];
        }
        $arr_msg[] = $msg;
        $log['name_product'] = $detail['name_product'];
        $log['msg'] = $msg;
        $log['cash'] = $detail['cash'];
        $log['price_old'] = $data_user['cash'];
        $log['price_change'] = $detail['cash'] + $price;
        $log['price_new'] = $data_user['cash'] - $detail['cash'] + $price;
        $log['diamond_old'] = $data_user['diamond'];
        $log['diamond_change'] = $kc;
        $log['diamond_new'] = $data_user['diamond'] + $kc;
        $full_log = addslashes(json_encode($log));
        $db->query("INSERT INTO `history_minigame`(`username`, `type_category`, `detail`, `site`, `created_at`, `updated_at`) VALUES ('{$data_user['username']}', '{$type}', '{$full_log}', '{$site}', '{$date}', '{$date}')");
        $count_kc += $kc;
        $count_price += $price;
        $json['data'] = $arr_msg;
    }
    insert_log($data_user['username'], 'PLAYMINIGAME', 'Chơi trò chơi ' . $detail['name_product'] . ' x ' . $qty . '', $old_cash = $data_user['cash'], $change_cash = $count_price + $gia, $new_cash = $data_user['cash'] - $gia + $count_price, $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = $count_kc, $new_cash_diamond = $data_user['diamond'] + $count_kc);
    $db->query("UPDATE `users` SET `cash` = `cash` + '{$count_price}',`diamond` = `diamond` + '{$count_kc}',`updated_at` = '{$date}',`cash` = `cash` - '{$gia}' WHERE `username` = '{$data_user['username']}'");
    $json['count_kc'] = $count_kc;
    $json['count_price'] = $count_price;
    $json['status'] = 'success';
    $json['msg'] = 'Giao dịch thành công';
    $rand = rand(0, count($detail['data']) - 1);
    echo json_encode($json);
}
