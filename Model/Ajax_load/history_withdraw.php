<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/libs/init.php');
?>

<table class="table fsize-16" style="width: 100%;">
    <thead>
        <tr role="row">
            <th>Thời gian</th>
            <th>Gói rút</th>
            <th>ID rút</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $current_page = isset($_POST['page']) ? (int)Anti_xss($_POST['page']) : 1;

        if ($current_page < 1) {
            $current_page = 1;
        }

        $sql_acc = "SELECT * FROM `withdraw` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ";
        $total_records = $db->num_rows($sql_acc);
        $limit = 10; // giới hạn số lượng trên 1 trang
        if ($limit < 0) {
            $limit = 0;
        }
        $total_page = ceil($total_records / $limit);
        if (!$total_page) {
            $total_page = 1;
        }
        if ($current_page < 1) {
            $current_page = 1;
        }
        if ($current_page > $total_page) {
            $current_page = $total_page;
        }
        $start = ($current_page - 1) * $limit;
        $range = 3; // độ dài của nút trang
        $middle = ceil($range / 2);
        if ($total_page < $range) {
            $min = 1;
            $max = $total_page;
        } else {
            $min = $current_page - $middle + 1;
            $max = $current_page + $middle - 1;
            if ($min < 1) {
                $min = 1;
                $max = $range;
            } else if ($max > $total_page) {
                $max = $total_page;
                $min = $total_page - $range + 1;
            }
        }
        if ($_SERVER['QUERY_STRING']) {
            $re = '/([?])page/m';
            $str = $_SERVER['REQUEST_URI'];
            preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
            if ($matches[0][0] == '?page') {
                $link = $_SERVER['SCRIPT_URI'] . '?page=';
            } else {
                $url = $_SERVER['SCRIPT_URI'] . '?' . $_SERVER['QUERY_STRING'];
                $link = removeParams($url, 'page') . '&page=';
            }
        } else {
            $link = $_SERVER['SCRIPT_URI'] . '?page=';
        }

        function removeParams($url, $param)
        {
            $new_Url = preg_replace('/([?&])' . $param . '[^&]+(&|$)/', '', $url);
            $url = trim($new_Url, '&');
            $url = trim($new_Url, '?');
            return $url;
        }

        $sql_show = "SELECT * FROM `withdraw` WHERE `username` = '{$data_user['username']}' AND `site` = '{$site}' ORDER BY `id` DESC LIMIT $start, $limit";
        if ($total_records > 0) {
            foreach ($db->fetch_assoc($sql_show, 0) as $info) {
        ?>

                <tr>
                    <td><?= date('Y-m-d H:i:s', $info['created_at']) ?></td>
                    <td><?= number_format($info['diamond']) ?> KC</td>
                    <td><?= $info['idgame'] ?></td>
                    <td><?= status_history($info['status']) ?></td>
                </tr>
        <?php }
        } ?>

    </tbody>
</table>

<?php if ($total_records > 0) { ?>
    <nav class="text-center">
        <div class="fsize-14 pagination pagination-style-three m-t-20">
            <a class="page-link" href="javascript:void(0)" onclick="page=<?= ($current_page - 1) ?>;load_his()" aria-hidden="true">&laquo;</a>
            <?php if ($current_page - 3 > 1) { ?>
                <a class="page-link" href="javascript:void(0)" onclick="page=1;load_his()">1</a>
                <a class="page-item disabled">...</a>
            <?php } ?>

            <?php
            for ($i = $min; $i <= $max; $i++) {
                if ($current_page == $i) {
            ?>
                    <a href="#" class="selected"><?= $i ?></a>
                <?php
                } else {
                ?>
                    <a class="page-link" href="javascript:void(0)" onclick="page=<?= $i ?>;load_his()"><?= $i ?></a>
            <?php
                }
            }
            ?>

            <?php if ($current_page + 3 < $total_page) { ?>

                <a class="page-link">...</a>

                <a class="page-link" href="javascript:void(0)" onclick="page=<?= $total_page ?>;load_his()"><?= $total_page ?></a>

            <?php } ?>

            <a class="page-link" href="javascript:void(0)" onclick="page=<?= ($current_page + 1) ?>;load_his()">&raquo;</a>



        <?php } ?>