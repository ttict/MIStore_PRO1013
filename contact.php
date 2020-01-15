<?php require_once "./helpers/common.php" ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include_once "./layouts/head-styles.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <?php include_once "./layouts/header.php" ?>
        <!-- END MOBILE MENU AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Liên Hệ</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="<?= BASE_URL ?>index.php">Trang chủ</a></li>
                                    <li>Liên Hệ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- ADDRESS SECTION START -->
            <div class="address-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-pin"></i>
                                <h6>Số 8 Ngõ 112 Trần Phú</h6>
                                <h6>Hà Đông, Hà Nội</h6>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-phone"></i>
                                <h6>(+880) 1945 082759</h6>
                                <h6>(+880) 1945 082759</h6>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-email"></i>
                                <h6>tuantrung@gmail.com</h6>
                                <h6>theviet69@yahoo.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADDRESS SECTION END --> 
            
            <!-- GOOGLE MAP SECTION START -->
            <div class="google-map-section">
                <div class="container-fluid">
                    <div class="google-map plr-185">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
            <!-- GOOGLE MAP SECTION END -->
            
            <!-- MESSAGE BOX SECTION START -->
            <div class="container-fluid mb-50"></div>
            <!-- MESSAGE BOX SECTION END --> 
        </section>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <?php include_once "./layouts/footer.php" ?>
        <!-- END FOOTER AREA --> 
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <?php include_once "./layouts/script.php" ?>

</body>

</html>