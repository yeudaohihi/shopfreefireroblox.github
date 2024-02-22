<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');

$username = Anti_xss($_POST['username']);
$type = Anti_xss($_POST['type']);
$check = $db->fetch_assoc("SELECT * FROM `users` WHERE `username` = '{$username}'", 1);
    if($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$username}'") < 1){
        echo JsonMsg('error','User không tồn tại trong hệ thống');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `users` WHERE `username` = '{$username}'", 1);
        $detail = json_decode($query['detail'], true);
        if($type == 'get_otp'){
            if($date - $check['updated_at'] < 60){
                echo JsonMsg('error', 'Bạn cần chờ 60s để nhận mã tiếp theo');
            }else{
                $otp = randomPassword();
                // $db->query("UPDATE `users` SET `detail` = JSON_SET(`detail`,'$.otp' ,'{$otp}'), `updated_at` = '{$date}' WHERE `username` = '{$username}'");
                
                // $db->query("DELETE FROM `confirm_otp` WHERE `username` = '{$username}'");
                // $db->query("INSERT INTO `confirm_otp`(`username`, `name`, `otp`, `created_at`, `updated_at`) VALUES ('{$username}', '{$detail['name']}', '{$otp}', '{$date}', '{$date}') ");
                $db->query("UPDATE `confirm_otp` SET `otp` = '{$otp}',`updated_at` = '{$date}' WHERE `username` = '{$username}'");
                
                $name = $detail['name'];
                
                $description = 'Mã OTP đăng nhập của bạn là: '.$otp.' ';
                $response = "$name đang yêu cầu mã OTP \n$description \nThời gian: ".date('d-m-Y H:i:s',$date)."";
                $parameters = array( // gữi telegram
                    "chat_id" => '-715736414',
                    "text" => $response,
                    "parseMode" => "html"
                );
                send("sendMessage", $parameters);
                echo JsonMsg('success','OTP xác nhận đăng nhập ADMIN đã được gửi đến bạn!');
            }
        }elseif($type == 'confirm'){
            $otp = Anti_xss($_POST['otp']);
            if(empty($otp)){
                echo JsonMsg('error','Vui lòng nhập OTP');
            }elseif($db->num_rows("SELECT * FROM `confirm_otp` WHERE `otp` = '{$otp}' AND  `username` = '{$username}'") < 1){
                echo JsonMsg('error','OTP không chính xác!');
            }else{
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
                
                echo JsonMsg('success','Xác thực ADMIN thành công');
                
            }
        }
    }