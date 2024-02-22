<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id' ,'username', 'idgame', 'amount', 'diamond', 'status', 'site', 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);
$username = Anti_xss($_POST['username']);
$idgame = Anti_xss($_POST['idgame']);
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
        $sql_idgame = '';
        $sql_status = '';
        $sql_site = '';
        if($username != ''){
            $sql_username = "AND `username` = '{$username}'";
        }elseif($idgame != ''){
            $sql_idgame = "AND `idgame` = '{$idgame}'";
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
        foreach($db->fetch_assoc("SELECT * FROM `withdraw` WHERE `id` != '0' $sql_username $sql_idgame $sql_status $sql_site $orderby LIMIT $start, $length", 0) as $info){
            $json = array();
            $json[] = $info['id'];
            $json[] = $info['username'];
            $json[] = detail_users($info['username'])['name'];
            $json[] = $info['idgame'];
            $json[] = number_format($info['amount']);
            $json[] = number_format($info['diamond']);
            $json[] = his_admin($info['status']);
            // $json[] = '<a href="/Dashboard/Setting/Card/EditCard/8" class="item-edit"><i class="far fa-edit"></i></a>
            // <a href="javascript:;" onclick="DeleteCard(8)" class="item-edit"><i class="fas fa-trash-alt"></i></a>';
            $json[] = $info['site'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `withdraw`"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `withdraw` WHERE `id` != '0' $sql_username $sql_idgame $sql_status $sql_site"),
            "data" =>  $data
        );
        echo json_encode($output);
    }