<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$column = array('id', 'username', 'bank', 'name', 'stk', 'amount', 'status', 'status' , 'note', 'created_at');
$start = Anti_xss($_POST['start']);
$length = Anti_xss($_POST['length']);

    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2' && $data_user['type'] != '4'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($start < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }elseif($length < 0){
        echo JsonMsg('error','Thiếu trường dữ liệu');
    }else{
        if($data_user['type'] == '2'){
            $sql_username = "";
        }elseif($data_user['type'] == '4'){
            $sql_username = "AND `username` = '{$data_user['username']}'";
        }
        if(isset($_POST['order'])){
            $orderby = 'ORDER BY `'.$column[$_POST['order']['0']['column']].'` '.$_POST['order']['0']['dir'].'';
        }else{
            $orderby = "ORDER BY `id` DESC";
        }
        foreach($db->fetch_assoc("SELECT * FROM `withdraw_cash` WHERE `id` != '0' $sql_username $orderby LIMIT $start, $length", 0) as $info){
            $json = array();
            $json[] = $info['id'];
            $json[] = $info['username'];
            $json[] = $info['bank'];
            $json[] = $info['name'];
            $json[] = $info['stk'];
            $json[] = number_format($info['amount']);
            $json[] = his_admin($info['status']);
            if($data_user['type'] == '2'){
                if($info['status'] == '1'){
                    $json[] = '<button data-bs-toggle="modal" data-bs-target="#info" data-amount="'.number_format($info['amount']).'" data-id="'.$info['id'].'" data-note="'.$info['note'].'" class="btn btn-success mt-2 text-white"><i class="fas fa-pen"></i></button>';
                }else{
                    $json[] = '<button type="button" class="btn btn-success mt-2 text-white"><i class="fas fa-check"></i></button>';
                }
            }
            $json[] = $info['note'];
            $json[] = date('H:i d-m-Y',$info['created_at']);
            $data[] = $json;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $db->num_rows("SELECT * FROM `withdraw_cash` $sql_username"),
            "recordsFiltered" => $db->num_rows("SELECT * FROM `withdraw_cash` WHERE `id` != '0' $sql_username"),
            "data" =>  $data
        );
        echo json_encode($output);
    }