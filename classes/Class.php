<?php
function name_log($type){
    if($type == 'SIGNUP'){
        return 'Đăng ký';
    }elseif($type == 'LOGIN'){
        return 'Đăng nhập';
    }elseif($type == 'UPDATESHOP'){
        return 'Cập nhật thông tin shop';
    }elseif($type == 'ADDDOMAIN'){
        return 'Thêm shop mới';
    }elseif($type == 'ADDTAG'){
        return 'Thêm Tag mới';
    }elseif($type == 'DELETETAG'){
        return 'Xóa Tag';
    }elseif($type == 'CREATEMINIGAME'){
        return 'Thêm minigame';
    }elseif($type == 'CREATEPRODUCT'){
        return 'Thêm danh mục';
    }elseif($type == 'CREATEACCOUNT'){
        return 'Thêm loại game';
    }elseif($type == 'CHANGEPASS'){
        return 'Đổi mật khẩu';
    }elseif($type == 'PLAYMINIGAME'){
        return 'Chơi trò chơi';
    }elseif($type == 'EDITEVENT'){
        return 'Sự kiện';
    }elseif($type == 'ADDPR'){
        return 'Thêm PR';
    }elseif($type == 'EDITPR'){
        return 'Cập nhật PR';
    }elseif($type == 'NHANQUAEVENT'){
        return 'Quà sự kiện';
    }elseif($type == 'WITHDRAWAL'){
        return 'Rút kim cương';
    }elseif($type == 'RECHARGE'){
        return 'Nạp thẻ';
    }elseif($type == 'ADDACOUNT'){
        return 'Thêm account';
    }elseif($type == 'EDITACOUNT'){
        return 'Sửa account';
    }elseif($type == 'DELETEACOUNT'){
        return 'Xóa account';
    }elseif($type == 'EDITPRODUCT'){
        return 'Sửa danh mục';
    }elseif($type == 'EDITUSER'){
        return 'Sửa thành viên';
    }elseif($type == 'CREATEDIAMONDBOX'){
        return 'Thêm hòm kim cương';
    }elseif($type == 'UPDATEALLSHOP'){
        return 'Cập nhật toàn bộ shop';
    }elseif($type == 'DELETEPRODUCT'){
        return 'Xóa danh mục';
    }elseif($type == 'WITHDRAWCASH'){
        return 'Rút tiền';
    }elseif($type == 'BUY'){
        return 'Mua tài khoản';
    }
}
function type_user($type){
    if($type == '1'){
        return 'Thành viên';
    }elseif($type == '2'){
        return 'Quản trị viên';
    }elseif($type == '3'){
        return 'Người quảng cáo';
    }elseif($type == '4'){
        return 'Cộng tác viên';
    }
}

function status_type($type){
    if($type == 'on'){
        return '<span class="badge bg-success">Chưa bán</span>';
    }elseif($type == 'off'){
        return '<span class="badge bg-danger">Đã bán</span>';
    }
}
function type_status($type){
    if($type == 'on'){
        return '<b class="btn btn-success rounded-pill">Bình thường</b>';
    }elseif($type == 'off'){
        return '<b class="btn btn-danger rounded-pill">Bị chặn</b>';
    }
}

function status_history($status){
    if($status == 1){
        $res['text'] = 'Đang chờ duyệt';
        $res['color'] = 'yellow';
    }elseif($status == 2){
        $res['text'] = 'Thành công';
        $res['color'] = 'green';
    }elseif($status == 3){
        $res['text'] = 'Thẻ thất bại';
        $res['color'] = 'red';
    }
    return $res;
}

function his_admin($status){
    if($status == 1){
        return '<span class="badge bg-secondary">Chờ duyệt</span>';
    }elseif($status == 2){
        return '<span class="badge bg-success">Thành công</span>';
    }elseif($status == 3){
        return '<span class="badge bg-danger">Thất bại</span>';
    }elseif($status == 4){
        return '<span class="badge bg-warning">Sai mệnh giá</span>';
    }
}

