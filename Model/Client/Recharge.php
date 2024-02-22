<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$ipSendCard = myip();
$checkIP = $db->num_rows("SELECT * FROM `bandIP` WHERE `ip` = '{$ipSendCard}' AND `site` = '{$site}'");
if($_POST){
    $type = Anti_xss($_POST['type']);
    $serial = Anti_xss(preg_replace('/\D/', '',$_POST['serial']));
    $code = Anti_xss(preg_replace('/\D/', '',$_POST['code']));
    $amount = Anti_xss(preg_replace('/\D/', '',$_POST['amount']));

    $check_card = $db->num_rows("SELECT * FROM `history_recharge` WHERE `serial` = '{$serial}' AND `code` = '{$code}' AND `site` = '{$site}'");

    if(!@$user){
        echo JsonMsg('error', 'Vui lòng đăng nhập để sử dụng tính năng');
    }elseif($dataWeb['status_web'] == 'off'){
        echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
    }elseif($dataWeb['status_card'] == 'off'){
        echo JsonMsg('error', 'Chức năng nạp thẻ đang bảo trì');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
    }elseif(empty($type) || empty($serial) || empty($code) || empty($amount)){
        echo JsonMsg('error', 'Vui lòng nhập đầy đủ thông tin');
    }elseif($check_card >= 1){
        echo JsonMsg('error', 'Thẻ cào này đã tồn tại trên hệ thống');
    }elseif($checkIP > 5){
        echo JsonMsg('error', 'Bạn đã bị cấm 24h');
    }else{
        $time30s = $date - 30;
        $checkSpam = $db->num_rows("SELECT * FROM `history_recharge` WHERE `ip` = '{$ipSendCard}' AND `created_at` BETWEEN '{$time30s}' AND '{$date}'");
        $getLastestCard = $db->fetch_assoc("SELECT * FROM `history_recharge` WHERE `ip` = '{$ipSendCard}' ORDER BY `id` DESC", 1);
        if($checkSpam > 3){
            if($date - $getLastestCard['created_at'] < 30){
                echo JsonMsg('error', 'Bạn đã nạp thẻ quá nhanh vui lòng chờ 1p để thử lại nếu không sẽ bị khóa');
                $db->query("INSERT INTO `bandIP`(`ip`, `site`, `date`) VALUES ('{$ipSendCard}', '{$site}', '{$date}')"); // ban IP 
            }
        }else{
            
            // $api = $dataWeb['apikey_card'];
            $request_id = rand(100000000,999999999);
            $date = time();
            $obj = recharge_gachthe1s($type,$amount,$code,$serial,$request_id);
            

            if($obj['status'] == 99){
                $db->query("INSERT INTO `history_recharge`(`username`, `type`, `serial`, `code`, `amount`, `real_amount`, `request_id`, `status`, `site`, `ip`,`updated_at`, `created_at`) 
                VALUES ('{$data_user['username']}', '{$type}', '{$serial}', '{$code}', '{$amount}', '0', '{$request_id}', '1', '{$site}', '{$ipSendCard}', '{$date}', '{$date}')");
                echo JsonMsg('success', 'Nạp thẻ thành công - vui lòng chờ 30s - 1p duyệt');
                $db->close();
            }else{
                echo JsonMsg('error', $obj['msg']);
            }
        }
    }
}