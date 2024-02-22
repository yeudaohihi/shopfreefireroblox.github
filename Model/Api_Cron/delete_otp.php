<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$db->query("UPDATE `confirm_otp` SET `otp` = NULL, `updated_at` = '{$date}'");