<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$domain = Anti_xss($_POST['domain']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif($db->num_rows("SELECT * FROM `list_domain` WHERE `domain` = '{$shop}'") > 0){
        echo JsonMsg('error','Tên miền này đã tồn tại trên hệ thống');
    }else{
        $detail['new_cash'] = '10000';
        $detail['persent_cash'] = '0';
        $detail['title'] = ''.$domain.' | Shop Bán Acc Free Fire - Liên Quân | Giá Rẻ - Uy Tín - Chất Lượng';
        $detail['mota'] = 'Shop Acc Free Fire, Liên Quân Uy Tín Hàng Đầu Việt Nam';
        $detail['status_web'] = 'on';
        $detail['status_card'] = 'on';
        $detail['status_diamond'] = 'on';
        $detail['status_noti'] = 'off';
        $detail['apikey_card'] = '';
        $detail['apikey_diamond'] = '';
        $detail['APP_ID'] = '';
        $detail['APP_SECRET'] = '';
        $detail['id_fanpage'] = '';
        $detail['thongbao'] = '';
        $detail['banner'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['logo'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['background'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['image_buy'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['image_try'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['image_play'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['btn_quay'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $detail['image_upthe'] = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
        $full_detail = addslashes(json_encode($detail));
        $db->query("INSERT INTO `list_domain`(`domain`, `detail`, `updated_at`, `created_at`) VALUES ('{$domain}', '{$full_detail}', '{$date}', '{$date}')");
        insert_log($data_user['username'], 'ADDDOMAIN', 'Thêm tên miền lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Thêm tên miền mới thành công');
    }