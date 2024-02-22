<?php
function insert_log($username, $type, $note, $old_cash = 0, $change_cash = 0, $new_cash = 0, $old_cash_diamond = 0, $change_cash_diamond = 0, $new_cash_diamond = 0){
    global $db,$site,$date,$user_agent;
    $log['old_cash'] = $old_cash;
    $log['change_cash'] = $change_cash;
    $log['new_cash'] = $new_cash;
    $log['old_cash_diamond'] = $old_cash_diamond;
    $log['change_cash_diamond'] = $change_cash_diamond;
    $log['new_cash_diamond'] = $new_cash_diamond;
    $log['note'] = $note;
    $log['ip'] = myip();
    $log['browser'] = getBrowser();
    $log['device'] = getOS();
    $log['user_agent'] = $user_agent;
    $log['header'] = getHeader();
    $detail_log = addslashes(json_encode($log));
    $db->query("INSERT INTO `log_user`(`type`, `username`, `detail`, `site`, `updated_at`, `created_at`) VALUES ('{$type}', '{$username}', '{$detail_log}', '{$site}', '{$date}', '{$date}')");
}
function detail_setting($domain){ // get thông tin domain
    global $db;
    $query = $db->fetch_assoc("SELECT `detail` FROM `list_domain` WHERE `domain` = '{$domain}'", 1);
    $detail = json_decode($query['detail'], true);
    return $detail;
}
function detail_users($username){
    global $db;
    $query = $db->fetch_assoc("SELECT `detail` FROM `users` WHERE `username` = '{$username}'", 1);
    $detail = json_decode($query['detail'], true);
    return $detail;
}
function get_detail($namedb,$id){
    global $db;
    $query = $db->fetch_assoc("SELECT `detail` FROM `$namedb` WHERE `id` = '{$id}'", 1);
    $detail = json_decode($query['detail'], true);
    return $detail;
}

function get_data($namedb,$username){
    global $db;
    $query = $db->fetch_assoc("SELECT * FROM `$namedb` WHERE `username` = '{$username}'", 1);
    return $query;
}

function get_data_id($namedb,$id){
    global $db;
    $query = $db->fetch_assoc("SELECT * FROM `$namedb` WHERE `id` = '{$id}'", 1);
    return $query;
}
function array_account($type){
    global $db;
    $query_account = $db->fetch_assoc("SELECT * FROM `AccountReward` WHERE `status` = 'on' AND `type_category` = '{$type}'", 1);
    $db->query("UPDATE `AccountReward` SET `status` = 'off' WHERE `id` = '{$query_account['id']}'");
    $arr_data[] = array("taikhoan" => $query_account['taikhoan'], "matkhau" => $query_account['matkhau'], "code" => $query_account['code']);
    return $arr_data;
}

function loop_wheel($numrolllop,$type_category,$data_detail,$query){
    global $db,$data_user,$date,$site;
    $day = date('d-m-Y');
    $data_array = $data_detail['data'];
    $arr_gift = array();
    $listgift = array();
    for ($i=0; $i < $numrolllop; $i++) {
        $Count_History = $db->num_rows("SELECT * FROM `history_minigame` WHERE `username` = '{$data_user['username']}' AND `type_category` = '{$type_category}' AND DATE_FORMAT(FROM_UNIXTIME(history_minigame.created_at), '%d-%m-%Y') = '{$day}'"); // get từ user ra
        $luotquay = $Count_History % 10;
        if($data_user['type'] == '3'){
            $quyluat = explode(',', $data_detail['lenh_admin']);
        }else{
            $quyluat = explode(',', $data_detail['lenh_user']);
        }
        $get_num = $quyluat[$luotquay]-1;
        if($data_array[$get_num]){
            if($data_array[$get_num]['tyle_type'] == 'KCRD'){
                $data_array_kimcuong = explode(',',$data_array[$get_num]['tyle_value']);
                $kc = rand($data_array_kimcuong[0],$data_array_kimcuong[1]);
                $price = '0';
            }elseif($data_array[$get_num]['tyle_type'] == 'KC'){
                $kc = $data_array[$get_num]['tyle_value'];
                $price = '0';
            }elseif($data_array[$get_num]['tyle_type'] == 'PRICE'){
                $price = $data_array[$get_num]['tyle_value'];
                $kc = '0';
            }elseif($data_array[$get_num]['tyle_type'] == 'ACCOUNT'){ // lấy thông tin tài khoản nếu trúng
                if($db->num_rows("SELECT * FROM `AccountReward` WHERE `status` = 'on' AND `type_category` = '{$type_category}'") >= 1){
                    $log['data_account'] = array_account($type_category);
                    $msg = str_replace('...',$kc,$data_array[$get_num]['tyle_text']);
                }else{
                    $msg = 'Tài khoản của vòng quay đã hết';
                    $price = $data_detail['cash'];
                }
                $price = '0';
                $kc = '0';
            }
            if($data_array[$get_num]['tyle_type'] != 'ACC'){
                $msg = str_replace('...',$kc,$data_array[$get_num]['tyle_text']);
            }
        }
        array_push($arr_gift, array("title" => $msg));
        $img = $data_array[$get_num]['item'];
        if($query['type'] == 'LATHINH'){
            for($a=0; $a < count($data_array); $a++){
                if($a != $get_num){
                    array_push($listgift, array("image" => $data_array[$a]['item']));
                }
            }
        }

        $count_price += $price;
        $count_kc += $kc;
        $log['name_product'] = $data_detail['name_product'];
        $log['msg'] = $msg;
        $log['cash'] = $data_detail['cash'];
        $log['price_old'] = $data_user['cash'];
        $log['price_change'] = $data_detail['cash'];
        $log['price_new'] = $data_user['cash']-$detail['cash']+$price;
        $log['diamond_old'] = $data_user['diamond'];
        $log['diamond_change'] = $kc;
        $log['diamond_new'] = $data_user['diamond']+$kc;
        $full_log = addslashes(json_encode($log));
        $db->query("INSERT INTO `history_minigame`(`username`, `type_category`, `detail`, `site`, `created_at`, `updated_at`) VALUES ('{$data_user['username']}', '{$type_category}', '{$full_log}', '{$site}', '{$date}', '{$date}')");
        unset($log);
    }
    $array['count_price'] = $count_price;
    $array['count_kc'] = $count_kc;
    $array['get_num'] = $get_num;
    $array['msg'] = $msg;
    $array['img'] = $img;
    $array['arr_gift'] = $arr_gift;
    $array['listgift'] = $listgift;
    return $array;
}