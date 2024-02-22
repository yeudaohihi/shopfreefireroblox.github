<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');

$email = Anti_xss($_POST['email']);
$otp = Anti_xss($_POST['otp']);
$password = Anti_xss($_POST['password']);
$repassword = Anti_xss($_POST['repassword']);
$check = $db->fetch_assoc("SELECT * FROM `users` WHERE `email` = '{$email}'", 1);
if (empty($email)) {
    echo JsonMsg('error', 'Vui lòng nhập địa chỉ Email');
} elseif (check_email($email) != true) {
    echo JsonMsg('error', 'Địa chỉ Email không hợp lệ');
    die();
} elseif ($db->num_rows("SELECT * FROM `users` WHERE `email` = '{$email}'") < 1) {
    echo JsonMsg('error', 'Địa chỉ Email không tồn tại trong hệ thống');
    die();
} else {
    if (empty($password)) {
        echo JsonMsg('error', 'Vui lòng nhập mật khẩu mới');
    } elseif (strlen($password) <= 6) {
        echo JsonMsg('error', 'Mật khẩu có nhiều hơn 6 ký tự trở lên');
    } elseif (empty($repassword)) {
        echo JsonMsg('error', 'Vui lòng nhập lại mật khẩu mới');
    } elseif ($password != $repassword) {
        echo JsonMsg('error', 'Hai mật khẩu khớp nhau');
    } elseif (empty($otp)) {
        echo JsonMsg('error', 'Vui lòng nhập OTP');
    } elseif ($db->num_rows("SELECT * FROM `confirm_otp` WHERE `otp` = '{$otp}' AND  `username` = '{$check['username']}'") < 1) {
        echo JsonMsg('error', 'OTP không chính xác!');
    } else {
        $password = md5($password);
        $db->query("UPDATE `users` SET `password` = '{$password}', `updated_at` = '{$date}' WHERE `id` = '{$check['id']}'");
        $db->query("DELETE FROM `confirm_otp` WHERE `username` = '{$check['username']}'");
        echo JsonMsg('success', 'Đổi mật khẩu thành công');
    }
}
