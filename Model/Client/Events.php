<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');

if(!@$user){
    echo JsonMsg('LOGIN', 'VUi lòng đăng nhập để nhận quà');
}elseif($dataWeb['status_web'] == 'off'){
    echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
}elseif($arr_user['status'] == 'off'){
    echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
}else{
    if($info_lixi['status'] == 'off'){
        echo JsonMsg('error', 'Sự kiện bảo trì hoặc đã kết thúc');
    }elseif($db->num_rows("SELECT * FROM `log_lixi` WHERE `username` = '{$data_user['username']}'") > 1){
        echo JsonMsg('error', 'Mỗi người chỉ nhận đc 1 lần thôi');
    }else{
        
        if($db->num_rows("SELECT * FROM `log_lixi` WHERE `username` = '{$data_user['username']}'") < 1){

            $diamond = explode(',',$js_lixi['diamond']);
            $rand_diamond = rand($diamond[0],$diamond[1]);
            $amount = $rand_diamond;
            $text = str_replace('...',number_format($amount),$js_lixi['noti']);
            $text_lx = "$amount Kim Cương";

            $diamond_new = $data_user['diamond'] + $amount;
            $db->query("INSERT INTO `log_lixi`(`username`, `description`, `site`, `updated_at`, `created_at`) VALUES ('{$data_user['username']}', '{$text_lx}', '{$site}', '{$date}', '{$date}')");
            $db->query("UPDATE `users` SET `diamond` = `diamond` + '{$amount}' WHERE `username` = '{$data_user['username']}'");
            insert_log($data_user['username'], 'NHANQUAEVENT', 'Nhận '.$amount.' Kim Cương từ sự kiện lì xì lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = $amount, $new_cash_diamond = $diamond_new );
            echo JsonMsg('success', html_entity_decode($text));
        }         
    }
}
