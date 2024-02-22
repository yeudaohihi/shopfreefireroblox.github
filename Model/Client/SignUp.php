<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$username = Anti_xss($_POST['username']);
$password = Anti_xss($_POST['password']);
$repassword = Anti_xss($_POST['repassword']);
$email = Anti_xss($_POST['email']);
$Cuser = "/^[A-Za-z0-9_.]{3,32}$/";
$ipRegister = myip();
$checkIP = $db->num_rows("SELECT * FROM `bandIP` WHERE `ip` = '{$ipRegister}' AND `site` = '{$site}'");
    if(empty($email)){
        echo JsonMsg('error','Vui lòng điền email');
    }elseif(check_email($email) != true){
        echo JsonMsg('error','Email không đúng định dạng');
    }elseif($db->num_rows("SELECT * FROM `users` WHERE `email` = '{$email}'") > 0){
        echo JsonMsg('error','Email này đã tồn tại trên hệ thống');
    }elseif(empty($username)){
        echo JsonMsg('error','Vui lòng điền tên đăng nhập');
    }elseif(!preg_match($Cuser,$username)){
        echo JsonMsg('error','Tên đăng nhập phải là chữ hoặc số, bao gồm dấu gạch ngang "-" và gạch dưới "_"');
    }elseif(strlen($username) <= 4){
        echo JsonMsg('error','Tên đăng nhập có nhiều hơn 4 ký tự trở lên');
    }elseif($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$username}'") > 0){
        echo JsonMsg('error','Tên đăng nhập này đã tồn tại trên hệ thống');
    }elseif(empty($password)){
        echo JsonMsg('error','Vui lòng nhập mật khẩu');
    }elseif(strlen($password) <= 6){
        echo JsonMsg('error','Mật khẩu có nhiều hơn 6 ký tự trở lên');
    }elseif($password != $repassword){
        echo JsonMsg('error','Mật khẩu xác nhận không chính xác');
    }else{
        $checkSpam = "SELECT * FROM `users` WHERE JSON_EXTRACT(`detail`, '$.ip') = '{$ipRegister}' ORDER BY `id` DESC LIMIT 1";
        $show = $db->fetch_assoc($checkSpam, 1);
        if($date - $show['created_at'] < 30){
            echo JsonMsg('error', 'Bạn đăng ký quá nhanh vui lòng chờ 1p để thử lại');
            $db->query("INSERT INTO `bandIP`(`ip`, `site`, `date`) VALUES ('{$ipRegister}', '{$site}', '{$date}')"); // ban IP 
        }else{
            $realPass = md5($password);
            $users['name'] = $username;
            $users['email'] = $email;
            $users['ip'] = myip();
            $users['status'] = 'on';
            $users['browser'] = getBrowser();
            $users['device'] = getOS();
            $users['user_agent'] = $user_agent;
            $deltai_users = addslashes(json_encode($users));
            $db->query("INSERT INTO `users`(`username`,`email`, `password`, `type`, `cash`, `diamond`, `turn_wheel`, `detail`, `site`, `updated_at`, `created_at`) VALUES ('{$username}', '{$email}', '{$realPass}', '1', '{$dataWeb['new_cash']}', '0', '0', '{$deltai_users}', '{$site}', '{$date}', '{$date}')");
            // ghi log_user
            insert_log($username, 'SIGNUP', 'Đăng ký lúc '.$date_current.' - IP ('.myip().')', $old_cash = 0, $change_cash = 0, $new_cash = 0, $old_cash_diamond = 0, $change_cash_diamond = 0, $new_cash_diamond = 0);
            echo JsonMsg('success','Đăng ký thành công');
            $session->send($username);
        } 
    }