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
$price = Anti_xss($_POST['price']);
$arr_data = array();
if($domain == 'ALL'){
    $sql_domain = "AND `site` = 'ALL'";
}else{
    $sql_domain = "AND `site` = '{$domain}'";
}
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }elseif(empty($name_product)){
        echo JsonMsg('error','Vui lòng nhập tên sản phẩm');
    }elseif($db->num_rows("SELECT * FROM `product_game` WHERE `id` = '{$id}' $sql_domain") < 1){
        echo JsonMsg('error','Không tìm thấy sản phẩm để chỉnh sửa');
    }elseif(empty($type)){
        echo JsonMsg('error','Vui lòng chọn loại tài khoản');
    }else{
        $query = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `id` = '{$id}' AND `type` IN ('ACCOUNT','RANDOM')", 1);
        $detail = json_decode($query['detail'], true);
        for($i= 0; $i < count($_POST['data_name']); $i++){
            array_push($arr_data, array("id" => $i, "label" => $_POST['data_name'][$i], "type" => $_POST['data_type'][$i], "name" => toslug($_POST['data_name'][$i]), "value" => $_POST['data_value'][$i], "show" => $_POST['data_show'][$i]));
        }
        $json['author'] = 'XboxTech';
        $json['name_product'] = $name_product;
        $json['thumb'] = update_file('thumb',$detail['thumb'],'product');
        $json['tag'] = $tag;
        if($type == 'RANDOM'){
            $json['cash'] = $price;
        }
        $json['thele'] = $thele;
        $json['data'] = $arr_data;
        $full_json = addslashes(json_encode($json));
        $db->query("UPDATE `product_game` SET `type` = '{$type}',`product` = '{$product}',`type_category` = '{$type_category}',`detail` = '{$full_json}',`site` = '{$domain}',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
        insert_log($data_user['username'], 'EDITPRODUCT', 'Chỉnh sửa ngăn game '.$detail['name_product'].'', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Chỉnh sửa thành công trò chơi '.$name_game.'');
    }