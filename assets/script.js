
// Tính tiền nạp qua atm 25%
function changeAmount(amount) {
    var real_amount = 0, cur_amount = 0;
    real_amount = Math.floor(amount * 1.25); // 25%
    real_amount = real_amount.toLocaleString("vi-VN", { style: 'currency', currency: 'VND' });
    cur_amount = Math.floor(amount).toLocaleString("vi-VN", { style: 'currency', currency: 'VND' });
    $("#amount_real").val(real_amount);
    $("#amount_Format").text(cur_amount);
}


$(document).ready(function () {
    $('body').delegate('#bonus', 'click', function () {
        $.ajax({
            url: '/Event',
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                if (data.status == 'LOGIN') {
                    $("#loginModal").modal('show');
                } else {
                    $('#bonus').css('opacity', '0');
                    $('.content-popup').html(data.msg);
                    $('#modalMinigame').modal('show');
                }
            }
        });
    });
});
// dropdown profile
$(document).ready(function () {
    $(".dropdown-profile").on("click", (event) => {
        console.log("click");
        $(".dropdown-content").toggleClass("open");
    });

    $(document).click(function (e) {
        $('.dropdown-profile')
            .not($('.dropdown-profile').has($(e.target)))
            .children('.dropdown-content')
            .removeClass('open');
    })
})
// menu
$(document).ready(function () {
    $("#menuToggle").on('click', function () {
        $(this).hide();
        $("#menuProfile").show();
    });

    $("#menuHide").on('click', function () {
        $("#menuToggle").show();
        $("#menuProfile").hide();
    });
});
// alert
$(document).ready(function () {
    $("#modalThongBao").show();
});
// index modal
function closeModalindex() {
    $("#modalThongBao").hide();
}

function closeModal() {
    $("#modalMinigame").removeClass("show");
}
function SendOTP(type) {
    email = $("#emailF").val();
    $.ajax({
        url: '/SendOTP',
        data: {
            email,
            type
        },
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgForgot').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
            } else {
                $('#msgForgot').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}

function Forgot() {
    $('#msgForgot').empty();
    var data = $("#form-Forgot").serialize();
    $.ajax({
        url: '/Forgot',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgForgot').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/" }, 2000);
            } else {
                $('#msgForgot').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}

// password
function changePassword() {
    $('#msgPassword').empty();
    var data = $("#form-Pass").serialize();
    $.ajax({
        url: '/Update_pass',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgPassword').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/user/changepass" }, 2000);
            } else {
                $('#msgPassword').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}
// rut kim cuong
function Diamond() {
    $('#msgDiamond').empty();
    var data = $("#form-Diamond").serialize();
    $.ajax({
        url: '/Model/Withdrawal',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgDiamond').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/user/diamond" }, 2000);
            } else {
                $('#msgDiamond').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}
// Nạp thẻ cào
function Napthe() {
    $('#msgCard').empty();
    var data = $("#charge").serialize();
    $.ajax({
        url: '/Model/Recharge',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgCard').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/user/recharge" }, 2000);
            } else {
                $('#msgCard').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}
// copy id
function copy(iduser) {
    navigator.clipboard.writeText(iduser).then(function () {
        alert('Copy thành công');
    }, function (err) {
        console.error('Lỗi copy: ', err); // báo lỗi
    });
}
// Đăng nhập tài khoản
function Login() {
    var data = $("#form-Login").serialize();
    $.ajax({
        url: '/Model/Login',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgLogin').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/" }, 2000);
            } else {
                $('#msgLogin').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}
// Đăng ký tài khoản
function Register() {
    var data = $("#form-Register").serialize();
    $.ajax({
        url: '/Model/SignUp',
        data: data,
        dataType: "json",
        type: "POST",
        success: function (data) {
            if (data.status == 'success') {
                $('#msgReg').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-green-100 tw-border-green-300 tw-text-green-500"><div class="relative">' + data.msg + '</div>');
                setTimeout(function () { window.location.href = "/" }, 2000);
            } else {
                $('#msgReg').html('<div class="tw-py-2 tw-px-3 tw-border tw-rounded tw-text-sm tw-w-full tw-block tw-font-semibold tw-bg-red-100 tw-border-red-300 tw-text-red-500"><div class="relative">' + data.msg + '</div>');
            }
        }
    });
}

// nhận quà sự kiện
$(document).ready(function () {
    $('body').delegate('#bonus', 'click', function () {
        $.ajax({
            url: '/Event',
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                if (data.status == 'LOGIN') {
                    location.href = '/Login';
                    return;
                }
                $('#bonus').css('opacity', '0');
                $('.content-msg').html(data.msg);
                $('#noticeModal1').modal('show');
            }
        });
    });
});