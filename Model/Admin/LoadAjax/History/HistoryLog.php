<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'id', 'type', 'username', 'username', 'username', 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$domain = Anti_xss($_POST['domain']);
$username = Anti_xss($_POST['username']);
$type = Anti_xss($_POST['type']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập');
    }elseif($start < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }elseif($length < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        $sql_domain = '';
        $sql_type = '';
        $sql_username = '';
        if($domain != ''){
            $sql_domain = "AND `domain` = '{$domain}'";
        }elseif($type != ''){
            $sql_type = "AND `type` = '{$type}'";
        }elseif($username != ''){
            $sql_username = "AND `username` = '{$username}'";
        }
        if(isset($_POST['order'])){
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        foreach($db->fetch_assoc("SELECT * FROM `log_user` WHERE `id` != '0' $sql_domain $sql_type $sql_username $orderby LIMIT $start, $length", 0) as $info){
            $detail = json_decode($info['detail'], true);
            $json = array();
            $json[] = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info" data-oldcash="'.number_format($detail['old_cash']).'" data-changecash="'.number_format($detail['change_cash']).'" data-newcash="'.number_format($detail['new_cash']).'" data-olddiamond="'.number_format($detail['old_cash_diamond']).'" data-changediamond="'.number_format($detail['change_cash_diamond']).'" data-newdiamond="'.number_format($detail['new_cash_diamond']).'" data-ip="'.$detail['ip'].'" data-browser="'.$detail['browser'].'"><i class="fa fa-eye"></i></button>';
            $json[] = $info['id'];
            $json[] = name_log($info['type']);
            $json[] = $info['username'];
            $json[] = detail_users($info['username'])['name'];
            $json[] = $detail['note'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `log_user`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `log_user` WHERE `id` != '0' $sql_domain $sql_type $sql_username"),
            "data" =>  $data
        );
        echo json_encode($output);
    }