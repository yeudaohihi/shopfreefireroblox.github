<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$type = Anti_xss($_POST['type']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2' && $data_user['type'] != '4'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `type` IN ('ACCOUNT','RANDOM')") < 1){
        echo JsonMsg('error','Không tìm thấy dữ liệu');
    }else{
        if($data_user['type'] == '2'){
            $sql_type = "AND `type` IN ('ACCOUNT','RANDOM')";
        }elseif($data_user['type'] == '4'){
            $sql_type = "AND `type` = 'ACCOUNT'";
        }
        $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' $sql_type", 1);
        $detail = json_decode($query['detail'], true);
        $json['type'] = $query['type'];
        $json['author'] = 'XboxTech.Vn';
        $json['name_product'] = $detail['name_product'];
        $json['data'] = $detail['data'];
        $json['tag'] = $detail['tag'];
        $json['thele'] = $detail['thele'];
        $json['thumb'] = $detail['thumb'];
        echo json_encode($json);
    }