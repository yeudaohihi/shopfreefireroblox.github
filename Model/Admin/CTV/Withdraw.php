<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$bank = Anti_xss($_POST['bank']);
$stk = (int)Anti_xss($_POST['stk']);
$ctk = Anti_xss($_POST['ctk']);
$amount = (int)Anti_xss($_POST['amount']);
$note = Anti_xss($_POST['note']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2' && $data_user['type'] != '4'){
        echo JsonMsg('error','Bạn không có quyền thực hiện thao tác này');
    }elseif(empty($bank)){
        echo JsonMsg('error','Vui lòng chọn ngân hàng muốn rút tiền');
    }elseif(empty($stk)){
        echo JsonMsg('error','Vui lòng nhập số tài khoản muốn rút tiền');
    }elseif(empty($ctk)){
        echo JsonMsg('error','Vui lòng nhập chủ tên chủ tài khoản muốn rút tiền');
    }elseif(empty($amount)){
        echo JsonMsg('error','Vui lòng nhập số tiền muốn rút');
    }elseif($amount < 0){
        echo JsonMsg('error','Số tiền rút không được bé hơn 0đ');
    }elseif($data_user['cash'] < $amount){
        echo JsonMsg('error','Bạn không đủ tiền để thực hiện rút tiền');
    }else{
        $db->query("UPDATE `users` SET `cash` = `cash` - '{$amount}',`updated_at` = '{$date}' WHERE `username` = '{$data_user['username']}'");
        $db->query("INSERT INTO `withdraw_cash`(`username`, `bank`, `name`, `stk`, `amount`, `status`, `note`, `site`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', '{$bank}', '{$ctk}', '{$stk}', '{$amount}', '1', '{$note}', '{$site}', '{$date}', '{$date}')");
        insert_log($data_user['username'], 'WITHDRAWCASH', 'Cộng tác viên rút tiền '.number_format($amount).' ', $old_cash = $data_user['cash'], $change_cash = $amount, $new_cash = $data_user['cash']-$amount, $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo json_encode(array("status" => 'success',"msg" => 'Tạo lệnh rút tiền thành công', "cash" => number_format($data_user['cash']-$amount)));
    }