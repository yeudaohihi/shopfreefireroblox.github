<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id', 'username', 'name', 'present_diamond', 'max_diamond', 'status', 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$domain = Anti_xss($_POST['domain']);
$type = Anti_xss($_POST['type']);
$username = Anti_xss($_POST['username']);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($start < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }elseif($length < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        $sql_domain = '';
        $sql_username = '';
        if($domain != ''){
            $sql_domain = "AND `domain` = '{$domain}'";
        }elseif($username != ''){
            $sql_username = "AND `username` = '{$username}'";
        }
        if(isset($_POST['order'])){
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        foreach($db->fetch_assoc("SELECT * FROM `list_pr` WHERE `id` != '0' $sql_domain $sql_username $orderby LIMIT $start, $length", 0) as $info){
            // $detail = json_decode($info['detail'], true);
            $json = array();
            $json[] = $info['id'];
            $json[] = $info['username'];
            $json[] = detail_users($info['username'])['name'];
            $json[] = number_format($info['present_diamond']);
            $json[] = number_format($info['max_diamond']);
            $json[] = type_status($info['status']);
            $json[] = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info" data-max_diamond="'.$info['max_diamond'].'" data-status="'.$info['status'].'" data-username="'.$info['username'].'"><i class="fa fa-eye"></i></button>';
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `list_pr`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `list_pr` WHERE `id` != '0' $sql_domain $sql_username"),
            "data" =>  $data
        );
        echo json_encode($output);
    }