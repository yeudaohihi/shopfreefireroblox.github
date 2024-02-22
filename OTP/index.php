<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');

if(!@$user || @$data_user['type'] == '1'){
    new Redirect(DOMAIN);
    exit;
}
?>


<style>
    .input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap;
}.input-group-btn {
    white-space: nowrap;
    vertical-align: middle;
}.input-group-btn {
    display: table-cell;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V4</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form">
				    <input hidden type="text" name="username" value="<?=$data_user['username']?>">
					<span class="login100-form-title p-b-49">
						Access OTP
					</span>
                    <div id="msg"></div>
					<div class="wrap-input100 validate-input m-b-23 input-group" data-validate = "OTP">
						<input class="input100" type="text" name="otp" placeholder="OTP">
						<span class="input-group-btn">
                            <button class="btn btn-primary" type="button" onclick="get_otp()" style="padding: 4px 12px;"> Gửi mã OTP</button>
                        </span>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="button" onclick="success()">
								Xác nhận
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


<script type="text/javascript">
function get_otp(){
    var username = $('input[name=username]').val();
    $.ajax({
        url: '/Model/Admin/Success_OTP',
        data: {
            "username": username,
            "type": "get_otp"
        },
        dataType: "json",
        type: "POST",
        success: function(data) {
            if(data.status == 'success'){
                $("#msg").html('<div class="alert alert-success alert-dismissible error-messages"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><ul><li>'+data.msg+'</li></ul></div>');
            }else{
                $("#msg").html('<div class="alert alert-danger alert-dismissible error-messages"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><ul><li>'+data.msg+'</li></ul></div>');
            }
        }
    });
}

function success(){
        var username = $('input[name=username]').val();
        var otp = $('input[name=otp]').val();
        $.ajax({
            url: '/Model/Admin/Success_OTP',
            data: {
                'type': 'confirm',
                'username': username,
                'otp': otp
            },
            dataType: "json",
            type: "POST",
            success: function(data) {
                if(data.status == 'success'){
                    $("#msg").html('<div class="alert alert-success alert-dismissible error-messages"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><ul><li>'+data.msg+'</li></ul></div>');
                    setTimeout(function(){
                        window.location.href = '/Cpanel';
                    }, 1000);
                }else{
                    $("#msg").html('<div class="alert alert-danger alert-dismissible error-messages"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><ul><li>'+data.msg+'</li></ul></div>');
                }
            }
        });
    }

</script>
</body>
</html>