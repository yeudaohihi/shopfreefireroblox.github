<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'id', 'type_category', 'username_post', 'cash', 'sale','status' , 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$username = Anti_xss($_POST['username']);
$type = Anti_xss($_POST['type']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] == '1'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }else{
        if($data_user['type'] == '4'){
            $sql_user = "AND `username_post` = '{$data_user['username']}'";
        }else{
            $sql_user = "";
        }
        $sql_type = '';
        $sql_username = '';

        if($type != ''){ // lọc loại tài khoản
            $sql_type = "AND `type_category` = '{$type}'";
        }

        if($username != ''){ // lọc người đăng
            $sql_username = "AND `username_post` = '{$username}'";
        }

        if(isset($_POST['order'])){ // lọc theo thứ tự
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        // lấy giá trị name ở bộ lọc
        $sql_query = "SELECT * FROM `list_account` WHERE `type_category` = '{$type}'";
        $query = $db->fetch_assoc($sql_query, 1);
        $detail_query = json_decode($query['detail'], true); // lấy detail
        $arr_query = $detail_query['data']; // lấy data trong detail
        $i = 0;
        for($a=0; $a < count($arr_query); $a++){ // vòng lặp data detail
            if($arr_query[$a]['type'] != 'password'){
                $arr_name = $arr_query[$a]['name']; // lấy giá trị từ bên ngoại
                $id = $arr_query[$a]['id'];
                $arr_value = Anti_xss($_POST['data'][$i]['value']);
                if($arr_value != null){
                    $sql[] = "AND JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(`detail`, '$.data[$id]'), '$.$arr_name')) = '{$arr_value}'"; // câu lệnh lọc giá trị array đa mảng
                }
                $i += 1;
            }
        }
        $implode = implode("", $sql); // nối câu lệnh
        foreach($db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` != '0' $sql_user $sql_type $sql_username $implode $orderby LIMIT $start, $length", 0) as $info){
            $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$info['type_category']}'", 1);
            $detail_product = json_decode($query_product['detail'], true);
            $detail = json_decode($info['detail'], true);
            if($info['status'] == 'on'){
                $status = 'Chưa bán';
            }elseif($info['status'] == 'off'){
                $status = 'Đã bán';
            }
            $json = array();
            $json[] = $info['id'];
            $json[] = $detail_product['name_product'];
            $json[] = $info['username_post'];
            $json[] = number_format($info['cash']);
            $json[] = ''.$info['sale'].'%';
            $json[] = $status;
            $json[] = '<a class="btn btn-info btn-sm" href="/Cpanel/Account/Edit/'.$info['id'].'" target="_blank"><i class="fa fa-pen"></i></a>';
            $json[] = '<button type="button" class="btn btn-danger btn-sm" onclick="delete_id('.$info['id'].')"><i class="fa fa-trash"></i></button>';
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `list_account`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `list_account` WHERE `id` != '0' $sql_user $sql_type $sql_username $implode"),
            "data" =>  $data,
        );
        echo json_encode($output);
    }