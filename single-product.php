<?php require_once "./helpers/common.php" ?>
<?php require_once "./helpers/db.php" ?>
<?php
$proId = $_GET['id'];
// chi tiết sản phẩm
$productQuery = "   select 
                    *
                    from products 
                    where id = $proId";
$product = executeQuery($productQuery, false);
// galleries của sản phẩm
$galleryQuery = "select * from product_galleries where product_id =  $proId";
$galleries    = executeQuery($galleryQuery, true);
// var_dump($galleries);die;
// comment cua san pham
$commentQuery = "select users.name,content,star,users.avatar from comments join users on comments.user_id = users.id where product_id = $proId and status = 1";
$comments = executeQuery($commentQuery, true);
$operating_sys = $product['operating_sys'];
$relateProdsQuery = "select * from products where operating_sys = '$operating_sys' limit 5";
$relateProds = executeQuery($relateProdsQuery, true);
$loi= isset($_GET["loi"]) ? $_GET['loi'] : "";
$_SESSION['UNIT_URL']=$_SERVER['REQUEST_URI'];


// Hien thi danh gia san pham
if (count($comments) == 0) {
    $star = 0;
} else {
    $totalStar = 0;
    foreach ($comments as $key => $comm) {
        $totalStar += $comm['star'];
    }
    $star = $totalStar / count($comments);
}

