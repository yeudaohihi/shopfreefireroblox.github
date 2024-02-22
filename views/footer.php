</section>


<script>
    function GetData(type, thumb, thele) {
        $("#img").attr("src", thumb);
        $("#thele").html(thele);
        $("input[name=type]").val(type);
    }

    function BuyDiamondBox() {
        var data = $(".form-diamondbox").serialize();
        $.ajax({
            url: '/Model/Buy/BuyDiamondBox',
            data: data,
            dataType: "json",
            type: "POST",
            success: function(data) {
                swal('Thông báo', data.msg, data.status);
            }
        });
    }
</script>
<div class="modal fade" id="info" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content background-4">
            <div class="modal-header" style="padding: 10px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title category fsize-18 fweight-700 color-1 uppercase pt10 text-center">
                    <i class="fa fa-bell" aria-hidden="true"></i> Thông báo
                </h5>
            </div>
            <div class="modal-body content-popup color-whitei">
                <center>
                    <img id="img" src="" style="width: 80%;">
                </center>
                <br>
                <center class="mt-2" id="thele"></center>
            </div>
            <form class="form-diamondbox">
                <input hidden name="type" value="">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><small>Số lượng cần mua</small></label>
                        <input class="form-control" name="qty" type="number" placeholder="Nhập số lượng cần mua" value="1">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn xTech-btnIndex color-whitei" style="width: auto; margin-top: 5px;" onclick="BuyDiamondBox()">Mua ngay</button>
                <button type="button" class="btn xTech-btnIndex color-whitei" style="width: auto; margin-top: 5px;" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<style>
    @media only screen and (max-width: 640px) {
        #bonus {
            width: 35% !important;
        }
    }

    #bonus {
        position: fixed;
        bottom: 15px;
        left: 15px;
        width: 13%;
        z-index: 1000;
        cursor: pointer;
    }
</style>

<?php if ($info_lixi['status'] == 'off') : ?>

<?php else : ?>
    <?php if ($db->num_rows("SELECT * FROM `log_lixi` WHERE `username` = '{$data_user['username']}'") < 1) : ?>
        <div id="bonus" title="Click để nhận thưởng!">
            <img class="lazyLoad" src="<?= $js_lixi['images'] ?>">
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="tw-py-5" style="background: #1b1a1a; font-family: 'Roboto', sans-serif;">
    <div class="tw-mt-2 tw-mb-12 md:tw-mb-0 tw-px-4 md:tw-px-0 tw-relative tw-max-w-6xl tw-w-full tw-mx-auto tw-text-white tw-grid tw-grid-cols-12 tw-gap-4 tw-font-semibold tw-text-gray-300">
        <div class="tw-col-span-12 md:tw-col-span-4 tw-font-bold tw-uppercase tw-mb-2">
            <span class="tw-mt-4 tw-border-2 tw-border-trueGray-700 tw-py-4 tw-px-4 tw-flex tw-flex-col tw-items-center">
                <img src="<?= $dataWeb['logo'] ?>" class="mb-2" style="max-width: 150px;" />
                <span class="tw-text-center"><?= $site ?> Acc Free Fire Uy Tín Giá Rẻ Chất Lượng.</span>
            </span>
            <p><a href="//xboxtech.vn/Privacy">Privacy Policy</a> | <a href="//xboxtech.vn/Dieukhoan">Terms of Service</a> | <a href="//xboxtech.vn/DeleteUser">Delete user data</a></p>
        </div>
        <div class="tw-col-span-12 md:tw-col-span-5 tw-py-2">
            <h2 class="tw-text-2xl tw-mb-2">VỀ CHÚNG TÔI</h2>
            <p class="tw-text-base tw-font-medium tw-mb-2">
                Chúng tôi luôn lấy uy tín đặt trên hàng đầu đối với khách hàng, hy vọng chúng tôi sẽ được phục vụ các bạn. Cám ơn!
            </p>
            <p>
                Thời gian hỗ trợ: <br />
                <span class="tw-font-medium">
                    Sáng: 8h00 -> 11h30 | Chiều: 13h00 -> 19h00
                </span>
            </p>
        </div>
        <div class="tw-col-span-12 md:tw-col-span-3 tw-py-2">
            <h3 class="tw-text-2xl tw-uppercase tw-mb-2">
                <?= $site ?>
            </h3>
            HỆ THỐNG BÁN ACC TỰ ĐỘNG<br />
            ĐẢM BẢO UY TÍN VÀ CHẤT LƯỢNG.<br />
            <a href="https://www.messenger.com/t/<?= $dataWeb['id_fanpage'] ?>" target="_blank"><img src="https://cdns.diongame.com/static/messenger-01.svg" style="max-width: 220px;" /></a>
        </div>
    </div>
