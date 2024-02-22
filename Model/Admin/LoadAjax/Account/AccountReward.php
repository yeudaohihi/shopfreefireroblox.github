<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'id', 'type_category', 'username_post', 'cash', 'sale','status' , 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
// lọc dữ liệu
$username = Anti_xss($_POST['username']);
$type = Anti_xss($_POST['type']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập trang này');
    }else{
        $sql_type = "";
        $sql_username = "";
        if($username != ''){
            $sql_username = "AND `taikhoan` = '{$username}'";
        }elseif($type != ''){
            $sql_type = "AND `type_category` = '{$type}'";
        }
        if(isset($_POST['order'])){ // lọc theo thứ tự
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        foreach($db->fetch_assoc("SELECT * FROM `AccountReward` WHERE `id` != '0' $sql_type $sql_username $orderby LIMIT $start, $length", 0) as $info){
            $query_product = $db->fetch_assoc("SELECT * FROM `product_game` WHERE `type_category` = '{$info['type_category']}'", 1);
            $detail_product = json_decode($query_product['detail'], true);

            $json = array();
            $json[] = $info['id'];
            $json[] = $detail_product['name_product'];
            $json[] = $info['username_post'];
            $json[] = $info['taikhoan'];
            $json[] = $info['matkhau'];
            $json[] = status_type($info['status']);
            $json[] = '<button type="button" class="btn btn-danger btn-sm" onclick="delete_id('.$info['id'].')"><i class="fa fa-trash"></i></button>';
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `AccountReward`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `AccountReward` WHERE `id` != '0' $sql_type $sql_username"),
            "data" =>  $data,
        );
        echo json_encode($output);
    }