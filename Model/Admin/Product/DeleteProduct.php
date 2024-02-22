<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$id = Anti_xss($_POST['id']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif($db->num_rows("SELECT * FROM `product_game` WHERE `id` = '{$id}'") < 1){
        echo JsonMsg('error','Không tìm thấy dữ liệu cần xóa');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `id` = '{$id}'", 1);
        $detail = json_decode($query['detail'], true);
        $db->query("DELETE FROM `product_game` WHERE `id` = '{$id}'");
        insert_log($data_user['username'], 'DELETEPRODUCT', 'Xóa trò chơi '.$detail['name_product'].'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Xóa thành công trò chơi '.$detail['name_product'].'');
    }