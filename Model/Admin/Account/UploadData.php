<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$cash = Anti_xss($_POST['cash']);
$sale = Anti_xss($_POST['sale']);
$type_category = Anti_xss($_POST['type_category']);
$data = Anti_xss($_POST['data']);
$link_anh = array();
$arr_data = array();
if (!@$user) {
    echo JsonMsg('error', 'Bạn chưa đăng nhập');
} elseif ($data_user['type'] == '1') {
    echo JsonMsg('error', 'Bạn không có quyền truy cập trang này');
} elseif ($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}' AND `type` IN ('ACCOUNT','RANDOM')") < 1) {
    echo JsonMsg('error', 'Không tìm thấy danh mục tài khoản');
} else {
    $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}' AND `type` IN ('ACCOUNT','RANDOM')", 1);
    $detail = json_decode($query['detail'], true);
    if ($query['type'] == 'ACCOUNT') { // đăng tài khoản
        if ($cash < 0) {
            echo JsonMsg('error', 'Giá tiền không được dưới 0đ');
        } elseif ($sale < 0) {
            echo JsonMsg('error', 'Khuyến mại không được dưới 0%');
        } elseif (count($_FILES["image"]["name"]) < 1) {
            echo JsonMsg('error', 'Bạn đang thiếu hình ảnh');
        } else {
            for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) {
                array_push($link_anh, upload_multiple_file('image', 'product', $i)); //new
            }
            for ($i = 0; $i < count($detail['data']); $i++) {
                $$detail['data'][$i]['name'] = Anti_xss($_POST[$detail['data'][$i]['name']]);
                array_push($arr_data, array("id" => $i, "label" => $detail['data'][$i]['label'], "type" => $detail['data'][$i]['type'], "name" => $detail['data'][$i]['name'], "value" => $$detail['data'][$i]['name'], "show" => $detail['data'][$i]['show'], $detail['data'][$i]['name'] => $$detail['data'][$i]['name']));
            }
            $json_image = json_encode($link_anh);
            $json['author'] = 'XboxTech.VN';
            $json['name_product'] = $detail['name_product'];
            $json['data'] = $arr_data;
            $full_detail = addslashes(json_encode($json));
            $db->query("INSERT INTO `list_account`(`type`, `type_category`, `username_post`, `detail`, `image`, `cash`, `sale`, `status`, `updated_at`, `created_at`) VALUES ('{$query['type']}', '{$type_category}', '{$data_user['username']}', '{$full_detail}', '{$json_image}', '{$cash}', '{$sale}', 'on', '{$date}', '{$date}')");
            insert_log($data_user['username'], 'ADDACOUNT', 'Thêm tài khoản ' . $query['name_product'] . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('sucess', 'Đăng tài khoản thành công');
        }
    } elseif ($query['type'] == 'RANDOM') { // đăng tài khoản vận may
        if (empty($data)) {
            echo JsonMsg('error', 'Vui lòng nhập dữ liệu cần đăng');
        } else {
            function upload_random($arr, $account, $name_product)
            {
                for ($i = 0; $i < count($arr); $i++) {
                    $arr_data[] = array("id" => $i, "label" => $arr[$i]['label'], "type" => $arr[$i]['type'], "name" => $arr[$i]['name'], "value" => $account[$i], "show" => $arr[$i]['show']);
                    $json['author'] = 'XboxTech.VN';
                    $json['name_product'] = $name_product;
                    $json['data'] = $arr_data;
                }
                return $json;
            }
            $arr = $detail['data'];
            $data = explode("\n", $data);
            $z = 0;
            foreach ($data as $key) {
                $account = explode("|", $data[$z]);
                $full_json = addslashes(json_encode(upload_random($arr, $account, $detail['name_product'])));
                $db->query("INSERT INTO `list_account`(`type`, `type_category`, `username_post`, `detail`, `image`, `cash`, `sale`, `status`, `updated_at`, `created_at`) VALUES ('{$query['type']}', '{$type_category}', '{$data_user['username']}', '{$full_json}', '', '{$detail['cash']}', '0', 'on', '{$date}', '{$date}')");
                $z++;
            }
            insert_log($data_user['username'], 'ADDACOUNT', 'Thêm ' . count($data) . ' tài khoản ' . $detail['name_product'] . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success', 'Đăng thành công ' . count($data) . '');
        }
    }
}
