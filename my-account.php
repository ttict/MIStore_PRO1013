<?php require_once "./helpers/common.php" ?>
<?php require_once "./helpers/db.php" ?>
<?php 
if (!isset($_SESSION['auth'])) {
    header("location: login.php");
} 


?>


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
                                <h1 class="breadcrumbs-title">Tài Khoản</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="<?= BASE_URL ?>index.php">Trang chủ</a></li>
                                    <li>Tài khoản</li>
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
                        <div class="col-md-8 col-md-offset-2">
                            <div class="my-account-content" id="accordion2">
                                <!-- My Personal Information -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" data-target="#personal_info">Thông tin tài khoản</a>
                                        </h4>
                                    </div>
                                    <div id="personal_info" class="panel-collapse collapse in" role="tabpanel">
                                        <div class="panel-body">
                                            <form action="#">
                                                <div class="new-customers">
                                                    <div class="p-30">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <input type="text"  value="<?= $_SESSION['auth']['name'] ?>">
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <input type="text"  value="<?= $_SESSION['auth']['address'] ?>">
                                                            </div>
                                                        </div>
                                                        <input type="text"  value="<?= $_SESSION['auth']['email'] ?>">
                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- My shipping address -->
                                
                                <!-- My Order info -->
                                
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