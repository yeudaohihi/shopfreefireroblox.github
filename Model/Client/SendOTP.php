<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');

$email = Anti_xss($_POST['email']);
$type = Anti_xss($_POST['type']);
$check = $db->fetch_assoc("SELECT * FROM `users` WHERE `email` = '{$email}'", 1);
if (check_email($email) != true) {
    echo JsonMsg('error', 'Địa chỉ Email không hợp lệ');die();
}
if ($db->num_rows("SELECT * FROM `users` WHERE `email` = '{$email}'") < 1) {
    echo JsonMsg('error', 'Địa chỉ Email không tồn tại trong hệ thống');die();
} else {
    $query = $db->fetch_assoc("SELECT * FROM `users` WHERE `email` = '{$email}'", 1);
    $detail = json_decode($query['detail'], true);
    if ($type == 'Client') {
        if ($date - $check['updated_at'] < 60) {
            echo JsonMsg('error', 'Bạn cần chờ 60s để nhận mã tiếp theo');die();
        } else {
            $otp = randomPassword();
            $username = $query['username'];
            // $db->query("UPDATE `users` SET `detail` = JSON_SET(`detail`,'$.otp' ,'{$otp}'), `updated_at` = '{$date}' WHERE `username` = '{$username}'");

            // $db->query("DELETE FROM `confirm_otp` WHERE `username` = '{$username}'");
            $db->query("INSERT INTO `confirm_otp`(`username`, `otp`, `created_at`, `updated_at`) VALUES ('{$username}', '{$otp}', '{$date}', '{$date}') ");
            //$db->query("UPDATE `confirm_otp` SET `otp` = '{$otp}',`updated_at` = '{$date}' WHERE `username` = '{$query['username']}'");
            $guitoi = $email;
            $subject = 'XÁC THỰC KHÔI PHỤC MẬT KHẨU';
            $bcc = "API SYSTEM";
            $hoten = 'Client';
            $token = $otp;
            $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi xác minh khôi phục mật khẩu bằng Email này, nếu là bạn thì mã xác thực bên dưới dùng để thực hiện thiết lập lại mật khẩu mới</h3>
                    <table>
                    <tbody>
                    <tr>
                    <td style="font-size:20px;">OTP:</td>
                    <td><b style="color:blue;font-size:30px;">' . $token . '</b></td>
                    </tr>
                    </tbody>
                    </table>';
            $isMail = send_email($guitoi, $hoten, $subject, $noi_dung, $bcc);
            if ($isMail) {
                echo JsonMsg('success', 'OTP xác nhận khôi phục đã được gửi đến Email của bạn!');die();
            } else {
                echo JsonMsg('error', 'Email này chưa đăng ký!');die();
            }
        }
    } elseif ($type == 'confirm') {
        $otp = Anti_xss($_POST['otp']);
        if (empty($otp)) {
            echo JsonMsg('error', 'Vui lòng nhập OTP');
        } elseif ($db->num_rows("SELECT * FROM `confirm_otp` WHERE `otp` = '{$otp}' AND  `username` = '{$username}'") < 1) {
            echo JsonMsg('error', 'OTP không chính xác!');
        } else {
            // $db->query("UPDATE `users` SET `detail` = JSON_SET(`detail`,'$.otp' ,''),`password` = '{$password}', `updated_at` = '{$date}' WHERE `id` = '{$query['id']}'");
            // echo JsonMsg('error','Đổi mật khẩu thành công');

            $users['name'] = $detail['name'];
            $users['ip'] = $detail['ip'];
            $users['otp'] = $data_otp['otp'];
            $users['status'] = $detail['status'];
            $users['browser'] = $detail['browser'];
            $users['device'] = $detail['device'];
            $users['user_agent'] = $detail['user_agent'];
            $deltai_users = addslashes(json_encode($users));
            $db->query("UPDATE `users` SET `detail` = '{$deltai_users}',`updated_at` = '{$date}' WHERE `username` = '{$username}'");

            echo JsonMsg('success', 'Xác thực ADMIN thành công');
        }
    }
}
