<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'id', 'type_category', 'username_post', 'cash', 'sale','status' , 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$username = Anti_xss($_POST['username']);
$type = Anti_xss($_POST['type']);
$username_post = Anti_xss($_POST['username_post']);
$id_acc = Anti_xss($_POST['id_acc']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] == '1'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }else{
        if($data_user['type'] == '4'){
            $sql_user = "AND `username_post` = '{$data_user['username']}'";
        }elseif($data_user['type'] == '3'){
            $sql_user = "AND `site` = '{$site}'";
        }
        else{
            $sql_user = "";
        }
        $sql_type = '';
        $sql_username = '';
        $sql_username_post = '';
        $sql_id_acc = '';

        if($type != ''){ // lọc loại tài khoản
            $sql_type = "AND `type_category` = '{$type}'";
        }elseif($username != ''){
            $sql_username = "AND `username` = '{$username}'";
        }elseif($username_post != ''){ // lọc người đăng
            $sql_username_post = "AND `username_post` = '{$username_post}'";
        }elseif($id_acc != ''){
            $sql_id_acc = "AND `id_acc` = '{$id_acc}'";
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
        foreach($db->fetch_assoc("SELECT * FROM `history_buy` WHERE `id` != '0' $sql_user $sql_type $sql_username $sql_id_acc $sql_username_post $implode $orderby LIMIT $start, $length", 0) as $info){
            $detail = json_decode($info['detail'], true);
            for ($z=0; $z < count($detail['data']); $z++) {
                if($data_user['type'] == '3'){
                    if($detail['data'][$z]['type'] == 'password'){
                        $value = '*********';
                    }else{
                        $value = $detail['data'][$z]['value'];
                    }
                }else{
                    $value = $detail['data'][$z]['value'];
                }
                $arr[] = 'data-'.$detail['data'][$z]['name'].'="'.$detail['data'][$z]['label'].'|'.$value.'"';
            }
            $json = array();
            $json[] = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info" '.implode("", $arr).'><i class="fa fa-eye"></i></button>';
            $json[] = $info['id'];
            $json[] = $info['id_acc'];
            $json[] = $detail['name_product'];
            $json[] = $info['username'];
            $json[] = $info['username_post'];
            $json[] = number_format($info['cash']);
            $json[] = $info['site'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
            unset($arr);
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `history_buy`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `history_buy` WHERE `id` != '0' $sql_user $sql_type $sql_id_acc $sql_username_post $sql_username $implode"),
            "data" =>  $data,
        );
        echo json_encode($output);
        
        unset($data);
    }