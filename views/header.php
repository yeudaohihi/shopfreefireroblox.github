
<?php
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
?>
<!-- THIẾT KẾ WEBSITE XBOXTECH.VN -->
<!doctype html>
<html lang="vi">
    <head>
        <title><?=$dataWeb['title']?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Được Kết Nối Nguồn Acc Từ Youtuber Nổi Tiếng Liên Quân Mobile" />
        <meta name="keywords" content="shop ban acc lien quan, shop acc lien quan, nicklq, nicklq.com" />
        <link rel="shortcut icon" href="https://xboxtech.vn/images/icons/icon.png" type="image/x-icon">
        <link rel="canonical" href="<?=DOMAIN?>" />
        <meta content="" name="author" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?=DOMAIN?>" />
        <meta property="og:title" content="Garena Kiểm Duyệt Uy Tín 100%" />
        <meta property="og:image" content="/upload/setting/12df53fea8b3adfa6c2ec456dd22e204.gif" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link data-n-head="ssr" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-n-head="ssr" rel="preconnect" href="https://fonts.gstatic.com" crossorigin="true">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim&display=swap">
        <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <link rel="stylesheet" href="/assets/css/styles.css?=<?=rand(100,200)?>">
        <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    </head>
    <style>
        .hidden-cs{
            display: flex;
        }
        @media (max-width: 767px) {
            .hidden-cs{
            display: none;
        }
        }
    </style>
    <?php 
        if($_SERVER[REQUEST_URI] == '/'){
            $background = 'fixed bottom no-repeat; background-size: cover;';
        }else{
            $background = 'overflow: auto;';
        }
    ?>
    <body style="background: url(<?=$dataWeb['background']?>) <?=$background?>">