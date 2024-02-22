<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$idgame = Anti_xss($_POST['idgame']);
$package = Anti_xss($_POST['packdiamond']); 

    if($package == 1){
        $diamond = 90;
        $amount = 20000;
    }elseif($package == 2){
        $diamond = 230;
        $amount = 50000;
    }elseif($package == 3){
        $diamond = 465;
        $amount = 100000;
    }elseif($package == 4){
        $diamond = 950;
        $amount = 200000;
    }elseif($package == 5){
        $diamond = 2375;
        $amount = 500000;
    }

    if($dataWeb['status_web'] == 'off'){
        echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
    }elseif(!@$user){
        echo JsonMsg('error', 'Vui lòng đăng nhập để sử dụng tính năng');
    }elseif($dataWeb['status_diamond'] == 'off'){
        echo JsonMsg('error', 'Chức năng rút kim cương đang bảo trì tạm thời');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
    }elseif($diamond > $data_user['diamond']){
        echo JsonMsg('error', 'Bạn không đủ kim cương để rút gói này');
    }elseif(empty($idgame)){
        echo JsonMsg('error', 'Vui lòng nhập ID Game');
    }elseif(empty($package)){
        echo JsonMsg('error', 'Vui lòng chọn gói kim cương');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error', 'Tài khoản của quý khách đã bị khóa');
    }else{
        if($data_user['type'] == 3){
            $checkStatus = $db->num_rows("SELECT * FROM `list_pr` WHERE `username` = '{$data_user['username']}' AND `status` = 'off'");
            $getDataUser = $db->fetch_assoc("SELECT * FROM `list_pr` WHERE `username` = '{$data_user['username']}'", 1);
            if($checkStatus == 1 || $getDataUser['max_diamond'] < ($getDataUser['present_diamond']+$diamond)){ // check pr
                $db->query("INSERT INTO `withdraw`(`username`, `request_id`, `idgame`, `amount`, `diamond`, `status`, `site`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', 'NULL', '{$idgame}', '{$amount}', '{$diamond}', '1', '{$site}', '{$date}', '{$date}')");
                $db->query("UPDATE `users` SET `diamond` = `diamond` - '{$diamond}' WHERE `username` = '{$data_user['username']}'");
                echo JsonMsg('success', 'Rút gói '.$diamond.' kim cương thành công');
            }else{
                $api = $dataWeb['apikey_diamond'];
                $request_id = rand(100000000,999999999);
                $obj = draw_diamond($api,$idgame,$amount,$request_id);
                if($obj['status'] == 00){
                    $db->query("UPDATE `list_pr` SET `present_diamond` = `present_diamond` + '{$diamond}',`updated_at` = '{$date}' WHERE `username` = '{$data_user['username']}'");
                    $db->query("INSERT INTO `withdraw`(`username`, `request_id`, `idgame`, `amount`, `diamond`, `status`, `site`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', '{$request_id}', '{$idgame}', '{$amount}', '{$diamond}', '1', '{$site}', '{$date}', '{$date}')");
                    $db->query("UPDATE `users` SET `diamond` = `diamond` - '{$diamond}' WHERE `username` = '{$data_user['username']}'");
                    echo JsonMsg('success', 'Rút gói '.$diamond.' kim cương thành công');
                }else{
                    echo JsonMsg('error', $obj['msg']);
                }
            }
        }else{
            $api = $dataWeb['apikey_diamond'];
            $request_id = rand(100000000,999999999);
            $obj = draw_diamond($api,$idgame,$amount,$request_id);
            if($obj['status'] == 00){
                $db->query("INSERT INTO `withdraw`(`username`, `request_id`, `idgame`, `amount`, `diamond`, `status`, `site`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', '{$request_id}', '{$idgame}', '{$amount}', '{$diamond}', '1', '{$site}', '{$date}', '{$date}')");
                $db->query("UPDATE `users` SET `diamond` = `diamond` - '{$diamond}' WHERE `username` = '{$data_user['username']}'");
                echo JsonMsg('success', 'Rút gói '.$diamond.' kim cương thành công');
            }else{
                echo JsonMsg('error', $obj['msg']);
            }
        }
    }
