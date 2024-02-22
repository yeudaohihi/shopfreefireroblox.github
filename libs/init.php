<?php
// Require các thư viện PHP
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/DB.php'); // Database
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Session.php'); // Session
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Functions.php'); // Function cơ bản
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Class.php'); // Function viết thêm
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/ClassDB.php'); // Function viết thêm
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Facebook/autoload.php'); //SDK FB.
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Mail/class.smtp.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Mail/PHPMailerAutoload.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/classes/Mail/class.phpmailer.php');
error_reporting(0);
// Kết nối database
$db = new DB();
$db->connect();
$db->set_char('utf8');
$user_agent = $_SERVER['HTTP_USER_AGENT'];
// Thông tin chung
define('DOMAIN', 'https://' . $_SERVER['SERVER_NAME']);

date_default_timezone_set('Asia/Ho_Chi_Minh');
$site = $_SERVER['SERVER_NAME'];
$date_current = '';
$date_current = date("H:i:s d-m-Y");
$date = time();
$month = date('m');

// $dataWeb = json_decode($db->fetch_assoc("SELECT `detail` FROM `list_domain` WHERE `domain` = '{$site}'", 1)['detail'], true);
$dataWeb = json_decode($db->fetch_assoc("SELECT `detail` FROM `list_domain`", 1)['detail'], true);
$data_momo = json_decode($db->fetch_assoc("SELECT `detail` FROM `setting_apibank` WHERE `type` = 'MOMO'", 1)['detail'], true);
$data_bank = json_decode($db->fetch_assoc("SELECT `detail` FROM `setting_apibank` WHERE `type` = 'BANK'", 1)['detail'], true);

// Khởi tạo session
$session = new Session();
$session->start();

// Kiểm tra session
if ($session->get() != '') {
    $user = $session->get();
} else {
    $user = '';
}

$data_user = "";
// Nếu đăng nhập
if ($user) {
    // Lấy dữ liệu tài khoản
    $sql_get_data_user = "SELECT * FROM `users` WHERE `username` = '{$user}' AND `site` = '{$site}'";
    if ($db->num_rows($sql_get_data_user)) {
        $data_user = $db->fetch_assoc($sql_get_data_user, 1);
        if (empty($data_user)) {
            $data_user = "";
        } else {
            $data_user = $data_user;
            $arr_user = json_decode($data_user['detail'], true);
        }
    }
}
$info_lixi = get_data_id('config_giveaway', 1);
$js_lixi = get_detail('config_giveaway', $info_lixi['id']);

$data_otp = $db->fetch_assoc("SELECT `otp` FROM `confirm_otp` WHERE `username` = '{$data_user['username']}'", 1);

define("APP_ID", $dataWeb['APP_ID']);
define("APP_SECRET", $dataWeb['APP_SECRET']);
$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.4',
    'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : ''
]);

$nameshop = $_SERVER['SERVER_NAME'];
$tach_data = explode(".", $nameshop);
$duoi = $tach_data[(count($tach_data) - 2)];

$LoginDomain = "https://xboxtech.dangnhapshop.vip/$duoi.php";

$permissions = ['email'];  // set the permissions.
$LoginFacebook = "https://www.facebook.com/v2.12/dialog/oauth?client_id=" . APP_ID . "&redirect_uri=$LoginDomain&response_type=token";
// gọi sẵn thư viện Class.php

// ĐẾM THỜI GIAN
function time_ago($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}
