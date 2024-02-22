<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
    $sql_show = "SELECT * FROM `product_game` WHERE `product` = 'minigame' ";
    foreach($db->fetch_assoc($sql_show, 0) as $info){
        $detail = json_decode($info['detail'], true);
        for ($i=0; $i < count($detail['data']); $i++) { 
            if($detail['data'][$i]['tyle_type'] == "KC"){
                $type = $info['type_category'];
                $name_wheel = $detail['name_product'];
                $arr_data[] = $detail['data'][$i]['tyle_value'];

                $file = "user.txt";
                $file_arr = file($file);
                $num_lines = count($file_arr);
                $last_arr_index = $num_lines - 1;
                $rand_index = rand(0, $last_arr_index);
                $rand_text = $file_arr[$rand_index];
            } 
        }

        $rand = rand(0,count($arr_data)-1);
        $wheel['type'] = $type;
        $wheel['name_wheel'] = $name_wheel;
        $wheel['msg'] = 'Trúng '.$arr_data[$rand].' Kim Cương';
        $wheel['name'] = $rand_text;
        $full_wheel = addslashes(json_encode($wheel));
        $db->query("INSERT INTO `log_wheel`(`username`, `type`, `detail`, `created_at`, `updated_at`) VALUES ('{$rand_text}', '{$type}', '{$full_wheel}', '{$date}', '{$date}')");
        
    }

    
