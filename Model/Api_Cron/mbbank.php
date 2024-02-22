<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$query = $db->fetch_assoc("SELECT * FROM `setting_apibank` WHERE `type` = 'BANK' AND `status` = 'on' AND `site` = '{$site}'", 1);
$detail = json_decode($query['detail'], true);
$token = $detail['apikey'];
$password = $detail['password'];
$stk = $detail['stk'];
$result = json_decode(file_get_contents("https://api.sieuthicode.net/historyapimbbank/$token"), true);
foreach ($result['data'] as $data) {
    $Description = strtolower($data['description']);
    $tranId = $data['refNo'];
    $amount = $data['creditAmount'];
    $iduser = explode_des($Description);

    if(preg_replace("/[^a-z]+/", "", $iduser) == 'naptien'){
        $id_user = parse_order_id($iduser);
        $query_user = $db->fetch_assoc("SELECT * FROM `users` WHERE `id` = '{$id_user}'", 1);
        if($db->num_rows("SELECT * FROM `users` WHERE `username` = '{$query_user['username']}'") > 0){
            if($db->num_rows("SELECT * FROM `HistoryBank` WHERE `trandid` = '{$tranId}'") < 1) {
                
                $cash = $amount * ((100+20)/100);
                $user = detail_users($query_user['username']);
                
                $db->query("INSERT INTO `HistoryBank`(`username`, `bank`, `amount`, `trandid`, `updated_at`, `created_at`) VALUES ('{$query_user['username']}', 'MB BANK', '{$amount}', '{$tranId}', '{$date}', '{$date}')");
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$cash}',`updated_at` = '{$date}' WHERE `username` = '{$query_user['username']}'");
                
                $db->query("INSERT INTO `top`(`username`, `name`, `amount`, `site`, `created_at`, `updated_at`) VALUES 
                ('{$query_user['username']}', '{$user['name']}', '{$amount}', '{$site}', '{$date}', '{$date}')");
                
                echo 'Thêm giao dịch mới thành công<br>';
            }else{
                echo 'Giao dịch này đã tồn tại trên hệ thống<br>';
            }
        }else{
            echo 'Không tìm thấy thông tin thành viên<br>';
        }
    }else{
        echo 'nội dung chuyển không hợp lệ<br>';
    }
}