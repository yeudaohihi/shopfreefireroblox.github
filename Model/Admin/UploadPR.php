<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$username = Anti_xss($_POST['username']);
$max_diamond = Anti_xss($_POST['max_diamond']);
$block = Anti_xss($_POST['block']);

$query = get_data('users',$username);

if(!@$user){
    echo JsonMsg('error','Bạn chưa đăng nhập');
}elseif($data_user['type'] != '2'){
    echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
}elseif(empty($username)){
    echo JsonMsg('error','Vui lòng nhập tên tài khoản cần thêm');
}elseif($max_diamond < 0){
    echo JsonMsg('error','Vui lòng nhập số kim cương giới hạn');
}elseif(empty($block)){
    echo JsonMsg('error','Vui lòng chọn trạng thái');
}elseif($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$username}'") < 1){
    echo JsonMsg('error','Không tìm thấy dữ liệu thành viên này');
}elseif($db->num_rows("SELECT * FROM `list_pr` WHERE `username` = '{$username}'") > 0){
    echo JsonMsg('error','Tài khoản này đã tồn tại trên hệ thống');
}else{
    $db->query("INSERT INTO `list_pr`(`id_user`, `username`, `present_diamond`, `max_diamond`, `status`, `site`, `updated_at`, `created_at`) VALUES ('{$query['id']}', '{$username}', '0', '{$max_diamond}', '{$block}', '{$query['site']}', '{$date}', '{$date}')");
    insert_log($data_user['username'], 'ADDPR', 'Thêm tài khoản quảng cáo ( '.$username.' ) lúc '.$date_current.' - IP ( '.myip().' )', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
    echo JsonMsg('success','Thêm tài khoản quảng cáo thành công');
}

