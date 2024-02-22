<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$name = Anti_xss($_POST['name']);
$amount = Anti_xss($_POST['amount']);
$shop = Anti_xss($_POST['shop']);
$request_id = 'CRACK_'.rand(100000,9000000);

if(!@$user){
    echo JsonMsg('error','Bạn chưa đăng nhập');
}elseif($data_user['type'] != '2'){
    echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
}elseif(empty($name)){
    echo JsonMsg('error','Vui lòng nhập tên họ và tên');
}elseif($amount < 0){
    echo JsonMsg('error','Vui lòng nhập số tiền');
}else{
    $db->query("INSERT INTO `top`(`username`, `name`, `amount`, `site`, `created_at`, `updated_at`) VALUES
     ('{$request_id}', '{$name}', '{$amount}', '{$shop}', '{$date}', '{$date}')");
    echo JsonMsg('success','Thêm top ảo cho '.$shop.' thành công');
}