// Tang view them 1 don vi
$viewQuery = "update products set views = views + 1 where id = $proId";
executeQuery($viewQuery);


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require_once "./layouts/head-styles.php" ?>
    <style>
        #information {
            margin: 50px 0;
        }
        .info-content img{
            display: block;
            margin: 0 auto;
        }
        .add-cart {
            margin: 0 20px;
            padding: 0 20px;
            border: 1px solid #ccc;
        }

        .add-cart:hover {
            background-color: #ff7f00;
            color: white;
            border: none;
            transition: all 0.5s;
        }
    </style>
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
                                <h1 class="breadcrumbs-title">Sản phẩm</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="<?= BASE_URL ?>index.php">Trang chủ</a></li>
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
        <section id="page-content" class="page-wrapper">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mb-80">
                                <div class="row">
                                    <!-- imgs-zoom-area start -->
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class="imgs-zoom-area">
                                            <img id="zoom_03" src="<?= $product['image']?>" data-zoom-image="<?= $product['image']?>" alt="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
                                                        <div class="p-c">
                                                            <a href="#" data-image="<?= $product['image']?>" data-zoom-image="<?=  $product['image']?>">
                                                                <img class="zoom_03" src="<?= $product['image']?>" alt="1">
                                                            </a>
                                                        </div>
                                                        <?php foreach ($galleries as $value):?>
                                                        <div class="p-c">
                                                            <a href="#" data-image="<?= $value['url']?>" data-zoom-image="<?=  $value['url']?>">
                                                                <img class="zoom_03" src="<?= $value['url']?>" alt="1">
                                                            </a>
                                                        </div>
                                                        <?php endforeach ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- imgs-zoom-area end -->
                                    <!-- single-product-info start -->
                                    <div class="col-md-7 col-sm-7 col-xs-12"> 
                                        <div class="single-product-info">
                                            <div class="single-pro-color-rating clearfix">
                                                <div class="f-left">
                                                    <h3 class="text-black-1"><?= $product['name']?></h3>
                                                    <h3 class="text-black-1">
                                                        <span style="text-decoration: line-through; font-size: 0.8em"><?= number_format($product['ori_price']) . 'VNĐ' ?></span>
                                                        <br>
                                                        <span style="color: #ff7f00; font-weight: bold"><?= number_format($product['sell_price']) . 'VNĐ' ?></span>
                                                    </h3>
                                                </div>
                                                <div class="pro-rating sin-pro-rating f-right">
                                                    <?php displayStar($star) ?>
                                                    <span class="text-black-5">( <?= count($comments) ?> Đánh giá )</span>
                                                </div>
                                            </div>
                                            <!-- hr -->
                                            <hr>
                                            <!-- single-product-tab -->
                                            <div class="single-product-tab">
                                                <ul class="reviews-tab mb-20">
                                                    <li  class="active"><a href="#description" data-toggle="tab">Giới thiệu</a></li>
                                                    <!-- <li ><a href="#information" data-toggle="tab">Thông tin sản phẩm</a></li> -->
                                                    <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                                                    <?php if(isset($_SESSION['auth'])): ?>
                                                    <li ><a href="#comments" data-toggle="tab">Bình luận</a></li>
                                                    <?php endif ?>
                                                </ul>
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="description">
                                                        <p><?= $product['short_desc']?></p>
                                                        <p>Màu: <input type="color" value="<?= $product['color'] ?>" style="border: none; background: none" disabled></p>
                                                        <p>CPU: <?= $product['cpu'] ?></p>
                                                        <p>Ram: <?= $product['ram'] ?></p>
                                                        <p>Kích thước màn hình: <?= $product['screen_size'] ?></p>
                                                        <p>Hệ điều hành: <?= $product['operating_sys'] ?></p>
                                                    </div>
                                                    <!-- <div role="tabpanel" class="tab-pane" id="information">
                                                        <div class="info-content"><?= $product['detail']?></div>
                                                        
                                                    </div> -->
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="reviews">
                                                        <!-- reviews-tab-desc -->
                                                        <div class="reviews-tab-desc">
                                                            <!-- single comments -->
                                                            <div class="media mt-30">
                                                                
                                                                <?php foreach ($comments as $value):?>
                                                                <div class="media-left">
                                                                    <a href="#"><img width="100px" class="media-object" src="<?=$value['avatar']?>" alt="#"></a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="clearfix">
                                                                    
                                                                        <div class="name-commenter pull-left">
                                                                            <h6 class="media-heading"><a href="#"><?= $value['name']?></a></h6>
                                                                            
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <p class="mb-0"><?=$value['content']?></p>
                                                                </div><br>
                                                                <?php endforeach ?>
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <?php if(isset($_SESSION['auth'])): ?>
                                                    <div role="tabpanel" class="tab-pane" id="comments">
                                                        <div class="media mt-30">
                                                            <form action="<?= BASE_URL . "add_comment.php?id=" . $product['id'] ?>" method="post">
                                                                <textarea class="height-80" name="content" placeholder="Bình Luận" ><?= $loi ?></textarea>
                                                                <div class="pro-rating sin-pro-rating">
                                                                    <label for="">
                                                                        <input type="radio" name="star" value="1">
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                    </label>
                                                                </div>
                                                                <div class="pro-rating sin-pro-rating">
                                                                    <label for="">
                                                                        <input type="radio" name="star" value="2">
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                    </label>
                                                                </div>
                                                                <div class="pro-rating sin-pro-rating">
                                                                    <label for="">
                                                                        <input type="radio" name="star" value="3">
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                    </label>
                                                                </div>
                                                                <div class="pro-rating sin-pro-rating">
                                                                    <label for="">
                                                                        <input type="radio" name="star" value="4">
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star-outline"></i></a>
                                                                    </label>
                                                                </div>
                                                                <div class="pro-rating sin-pro-rating">
                                                                    <label for="">
                                                                        <input type="radio" name="star" value="5">
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                        <a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a>
                                                                    </label>
                                                                </div>
                                                    
                                                                <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" name="ok">Gửi</button> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php endif ?>
                                                </div>
                                                
                                            </div>
                                            <!--  hr -->
                                            
                                            <!-- hr -->
                                            <hr>
                                            <!-- plus-minus-pro-action -->
                                            <div class="plus-minus-pro-action">
                                                <form action="<?= BASE_URL . "add_cart.php" ?>">
                                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                    <div class="sin-plus-minus f-left clearfix">
                                                        <p class="color-title f-left">Số lượng</p>
                                                    
                                                        <div class="cart-plus-minus f-left">
                                                            <div class="dec qtybutton">-</div>
                                                            <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                                                            <div class="inc qtybutton">+</div>
                                                        </div>   
                                                    </div>
                                                    <div class="sin-pro-action f-left">
                                                        <ul class="action-button">
                                                            
                                                            <li>
                                                                <button type="submit" class="add-cart">Thêm vào giỏ</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>    
                                    </div>
                                    
                                    <!-- single-product-info end -->
                                </div>
                                <div role="tabpanel" class="row" id="information">
                                    <div class="info-content"><?= $product['detail']?></div>
                                    
                                </div>
                            </div>
                            <!-- single-product-area end -->
                            <div class="related-product-area">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-title text-left mb-40">
                                            <h2 class="uppercase">Sản phẩm liên quan</h2>
                                            <h6>Các mẫu điện thoại tương tự được tìm kiếm</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="active-related-product">
                                         <!-- product-item start -->
                                         <?php foreach ($relateProds as $key => $prod): ?>
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

                                    </div>   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </section>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <?php require_once "./layouts/footer.php" ?>
        <!-- END FOOTER AREA -->

        <!-- START QUICKVIEW PRODUCT -->
        
        <!-- END QUICKVIEW PRODUCT -->  
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <?php require_once "./layouts/script.php" ?>

</body>

</html>