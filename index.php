<?php require_once "./helpers/common.php" ?>
<?php require_once "./helpers/db.php" ?>

<?php 
$newProdQuery = "select * from products
                 order by id DESC
                 limit 5";
$newProd = executeQuery($newProdQuery, true);

$hotProdQuery = "select * from products 
                 order by views DESC
                 limit 5";
$hotProd = executeQuery($hotProdQuery, true);

$allProdQuery = "select * from products limit 8";
$allProd = executeQuery($allProdQuery, true);

$sliderQuery = "select * from sliders 
                order by sort_order
                limit 3";
$sliders = executeQuery($sliderQuery, true);
$_SESSION['UNIT_URL']=$_SERVER['REQUEST_URI'];
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

        <?php include_once "./layouts/header.php" ?>

        <!-- START SLIDER AREA -->
        <div class="slider-area  plr-185  mb-80">
            <div class="container-fluid">
                <div class="slider-content">
                    <div class="row">
                        <div class="active-slider-1 slick-arrow-1 slick-dots-1">
                            <!-- layer-1 Start -->
                            <?php foreach ($sliders as $key => $slide): ?>
                            <div class="col-md-12">
                                <div class="layer-1">
                                    <div class="slider-img">
                                        <img src="<?= $slide['image_url'] ?>" alt="">
                                    </div>
                                    <div class="slider-info gray-bg">
                                        <div class="slider-info-inner">
                                            <h1 class="slider-title-1 text-uppercase text-black-1"><?= $slide['title'] ?></h1>
                                            <div class="slider-brief text-black-2">
                                                <p><?= $slide['short_desc'] ?></p>
                                            </div>
                                            <a href="<?= BASE_URL . $slide['url'] ?>" class="button extra-small button-black">
                                                <span class="text-uppercase">Mua ngay</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach ?>
                            <!-- layer-1 end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SLIDER AREA -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- FEATURED PRODUCT SECTION START -->
            <div class="featured-product-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center mb-50">
                                <h2 class="uppercase">Sản phẩm mới</h2>
                                <h6>Các mẫu điện thoại thông minh mới nhất</h6>
                            </div>
                        </div>
                    </div>
                    <div class="featured-product">
                        <div class="row active-featured-product slick-arrow-2">
                            <!-- product-item start -->
                            <?php foreach ($newProd as $key => $prod): ?>
                            <div class="col-xs-12">
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
                                            <?php displayStar($prod['star']) ?>
                                        </div>
                                        
                                        <h3 class="pro-price">
                                            <span style="text-decoration: line-through; font-size: 0.8em"><?= number_format($prod['ori_price']) . 'VNĐ' ?></span>
                                            <br>
                                            <span style="color: #ff7f00; font-weight: bold"><?= number_format($prod['sell_price']) . 'VNĐ' ?></span>
                                        </h3>
                                        <ul class="action-button">                               
                                            <li>
                                                <a href="<?= BASE_URL . "add_cart.php?id=" . $prod['id'] ?>" title="Add to cart">Thêm vào giỏ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- product-item end -->

                        </div>
                    </div>          
                </div>            
            </div>
            <!-- FEATURED PRODUCT SECTION END -->

            <!-- HOT PRODUCT SECTION START -->
            <div class="featured-product-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center mb-50">
                                <h2 class="uppercase">Sản phẩm hot</h2>
                                <h6>Các mẫu điện thoại thông minh được ưa chuộng nhất</h6>
                            </div>
                        </div>
                    </div>
                    <div class="featured-product">
                        <div class="row active-featured-product slick-arrow-2">
                            <!-- product-item start -->
                            <?php foreach ($hotProd as $key => $prod): ?>
                            <div class="col-xs-12">
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
                                            <?php displayStar($prod['star']) ?>
                                        </div>
                                        <h3 class="pro-price">
                                            <span style="text-decoration: line-through; font-size: 0.8em"><?= number_format($prod['ori_price']) . 'VNĐ' ?></span>
                                            <br>
                                            <span style="color: #ff7f00; font-weight: bold"><?= number_format($prod['sell_price']) . 'VNĐ' ?></span>
                                        </h3>
                                        <ul class="action-button">                               
                                            <li>
                                                <a href="<?= BASE_URL . "add_cart.php?id=" . $prod['id'] ?>" title="Add to cart">Thêm vào giỏ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- product-item end -->
                        </div>
                    </div>          
                </div>            
            </div>
            <!-- FEATURED PRODUCT SECTION END -->

            <!-- PRODUCT TAB SECTION START -->
            <div class="product-tab-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="section-title text-center mb-0">
                                <h2 class="uppercase">Danh sách sản phẩm</h2>
                                <h6>Các mẫu điện thoại hiện có</h6>
                            </div>
                        </div>
                        
                    </div>
                    <div class="featured-product">
                        <div class="row">
                            <!-- product-item start -->
                            <?php foreach ($allProd as $key => $prod): ?>
                            <div class="col-md-3 col-sm-4 col-xs-12">
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
                                            <?php displayStar($prod['star']) ?>
                                        </div>
                                        <h3 class="pro-price">
                                            <span style="text-decoration: line-through; font-size: 0.8em"><?= number_format($prod['ori_price']) . 'VNĐ' ?></span>
                                            <br>
                                            <span style="color: #ff7f00; font-weight: bold"><?= number_format($prod['sell_price']) . 'VNĐ' ?></span>
                                        </h3>
                                        <ul class="action-button">                               
                                            <li>
                                                <a href="<?= BASE_URL . "add_cart.php?id=" . $prod['id'] ?>" title="Add to cart">Thêm vào giỏ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- product-item end -->

                        </div>
                    </div>
                </div>
                <!-- popular-product end -->
                
            </div>
                   
            <!-- PRODUCT TAB SECTION END -->

        <!-- START FOOTER AREA -->
        <?php include_once "./layouts/footer.php" ?>
        <!-- END FOOTER AREA -->


    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <?php include_once "./layouts/script.php" ?>

</body>

</html>