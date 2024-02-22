<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id', 'username', 'type', 'serial', 'code', 'amount', 'status', 'site' , 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$username = Anti_xss($_POST['username']);
$serial = Anti_xss($_POST['serial']);
$code = Anti_xss($_POST['code']);
$status = Anti_xss($_POST['status']);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2' && $data_user['type'] != '3'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($start < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }elseif($length < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        $sql_username = '';
        $sql_serial = '';
        $sql_code = '';
        $sql_status = '';
        $sql_site = '';
        if($username != ''){
            $sql_username = "AND `username` = '{$username}'";
        }elseif($serial != ''){
            $sql_serial = "AND `serial` = '{$serial}'";
        }elseif($code != ''){
            $sql_code = "AND `code` = '{$code}'";
        }elseif($status != ''){
            $sql_status = "AND `status` = '{$status}'";
        }if($data_user['type'] == 2){
            $sql_site = "";
        }elseif($data_user['type'] == 3){
            $sql_site = "AND `site` = '{$site}'";
        }
        
        if(isset($_POST['order'])){
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        foreach($db->fetch_assoc("SELECT * FROM `history_recharge` WHERE `id` != '0' $sql_username $sql_serial $sql_code $sql_status $sql_site $orderby LIMIT $start, $length", 0) as $info){
            $json = array();
            $json[] = $info['id'];
            $json[] = $info['username'];
            $json[] = detail_users($info['username'])['name'];
            $json[] = $info['type'];
            $json[] = $info['serial'];
            $json[] = $info['code'];
            $json[] = number_format($info['amount']);
            $json[] = his_admin($info['status']);
            $json[] = $info['site'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `history_recharge`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `history_recharge` WHERE `id` != '0' $sql_username $sql_serial $sql_code $sql_status $sql_site"),
            "data" =>  $data
        );
        echo json_encode($output);
    }