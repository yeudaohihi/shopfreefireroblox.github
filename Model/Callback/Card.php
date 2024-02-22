<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php'); 
    # Đối số pricesvalue là mệnh giá thẻ cào lúc quý khách gửi thẻ
    #1: Thẻ thành công đúng mệnh giá
    #2: Thẻ thành công sai mệnh giá
    #3: Thẻ lỗi

//     $status = $_GET["status"]; // trạng thái thẻ cào
//     $serial = $_GET["serial"]; // serial thẻ cào
//     $pin = $_GET["cardcode"]; // mã thẻ cào
//     $card_type = $_GET["cardtype"]; // nhà mạng
//     $amount = $_GET["amount"]; // mệnh giá
//     $amount_ck = $_GET["amount_real"]; // mệnh giá thực sau CK
// 	$amount_real = $amount_real; // mệnh giá thật
//     $request_id = $_GET["trans"]; // mã reques_id
    
    $status = $_GET["status"]; // trạng thái thẻ cào
    $message = $_GET["message"];
    $serial = $_GET["serial"]; // serial thẻ cào
    $pin = $_GET["code"]; // mã thẻ cào
    $card_type = $_GET["telco"]; // nhà mạng
    $amount = $_GET["declared_value"]; // mệnh giá
    $amount_ck = $_GET["amount"]; // mệnh giá thực sau CK
	$amount_real = $_GET["value"]; // mệnh giá thật
    $request_id = $_GET["request_id"]; // mã reques_id

	$myfile = fopen("log_card.txt", "a+");
    fwrite($myfile, print_r($_GET, true).PHP_EOL);
    fclose($myfile);

    $check = $db->num_rows("SELECT * FROM `history_recharge` WHERE `serial` = '{$serial}' AND `request_id` = '{$request_id}' AND `status` = '1'");
    if($check >= 1){
        $info = $db->fetch_assoc("SELECT * FROM `history_recharge` WHERE `serial` = '{$serial}' AND `request_id` = '{$request_id}' AND `status` = '1' LIMIT 1", 1);
      	$newDataWeb = json_decode($db->fetch_assoc("SELECT * FROM `list_domain` = '{$info['site']}'", 1)['detail'], true);
        $info_user = $db->fetch_assoc("SELECT * FROM `users` WHERE `username` = '{$info['username']}'", 1);
        if($status == '1'){ // thẻ thành công
            $status_card = 2;
            if($newDataWeb[persent_cash] > 0){ 
                $amount = $amount * ((100+$newDataWeb[persent_cash])/100);
            }else{  	              
                // if(strtoupper($info[type]) == 'VIETTEL' && $info[amount] >= 50000){
                //     $amount = $amount * ((100+100)/100);
                // }else{
                //     $amount = $amount;
                // }
                $amount = $amount;
            } 
            $cash_old = $info_user[cash];
            $cash_new = $info_user[cash] + $amount;
            $value = $amount_real;
            $user = detail_users($info['username']);
            if($amount_real == 50000){
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}', `turn_wheel` = `turn_wheel` + '1' WHERE `username` = '{$info['username']}' ");
            }else if($amount_real == 100000){
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}', `turn_wheel` = `turn_wheel` + '2' WHERE `username` = '{$info['username']}' ");
            }else if($amount_real == 200000){
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}', `turn_wheel` = `turn_wheel` + '4' WHERE `username` = '{$info['username']}' ");
            }else if($amount_real == 300000){
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}', `turn_wheel` = `turn_wheel` + '6' WHERE `username` = '{$info['username']}' ");
            }else if($amount_real == 500000){
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}', `turn_wheel` = `turn_wheel` + '10' WHERE `username` = '{$info['username']}'");
            }else{
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$amount}' WHERE `username` = '{$info['username']}' ");
            }
            
            $db->query("UPDATE `history_recharge` SET `real_amount` = '{$amount_ck}', `status` = '2', `updated_at` = '{$date}' WHERE `serial` = '{$serial}' AND `request_id` = '{$request_id}' ");
            $db->query("INSERT INTO `top`(`username`, `name`, `amount`, `site`, `created_at`, `updated_at`) VALUES 
            ('{$info['username']}', '{$user['name']}', '{$value}', '{$info['site']}', '{$date}', '{$date}')");
            insert_log($info[username], 'RECHARGE', 'Nạp thẻ thành công mệnh giá '.number_format($amount).'đ lúc '.$date_current.' - IP ('.myip().')', $old_cash = $cash_old, $change_cash = $amount, $new_cash = $cash_new, $old_cash_diamond = $info_user[diamond], $change_cash_diamond = 0, $new_cash_diamond = $info_user[diamond] );
        }else if($status == '2'){ // thẻ sai mệnh giá
            $db->query("UPDATE `history_recharge` SET `real_amount` = '{$amount_ck}', `status` = '4', `updated_at` = '{$date}' WHERE `serial` = '{$serial}' AND `request_id` = '{$request_id}' ");
        }else{ // thẻ thất bại
            $db->query("UPDATE `history_recharge` SET `status` = '3', `updated_at` = '{$date}' WHERE `serial` = '{$serial}' AND `request_id` = '{$request_id}' ");
        }
    }