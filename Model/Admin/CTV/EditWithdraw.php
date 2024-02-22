<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$id = Anti_xss($_POST['id']);
$status = Anti_xss($_POST['status']);
$note = Anti_xss($_POST['note']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền thực hiện thao tác này');
    }elseif($db->num_rows("SELECT * FROM `withdraw_cash` WHERE `id` = '{$id}'") < 1){
        echo JsonMsg('error','Không tìm thấy đơn bạn cần duyệt trên hệ thống');
    }elseif($db->num_rows("SELECT * FROM `withdraw_cash` WHERE `id` = '{$id}' AND `status` = '1'") < 1){
        echo JsonMsg('error','Đơn rút tiền này đã được xử lý');
    }elseif(empty($status)){
        echo JsonMsg('error','Vui lòng chọn trạng thái muốn duyệt đơn');
    }elseif($status != '2' && $status != '3'){
        echo JsonMsg('error','Trạng thái bạn chọn không hợp lệ');
    }else{
        if($status == '2'){
            $db->query("UPDATE `withdraw_cash` SET `status` = '{$status}',`note` = '{$note}',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
            insert_log($data_user['username'], 'WITHDRAWCASH', 'Duyệt lệnh đơn rút tiền #'.$id.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success','Duyệt thành công đơn rút tiền #'.$id.'');
        }elseif($status == '3'){
            $query = $db->fetch_assoc("SELECT * FROM `withdraw_cash` WHERE `id` = '{$id}'", 1);
            $db->query("UPDATE `users` SET `cash` = `cash` + '{$query['amount']}',`updated_at` = '{$date}' WHERE `username` = '{$query['username']}'");
            $db->query("UPDATE `withdraw_cash` SET `status` = '{$status}',`note` = '{$note}',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
            insert_log($data_user['username'], 'WITHDRAWCASH', 'Hủy lệnh đơn rút tiền #'.$id.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
            echo JsonMsg('success','Hủy thành công đơn rút tiền #'.$id.'');
        }
    }