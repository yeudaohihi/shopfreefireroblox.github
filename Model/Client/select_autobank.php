<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
$types = strtoupper(Anti_xss($_POST['types']));
if(!@$user){
    new Redirect(DOMAIN);
    exit;
}else{
    $query = $db->fetch_assoc("SELECT * FROM `setting_apibank` WHERE `type` = '{$types}' AND `site` = '{$site}'", 1);
    $detail = json_decode($query['detail'], true);
}
?>

<?php if($types == NULL){?>

<?php }elseif($types == 'MOMO'){ ?>
    <div class="col-md-6">
        <div class="element-wrapper">
            <div class="element-box text-center">
                <img src="https://codetay.com/wp-content/uploads/2019/06/logo-momo.png">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Momo: </td>
                            <td style="text-align: left; color: #00cc99;">
                                <b><?=$detail['phone']?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Chủ tài khoản:
                            </td>
                            <td style="text-align: left;">
                                <b><?=strtoupper($detail['ctk'])?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Nội dung chuyển tiền:</td>
                            <td style="text-align: left;">
                                <b style="color:red;" id="copy1">naptien <?=$data_user['id']?></b> <a onclick="copyToClipboard('copy1')" class="copy"><i class="gg-copy gg-icon-copy"></i></a>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><b>Nhập đúng nội dung tiền tự động cộng trong vài phút.</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }elseif($types == 'BANK'){ ?>
    <div class="col-md-6">
        <div class="element-wrapper">
            <div class="element-box text-center">
                <img src="https://iweb.tatthanh.com.vn/pic/3/blog/y-nghia-thiet-ke-logo-cua-ngan-hang-vietcombank.jpg" >
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Số tài khoản: </td>
                            <td style="text-align: left; color: #00cc99;">
                                <b><?=$detail['stk']?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Chủ tài khoản:
                            </td>
                            <td style="text-align: left;">
                                <b><?=$detail['ctk']?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight:bold;">Nội dung chuyển tiền:</td>
                            <td style="text-align: left;">
                                <b style="color:red;" id="copy1">naptien <?=$data_user['id']?></b> <a onclick="copyToClipboard('copy1')" class="copy"><i class="gg-copy gg-icon-copy"></i></a>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><b>Nhập đúng nội dung tiền tự động cộng trong vài phút.</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>