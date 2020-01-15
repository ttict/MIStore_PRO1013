<?php require_once "./helpers/common.php" ?>
<?php require_once "./helpers/db.php" ?>
<?php
$id = $_GET['id'];
$_SESSION['cart'] = [];
$queryInvoice = "select * from invoices join invoice_detail on invoices.id = invoice_detail.invoice_id where invoices.id = $id";
$invoice = executeQuery($queryInvoice, true);
// var_dump($invoice);die;
?>
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
                                <h1 class="breadcrumbs-title">Giỏ hàng</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="<?= BASE_URL ?>index.php">Trang chủ</a></li>
                                    <li>Giỏ hàng</li>
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

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <ul class="cart-tab">
                                <li>
                                    <a class="active" href="#" data-toggle="tab">
                                        <span>01</span>
                                        Giỏ Hàng
                                    </a>
                                </li>
                                <li>
                                    <a class="active" href="#" data-toggle="tab">
                                        <span>02</span>
                                        Thanh toán
                                    </a>
                                </li>
                                <li>
                                    <a href="#order-complete" data-toggle="tab" class="active">
                                        <span>03</span>
                                        Thanh Toán Hoàn Thành
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- order-complete start -->
                                <div class="tab-pane active" id="order-complete">
                                    <div class="order-complete-content box-shadow">
                                        <div class="thank-you p-30 text-center">
                                            <h6 class="text-black-5 mb-0">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</h6>
                                        </div>
                                        <div class="order-info p-30 mb-10">
                                            <ul class="order-info-list">
                                                <li>
                                                    <h6>Mã Giao dịch</h6>
                                                    <p><?= $invoice[0]['id'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>Mã Giao dich</h6>
                                                    <p><?= $invoice[0]['id'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>Mã giao dịch</h6>
                                                    <p><?= $invoice[0]['id'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>Mã giao dịch</h6>
                                                    <p><?= $invoice[0]['id'] ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <!-- our order -->
                                            <div class="col-md-6">
                                                <div class="payment-details p-30">
                                                    <h6 class="widget-title border-left mb-20">Hóa đơn của bạn</h6>
                                                    <table>
                                                        <?php foreach ($invoice as $key => $prod): ?>
                                                        <tr>
                                                            <td class="td-title-1"><?= $prod['name'] ?></td>
                                                            <td class="td-title-2"><?= $prod['total'] ?></td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                        
                                                        <tr>
                                                            <td class="td-title-1">Tổng tiền sản phẩm</td>
                                                            <td class="td-title-2"><?= $invoice[0]['total_price'] - 50 ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-title-1">Tiền ship</td>
                                                            <td class="td-title-2">50</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="order-total">Tổng tiền thanh toán</td>
                                                            <td class="order-total-price"><?= $prod['total_price'] ?></td>
                                                        </tr>
                                                    </table>
                                                </div>         
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bill-details p-30">
                                                    <h6 class="widget-title border-left mb-20">Thông tin Thanh toán</h6>
                                                    <ul class="bill-address">
                                                        <li>
                                                            <span>Địa chỉ</span>
                                                            <?= $invoice[0]['address'] ?> 
                                                        </li>
                                                        <li>
                                                            <span>Email:</span>
                                                            <?= $invoice[0]['email'] ?>
                                                        </li>
                                                        <li>
                                                            <span>Điện thoại : </span>
                                                            <?= $invoice[0]['phone_number'] ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- order-complete end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

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