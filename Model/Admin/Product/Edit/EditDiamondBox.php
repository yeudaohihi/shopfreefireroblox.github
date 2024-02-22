<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$id = Anti_xss($_POST['id']);
$type = Anti_xss($_POST['type']);
$product = Anti_xss($_POST['product']);
$name_product = Anti_xss($_POST['name_product']);
$type_category = to_slug($name_product);
$thele = Anti_xss($_POST['thele']);
$domain = Anti_xss($_POST['domain']);
$tag = Anti_xss($_POST['tag']);
$cash = Anti_xss($_POST['cash']);
$arr_data = array();
if($domain == 'ALL'){
    $sql_domain = "AND `site` = 'ALL'";
}else{
    $sql_domain = "AND `site` = '{$domain}'";
}
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($db->num_rows("SELECT * FROM `product_game` WHERE `id` = '{$id}'") < 1){
        echo JsonMsg('error','Sản phẩm này không tồn tại trên hệ thống');
    }elseif(empty($type)){
        echo JsonMsg('error','Vui lòng chọn loại tài khoản');
    }elseif($cash < 0){
        echo JsonMsg('error','Số tiền không được bé hơn 0đ');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `id` = '{$id}'", 1);
        $detail = json_decode($query['detail'], true);
        for($i= 0; $i < count($_POST['tyle_type']); $i++){
            array_push($arr_data, array("tyle_type" => $_POST['tyle_type'][$i], "tyle_value" => $_POST['tyle_value'][$i], "tyle_text" => $_POST['tyle_text'][$i]));
        }
        $json['author'] = 'XboxTech';
        $json['name_product'] = $name_product;
        $json['thumb'] = update_file('thumb',$detail['thumb'],'product');
        $json['tag'] = $tag;
        $json['cash'] = $cash;
        $json['thele'] = $thele;
        $json['data'] = $arr_data;
        $full_json = addslashes(json_encode($json));
        $db->query("UPDATE `product_game` SET `type` = '{$type}',`product` = '{$product}',`type_category` = '{$type_category}',`detail` = '{$full_json}',`site` = '{$domain}',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
        insert_log($data_user['username'], 'EDITPRODUCT', 'Chỉnh sửa trò chơi '.$name_product.'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Chỉnh sửa thành công hòm kim cương '.$name_game.'');
    }