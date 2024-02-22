<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
header('Content-Type: application/json');
$numrolllop = Anti_xss(preg_replace('/\D/', '',$_POST['numrolllop']));
$typeRoll = Anti_xss($_POST['typeRoll']);
$type = Anti_xss($_POST['type']);
$listgift = array();
$arr_gift = array();
if($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `site` = '{$site}'") == 0){
    $sql = "SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `site` = 'ALL'";
}else{
    $sql = "SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `site` = '{$site}'";
}
$query = $db->fetch_assoc($sql, 1);
$detail = json_decode($query['detail'], true);
$data_detail = $detail['data'];
#tính số lượt quay
	$gia = $detail['cash'] * $numrolllop;
    if($db->num_rows("SELECT * FROM `product_game` WHERE `type_category` = '{$type}' AND `site` IN ('ALL','{$site}')") < 1){
        $json['status'] = 'error';
        $json['msg'] = 'Không tìm thấy dữ liệu trò chơi';
    }elseif($numrolllop < 0){
        $json['status'] = 'error';
        $json['msg'] = 'Số lượt chơi không được bé hơn 0';
    }elseif($dataWeb['status_web'] == 'off'){
        $json['status'] == 'error';
        $json['msg'] = 'Trang web hiện tại đang bảo trì';
    }elseif($numrolllop < 0 || $numrolllop > 10){
        $json['status'] = 'error';
        $json['msg'] = 'Số lượt quay không hợp lệ';
    }else{
        if($typeRoll == 'play'){
            if(!@$user){
                $json['status'] = 'login';
                $json['msg'] = 'Bạn chưa đăng nhập';
            }elseif($arr_user['status'] == 'off'){
                $json['status'] = 'error';
                $json['msg'] = 'Bạn đã bị chặn, vui lòng liên hệ admin';
            }elseif($data_user['cash'] < $gia){
                $json['status'] = 'error';
                $json['msg'] = 'Bạn không đủ tiền để thực hiện giao dịch này';
            }else{
                if($detail['cash'] == '0'){
                    if($data_user['turn_wheel'] < $numrolllop){
                        $json['status'] = 'error';
                        $json['msg'] = 'Bạn không đủ lượt quay';
                    }else{
                        $loop_wheel = loop_wheel($numrolllop,$type,$detail,$query);
                        insert_log($data_user['username'], 'PLAYMINIGAME', 'Chơi trò chơi '.$detail['name_product'].' x'.$numrolllop.'', $old_cash = $data_user['cash'], $change_cash = $loop_wheel['count_price']+$gia, $new_cash = $data_user['cash']-$gia+$loop_wheel['count_price'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = $loop_wheel['count_kc'], $new_cash_diamond = $data_user['diamond']+$loop_wheel['count_kc']);
                        $db->query("UPDATE `users` SET `turn_wheel` = `turn_wheel` - '{$numrolllop}',`cash` = `cash` + '{$loop_wheel['count_price']}',`diamond` = `diamond` + '{$loop_wheel['count_kc']}',`updated_at` = '{$date}' WHERE `username` = '{$data_user['username']}'");
                        
                        if($data_array[$loop_wheel['get_num']]['tyle_type'] == 'NO'){
                            $locale = '1';
                        }else{
                            $locale = '0';
                        }
                        $json['msg'] = array("name" => $loop_wheel['msg'], "pos" => $loop_wheel['get_num']+1, "locale" => $locale, "image" => $loop_wheel['img'], "num_roll_remain" => $data_user['turn_wheel']-$numrolllop);
                        $json['typeRoll'] = 'Quay Thật';
                        $json['arr_gift'] = $loop_wheel['arr_gift'];
                        $json['total'] = number_format($loop_wheel['count_kc']);
                        $json['price'] = number_format($gia); 
                        if($query['type'] == 'LATHINH'){
                            $json['listgift'] = $loop_wheel['listgift'];
                        }

                        $wheel['msg'] = 'Trúng '.$loop_wheel['count_kc'].' Kim Cương';
                        $wheel['name'] = $arr_user['name'];
                        $full_wheel = addslashes(json_encode($wheel));
                        if($loop_wheel['count_kc'] > 1){
                            $db->query("INSERT INTO `log_wheel`(`username`, `type`, `detail`, `site`, `created_at`, `updated_at`) VALUES ('{$data_user['username']}', '{$type}', '{$full_wheel}', '{$web}', '{$date}', '{$date}')");
                        }
                    }
                }else{
                    $loop_wheel = loop_wheel($numrolllop,$type,$detail,$query);
                    insert_log($data_user['username'], 'PLAYMINIGAME', 'Chơi trò chơi '.$detail['name_product'].' x'.$numrolllop.'', $old_cash = $data_user['cash'], $change_cash = $loop_wheel['count_price']+$gia, $new_cash = $data_user['cash']-$gia+$loop_wheel['count_price'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = $loop_wheel['count_kc'], $new_cash_diamond = $data_user['diamond']+$loop_wheel['count_kc']);
                    $db->query("UPDATE `users` SET `cash` = `cash` - '{$gia}',`cash` = `cash` + '{$loop_wheel['count_price']}',`diamond` = `diamond` + '{$loop_wheel['count_kc']}',`updated_at` = '{$date}' WHERE `username` = '{$data_user['username']}'");
                    
                    if($data_array[$loop_wheel['get_num']]['tyle_type'] == 'NO'){
                        $locale = '1';
                    }else{
                        $locale = '0';
                    }
                    $json['msg'] = array("name" => $loop_wheel['msg'], "pos" => $loop_wheel['get_num']+1, "locale" => $locale, "image" => $loop_wheel['img'], "num_roll_remain" => floor(($data_user['cash']-$gia+$loop_wheel['count_price'])/$detail['cash']));
                    $json['typeRoll'] = 'Quay Thật';
                    $json['arr_gift'] = $loop_wheel['arr_gift'];
                    $json['total'] = number_format($loop_wheel['count_kc']);
                    $json['price'] = number_format($gia);
                    if($query['type'] == 'LATHINH'){
                        $json['listgift'] = $loop_wheel['listgift'];
                    }

                    $wheel['msg'] = 'Trúng '.$loop_wheel['count_kc'].' Kim Cương';
                    $wheel['name'] = $arr_user['name'];
                    $full_wheel = addslashes(json_encode($wheel));
                    if($loop_wheel['count_kc'] > 1){
                        $db->query("INSERT INTO `log_wheel`(`username`, `type`, `detail`, `site`, `created_at`, `updated_at`) VALUES ('{$data_user['username']}', '{$type}', '{$full_wheel}', '{$web}', '{$date}', '{$date}')");
                    }
                }
            }
        }elseif($typeRoll == 'try'){
            for($i=0; $i < $numrolllop; $i++){
                $get_num = rand(0,count($data_detail)-2);
                if($data_detail[$get_num]){
                    if($data_detail[$get_num]['tyle_type'] == 'KCRD'){
                        $kc = rand(12,500);
                    }elseif($data_detail[$get_num]['tyle_type'] == 'KC'){
                        $kc = $data_detail[$get_num]['tyle_value'];
                    }elseif($data_detail[$get_num]['tyle_type'] == 'PRICE'){
                        $kc = '0';
                        $price = $data_detail[$get_num]['tyle_value'];
                    }elseif($data_detail[$get_num]['tyle_type'] == 'NO'){
                        $kc = '0';
                        $price = '0';
                    }
                    $msg = str_replace('...',$kc,$data_detail[$get_num]['tyle_text']);
                }
                array_push($arr_gift, array("title" => $msg));
                $count_kc += $kc;
                if($query['type'] == 'LATHINH'){
                    $img = $data_detail[$get_num]['item'];
                    for($a=0; $a < count($data_detail); $a++){
                        if($a != $get_num){
                            array_push($listgift, array("image" => $data_detail[$a]['item']));
                        }
                    }
                }
            }
            if($data_detail[$get_num]['tyle_type'] == 'NO'){
                $locale = '1';
            }else{
                $locale = '0';
            }
            $json['msg'] = array("name" => $msg, "pos" => $get_num+1, "locale" => $locale, "num_roll_remain" => '1', "image" => $data_detail[$get_num]['item']);
            $json['typeRoll'] = 'Quay Thử';
            $json['arr_gift'] = $arr_gift;
            $json['total'] = number_format($count_kc);
            $json['price'] = number_format($gia);
            if($query['type'] == 'LATHINH'){
                $json['listgift'] = $listgift;
            }
        }
    }
    echo json_encode($json);