<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'id', 'type_category', 'username', 'type_category', 'type_category', 'site', 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$domain = Anti_xss($_POST['domain']);
$username = Anti_xss($_POST['username']);
$type_category = Anti_xss($_POST['type']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2' && $data_user['type'] != '3'){
        echo JsonMsg('error','Bạn không có quyền truy cập');
    }elseif($start < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }elseif($length < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        $sql_domain = '';
        $sql_type = '';
        $sql_username = '';
        $sql_site = '';
        if($domain != ''){
            $sql_domain = "AND `site` = '{$domain}'";
        }elseif($type_category != ''){
            $sql_type = "AND `type_category` = '{$type_category}'";
        }elseif($username != ''){
            $sql_username = "AND `username` = '{$username}'";
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
        foreach($db->fetch_assoc("SELECT * FROM `history_minigame` WHERE `id` != '0' $sql_domain $sql_type $sql_username $sql_site $orderby LIMIT $start, $length", 0) as $info){
            $detail = json_decode($info['detail'], true);
            $json = array();
            $json[] = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info" data-oldcash="'.number_format($detail['price_old']).'" data-changecash="'.number_format($detail['price_change']).'" data-newcash="'.number_format($detail['price_new']).'" data-olddiamond="'.number_format($detail['diamond_old']).'" data-changediamond="'.number_format($detail['diamond_change']).'" data-newdiamond="'.number_format($detail['diamond_new']).'"><i class="fa fa-eye"></i></button>';
            $json[] = $info['id'];
            $json[] = $detail['name_product'];
            $json[] = $info['username'];
            $json[] = number_format($detail['cash']);
            $json[] = $detail['msg'];
            $json[] = $info['site'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $count = $db->num_rows("SELECT * FROM `history_minigame`");
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `history_minigame`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `history_minigame` WHERE `id` != '0' $sql_domain $sql_type $sql_username $sql_site"),
            "data" =>  $data
        );
        echo json_encode($output);
    }