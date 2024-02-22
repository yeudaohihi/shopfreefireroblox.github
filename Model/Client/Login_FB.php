<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
function curl($url,$post = false,$ref = '', $cookie = false,$follow = false,$cookies = false,$header = true,$headers = false)
{
    $ch=curl_init($url);
    if($ref != '') {
        curl_setopt($ch, CURLOPT_REFERER, $ref);
    }
    if($cookie){
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if($cookies)
    {
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
    }
    if($post){
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_POST, 1);
    }
    if($follow) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if($header)     curl_setopt($ch, CURLOPT_HEADER, 1);
    if($headers)        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $result[0] = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $result[1] = substr($result[0], $header_size);
    curl_close($ch);
    return $result;
}

if(isset($_GET['token']) && $_GET['token']){
    $_SESSION['facebook_access_token'] = (string) $_GET['token'];
    $response = $fb->get('/me?fields=id,name,email', $_GET['token']);
    $name = preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($response->getGraphUser()['name']));
    $email = $response->getGraphUser()['email'];
    $fb_ID = $response->getGraphUser()['id'];
    $_SESSION['username'] = $fb_ID;

    $iduser = $fb_ID;
    if ($db->num_rows("SELECT `username` FROM `users` WHERE `username` = '{$iduser}'") < 1) {
        $users['name'] = $name;
        $users['ip'] = myip();
        $users['status'] = 'on';
        $users['browser'] = getBrowser();
        $users['device'] = getOS();
        $users['user_agent'] = $user_agent;
        $deltai_users = addslashes(json_encode($users));
        $db->query("INSERT INTO `users`(`username`, `password`, `type`, `cash`, `diamond`, `turn_wheel`, `detail`, `site`, `updated_at`, `created_at`) VALUES ('{$fb_ID}', NULL, '1', '{$dataWeb['new_cash']}', '0', '0', '{$deltai_users}', '{$site}', '{$date}', '{$date}')");
	}

	$session->send($iduser);//lưu session id fb
	$db->close(); // Giải phóng
        echo '<script>location.href="'.DOMAIN.'";</script>'; // về trang chủ
	}else {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop Bán Acc Free Fire</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <script>
    window.onload = function () {
        document.location.href = '<?=DOMAIN?>/Client/Login_FB?token=' + getParameterByName('access_token');
    };

    function getParameterByName(name) {
        var _url = window.location.href.indexOf('?') > -1 ? window.location.href.replace('#', '') : window.location.href.replace('#', '?');
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(_url);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }
    </script>
</body>
</html>
<?php
}
?>