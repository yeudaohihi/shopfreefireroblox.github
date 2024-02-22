<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$id = Anti_xss($_POST['id']);
$cash = Anti_xss($_POST['cash']);
$sale = Anti_xss($_POST['sale']);
$type = Anti_xss($_POST['type']);
$type_category = Anti_xss($_POST['type_category']);
$status = Anti_xss($_POST['status']);
$link_anh = array();
$arr_data = array();
if (!@$user) {
    echo JsonMsg('error', 'Bạn chưa đăng nhập');
} elseif ($data_user['type'] == '1') {
    echo JsonMsg('error', 'Bạn không có quyền truy cập trang này');
} elseif (empty($cash)) {
    echo JsonMsg('error', 'Vui lòng nhập giá tiền');
} elseif ($cash < 0) {
    echo JsonMsg('error', 'Giá tiền không được bé hơn 0đ');
} elseif ($sale < 0) {
    echo JsonMsg('error', 'Khuyến mại không được bé hơn 0%');
} elseif ($sale > 100) {
    echo JsonMsg('error', 'Khuyến mại không được lớn hơn 100%');
} elseif (empty($status)) {
    echo JsonMsg('error', 'Vui lòng chọn trạng thái tài khoản');
} else {
    if ($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `type` = '{$type}' AND `type_category` = '{$type_category}'") > 0) {
        $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}' AND `type` IN ('ACCOUNT','RANDOM')", 1);
        $detail = json_decode($query_product['detail'], true);
        $query = $db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` = '{$id}'", 1);
        if ($data_user['type'] == '3') { // admin phụ
            echo JsonMsg('error', 'Bạn không có quyền chỉnh sửa tài khoản này');
        } elseif ($data_user['type'] == '4') { // ctv
            if ($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'") > 0) {
                if (count($_FILES["image"]["name"]) > 1) {
                    for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) { // upload nếu có ảnh mới
                        array_push($link_anh, upload_multiple_file('image', 'product', $i)); //new
                    }
                    $full_img = json_encode($link_anh);
                } else {
                    $full_img = $query['image'];
                }
                for ($i = 0; $i < count($detail['data']); $i++) {
                    $$detail['data'][$i]['name'] = Anti_xss($_POST[$detail['data'][$i]['name']]);
                    array_push($arr_data, array("id" => $i, "label" => $detail['data'][$i]['label'], "type" => $detail['data'][$i]['type'], "name" => $detail['data'][$i]['name'], "value" => $$detail['data'][$i]['name'], "show" => $detail['data'][$i]['show'], $detail['data'][$i]['name'] => $$detail['data'][$i]['name']));
                }
                $json_image = json_encode($link_anh);
                $json['author'] = 'XboxTech.Vn';
                $json['data'] = $arr_data;
                $full_detail = addslashes(json_encode($json));
                $db->query("UPDATE `list_account` SET `type` = '{$type}',`detail` = '{$full_detail}',`image` = '{$full_img}',`cash` = '{$cash}',`sale` = '{$sale}',`status` = '{$status}',`updated_at` = '{$date}' WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'");
                insert_log($data_user['username'], 'EDITACOUNT', 'Chỉnh sửa tài khoản #' . $id . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
                echo JsonMsg('success', 'Chỉnh sửa thành công tài khoản #' . $id . '');
            } else {
                echo JsonMsg('error', 'Bạn không thể chỉnh sửa tài khoản này');
            }
        } elseif ($data_user['type'] == '2') { // quản trị viên
            if (count($_FILES["image"]["name"]) > 1) {
                for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) { // upload nếu có ảnh mới
                    array_push($link_anh, upload_multiple_file('image', 'product', $i)); //new
                }
                $full_img = json_encode($link_anh);
            } else {
                $full_img = $query['image'];
            }
            for ($i = 0; $i < count($detail['data']); $i++) {
                $$detail['data'][$i]['name'] = Anti_xss($_POST[$detail['data'][$i]['name']]);
                array_push($arr_data, array("id" => $i, "label" => $detail['data'][$i]['label'], "type" => $detail['data'][$i]['type'], "name" => $detail['data'][$i]['name'], "value" => $$detail['data'][$i]['name'], "show" => $detail['data'][$i]['show'], $detail['data'][$i]['name'] => $$detail['data'][$i]['name']));
            }
            $json_image = json_encode($link_anh);
            $json['author'] = 'XboxTech.Vn';
            $json['data'] = $arr_data;
            $full_detail = addslashes(json_encode($json));
            $db->query("UPDATE `list_account` SET `type` = '{$type}',`detail` = '{$full_detail}',`image` = '{$full_img}',`cash` = '{$cash}',`sale` = '{$sale}',`status` = '{$status}',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
            insert_log($data_user['username'], 'EDITACOUNT', 'Chỉnh sửa tài khoản #' . $id . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success', 'Chỉnh sửa thành công tài khoản #' . $id . '');
        }
    } else {
        echo JsonMsg('error', 'Không tìm thấy dữ liệu tài khoản');
    }
}
