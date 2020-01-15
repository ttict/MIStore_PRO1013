<?php require_once "./helpers/common.php" ?>
<?php require_once "./helpers/db.php" ?>
<?php
    $sessionValue = isset($_SESSION["cart"])==true ? $_SESSION["cart"] : [];
    $_SESSION['UNIT_URL']=$_SERVER['REQUEST_URI'];

    if(!isset($_SESSION['auth'])) {
        header("location: " . BASE_URL . "login.php");die;
    }
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
                                    <a class="active" href="#shopping-cart" data-toggle="tab">
                                        <span>01</span>
                                        Giỏ Hàng
                                    </a>
                                </li>
                                <li>
                                    <a class="active" href="#checkout" data-toggle="tab">
                                        <span>02</span>
                                        Thanh toán
                                    </a>
                                </li>
                                <li>
                                    <a href="#order-complete" data-toggle="tab">
                                        <span>03</span>
                                        Thanh Toán Hoàn Thành
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- shopping-cart start -->
                                <div class="tab-pane" id="shopping-cart">
                                    <div class="shopping-cart-content">
                                        <form action="#">
                                            <div class="table-content table-responsive mb-50">
                                                <table class="text-center">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">Sản phẩm</th>
                                                            <th class="product-price">Giá</th>
                                                            <th class="product-quantity">Số lượng</th>
                                                            <th class="product-subtotal">Tổng tiền</th>
                                                            <th class="product-remove">Xóa</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- tr -->
                                                        <?php 
                                                        if (count($sessionValue)>-1) {
                                                            $_SESSION['cartSum'] = 0;
                                                            foreach ($sessionValue as $Value){
                                                               $_SESSION['cartSum'] += $Value['qty'] * $Value['sell_price'];
                                                        ?>
                                                        <tr>
                                                        <td class="product-thumbnail">
                                                            <div class="pro-thumbnail-img">
                                                                <img src="<?= $Value['image']?>" alt="">
                                                            </div>
                                                            <div class="pro-thumbnail-info text-left">
                                                                <h6 class="product-title-2">
                                                                    <a href="<?= BASE_URL . "single-product.php?id=" . $Value['id'] ?>"><?= $Value['name']?></a>
                                                                </h6>
                                                                <p><?= $Value['short_desc']?></p>
                                                                
                                                            </div>
                                                        </td>
                                                        <td class="product-price"><?= $Value['sell_price']?></td>
                                                        <td class="product-quantity">
                                                            <div class="cart-plus-minus f-left">
                                                                <div class="dec qtybutton"><a href="../../cart/cartQty.php?qty=decrease&id=<?= $Value['id'] ?>">-</a></div>
                                                                <input type="text" value="<?= $Value['qty']?>" name="qtybutton" class="cart-plus-minus-box">
                                                                <div class="inc qtybutton"><a href="../../cart/cartQty.php?qty=increase&id=<?= $Value['id'] ?>">+</a></div>
                                                            </div> 
                                                        </td>
                                                        <td class="product-subtotal"><?= $Value['sell_price'] * $Value['qty'] ?></td>
                                                        <td class="product-remove">
                                                            <a href="<?= BASE_URL . "cart/remove-cart.php?id=" . $Value['id'] ?>"><i class="zmdi zmdi-close"></i></a>
                                                        </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="payment-details box-shadow p-30 mb-50">
                                                        <h6 class="widget-title border-left mb-20">Thông tin thanh toán</h6>
                                                        <table>
                                                            <tr>
                                                                <td class="td-title-1">Tổng giá tiền</td>
                                                                <td class="td-title-2" id="totalPrice"><?= isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] : 0 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Tiền ship</td>
                                                                <td class="td-title-2">50000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="order-total">Tổng số tiền thanh toán</td>
                                                                <td class="order-total-price" id="totalSpent"><?= isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] + 50000 : 0 ?></td>
                                                            </tr>
                                                        </table>
                                                        <ul class="action-button">
                                                            <li>
                                                                <a href="<?= BASE_URL ?>checkout.php">Thanh toán</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                <!-- shopping-cart end -->
                                <!-- wishlist start -->
                            
                                <!-- wishlist end -->
                                <!-- checkout start -->
                                <div class="tab-pane active" id="checkout">
                                    <div class="checkout-content box-shadow p-30">
                                        <form action="<?= BASE_URL ?>purchase.php" method="POST">
                                            <div class="row">
                                                <!-- billing details -->
                                                <div class="col-md-6">
                                                    <div class="billing-details pr-10">
                                                        <h6 class="widget-title border-left mb-20">Thông tin thanh Toán</h6>
                                                        <input type="text" name="name" placeholder="Tên...">
                                                        <input type="text" name="email" placeholder="Địa chỉ Email...">
                                                        <input type="text" name="phone" placeholder="Số điện thoại...">                                                       
                                                        
                                                        <select class="custom-select" name="city">
                                                            <option value="defalt">Thành phố</option>
                                                            <option value="Hà Nội">Hà Nội</option>
                                                            <option value="Hồ Chí Minh">TP Hồ Chí Minh</option>
                                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                                            <option value="Hải Phòng">Hải Phòng</option>
                                                        </select>
                                                        <textarea class="custom-textarea" name="address" placeholder="Địa chỉ nhận hàng..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- our order -->
                                                    <div class="payment-details pl-10 mb-50">
                                                        <h6 class="widget-title border-left mb-20">Hóa Đơn</h6>
                                                        <table>
                                                            <?php if($sessionValue): ?>
                                                            <?php foreach ($sessionValue as $key => $prod): ?>
                                                            <tr>
                                                                <td class="td-title-1"><?= $prod['name'] ?></td>
                                                                <td class="td-title-2"><?= $prod['sell_price'] * $prod['qty'] ?></td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                            <?php endif ?>
                                                            
                                                            <tr>
                                                                <td class="td-title-1">Tổng tiền sản phẩm</td>
                                                                <td class="td-title-2"><?= isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] : 0 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1">Tiền ship</td>
                                                                <td class="td-title-2">50000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="order-total">Tổng tiền thanh toán</td>
                                                                <td class="order-total-price"><?= isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] + 50000: 0 ?></td>
                                                            </tr>
                                                        </table>
                                                    </div> 
                                                   
                                                    <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">Đặt hàng</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- checkout end -->

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