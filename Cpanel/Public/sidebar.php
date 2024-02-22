<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href=""><img class="lazyLoad" data-src="/Cpanel/assets/images/sieuthicode.png" alt="Logo" style="height: 3.5rem !important;" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active ">
                        <a href="/Cpanel" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php if ($data_user['type'] == 2) : ?>
                        <!-- <li class="sidebar-title">Cài đặt chính</li> -->

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-wrench"></i>
                                <span>Cài đặt website</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Setting">Cài đặt all shop</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Setting_AutoBank">Cài đặt api tự động</a>
                                </li>
                                <!--<li class="submenu-item ">-->
                                <!--    <a href="/Cpanel/ProductTag">Cài đặt nhãn dán</a>-->
                                <!--</li>-->
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Setting/Events">Cài đặt sự kiện</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/ListPR">Cài đặt PR</a>
                                </li>
                            </ul>
                        </li>


                        <!-- <li class="sidebar-title">Danh mục</li> -->

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-wrench"></i>
                                <span>Cài đặt danh mục</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Product/CreateProduct">Thêm danh mục</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Product/CreateMinigame">Thêm trò chơi</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Product/CreateAccountGame">Thêm sản phẩm tài khoản</a>
                                </li>
                               
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Product/CreateDiamondBox">Thêm hòm kim cương</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/Product/List">Danh sách sản phẩm</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/Cpanel/ProductTag">Cài đặt nhãn dán</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="/Cpanel/ListUser" class='sidebar-link'>
                                <i class="fas fa-users"></i>
                                <span>Danh sách thành viên</span>
                            </a>
                        </li>

                        <!--<li class="sidebar-item">-->
                        <!--    <a href="/Cpanel/Withdraw/CTV" class='sidebar-link'>-->
                        <!--        <i class="fa fa-money-check"></i>-->
                        <!--        <span>Rút tiền</span>-->
                        <!--        <span class="badge bg-success"><?= $db->num_rows("SELECT * FROM `withdraw_cash` WHERE `status` = '1'") ?></span>-->
                        <!--    </a>-->
                        <!--</li>-->
                    <?php endif; ?>


                    <!-- <li class="sidebar-title">Accounts</li> -->
                    <li class="sidebar-item">
                        <a href="/Cpanel/Account/ListAccount" class='sidebar-link'>
                            <i class="bi bi-list"></i>
                            <span>Danh sách tài khoản</span>
                        </a>
                    </li>

                    <?php if ($data_user['type'] == '4') : ?>
                        <li class="sidebar-item">
                            <a href="/Cpanel/History/Buy" class='sidebar-link'>
                                <i class="bi bi-clock-history"></i>
                                <span>Lịch sử giao dịch</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/Cpanel/Withdraw/CTV" class='sidebar-link'>
                                <i class="fa fa-money-check"></i>
                                <span>Rút tiền</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- <li class="sidebar-title">Lịch sử</li> -->

                    <?php if ($data_user['type'] == '2' || $data_user['type'] == '3') : ?>

                        <!-- <li class="sidebar-item">
                            <a href="/Cpanel/Account/Reward" class='sidebar-link'>
                                <i class="bi bi-list"></i>
                                <span>Tài khoản trả thưởng</span>
                            </a>
                        </li> -->

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-clock-history"></i>
                                <span>Giao dịch</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item">
                                    <a href="/Cpanel/History/Buy">Mua acc</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/Cpanel/History/Recharge">Nạp thẻ</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/Cpanel/History/Diamond">Rút kim cương</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/Cpanel/History/Minigame">Trò chơi</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($data_user['type'] == 2) : ?>

                        <li class="sidebar-item">
                            <a href="/Cpanel/History/Log" class="sidebar-link">
                                <i class="bi bi-clock-history"></i>
                                <span>Lịch sử biến động</span>
                            </a>
                        </li>

                    <?php endif; ?>
                    <li class="sidebar-item  ">
                        <a href="/Logout" class='sidebar-link'>
                            <i class="bi bi-backspace-fill"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>