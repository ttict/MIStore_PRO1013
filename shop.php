<?php 
require_once("./helpers/common.php");
require_once("./helpers/db.php");

// $query = "select * from products";
// $products = executeQuery($query, true);

$order = isset($_GET['order']) ? $_GET['order'] : "new";
$search = isset($_GET['search']) ? $_GET['search'] : "";
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
                                    <ul class="shop-tab f-left" role="tablist">
                                        <li class="active">
                                            <a href="#grid-view" data-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li>
                                            <a href="#list-view" data-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>
                                    <!-- short-by -->
                                    <div class="short-by f-left text-center">
                                        <span>Sắp xếp theo:</span>
                                        <select id="orderFilter">
                                            <?php if($order == "new"): ?>
                                            <option value="new" selected>Sản phẩm mới</option>
                                            <option value="hot">Sản phẩm hot</option>
                                            <option value="priceDown">Giá giảm dần</option>
                                            <option value="priceUp">Giá tăng dần</option>
                                            <?php endif ?>
                                            <?php if($order == "hot"): ?>
                                            <option value="new">Sản phẩm mới</option>
                                            <option value="hot" selected>Sản phẩm hot</option>
                                            <option value="priceDown">Giá giảm dần</option>
                                            <option value="priceUp">Giá tăng dần</option>
                                            <?php endif ?>
                                        </select> 
                                    </div> 
                                    <!-- showing -->
                                    <div class="showing f-right text-right">
                                        <span id="countProds"></span>
                                    </div>                                   
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div role="tabpanel" class="tab-pane active" id="grid-view">
                                        <div class="row" id="gridView">
                                            <!-- product-item start -->
                                            
                                            <!-- product-item end -->

                                        </div>
                                    </div>
                                    <!-- list-view -->
                                    <div role="tabpanel" class="tab-pane" id="list-view">
                                        <div class="row" id="listView">
                                            <!-- product-item start -->
                                            
                                        </div>                                        
                                    </div>
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
                                    <label><input type="checkbox" name="os7" value="phone-1">Android 7</label><br>
                                    <label><input type="checkbox" name="os71" value="phone-1">Android 7.1</label><br>
                                    <label><input type="checkbox" name="os8" value="phone-1">Android 8</label><br>
                                    <label><input type="checkbox" name="os81" value="phone-1">Android 8.1</label><br>
                                    <label><input type="checkbox" name="os9" value="phone-1">Android 9</label><br>
                                    <label><input type="checkbox" name="os1" value="phone-1">Android One</label><br>
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
        <?php include_once "./layouts/footer.php" ?>
        <!-- END FOOTER AREA -->

        
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <?php include_once "./layouts/script.php" ?>
    <script>
        var search = '<?= $search ?>';
        function displayStar(star) {
            var result = '';
            if (star == null) {
                star = 0;
            }
            var decimalStar = star % 1;
            var wholeStar = parseInt(star);
            for (let index = 0; index < wholeStar; index++) {
                result += '<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>';
            }
            if (decimalStar < 0.25) {
                result += '<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>';
            } else if (decimalStar <= 0.75) {
                result += '<a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a>';
            } else {
                result += '<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>';
            }
            var remainStar = 4 - wholeStar;
            if (remainStar != 0) {
                for (let index = 0; index < remainStar; index++) {
                    result += '<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>';
                }
            }
            // console.log(result);
            return result;
        }
        function createProdList(data) {
            var listContent = "";
            $.each(data, function() {
                var listCard = 
                            `<div class="col-md-12">
                                <div class="shop-list product-item">
                                    <div class="product-img">
                                        <a href="../../single-product.php?id=${this.id}">
                                            <img src="${this.image}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <div class="clearfix">
                                            <h6 class="product-title f-left">
                                                <a href="../../single-product.php?id=${this.id}">${this.name}</a>
                                            </h6>
                                            <div class="pro-rating f-right">`
                                                + displayStar(this.star) + 
                                            `</div>
                                        </div>
                                        <h3 class="pro-price">
                                            <span style="text-decoration: line-through; font-size: 0.8em"> ${formatNumber(this.ori_price)} VNĐ ?></span>
                                            <br>
                                            <span style="color: #ff7f00; font-weight: bold"> ${formatNumber(this.sell_price)} VNĐ ?></span>
                                        </h3>
                                        <p>${this.short_desc}</p>
                                        <ul class="action-button">
                                            <li>
                                                <a href="../../add_cart.php?id=${this.id}" title="Add to cart">Thêm vào giỏ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>`;
                listContent += listCard;
            });
            return listContent;
        }

        function createProdGrid(data) {
            var gridContent = "";
            $.each(data, function() {
                var gridCard = 
                            `<div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="../../single-product.php?id=${this.id}">
                                            <img src="${this.image}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="../../single-product.php?id=${this.id}">${this.name}</a>
                                        </h6>
                                        <div class="pro-rating">`
                                           + displayStar(this.star) + 
                                        `</div>
                                        <h3 class="pro-price">
                                            <span style="text-decoration: line-through; font-size: 0.8em"> ${formatNumber(this.ori_price)} VNĐ </span>
                                            <br>
                                            <span style="color: #ff7f00; font-weight: bold"> ${formatNumber(this.sell_price)} VNĐ </span>
                                        </h3>
                                        <ul class="action-button">                               
                                            <li>
                                                <a href="../../add_cart.php?id=${this.id}" title="Add to cart">Thêm vào giỏ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>`;

                gridContent += gridCard;
            });
            return gridContent;
        }

        function getShopFilter() {
            var opts = [];
            checkboxes.each(function () {
                if(this.checked) {
                    opts.push(this.name);
                }
            })
            return opts;
        }
        var countProds = 0;
        function updateShopList(opts, prices, order, search) {
            $.ajax({
                type: "POST",
                url: "../../filter/processFilter.php",
                dataType: "json",
                cache: false,
                data: {filterOpts: opts, priceRange: prices, order: order, search: search},
                success: function (records) {
                    countProds = records.length;
                    $("#countProds").html(`Có tất cả: ${countProds} sản phẩm`);
                    $('#listView').html(createProdList(records));
                    $('#gridView').html(createProdGrid(records));
                }
            })
        }
        var defaultPrice = [0, 30000000];
        var checkboxes = $("input:checkbox");
        checkboxes.on("change", function () {
            var opts = getShopFilter();
            var prices = defaultPrice;
            var order = getOrder();
            updateShopList(opts, prices, order, search);
        })

        function getPriceFilter() {
            return $("#slider-range").slider("values");
        }

        function getOrder() {
            return $("#orderFilter").val();
        }

        $("#orderFilter").on("change", function () {
            var opts = getShopFilter();
            var prices = defaultPrice;
            var order = getOrder();
            updateShopList(opts, prices, order, search);
        })

        $("#slider-range").on("slidechange", function( event, ui ) {
            var opts = getShopFilter();
            var prices = getPriceFilter();
            var order = getOrder();
            updateShopList(opts, prices, order, search);
        })

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        updateShopList([], defaultPrice, getOrder(), search);
    </script>
</body>

</html>