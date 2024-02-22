<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$username = Anti_xss($_POST['username']);
$cash = Anti_xss($_POST['cash']);
$diamond = Anti_xss($_POST['diamond']);
$type = Anti_xss($_POST['type']);
$status = Anti_xss($_POST['status']);
// $turn_wheel = Anti_xss($_POST['turn_wheel']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$username}'") < 1){
        echo JsonMsg('error','Không tìm thấy dữ liệu thành viên cần sửa');
    }elseif($cash < 0){
        echo JsonMsg('error','Số tiền không được bé hơn 0đ');
    }elseif($diamond < 0){
        echo JsonMsg('error','Số kim cương không được bé hơn 0');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `users` WHERE `username` = '{$username}'", 1);
        $detail = json_decode($query['detail'], true);
        insert_log($data_user['username'], 'EDITUSER', 'Chỉnh sửa thành viên '.$username.'', $old_cash = $query['cash'], $change_cash = $cash, $new_cash = $cash, $old_cash_diamond = $query['diamond'], $change_cash_diamond = $diamond, $new_cash_diamond = $diamond);
        $users['name'] = $detail['name'];
        $users['ip'] = $detail['ip'];
        $users['status'] = $status;
        $users['browser'] = $detail['browser'];
        $users['device'] = $detail['device'];
        $users['user_agent'] = $detail['user_agent'];
        $deltai_users = addslashes(json_encode($users));
        $db->query("UPDATE `users` SET `type` = '{$type}',`cash` = '{$cash}',`diamond` = '{$diamond}',`detail` = '{$deltai_users}',`updated_at` = '{$date}' WHERE `username` = '{$username}'");
        echo JsonMsg('success','Cập nhật thành công');
    }