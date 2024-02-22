<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');

$sql_show = "SELECT * FROM `history_buy` WHERE `id` = '{$_GET['id']}' AND `username` = '{$data_user['username']}' AND `site` = '{$site}' LIMIT 1";
$info = $db->fetch_assoc($sql_show, 1);
$json_data = json_decode($info['detail'], true);
$arr_account = $json_data['data'];
?>


<?php if ($db->num_rows($sql_show) < 1) : ?>
    <div class="alert alert-danger c-font-dark text-center" style="margin-bottom: 0px;color:red;">
        <b>Không tìm thấy dữ liệu.</b>
    </div>
<?php else : ?>
    <form accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông tin tài khoản #<?= $info['id_acc'] ?></h4>
        </div>
        <div class="modal-body">
            <div class="form-horizontal">
                <div class="form-group m-t-10">
                    <label class="col-md-3 control-label text-black"><b>Tài khoản:</b></label>
                    <div class="col-md-6">
                        <input class="form-control c-square c-theme" type="text" placeholder="Tài khoản" readonly="" value="<?= $arr_account[0]['tentaikhoan'] ?>">

                    </div>
                </div>
                <div class="form-group m-t-10">
                    <label class="col-md-3 control-label text-black"><b>Mật khẩu:</b></label>
                    <div class="col-md-6">
                        <div class="input-group c-square">
                            <input type="text" class="form-control c-square c-theme show_password" id="pass" placeholder="Mật khẩu" readonly="" value="<?= $arr_account[1]['matkhau'] ?>">
                            <span class="input-group-btn">
                                <button class="btn-his" type="button" id="getpass">Copy</button>
                            </span>
                        </div>
                        <span class="help-block">Click vào nút copy để sao chép mật khẩu hoặc nhấp đúp vào ô mật khẩu để thấy mật khẩu.</span>
                    </div>
                </div>

                <div class="form-group m-t-10">
                    <label class="col-md-3 control-label text-black"><b>T.tin bổ sung:</b></label>
                    <div class="col-md-6">
                        <textarea rows="5" class="form-control c-square c-theme" type="text" placeholder="Thông tin bổ sung" readonly=""><?= $arr_account[2]['thongtinbosung'] ?></textarea>
                    </div>
                </div>

                <div class="alert alert-danger c-font-dark">
                    <b>Để tránh các trường hợp xấu xảy ra, quý khách vui lòng chờ từ 5-7 ngày rồi hãy thay đổi ( Email và SĐT ) để đảm bảo không có vấn đề sau khi giao dịch tại shop! Xin cảm ơn.</b>
                </div>

                <!-- <div class="alert alert-info c-font-dark">
                Sau khi nhận tài khoản mật khẩu bạn có thể thay đổi mật khẩu để bảo mật.<br>
                Sau 5-7 ngày thì bạn có thể thay đổi thông tin Email và SĐT.<br>
            </div> -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
        </div>
    </form>

    <script>
        document.querySelector('#getpass').addEventListener('click', function(event) {
            var copyTextarea = document.querySelector('#pass');
            copyTextarea.select();

            try {
                document.execCommand('copy');
            } catch (err) {
                alert('Trình duyệt của bạn không thể thực hiện thao tác copy nhanh');
            }
            if (document.selection) {
                document.selection.empty();
            } else if (window.getSelection) {
                window.getSelection().removeAllRanges();
            }
        });
    </script>

<?php endif; ?>