function status_callback($status){
    if($status == 1){
        $show = 'Chờ duyệt';
    }elseif($status == 2){
        $show = 'Thành công';
    }elseif($status == 3){
        $show = 'Thẻ thất bại';
    }elseif($status == 4){
        $show = 'Sai mệnh giá';
    }
    return $show;
}

function color_top($id){
    $result['icon'] = 'certification';
    if($id == 1){
        $result['color'] = 'red-600';
        $result['icon'] = 'shield';
    }elseif($id == 2){
        $result['color'] = 'blue-500';
    }elseif($id == 3){
        $result['color'] = 'yellow-500';
    }else{
        $result['color'] = 'teal-500';
    }
    return $result;
}

function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches)) {
        return true;
    } else {
        return false;
    }
}

function send_email($mail_nhan, $ten_nhan, $chu_de, $noi_dung, $bcc)
{
    global $dataWeb;
    $mail = new PHPMailer();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = "html";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $dataWeb['email_smtp']; // GMAIL STMP
    $mail->Password = $dataWeb['pass_email_smtp']; // PASS STMP
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($dataWeb['email_smtp'], $bcc);
    $mail->addAddress($mail_nhan, $ten_nhan);
    $mail->addReplyTo($dataWeb['email_smtp'], $bcc);
    $mail->isHTML(true);
    $mail->Subject = $chu_de;
    $mail->Body = $noi_dung;
    $mail->CharSet = 'UTF-8';
    $send = $mail->send();
    return $send;
}
function upload_multiple_file($name,$folder,$i = 0){
    $rand = rand(0,99999999999999);
    $arr_type = ['jpg', 'jpeg', 'png', 'gif'];
    $destination_path = realpath($_SERVER["DOCUMENT_ROOT"]);
    $path = $destination_path.'/upload/'.$folder.'/'; // patch lưu file
    if($_FILES[$name]["error"][$i] == 0){
        $arr = explode(".", $_FILES[$name]["name"][$i]);
        if(in_array(strtolower(end($arr)), $arr_type)){
            @move_uploaded_file($_FILES[$name]["tmp_name"][$i], $path.md5($_FILES[$name]["name"][$i].$rand).".".end($arr));
        }
        $image = DOMAIN."/upload/$folder/".md5($_FILES[$name]["name"][$i].$rand).".".end($arr);
    }
    return $image;
}
function upload_file($name,$folder){ // upload file lên hệ thống
    $rand = rand(0,99999999999999);
    $arr_type = ['jpg', 'jpeg', 'png', 'gif'];
    $destination_path = realpath($_SERVER["DOCUMENT_ROOT"]);
    $path = $destination_path.'/upload/'.$folder.'/'; // patch lưu file
    if($_FILES[$name]["error"] == 0){
        $arr = explode(".", $_FILES[$name]["name"]);
        if(in_array(strtolower(end($arr)), $arr_type)){
            @move_uploaded_file($_FILES[$name]["tmp_name"], $path.md5($_FILES[$name]["name"].$rand).".".end($arr));
        }
        $image = DOMAIN."/upload/$folder/".md5($_FILES[$name]["name"].$rand).".".end($arr);
    }
    return $image;
}
function update_file($name,$old_link,$folder){ // cập nhật lại link web
    $rand = rand(0,99999999999999);
    $arr_type = ['jpg', 'jpeg', 'png', 'gif'];
    $destination_path = realpath($_SERVER["DOCUMENT_ROOT"]);
    $path = $destination_path.'/upload/'.$folder.'/'; // patch lưu file
    if($_FILES[$name]["error"] == 0) {
        $arr = explode(".", $_FILES[$name]["name"]);
        if(in_array(strtolower(end($arr)), $arr_type)){
            @move_uploaded_file($_FILES[$name]["tmp_name"], $path.md5($_FILES[$name]["name"].$rand).".".end($arr));
        }
        $image = DOMAIN."/upload/$folder/".md5($_FILES[$name]["name"].$rand).".".end($arr);
    }else{
        $image = $old_link;
    }
    return $image;
}

