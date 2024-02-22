<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');

// if(!@$user || @$data_user['type'] == '1' || @$arr_user['otp'] == NULL || @$arr_user['otp'] != $data_otp['otp']){
//     new Redirect("/OTP");
//     exit;
// }

if(!@$user || @$data_user['type'] == '1'){
    new Redirect("/");
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sieuthicode Admin</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Cpanel/assets/css/bootstrap.css?sdfsdf">
    <link rel="stylesheet" href="/Cpanel/assets/vendors/choices.js/choices.min.css" />
    
    <link rel="stylesheet" href="/Cpanel/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="/Cpanel/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/Cpanel/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/Cpanel/assets/css/app.css">
    <link rel="stylesheet" href="/Cpanel/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/Cpanel/assets/vendors/toastify/toastify.css">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.17.2/full-all/ckeditor.js"></script>
    <!-- data table -->
    <link rel="stylesheet" href="/Cpanel/assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <script src="/Cpanel/assets/vendors/jquery-datatables/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- // -->
    <script src="/Cpanel/assets/vendors/fontawesome/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
</head>