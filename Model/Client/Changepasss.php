<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$username = $data_user['username'];
$password_old = md5(Anti_xss($_POST['password_old']));
$password_new = md5(Anti_xss($_POST['password_new']));
$re_password = md5(Anti_xss($_POST['re_password']));

    $sql_info = "SELECT * FROM `users` WHERE `username` = '{$username}' AND `site` = '{$site}' LIMIT 1";
    $info_user = $db->fetch_assoc($sql_info, 1);

    if($dataWeb['status_web'] == 'off'){
        echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
    }elseif(!@$user){
        echo JsonMsg('error','Vui lòng đăng nhập để sử dụng tính năng');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
    }elseif(empty($password_old)){
        echo JsonMsg('error','Vui lòng nhập mật khẩu hiện tại');
    }elseif(empty($password_new)){
        echo JsonMsg('error','Vui lòng nhập mật khẩu mới');
    }elseif(empty($password_new)){
        echo JsonMsg('error','Vui lòng xác nhận mật khẩu mới');
    }elseif($password_old != $info_user['password']){
        echo JsonMsg('error','Mật khẩu cũ không chính xác');
    }elseif($password_new != $re_password){
        echo JsonMsg('error','Mật khẩu xác nhận không chính xác');
    }elseif($password_old == $password_new){
        echo JsonMsg('error','Mật khẩu mới không được trùng mật khẩu cũ');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error','Tài khoản của bạn đã bị dừng hoạt động');
    }else{
        insert_log($username, 'CHANGEPASS', 'Thay đổi mật khẩu lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        $db->query("UPDATE `users` SET `password` = '{$password_new}',`updated_at` = '{$date}' WHERE `username` = '{$username}' AND `site` = '{$site}'");
        echo JsonMsg('success','Thay đổi mật khẩu thành công!');
    }