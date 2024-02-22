<?php
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
	        $status = Anti_xss($_POST['status']); // trạng thái, nạp thành công = thanhcong , nạp thất bại = thatbai
            $tranid = Anti_xss($_POST['content']); // trả content mà bạn đã gửi lên hệ thống.
			$sms = Anti_xss($_POST['sms']);

			$myfile = fopen("log_diamond.txt", "a+");
			fwrite($myfile, print_r($_POST, true).PHP_EOL);
			fclose($myfile);

            $sql_data = "SELECT * FROM `withdraw` WHERE `request_id` = '{$tranid}' AND `status` = 1 LIMIT 1";
        	$check = $db->num_rows($sql_data);

        	if($check >= 1){
    	        $info  = $db->fetch_assoc($sql_data, 1);
				$id_game = $info[idgame];
    	        if($status == 'thanhcong'){
    	            $db->query("UPDATE `withdraw` SET `status` = 2 WHERE `idgame` = '{$id_game}' AND `request_id` = '{$tranid}'");
    	        }else{ //thất bại
                    $kc = $info[diamond];
    	            $db->query("UPDATE `withdraw` SET `status` = 3 WHERE `idgame` = '{$id_game}' AND `request_id` = '{$tranid}'");
    	            $db->query("UPDATE `users` SET `diamond` = `diamond` + '{$kc}' WHERE `username` = '{$info['username']}' "); //hoàn KC
    	        }
    	    }
?>