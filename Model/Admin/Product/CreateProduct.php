<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$name = Anti_xss($_POST['name']);
$key_product = to_slug($name);
$type = Anti_xss($_POST['type']);
$id = Anti_xss($_POST['id']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }else{
        if($type == 'upload'){
            if(empty($name)){
                echo JsonMsg('error','Vui lòng nhập tên danh mục');
            }elseif($db->num_rows("SELECT * FROM `product` WHERE `key_product` = '{$key_product}'") > 0){
                echo JsonMsg('error','Danh mục này đã tồn tại');
            }else{
                $image = upload_file('image','product');
                $db->num_rows("INSERT INTO `product`(`key_product`, `name`, `image`, `created_at`, `updated_at`) VALUES ('{$key_product}', '{$name}', '{$image}', '{$date}', '{$date}')");
                insert_log($data_user['username'], 'CREATEPRODUCT', 'Thêm danh mục '.$name.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
                echo JsonMsg('success','Thêm danh mục thành công');
            }
        }elseif($type == 'delete'){
            if(empty($id)){
                echo JsonMsg('erros','Thiếu trường dữ liệu');
            }elseif($db->num_rows("SELECT * FROM `product` WHERE `id` = '{$id}'") < 0){
                echo JsonMsg('error','Danh mục này không tồn tại');
            }else{
                $db->query("DELETE FROM `product` WHERE `id` = '{$id}'");
                insert_log($data_user['username'], 'DELETEPRODUCT', 'Xóa danh mục #'.$id.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
                echo JsonMsg('success','Xóa danh mục #'.$id.' thành công');
            }
        }
    }