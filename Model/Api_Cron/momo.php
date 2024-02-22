<?php 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$query = $db->fetch_assoc("SELECT * FROM `setting_apibank` WHERE `type` = 'MOMO' AND `status` = 'on' AND `site` = '{$site}'", 1);
$detail = json_decode($query['detail'], true);
$token = $detail['apikey'];
$result = json_decode(file_get_contents("https://api.sieuthicode.net/historyapimomo/$token"), true);
foreach ($result['momoMsg']['tranList'] as $data) {
    $partnerId      = $data['partnerId'];
    $comment        = strtolower($data['comment']);
    $tranId         = $data['tranId'];
    $partnerName    = $data['partnerName'];
    $amount         = $data['amount'];
    $iduser         = explode_bank($comment);
    #lấy thông tin thành viên
    $query_user = $db->fetch_assoc("SELECT * FROM `users` WHERE `id` = '{$iduser['id']}'", 1);
    if($iduser['type'] == 'naptien'){
        if($db->num_rows("SELECT * FROM `users` WHERE `id` = '{$iduser['id']}'") > 0) {
            if($db->num_rows("SELECT * FROM `HistoryBank` WHERE `trandid` = '{$tranId}'") < 1) {
                
                $cash = $amount * ((100+20)/100);
                $user = detail_users($query_user['username']);
                
                $db->query("INSERT INTO `HistoryBank`(`username`, `bank`, `amount`, `trandid`, `updated_at`, `created_at`) VALUES ('{$query_user['username']}', 'MOMO', '{$amount}', '{$tranId}', '{$date}', '{$date}')");
                $db->query("UPDATE `users` SET `cash` = `cash` + '{$cash}',`updated_at` = '{$date}' WHERE `username` = '{$query_user['username']}'");
                
                $db->query("INSERT INTO `top`(`username`, `name`, `amount`, `site`, `created_at`, `updated_at`) VALUES 
                ('{$query_user['username']}', '{$user['name']}', '{$amount}', '{$site}', '{$date}', '{$date}')");
                
                echo 'Thêm giao dịch mới thành công<br>';
            }else{
                echo 'Mã giao dịch này đã tồn tại trên hệ thống<br>';
            }
        }else{
            echo 'Không tìm thấy thành viên này<br>';
        }
    }else{
        echo 'Nội dung giao dịch không hợp lệ<br>';
    }
}