<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$username = Anti_xss($_POST['username']);
$max_diamond = Anti_xss($_POST['max_diamond']);
$status = Anti_xss($_POST['status']);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif($db->num_rows("SELECT * FROM `list_pr` WHERE `username` = '{$username}'") < 1){
        echo JsonMsg('error','Không tìm thấy dữ liệu tài khoản quảng cáo cần sửa');
    }elseif($max_diamond < 0){
        echo JsonMsg('error','Số kim cương giới hạn không được bé hơn 0');
    }elseif(empty($status)){
        echo JsonMsg('error','Vui lòng nhập trạng thái hoạt động');
    }else{
        insert_log($data_user['username'], 'EDITPR', 'Chỉnh sửa tài khoản quảng cáo lúc '.$date_current.' - IP ( '.myip().' )', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        $db->query("UPDATE `list_pr` SET `max_diamond` = '{$max_diamond}', `status` = '{$status}', `updated_at` = '{$date}' WHERE `username` = '{$username}'");
        echo JsonMsg('success','Cập nhật thành công');
    }