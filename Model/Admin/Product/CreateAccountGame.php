<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
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
    }elseif(empty($name_product)){
        echo JsonMsg('error','Vui lòng nhập tên sản phẩm');
    }elseif($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type_category}' $sql_domain") > 0){
        echo JsonMsg('error','Sản phẩm này đã tồn tại trên hệ thống');
    }elseif(empty($type)){
        echo JsonMsg('error','Vui lòng chọn loại tài khoản');
    }else{
        for($i= 0; $i < count($_POST['data_name']); $i++){
            array_push($arr_data, array("id" => $i, "label" => $_POST['data_name'][$i], "type" => $_POST['data_type'][$i], "name" => toslug($_POST['data_name'][$i]), "value" => $_POST['data_value'][$i], "show" => $_POST['data_show'][$i]));
        }
        $json['author'] = 'XboxTech';
        $json['name_product'] = $name_product;
        $json['thumb'] = upload_file('thumb','product');
        $json['tag'] = $tag;
        $json['cash'] = $cash;
        $json['thele'] = $thele;
        $json['data'] = $arr_data;
        $full_json = addslashes(json_encode($json));
        $db->query("INSERT INTO `product_game`(`stt`, `type`, `product`, `type_category`, `detail`, `status`, `site`, `created_at`, `updated_at`) VALUES ('1', '{$type}', '{$product}', '{$type_category}', '{$full_json}', 'on', '{$domain}', '{$date}', '{$date}')");
        insert_log($data_user['username'], 'CREATEACCOUNT', 'Thêm ngăn tài khoản game '.$name_game.' ', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Thêm thành công trò chơi '.$name_game.'');
    }