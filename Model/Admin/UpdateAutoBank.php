<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$type = strtoupper(Anti_xss($_POST['type']));
$phone_momo = Anti_xss($_POST['phone_momo']);
$password_momo = Anti_xss($_POST['password_momo']);
$name_momo = Anti_xss($_POST['ctk_momo']);
$apikey_momo = Anti_xss($_POST['apikey_momo']);

$stk_bank = Anti_xss($_POST['stk_bank']);
$name = Anti_xss($_POST['name']);
$apikey_bank = Anti_xss($_POST['apikey_bank']);
$password = Anti_xss($_POST['password']);

$partner_id = Anti_xss($_POST['partner_id']);
$partner_key = Anti_xss($_POST['partner_key']);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($db->num_rows("SELECT * FROM `setting_apibank` WHERE `type` = '{$type}'") < 1){
        echo JsonMsg('error','Apikey này không tồn tại');
    }elseif($type == 'BANK'){
        if(empty($stk_bank)){
            echo JsonMsg('error','Số tài khoản ngân hàng không được để trống');
        }elseif(empty($name)){
            echo JsonMsg('error','Vui lòng nhập tên chủ tài khoản');
        }elseif(empty($apikey_bank)){
            echo JsonMsg('error','Apikey ngân hàng không được để trống');
        }elseif(empty($password)){
            echo JsonMsg('error','Password ngân hàng không được để trống');
        }else{
            $detail['stk'] = $stk_bank;
            $detail['ctk'] = $name;
            $detail['apikey'] = $apikey_bank;
            $detail['password'] = $password;
            $full_detail = addslashes(json_encode($detail));
            $db->query("UPDATE `setting_apibank` SET `detail` = '{$full_detail}', `updated_at` = '{$date}' WHERE `type` = '{$type}'");
            insert_log($data_user['username'], 'UPDATEAPIKEY', 'Sửa thông tin apikey ('.$type.') lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash']);
            echo JsonMsg('success','Cập nhật thành công');
        }
    }elseif($type == 'MOMO'){
        if(empty($phone_momo)){
            echo JsonMsg('error','Số điện thoại momo không được để trống');
        }elseif(empty($password_momo)){
            echo JsonMsg('error','Mật khẩu momo không được để trống');
        }elseif(empty($name_momo)){
            echo JsonMsg('error','Vui lòng nhập tên chủ tài khoản');
        }elseif(empty($apikey_momo)){
            echo JsonMsg('error','Apikey momo không được để trống');
        }else{
            $detail['phone'] = $phone_momo;
            $detail['password'] = $password_momo;
            $detail['ctk'] = $name_momo;
            $detail['apikey'] = $apikey_momo;
            $full_detail = addslashes(json_encode($detail));
            $db->query("UPDATE `setting_apibank` SET `detail` = '{$full_detail}', `updated_at` = '{$date}' WHERE `type` = '{$type}'");
            insert_log($data_user['username'], 'UPDATEAPIKEY', 'Sửa thông tin apikey ('.$type.') lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash']);
            echo JsonMsg('success','Cập nhật thành công');
        }
    }


    

