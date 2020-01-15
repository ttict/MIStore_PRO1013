<?php 
require_once "../helpers/common.php"; 
require_once "../helpers/db.php";  

$searchResult = $_GET["result"];
// var_dump($result);die;
if ($searchResult=='none') {
    $searchedProducts = [];
} else {
    $searchResultId = explode(",", $searchResult);
    foreach ($searchResultId as $key => $id) {
        $getSearchedProductQuery = "select * from products where id = $id";
        $searchedProducts[] = executeQuery($getSearchedProductQuery);
    }
}
// var_dump($searchedProducts);die;

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <?php include_once "../layouts/head-styles.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <?php include_once "../layouts/header.php" ?>
        <!-- END MOBILE MENU AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Sản phẩm</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.php">Trang chủ</a></li>
                                    <li>Sản phẩm</li>
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

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-push-3 col-sm-12">
                            <div class="shop-content">
                                <!-- shop-option start -->
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <!-- Nav tabs -->
                                    
                                    <!-- short-by -->
                                    <div class="short-by f-left text-center">
                                        <span>Sắp xếp theo:</span>
                                        <select>
                                            <option value="1">Sản phẩm mới</option>
                                            <option value="2">Sản phẩm hot</option>
                                            <option value="3">Giá giảm dần</option>
                                            <option value="4">Giá tăng dần</option>
                                        </select> 
                                    </div> 
                                    <!-- showing -->
                                    <div class="showing f-right text-right">
                                        <span>Có tất cả: <?= count($searchedProducts) ?> sản phẩm</span>
                                    </div>                                   
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div role="tabpanel" class="tab-pane active" id="grid-view">
                                        <div class="row">
                                            <!-- product-item start -->
                                            <?php if ($searchResult == 'none') { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            <p>Không có sản phẩm cần tìm</p>
                                            </div>
                                            <?php
                                            } elseif ($searchResult) { 
                                                
                                                foreach ($searchedProducts as $key => $prod) {
                                            ?>       
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="<?= BASE_URL . "single-product.php?id=" . $prod['id'] ?>">
                                                        <img src="<?= $prod['image'] ?>" alt=""/>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a href="<?= BASE_URL . "single-product.php?id=" . $prod['id'] ?>"><?= $prod['name'] ?></a>
                                                    </h6>
                                                    <div class="pro-rating">
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                                    </div>
                                                    <h3 class="pro-price"><?= $prod['sell_price'] ?></h3>
                                                    <ul class="action-button">                               
                                                        <li>
                                                            <a href="#" title="Add to cart">Thêm vào giỏ</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </div>
                                            <?php } }?>
                                            <!-- product-item end -->

                                        </div>
                                    </div>
                                    <!-- list-view -->
                                    
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                                
                                <!-- shop-pagination end -->
                            </div>
                        </div>
                        <div class="col-md-3 col-md-pull-9 col-sm-12">
                            
                            <!-- shop-filter -->
                            <aside class="widget shop-filter box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Mức giá</h6>
                                <div class="price_filter">
                                    <div class="price_slider_amount">
                                        <input type="submit"  value="Khoảng giá:"/> 
                                        <input type="text" id="amount" name="price"  placeholder="Add Your Price" /> 
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                            </aside>                       
                            <!-- operating-system -->
                            <aside class="widget operating-system box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Hệ điều hành</h6>
                                <form action="action_page.php">
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android 7</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android 7.1</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android 8</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android 8.1</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android 9</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android One</label><br>
                                </form>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </div>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <?php include_once "../layouts/footer.php" ?>
        <!-- END FOOTER AREA -->

        
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <?php include_once "../layouts/script.php" ?>

</body>

</html>