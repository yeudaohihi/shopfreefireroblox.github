<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$id = Anti_xss($_POST['id']);
if (!@$user) {
    echo JsonMsg('error', 'Bạn chưa đăng nhập');
} elseif ($data_user['type'] == '1') {
    echo JsonMsg('error', 'Bạn không có quyền truy cập vào trang này');
} elseif ($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}'") < 1) {
    echo JsonMsg('error', 'Không tìm thấy tài khoản bạn cần xóa');
} else {
    if ($data_user['type'] == '4') {
        if ($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'") > 0) {
            $db->query("DELETE FROM `list_account` WHERE `id` = '{$id}' AND `username_post` = '{$data_user['username']}'");
            insert_log($data_user['username'], 'DELETEACOUNT', 'Xóa tài khoản #' . $id . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success', 'Xóa thành công tài khoản #' . $id . '');
        } else {
            echo JsonMsg('error', 'Không tìm thấy tài khoản để xóa');
        }
    } elseif ($data_user['type'] == '3') {
        echo JsonMsg('error', 'Bạn không có quyền thao tác chức năng này');
    } elseif ($data_user['type'] == '2') {
        $db->query("DELETE FROM `list_account` WHERE `id` = '{$id}'");
        insert_log($data_user['username'], 'DELETEACOUNT', 'Xóa tài khoản #' . $id . '', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success', 'Xóa thành công tài khoản #' . $id . '');
    }
}
