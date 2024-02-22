<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$new_cash = Anti_xss($_POST['new_cash']);
$persent_cash = Anti_xss($_POST['persent_cash']);
$status_diamond = Anti_xss($_POST['status_diamond']);
    if(!@$user){
        echo JsonMsg('error','Bạn chưa đăng nhập');
    }elseif($data_user['type'] != '2'){
        echo JsonMsg('error','Bạn không có quyền truy cập vào trang này');
    }elseif($new_cash < 0){
        echo JsonMsg('error','Số tiền tặng cho người mới không được bé hơn 0đ');
    }elseif($persent_cash < 0 || $persent_cash > 100){
        echo JsonMsg('error','Số Khuyến mại không được bé hơn 0% và lớn hơn 100%');
    }elseif(empty($status_diamond)){
        echo JsonMsg('error','Vui lòng chọn trạng thái rút kim cương');
    }else{
        $background = update_file('background',$dataWeb['background'],'setting');
        $image_buy = update_file('image_buy',$dataWeb['image_buy'],'setting');
        $image_try = update_file('image_try',$dataWeb['image_try'],'setting');
        $image_play = update_file('image_play',$dataWeb['image_play'],'setting');
        $btn_quay = update_file('btn_quay',$dataWeb['btn_quay'],'setting');
        $image_upthe = update_file('image_upthe',$dataWeb['image_upthe'],'setting');
        foreach($db->fetch_assoc("SELECT * FROM `list_domain` WHERE `id` != '0'", 0) as $info){
            $detail_info = json_decode($info['detail'], true);
            $detail['new_cash'] = $new_cash;
            $detail['persent_cash'] = $persent_cash;
            $detail['title'] = $detail_info['title'];
            $detail['mota'] = $detail_info['mota'];
            $detail['status_web'] = $detail_info['status_web'];
            $detail['status_card'] = $detail_info['status_card'];
            $detail['status_diamond'] = $status_diamond;
            $detail['status_noti'] = $detail_info['status_noti'];
            $detail['apikey_card'] = $detail_info['apikey_card'];
            $detail['apikey_diamond'] = $detail_info['apikey_diamond'];
            $detail['APP_ID'] = $detail_info['APP_ID'];
            $detail['APP_SECRET'] = $detail_info['APP_SECRET'];
            $detail['id_fanpage'] = $detail_info['id_fanpage'];
            $detail['thongbao'] = $detail_info['thongbao'];
            $detail['banner'] = $detail_info['banner'];
            $detail['logo'] = $detail_info['logo'];
            $detail['background'] = $background;
            $detail['image_buy'] = $image_buy;
            $detail['image_try'] = $image_try;
            $detail['image_play'] = $image_play;
            $detail['btn_quay'] = $btn_quay;
            $detail['image_upthe'] = $image_upthe;
            $full_detail = addslashes(json_encode($detail));
            $db->query("UPDATE `list_domain` SET `detail` = '{$full_detail}',`updated_at` = '{$date}' WHERE `id` = '{$info['id']}'");
        }
        insert_log($data_user['username'], 'UPDATEALLSHOP', 'Sửa thông tin của tất cả trang', $old_cash = $data_user['cash'], $change_cash = 0, $new_cash = $data_user['cash'], $old_cash_diamond = $data_user['diamond'], $change_cash_diamond = 0, $new_cash_diamond = $data_user['diamond']);
        echo JsonMsg('success','Cập nhật thành công');
    }