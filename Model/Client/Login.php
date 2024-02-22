<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
$username = Anti_xss($_POST['username']);
$password = md5(Anti_xss($_POST['password']));
if (empty($username)) {
    echo JsonMsg('error', 'Vui lòng nhập tên đăng nhập');
} elseif (empty($password)) {
    echo JsonMsg('error', 'Vui lòng nhập mật khẩu');
} elseif ($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}' AND `site` = '{$site}'") < 1) {
    echo JsonMsg('error', 'Tài khoản hoặc mật khẩu không chính xác');
} elseif (detail_users($username)['status'] == 'off') {
    echo JsonMsg('error', 'Tài khoản của bạn đã bị dừng hoạt động');
} else {
    insert_log($username, 'LOGIN', 'Đăng nhập lúc ' . $date_current . ' - IP (' . myip() . ')', $old_cash = 0, $change_cash = 0, $new_cash = 0, $old_cash_diamond = 0, $change_cash_diamond = 0, $new_cash_diamond = 0);
    echo JsonMsg('success', 'Đăng nhập thành công!');
    $session->send($username);
}