</div>
<div class="tw-py-2 tw-text-white tw-font-medium" style="background: #151212;">
    <div class="tw-max-w-6xl tw-mx-auto tw-text-center">
        <!--Copyright <?= date('Y') ?> - <?= $site ?>  -->
        Developed by <a href="https://www.facebook.com/tuannguyen2811/" style="color:#ee4d2d"><b>Xboxtech</b></a>, All Rights Reserved.
    </div>
</div>
<a href="https://www.messenger.com/t/<?= $dataWeb['id_fanpage'] ?>" target="_blank" class="tw-h-10 md:tw-h-12 tw-w-10 md:tw-w-12 tw-fixed tw-rounded-full tw-flex tw-items-center tw-justify-center focus:tw-outline-none" style="right: 2%; bottom: 100px; z-index: 1000;">
    <img alt="shop" src="/assets/images/mes.png" />
</a>
<button type="button" class="tw-h-10 tw-w-10 tw-border-2 tw-border-blue-600 tw-fixed tw-opacity-90 tw-rounded tw-text-2xl tw-text-white tw-bg-blue-500 tw-rounded-full tw-font-bold tw-flex tw-items-center tw-justify-center focus:tw-outline-none" style="right: 2%; bottom: 45px; z-index: 1000;">
    <i class="bx bx-up-arrow-alt"></i>
</button>
<!---->
<!---->
</div>
<style>
    .fade {
        display: none;
    }

    .fade.show {
        display: flex !important;
    }

    .open {
        display: block !important;
    }
</style>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="theleModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-red-500 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-text-gray-800 tw-font-semibold tw-text-center tw-rounded-t tw-grid tw-grid-cols-12 tw-gap-0">
                <div class="tw-col-span-12 tw-py-3 tw-flex tw-px-4 tw-rounded-t tw-font-bold tw-text-white">
                    <i class="tw-relative bx bxs-bell-ring tw-text-xl" style="top: 3px;"></i> THÔNG BÁO
                </div>
            </div>
        </div>
        <div class="tw-p-2 md:tw-p-4">
            Quay càng nhiều tỉ lệ càng cao
        </div>
    </div>
