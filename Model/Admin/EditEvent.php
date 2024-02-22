<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');

if(!@$user){
    new Redirect(DOMAIN);
    exit;
}

$status = Anti_xss($_POST['status']);
$diamond = Anti_xss($_POST['diamond']);
$type = Anti_xss($_POST['type']);
$noti = $_POST['noti'];
$detail_event = get_detail('config_giveaway',1);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif(empty($status)){
        echo JsonMsg('error','Bạn vui lòng chọn trạng thái hoạt động');
    }elseif(empty($diamond)){
        echo JsonMsg('error','Bạn vui lòng nhập phần thưởng');
    }elseif(empty($noti)){
        echo JsonMsg('error','Bạn nên thêm thông báo phần thưởng');
    }else{
        $detail_event = get_detail('config_giveaway',1);
        $detail['diamond'] = $diamond;
        $detail['noti'] = $noti;
        $detail['images'] = update_file('images',$detail_event['images'],'setting');
        $full_detail = addslashes(json_encode($detail));
        $db->query("UPDATE `config_giveaway` SET `detail` = '{$full_detail}', `status` = '{$status}', `updated_at` = '{$date}' WHERE `id` = '1' AND `type` = 'LIXI' ");
        insert_log($data_user['username'], 'EDITEVENT', 'Chỉnh sửa sự kiện lúc '.$date_current.' - IP ( '.myip().' )', $old_cash = $data_user[cash], $change_cash = 0, $new_cash = $data_user[cash], $old_cash_diamond = $data_user[diamond], $change_cash_diamond = 0, $new_cash_diamond = $data_user[diamond]);
        echo JsonMsg('success','Cập nhật thành công');
    }