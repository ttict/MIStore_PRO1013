<?php require_once "../helpers/common.php" ?>
<?php require_once "../helpers/db.php" ?>
<?php 
$err = isset($_GET['err']) ? $_GET['err'] : "";

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require_once "../layouts/head-styles.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <?php require_once "../layouts/header.php" ?>
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
                                <h6 class="widget-title border-left mb-50">Quên mật khẩu</h6>
                                <form action="<?= BASE_URL . 'login/post-forget-password.php'?>" method="post">
                                    <div class="login-account p-30 box-shadow">
                                        <p>Nhập địa chỉ email đã đăng ký</p>
                                        <input type="text" name="email" placeholder="Email" required>
                                        <p style="color: #ff7f00"><small><?= $err ?></small></p>
                                        <button class="submit-btn-1 btn-hover-1" type="submit">Tiếp tục</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- new-customers -->
                        
                    </div>
                </div>
            </div>
            <!-- LOGIN SECTION END -->             

        </div>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <?php require_once "../layouts/footer.php" ?>
        <!-- END FOOTER AREA --> 
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <?php require_once "../layouts/script.php" ?>

</body>

</html>