function parse_order_id($des)
{
    global $MEMO_PREFIX;
    $re = '/'.$MEMO_PREFIX.'\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0 )
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength ));
    return $orderId ;
}

function explode_des($description)
{
    $conten = 'naptien';
    $pos = strpos($description, $conten);
    $id = substr($description, $pos + strlen($conten));
    $id = trim($id);
    $id = substr($id, 0, strpos($id, ' '));
    
    $uid = preg_replace('/\D/', '', $id);
    
    return $conten . ' ' . $uid;
}

function explode_bank($description){ // lấy id user từ nội dung chuyển khoản
    $explode = explode(' ', $description); // lấy type và username
    if($explode['0'] == 'MB'){
        $json['id'] = explode('.', $explode['2'])[0];
        $json['type'] = $explode['1'];
    }elseif($explode['0'] == 'MBVCB'){
        $json['id'] = $explode['5'];
        $json['type'] = $explode['3'];
    }else{
        $json['id'] = $explode['1'];
        $json['type'] = $explode['0'];
    }
    return $json;
}

function randomPassword() {
    $characters = '0123456789';
    $randomString = '';
  
    for ($i = 0; $i < 8; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

function recharge_payin($api,$type,$amount,$code,$serial,$request_id){

    $url = "https://napcard.vn/ChargingCard/Ver1";
    
    $data_post = array();
        $data_post['apikey'] = $api;
        $data_post['trans'] = $request_id;
        $data_post['cardtype'] = $type;
        $data_post['amount'] = $amount;
        $data_post['serial'] = $serial;
        $data_post['cardcode'] = $code;
    $data = http_build_query($data_post);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    curl_setopt($ch, CURLOPT_REFERER, $actual_link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

function recharge_gachthe1s($type,$amount,$code,$serial,$request_id){

    global $dataWeb;
    $command = 'charging';  // Nap the
    $url = 'https://gachthe1s.com/chargingws/v2';
	$partner_id = $dataWeb['partner_id'];
    $partner_key = $dataWeb['partner_key'];
  
    $dataPost = array();
        $dataPost['request_id'] = $request_id;
        $dataPost['code'] = $code;
        $dataPost['partner_id'] = $partner_id;
        $dataPost['serial'] = $serial;
        $dataPost['telco'] = $type;
        $dataPost['command'] = $command;
        ksort($dataPost);
        $sign = $partner_key;

        foreach ($dataPost as $item) {
            $sign .= $item;
        }
        
        $mysign = md5($sign);

        $dataPost['amount'] = $amount;
        $dataPost['sign'] = $mysign;

    $data = http_build_query($dataPost);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    curl_setopt($ch, CURLOPT_REFERER, $actual_link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

function draw_diamond($api,$idgame,$amount,$request_id){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://napcard.vn/ChargingKC/v2');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $charging=array('APIkey' => $api, "playerid" => $idgame, "menhgia" => $amount, "content" => $request_id);
    curl_setopt($ch, CURLOPT_POST,count($charging));
    curl_setopt($ch, CURLOPT_POSTFIELDS,$charging);
    $msg=curl_exec($ch);
    curl_close($ch);
    return json_decode($msg, true);
}

function getHeader(){
    $headers = array();
    $copy_server = array(
        'CONTENT_TYPE'   => 'Content-Type',
        'CONTENT_LENGTH' => 'Content-Length',
        'CONTENT_MD5'    => 'Content-Md5',
    );
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                $headers[$key] = $value;
            }
        } elseif (isset($copy_server[$key])) {
            $headers[$copy_server[$key]] = $value;
        }
    }
    if (!isset($headers['Authorization'])) {
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
            $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
            $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
        }
    }
    return $headers;
}

function getOS(){ // get thiết bị
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser(){ // get trình duyệt
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/coc_coc_browser/i'    => 'Cốc Cốc'
    );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}
function myip(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }else{  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip;
}

function JsonMsg($status,$msg){
    return json_encode(array("status" => $status,"msg" => $msg));
}