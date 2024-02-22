<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$type_category = Anti_xss($_POST['type_category']);
$type = Anti_xss($_POST['type']);
if (!@$user) {
    echo JsonMsg('error', 'Bạn chưa đăng nhập');
} elseif ($data_user['type'] != '2') {
    echo JsonMsg('error', 'Bạn không có quyền thực hiện thao tác này');
} else {
    if ($type == 'upload') {
        if ($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}'") < 1) {
            echo JsonMsg('error', 'Không tìm thấy game bạn đã chọn');
        } else {
            $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}'", 1);
            $info = explode("\n", $_POST['info']);
            for ($i = 0; $i < count($info); $i++) {
                $data = explode("|", $info[$i]);
                $db->query("INSERT INTO `AccountReward`(`username_post`, `product`, `type_category`, `taikhoan`, `matkhau`, `code`, `status`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', '{$query['product']}', '{$query['type_category']}', '{$data['0']}', '{$data['1']}', '{$data['2']}', 'on', '{$date}', '{$date}')");
            }
            insert_log($data_user['username'], 'ADDACOUNT', 'Thêm ' . count($info) . ' tài khoản trả thưởng', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success', 'Đăng thành công ' . count($info) . '');
        }
    } elseif ($type == 'delete') {
        $id = Anti_xss($_POST['id']);
        if ($db->num_rows("SELECT * FROM `AccountReward` WHERE `id` = '{$id}'") < 1) {
            echo JsonMsg('error', 'Không tìm thấy tài khoản bạn cần xóa');
        } else {
            $db->query("DELETE FROM `AccountReward` WHERE `id` = '{$id}'");
            insert_log($data_user['username'], 'DELETEACOUNT', 'Xóa tài khoản #' . $id . ' tài khoản trả thưởng', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success', 'Xóa thành công tài khoản #' . $id . '');
        }
    }
}