</div>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="loginModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-relative tw-max-w-md tw-mx-auto tw-bg-white tw-w-full tw-rounded tw-px-4 md:tw-px-6 tw-py-4">
        <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
        </span>
        <div class="tw-w-full">
            <img class="tw-h-16 tw-mx-auto" src="<?= $dataWeb['logo'] ?>" />
            <h3 class="tw-text-center tw-text-lg tw-font-bold tw-text-blue-900 tw-mb-8">
                ĐĂNG NHẬP TÀI KHOẢN
            </h3>
            <div class="tw-mb-4" id="msgLogin"></div>

            <!---->
            <a href="<?= $LoginFacebook ?>">
                <button class="tw-border tw-border-blue-700 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-blue-700 tw-text-white">
                    <span class="tw-ml-8 tw-relative">
                        <i class="tw-absolute bx bxl-facebook-circle tw-text-2xl" style="top: -3px; left: -30px;"></i>
                        Đăng nhập bằng Facebook
                    </span>
                </button>
            </a>

            <div class="tw-mt-5">
                <form id="form-Login">
                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Tên tài khoản *
                        </label>
                        <input name="username" type="text" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>
                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Mật khẩu *
                        </label>
                        <input name="password" autocomplete="" type="password" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                        <span class="tw-w-full tw-text-left"><a data-toggle="modal" data-target="#forgotModal" href="javascript:;">Quên mật khẩu ?</a></span>
                    </div>
                    <div class="tw-text-center tw-text-red-500"></div>
                    <button type="button" onclick="Login()" class="tw-border tw-border-red-600 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-mb-3"><span class="tw-relative"> ĐĂNG NHẬP </span></button>
                    <button type="button" class="tw-border tw-border-gray-400 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-white tw-text-gray-700" data-dismiss="modal" data-toggle="modal" data-target="#registerModal"><span class="tw-relative"> Tạo tài khoản </span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="registerModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-relative tw-max-w-md tw-mx-auto tw-bg-white tw-w-full tw-rounded tw-px-4 md:tw-px-6 tw-py-4">
        <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
        </span>
        <div class="tw-w-full">
            <img class="tw-h-16 tw-mx-auto" src="<?= $dataWeb['logo'] ?>" />
            <h3 class="tw-text-center tw-text-lg tw-font-bold tw-text-blue-900 tw-mb-8">
                ĐĂNG KÝ TÀI KHOẢN
            </h3>
            <div class="tw-mb-4" id="msgReg"></div>
            <!---->
            <a href="<?= $LoginFacebook ?>">
                <button class="tw-border tw-border-blue-700 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-blue-700 tw-text-white">
                    <span class="tw-ml-8 tw-relative">
                        <i class="tw-absolute bx bxl-facebook-circle tw-text-2xl" style="top: -3px; left: -30px;"></i>
                        Đăng nhập bằng Facebook
                    </span>
                </button>
            </a>
            </button>

            <div class="tw-mt-5">
                <form id="form-Register">
                    <div class="tw-mt-2 tw-mb-3 tw-grid tw-grid-cols-12 tw-gap-2">
                        <div class="tw-col-span-12">
                            <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                                Email (Bắt buộc.) *
                            </label>
                            <input type="email" name="email" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                        </div>
                    </div>
                    <div class="tw-mt-2 tw-mb-3 tw-grid tw-grid-cols-12 tw-gap-2">
                        <div class="tw-col-span-12">
                            <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                                Tên tài khoản *
                            </label>
                            <input type="text" name="username" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                        </div>
                    </div>
                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Mật khẩu *
                        </label>
                        <input type="password" name="password" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>

                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Xác nhận mật khẩu *
                        </label>
                        <input type="password" name="repassword" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>
                    <div class="tw-text-center tw-text-red-500"></div>
                    <button type="button" onclick="Register()" class="tw-border tw-border-red-600 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-mb-3"><span class="tw-relative"> ĐĂNG KÝ </span></button>
                    <button type="button" class="tw-border tw-border-gray-400 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-white tw-text-gray-700" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"><span class="tw-relative"> Đăng nhập </span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="forgotModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-relative tw-max-w-md tw-mx-auto tw-bg-white tw-w-full tw-rounded tw-px-4 md:tw-px-6 tw-py-4">
        <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
        </span>
        <div class="tw-w-full">
            <img class="tw-h-16 tw-mx-auto" src="<?= $dataWeb['logo'] ?>" />
            <h3 class="tw-text-center tw-text-lg tw-font-bold tw-text-blue-900 tw-mb-8">
                Quên Mật khẩu
            </h3>
            <div class="tw-mb-4" id="msgForgot"></div>
            <!---->
            <a href="<?= $LoginFacebook ?>">
                <button class="tw-border tw-border-blue-700 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-blue-700 tw-text-white">
                    <span class="tw-ml-8 tw-relative">
                        <i class="tw-absolute bx bxl-facebook-circle tw-text-2xl" style="top: -3px; left: -30px;"></i>
                        Đăng nhập bằng Facebook
                    </span>
                </button>
            </a>
            </button>

            <div class="tw-mt-5">
                <form id="form-Forgot">
                    <div class="tw-mt-2 tw-mb-3 tw-grid tw-grid-cols-12 tw-gap-2">
                        <div class="tw-col-span-12">
                            <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                                Email (Nhập email chính xác để xác minh) *
                            </label>
                            <div class="flex">

                                <input type="text" name="email" id="emailF" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" /><a href="javascript:" type="button" onclick="SendOTP('Client')">Gửi lại OTP</a>
                            </div>
                        </div>
                    </div>
                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Mã OTP *
                        </label>
                        <input type="text" name="otp" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>
                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Mật khẩu *
                        </label>
                        <input type="password" name="password" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>


                    <div class="tw-mb-3">
                        <label class="tw-block tw-font-semibold tw-text-sm tw-text-blue-900">
                            Xác nhận mật khẩu *
                        </label>
                        <input type="password" name="repassword" autocomplete="" class="tw-w-full tw-border tw-border-blue-800 tw-rounded tw-h-11 tw-px-3 tw-font-semibold" />
                    </div>
                    <div class="tw-text-center tw-text-red-500"></div>
                    <button type="button" onclick="Forgot()" class="tw-border tw-border-red-600 tw-rounded tw-h-11 tw-px-3 tw-font-semibold tw-w-full tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-mb-3"><span class="tw-relative"> Xác nhận đổi mật khẩu</span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal nạp -->
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="chargeModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-red-600 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-col-span-12 tw-py-3 tw-rounded-t tw-font-bold">
                NẠP TIỀN - CHUYỂN KHOẢN QUA
            </div>
        </div>

        <div class="tw-p-3 tw-py-4 md:tw-p-4 tw-pb-8 md:tw-pb-8">
            <div class="tw-grid tw-grid-cols-12 tw-gap-4">
                <div class="tw-col-span-12 md:tw-col-span-6">
                    <button class="tw-w-full tw-bg-gray-200 hover:tw-bg-gray-300 tw-rounded tw-flex tw-items-center tw-h-12 tw-px-4" data-toggle="modal" data-target="#bankModal">
                        <img class="tw-w-6 lazyLoad isLoaded" src="/upload/bank/bank.png" /> <span class="tw-ml-2 tw-font-semibold tw-text-gray-800">Ngân Hàng (ATM)</span>
                    </button>
                </div>
                <div class="tw-col-span-12 md:tw-col-span-6">
                    <button class="tw-w-full tw-bg-gray-200 hover:tw-bg-gray-300 tw-rounded tw-flex tw-items-center tw-h-12 tw-px-4" data-toggle="modal" data-target="#momoModal">
                        <img class="tw-w-6 lazyLoad isLoaded" src="/upload/bank/momo.png" /> <span class="tw-ml-2 tw-font-semibold tw-text-gray-800">Ứng dụng MOMO</span>
                    </button>
                </div>
            </div>
            <div class="tw-mt-4">
                <div class="tw-text-sm tw-font-semibold tw-text-gray-700">
                    <p>
                        <span><i class="bx bx-caret-right"></i></span> Hệ thống nạp <b class="tw-text-red-600">ATM/MOMO tự động 24/24</b>, Nạp 100k nhận 120k tiền shop
                    </p>
                    <p>
                        <span><i class="bx bx-caret-right"></i></span><b> Lưu ý: </b> Chuyển tiền nhanh 24/7 để tránh bị treo, chậm tiền! Nếu gửi đúng stk và nội dung mà 30p không nhận được tiền hoặc chuyển ghi sai nội dung vui lòng liên hệ page để
                        được hỗ trợ.
                    </p>
                </div>
            </div>
            <div class="tw-mt-4">
                <label class="tw-uppercase tw-text-red-600 tw-font-bold tw-text-sm tw-block tw-mb-2">
                    Quy Đổi Tiền Nạp ATM/MOMO
                </label>
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="tw-2/5">
                        <div class="tw-w-full tw-relative">
                            <label class="tw-inline-block tw-text-gray-600 tw-absolute tw-text-xs tw-font-medium" style="left: 10px; top: 6px;">
                                Số tiền bạn chuyển
                            </label>
                            <input type="number" placeholder="ví dụ: 100000" id="amount_send" oninput="changeAmount($(this).val())" class="focus:tw-outline-none tw-pt-3 tw-px-2 tw-h-12 tw-rounded tw-border-2 tw-border-gray-300 tw-w-full tw-text-sm tw-font-semibold tw-placeholder-gray-800 focus:tw-placeholder-white focus:tw-border-red-500 tw-transition tw-duration-200" />
                        </div>

                        <span class="tw-mt-1 tw-absolute tw-text-xs tw-block tw-font-semibold"><i class="tw-relative tw-font-bold bx bx-subdirectory-right" style="top: 1px;"></i> <span id="amount_Format">0đ</span></span>
                    </div>
                    <div class="tw-1/5"><i class="bx bx-transfer-alt tw-text-gray-600 tw-text-lg"></i></div>
                    <div class="tw-2/5">
                        <div class="tw-w-full tw-relative">
                            <label class="tw-inline-block tw-text-gray-600 tw-absolute tw-text-xs tw-font-medium" style="left: 10px; top: 6px;">
                                Tiền nhận trên shop
                            </label>
                            <input readonly="readonly" placeholder="120000" id="amount_real" class="focus:tw-outline-none tw-pt-3 tw-px-2 tw-h-12 tw-rounded tw-border-2 tw-border-gray-300 tw-w-full tw-text-sm tw-font-semibold tw-placeholder-gray-800 focus:tw-placeholder-white tw-transition tw-duration-200 tw-text-red-700" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal ATM -->
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="bankModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-gray-200 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-text-gray-800 tw-font-semibold tw-text-center tw-rounded-t tw-grid tw-grid-cols-12 tw-gap-0">
                <div class="tw-col-span-12 tw-py-3 tw-flex tw-px-4 tw-rounded-t tw-font-bold">
                    <img class="tw-w-6 tw-h-6 tw-mr-2 lazyLoad isLoaded" src="/assets/images/bank.png" /> CHUYỂN QUA NGÂN HÀNG
                </div>
            </div>
        </div>

        <div class="tw-p-2 md:tw-p-4">
            <div>
                <div class="relative tw-text-sm tw-text-red-600">
                    <p>
                        <span style="color: rgb(0, 0, 0);"><strong>THÔNG TIN TÀI KHOẢN NGÂN HÀNG</strong></span>
                    </p>

                    <p>
                        <strong>NGÂN HÀNG : </strong><span style="color: rgb(230, 76, 76);"><strong>MB Bank</strong></span>
                    </p>

                    <p>
                        <strong>SỐ TÀI KHOẢN : </strong><span style="color: rgb(230, 76, 76);"><strong><b style="color:#ee4d2d;"><?= $data_bank['stk'] ?></b></strong></span>
                    </p>

                    <p>
                        <strong>CHỦ TÀI KHOẢN: </strong><span style="color: rgb(230, 76, 76);"><strong><b style="color:#ee4d2d;"><?= $data_bank['ctk'] ?></b></strong></span>
                    </p>

                </div>
                <input readonly="readonly" hidden value="<?= $data_bank['stk'] ?>" class="tw-h-10 tw-px-3 tw-border-2 tw-border-pink-700 tw-text-lg tw-border-dashed tw-rounded tw-w-full tw-text-pink-700 tw-font-extrabold focus:tw-outline-none" />
                <button onclick="copy('<?= $data_bank['stk'] ?>')" class="focus:tw-outline-none tw-px-2 tw-h-6 tw-bg-gray-500 hover:tw-bg-gray-600 tw-rounded tw-text-xs tw-font-bold tw-text-white tw-uppercase">
                    Copy số tài khoản
                </button>
            </div>
            <div class="tw-border-b tw-border-gray-200 tw-my-3"></div>
            <div class="tw-my-2">
                <p class="tw-font-semibold tw-text-sm tw-mb-1">
                    Nội dung chuyển khoản:
                </p>
                <div class="tw-relative">
                    <input readonly="readonly" value="naptien <?= $data_user['id'] ?>" class="tw-h-10 tw-px-3 tw-border-2 tw-border-red-500 tw-text-lg tw-border-dashed tw-rounded tw-w-full tw-text-red-600 tw-font-extrabold focus:tw-outline-none" />
                    <button onclick="copy('naptien <?= $data_user['id'] ?>')" class="tw-bg-red-600 hover:tw-bg-red-500 tw-px-4 tw-h-6 tw-text-white tw-flex tw-items-center tw-py-1 tw-absolute tw-text-sm tw-font-semibold tw-rounded" style="top: 8px; right: 8px;">
                        COPY NỘI DUNG
                    </button>
                </div>
                <div class="tw-mt-2 tw-font-semibold tw-text-sm">
                    <i class="tw-ml-3 bx bxs-upvote"></i> Khi chuyển khoản qua Ngân hàng (ATM) bạn cần ghi nội dung
                    <b class="tw-mx-1 tw-text-red-600">naptien <?= $data_user['id'] ?></b>
                    bên trên.
                </div>
                <div class="tw-mt-1 tw-text-sm tw-font-semibold tw-text-red-600">
                    <i>Lưu ý: Sau khi chuyển khoản xong, hãy chờ "vài phút" rồi ấn <b>"Xác nhận. Tôi đã chuyển"</b>. </i>
                </div>
                <a href="https://www.messenger.com/t/<?= $dataWeb['id_fanpage'] ?>" class="tw-my-2 tw-text-uppercase tw-bg-red-600 hover:tw-bg-red-500 tw-h-10 tw-font-semibold tw-rounded tw-text-white tw-px-3">
                    Xác nhận. Tôi đã chuyển
                </a>
                <div class="tw-mt-1 tw-font-semibold tw-text-sm tw-text-red-600">
                    <i>
                        <p>
                            Các giao dịch chuyển sai "Nội dung chuyển khoản" sẽ không được xử lý tự động. Hãy liên hệ Fanpage để được hỗ trợ.
                        </p>
                    </i>
                </div>
            </div>
            <div class="tw-border-b tw-border-gray-200 tw-my-3"></div>
            <div class="tw-mt-1">
                <p class="tw-font-semibold tw-text-sm tw-mb-1">
                    Hướng dẫn nạp tiền qua Ngân hàng
                </p>
                <button class="focus:tw-outline-none tw-px-2 tw-h-6 tw-bg-green-500 hover:tw-bg-green-600 tw-rounded tw-text-xs tw-font-bold tw-text-white tw-uppercase">
                    Click xem video hướng dẫn
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Modal MOMO -->
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="momoModal" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-gray-200 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" class="close" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-text-gray-800 tw-font-semibold tw-text-center tw-rounded-t tw-grid tw-grid-cols-12 tw-gap-0">
                <div class="tw-col-span-12 tw-py-3 tw-flex tw-px-4 tw-rounded-t tw-font-bold">
                    <img class="tw-w-6 tw-h-6 tw-mr-2 lazyLoad isLoaded" src="/assets/images/momo.png" /> CHUYỂN KHOẢN QUA MOMO
                </div>
            </div>
        </div>

        <div class="tw-p-2 md:tw-p-4">
            <div>
                <div class="relative tw-text-sm tw-text-pink-700">
                    <p><strong>THÔNG TIN VÍ MOMO</strong></p>
                    <p><strong>CHỦ TÀI KHOẢN: <b style="color:#ee4d2d;"><?= $data_momo['ctk'] ?></b></strong></p>
                    <p><strong>VÍ MOMO: <b style="color:#ee4d2d;"><?= $data_momo['phone'] ?></b></strong></p>
                </div>
                <input readonly="readonly" hidden value="<?= $data_momo['phone'] ?>" class="tw-h-10 tw-px-3 tw-border-2 tw-border-pink-700 tw-text-lg tw-border-dashed tw-rounded tw-w-full tw-text-pink-700 tw-font-extrabold focus:tw-outline-none" />
                <button onclick="copy('<?= $data_momo['phone'] ?>')" class="focus:tw-outline-none tw-px-2 tw-h-6 tw-bg-gray-500 hover:tw-bg-gray-600 tw-rounded tw-text-xs tw-font-bold tw-text-white tw-uppercase">
                    Copy số tài khoản ví MOMO
                </button>
            </div>
            <div class="tw-border-b tw-border-gray-200 tw-my-3"></div>
            <div class="tw-my-2">
                <p class="tw-font-semibold tw-text-sm tw-mb-1">Nội dung <b class="tw-text-red-500">ghi chú</b> khi chuyển:</p>
                <div class="tw-relative">
                    <input readonly="readonly" value="naptien <?= $data_user['id'] ?>" class="tw-h-10 tw-px-3 tw-border-2 tw-border-pink-700 tw-text-lg tw-border-dashed tw-rounded tw-w-full tw-text-pink-700 tw-font-extrabold focus:tw-outline-none" />
                    <button onclick="copy('naptien <?= $data_user['id'] ?>')" class="tw-bg-pink-700 hover:tw-bg-pink-600 tw-px-4 tw-h-6 tw-text-white tw-flex tw-items-center tw-py-1 tw-absolute tw-text-sm tw-font-semibold tw-rounded" style="top: 8px; right: 8px;">
                        COPY NỘI DUNG
                    </button>
                </div>
                <div class="tw-mt-2 tw-font-semibold tw-text-sm">
                    <i class="tw-ml-3 bx bxs-upvote"></i> Khi chuyển khoản qua ví Momo bạn cần ghi nội dung ghi chú
                    <b class="tw-mx-1 tw-text-pink-700">naptien <?= $data_user['id'] ?></b>
                    bên trên.
                </div>
                <div class="tw-mt-1 tw-font-semibold tw-text-sm tw-text-red-600">
                    <p>
                        Lưu ý: Nếu quá 30 phút không nhận được tiền, vui lòng liên hệ page hỗ trợ!
                    </p>
                    <i>- Các giao dịch chuyển sai "Nội dung ghi chú" sẽ không được xử lý tự động. Hãy liên hệ Fanpage để được hỗ trợ. </i>
                </div>
            </div>
            <div class="tw-border-b tw-border-gray-200 tw-my-3"></div>
            <div class="tw-mt-1">
                <p class="tw-font-semibold tw-text-sm tw-mb-1">
                    Hướng dẫn nạp tiền qua Ví Momo
                </p>
                <button class="focus:tw-outline-none tw-px-2 tw-h-6 tw-bg-green-500 hover:tw-bg-green-600 tw-rounded tw-text-xs tw-font-bold tw-text-white tw-uppercase">
                    Click xem video hướng dẫn
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="modalMinigame" role="dialog" aria-hidden="true" style="z-index: 5000; background: rgba(93, 93, 93, 0.77);">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-red-500 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" class="close"></i>
            </span>
            <div class="tw-text-gray-800 tw-font-semibold tw-text-center tw-rounded-t tw-grid tw-grid-cols-12 tw-gap-0">
                <div class="tw-col-span-12 tw-py-3 tw-flex tw-px-4 tw-rounded-t tw-font-bold tw-text-white">
                    <i class="tw-relative bx bxs-bell-ring tw-text-xl" style="top: 3px;"></i> THÔNG BÁO
                </div>
            </div>
        </div>
        <div class="tw-p-2 md:tw-p-4">
            <div class="content-popup"></div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="/assets/js/slick.js"></script>
<script src="/assets/js/hs.core.js"></script>
<script src="/assets/js/hs.slick-carousel.js"></script>
<script>
    var hscheck = false;
    $(document).ready(() => {
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');
        $("#sliderSyncingNav .js-slide img").on("click", function() {
            $("#viewModal").modal("show");
            if (hscheck != 1) {
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel2');
                hscheck = true;
            }

        })
    })
</script>
<script>
    $("#form-Login input").keyup(function(e) {
        if (e.keyCode == 13) {
            Login();
        }
    });
    $("#form-Register input").keyup(function(e) {
        if (e.keyCode == 13) {
            Register();
        }
    });
</script>
<script src="/assets/script.js?<?= rand(100000, 900000) ?>"></script>
</body>

</html>