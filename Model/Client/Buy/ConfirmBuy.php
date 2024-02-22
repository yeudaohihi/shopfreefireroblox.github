<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$id = Anti_xss($_POST['id']);
$arr_data = array();
$query = $db->fetch_assoc("SELECT * FROM `list_account` WHERE `id` = '{$id}'", 1);
$detail = json_decode($query['detail'], true);
$price = $query['cash'] - (($query['cash'] * $query['sale']) / 100);
    if($dataWeb['status_web'] == 'off'){
        echo JsonMsg('error', 'Trang web hiện tại đang bảo trì tạm thời');
    }elseif(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error', 'Bạn đã bị chặn, vui lòng liên hệ admin');
    }elseif(empty($id)){
        echo JsonMsg('error','Vui lòng chọn tài khoản muốn giao dịch');
    }elseif($arr_user['status'] == 'off'){
        echo JsonMsg('error','Bạn đã bị chặn bởi admin');
    }elseif($data_user['type'] == '4'){
        echo JsonMsg('error','Bạn không thể thực hiện giao dịch này');
    }elseif($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}'") < 1){
        echo JsonMsg('error','Không tìm thấy tài khoản bạn chọn');
    }elseif($db->num_rows("SELECT * FROM `list_account` WHERE `id` = '{$id}' AND `status` = 'off'") > 0){
        echo JsonMsg('error','Tài khoản này đã được mua bởi người khác');
    }elseif($data_user['cash'] < $price){
        echo JsonMsg('error','Bạn không đủ tiền để thực hiện giao dịch này');
    }else{
        for ($i=0; $i < count($detail['data']); $i++) {
            if($data_user['type'] == '3'){
                if($detail['data'][$i]['show'] == 'on'){
                    array_push($arr_data, array("id" => $i, "label" => $detail['data'][$i]['label'], "type" => $detail['data'][$i]['type'], "name" => $detail['data'][$i]['name'], "value" => $detail['data'][$i]['value'], "show" => $detail['data'][$i]['show'], $detail['data'][$i]['name'] => $detail['data'][$i]['value']));
                }
            }else{
                array_push($arr_data, array("id" => $i, "label" => $detail['data'][$i]['label'], "type" => $detail['data'][$i]['type'], "name" => $detail['data'][$i]['name'], "value" => $detail['data'][$i]['value'], "show" => $detail['data'][$i]['show'], $detail['data'][$i]['name'] => $detail['data'][$i]['value']));
            }
        }
        $json['name_product'] = $detail['name_product'];
        $json['data'] = $arr_data;
        $full_detail = addslashes(json_encode($json));
        insert_log($data_user['username'], 'BUY', 'Mua tài khoản #'.$id.' '.$detail['name_product'].'', $old_cash = $data_user['cash'], $change_cash = $price, $new_cash = $data_user['cash']-$price, $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        $db->query("INSERT INTO `history_buy`(`id_acc`, `type_category`, `username`, `username_post`, `detail`, `cash`, `site`, `updated_at`, `created_at`) VALUES ('{$id}', '{$query['type_category']}', '{$data_user['username']}', '{$query['username_post']}', '{$full_detail}', '{$price}', '{$site}', '{$date}', '{$date}')");
        $db->query("UPDATE `list_account` SET `status` = 'off',`updated_at` = '{$date}' WHERE `id` = '{$id}'");
        $db->query("UPDATE `users` SET `cash` = `cash` - '{$price}',`updated_at` = '{$date}' WHERE `username` = '{$data_user['username']}'"); // trừ tiền thành viên khi mua thành công
        $db->query("UPDATE `users` SET `cash` = `cash` + '{$price}',`updated_at` = '{$date}' WHERE `username` = '{$query['username_post']}'"); // cộng tiền cho CTV khi giao dịch tành công
        echo JsonMsg('success','Bạn đã mua thành công tài khoản #'.$id.'');
    }