<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$domain = Anti_xss($_POST['domain']);
$partner_id = Anti_xss($_POST['partner_id']);
$partner_key = Anti_xss($_POST['partner_key']);
$email_smtp = Anti_xss($_POST['email_smtp']);
$pass_email_smtp = Anti_xss($_POST['pass_email_smtp']);
$new_cash = Anti_xss($_POST['new_cash']);
$persent_cash = Anti_xss($_POST['persent_cash']);
$title = Anti_xss($_POST['title']);
$mota = Anti_xss($_POST['mota']);
$status_web = Anti_xss($_POST['status_web']);
$status_card = Anti_xss($_POST['status_card']);
$status_diamond = Anti_xss($_POST['status_diamond']);
$status_noti = Anti_xss($_POST['status_noti']);
$apikey_card = Anti_xss($_POST['apikey_card']);
$apikey_diamond = Anti_xss($_POST['apikey_diamond']);
$APP_ID = Anti_xss($_POST['APP_ID']);
$APP_SECRET = Anti_xss($_POST['APP_SECRET']);
$id_fanpage = Anti_xss($_POST['id_fanpage']);
$thongbao = $_POST['thongbao'];

$detail_setting = detail_setting($domain); // lấy thông tin web
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($db->num_rows("SELECT * FROM `list_domain` WHERE `domain` = '{$domain}'") < 1){
        echo JsonMsg('error','Tên miền này không tồn tại');
    }elseif(empty($title)){
        echo JsonMsg('error','Tiêu đề không được để trống');
    }elseif(empty($status_web)){
        echo JsonMsg('error','Trạng thái trang không được để trống');
    }elseif(empty($status_noti)){
        echo JsonMsg('error','Trạng thái bảng thông báo không được để trống');
    }elseif(empty($status_card)){
        echo JsonMsg('error','Trạng thái nạp thẻ không được để trống');
    }elseif(empty($status_diamond)){
        echo JsonMsg('error','Trạng thái rút kim cương không được để trống');
    }elseif(empty($partner_id)){
        echo JsonMsg('error','Thiếu Partner ID nạp thẻ');
    }elseif(empty($partner_key)){
        echo JsonMsg('error','Thiếu Partner KEY nạp thẻ');
    }elseif(empty($apikey_diamond)){
        echo JsonMsg('error','Thiếu APIKEY rút kim cương');
    }elseif(empty($email_smtp)){
        echo JsonMsg('error','Thiếu Email SMTP');
    }elseif(empty($pass_email_smtp)){
        echo JsonMsg('error','Thiếu Pass Email SMTP');
    }else{
        $detail['new_cash'] = $new_cash;
        $detail['persent_cash'] = $persent_cash;
        $detail['title'] = $title;
        $detail['mota'] = $mota;
        $detail['status_web'] = $status_web;
        $detail['status_card'] = $status_card;
        $detail['status_diamond'] = $status_diamond;
        $detail['status_noti'] = $status_noti;
        $detail['partner_id'] = $partner_id;
        $detail['partner_key'] = $partner_key;
        $detail['email_smtp'] = $email_smtp;
        $detail['pass_email_smtp'] = $pass_email_smtp;
        $detail['apikey_diamond'] = $apikey_diamond;
        $detail['APP_ID'] = $APP_ID;
        $detail['APP_SECRET'] = $APP_SECRET;
        $detail['id_fanpage'] = $id_fanpage;
        $detail['thongbao'] = $thongbao;
        $detail['banner'] = update_file('banner',$detail_setting['banner'],'setting');
        $detail['logo'] = update_file('logo',$detail_setting['logo'],'setting');
        $detail['background'] = update_file('background',$detail_setting['background'],'setting');
        $detail['image_buy'] = update_file('image_buy',$detail_setting['image_buy'],'setting');
        $detail['image_try'] = update_file('image_try',$detail_setting['image_try'],'setting');
        $detail['image_play'] = update_file('image_play',$detail_setting['image_play'],'setting');
        $detail['btn_quay'] = update_file('btn_quay',$detail_setting['btn_quay'],'setting');
        $detail['image_upthe'] = update_file('image_upthe',$detail_setting['image_upthe'],'setting');
        $full_detail = addslashes(json_encode($detail));
        $db->query("UPDATE `list_domain` SET `detail` = '{$full_detail}',`updated_at` = '{$date}' WHERE `domain` = '{$domain}'");
        insert_log($data_user['username'], 'UPDATESHOP', 'Sửa thông tin tên miền ('.$domain.') lúc '.$date_current.' - IP ('.myip().')', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Cập nhật thành công');
    }