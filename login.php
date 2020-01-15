<?php require_once "./helpers/common.php" ?>
<?php if (isset($_SESSION['auth'])) {
    header('location: index.php');
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require_once "./layouts/head-styles.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <?php require_once "./layouts/header.php" ?>
        <!-- END MOBILE MENU AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Đăng nhập / Đăng ký</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="<?= BASE_URL ?>index.php">Trang chủ</a></li>
                                    <li>Đăng nhập / Đăng ký</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <div id="page-content" class="page-wrapper">

            <!-- LOGIN SECTION START -->
            <div class="login-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="registered-customers">
                                <h6 class="widget-title border-left mb-50">ĐĂNG NHẬP</h6>
                                <form action="<?= BASE_URL . 'login/post-login.php'?>" method="post">
                                    <div class="login-account p-30 box-shadow">
                                        <p>Nếu bạn có tài khoản, vui lòng đăng nhập</p>
                                        <input type="text" name="email" placeholder="Email">
                                        <input type="password" name="password" placeholder="Mật khẩu">
                                        <p><small><a href="<?= BASE_URL . 'login/forget-password.php' ?>">Quên mật khẩu?</a></small></p>
                                        <button class="submit-btn-1 btn-hover-1" type="submit">Đăng nhập</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- new-customers -->
                        <div class="col-md-6">
                            <div class="new-customers">
                                <form action="<?= BASE_URL . 'login/add_signin.php'?>" method="post">
                                    <h6 class="widget-title border-left mb-50">ĐĂNG KÝ</h6>
                                    <div class="login-account p-30 box-shadow">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="name"  placeholder="Tên">
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="address" placeholder="Địa chỉ....">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="phone" placeholder="Số điện thoại...">
                                            </div>
                                        </div>
                                        <input type="text" name="email"  placeholder="Địa chỉ email...">
                                        <?php echo isset($loi) ? $loi : ''; ?>
                                        <input type="password" name="password" placeholder="Mật Khẩu">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="Đăng ký" >
                                            </div>
                                            <div class="col-md-6">
                                                <button class="submit-btn-1 mt-20 btn-hover-1 f-right" type="reset" >Làm lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LOGIN SECTION END -->             

        </div>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <?php require_once "./layouts/footer.php" ?>
        <!-- END FOOTER AREA --> 
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <?php require_once "./layouts/script.php" ?>

</body>

</html>