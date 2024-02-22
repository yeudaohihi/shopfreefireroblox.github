<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$name = Anti_xss($_POST['name']);
$type = Anti_xss($_POST['type']);
$id = Anti_xss($_POST['id']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif(empty($type)){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        if($type == 'upload'){
            if(empty($name)){
                echo JsonMsg('error','Vui lòng nhập tên');
            }else{
                $image = upload_file('image','tag');
                $db->query("INSERT INTO `product_tag`(`name`, `image`, `created_at`, `updated_at`) VALUES ('{$name}', '{$image}', '{$date}', '{$date}')");
                insert_log($data_user['username'], 'ADDTAG', 'Thêm Tag lúc '.$date_current.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
                echo JsonMsg('success','Thêm thành công');
            }
        }elseif($type == 'delete'){
            if($db->num_rows("SELECT * FROM `product_tag` WHERE `id` = '{$id}'") < 0){
                echo JsonMsg('error','Không tìm thấy Tag này');
            }else{
                $db->query("DELETE FROM `product_tag` WHERE `id` = '{$id}'");
                insert_log($data_user['username'], 'DELETETAG', 'Xóa Tag lúc '.$date_current.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
                echo JsonMsg('success','Xóa thành công');
            }
        }
    }