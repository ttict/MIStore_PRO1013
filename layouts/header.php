<!-- Loader area -->
<div class="loader-wrapper">
    <div class="loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>
<!-- START HEADER AREA -->
<header class="header-area header-wrapper">
    <!-- header-top-bar -->
    <div class="header-top-bar plr-185">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 hidden-xs">
                    <div class="call-us">
                        <p class="mb-0 roboto">(+88) 01234-567890</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="top-link clearfix">
                        <ul class="link f-right">
                            
                            <?php if(isset($_SESSION['auth'])): ?>
                            <li>
                                <a href="<?= BASE_URL . "my-account.php" ?>">
                                    <i class="zmdi zmdi-account"></i>
                                    <?= $_SESSION['auth']['name'] ?> | Tài khoản
                                </a>
                            </li>
                            <li>
                                <a href=<?= BASE_URL . "login/signout.php" ?>>
                                <i class="zmdi zmdi-lock"></i>
                                Đăng xuất
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if(!isset($_SESSION['auth'])): ?>
                            <li>
                                <a href=<?= BASE_URL . "login.php" ?>>
                                    <i class="zmdi zmdi-lock"></i>
                                    Đăng nhập
                                </a>
                            </li>
                                <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle-area -->
    <div id="sticky-header" class="header-middle-area plr-185">
        <div class="container-fluid">
            <div class="full-width-mega-dropdown">
                <div class="row">
                    <!-- logo -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="logo">
                            <a href="<?= BASE_URL . "index.php" ?>">
                                <img src="img/logo/logo.png" alt="main logo">
                            </a>
                        </div>
                    </div>
                    <!-- primary-menu -->
                    <div class="col-md-8 hidden-sm hidden-xs">
                        <nav id="primary-menu">
                            <ul class="main-menu text-center">
                                <li>
                                    <a href="<?= BASE_URL . "index.php"?>">Trang chủ</a>
                                </li>

                                <li>
                                    <a href="<?= BASE_URL . "about.php" ?>">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL . "shop.php?order=new"?>">Sản phẩm mới</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL . "shop.php?order=hot"?>">Sản phẩm hot</a>
                                </li>
                                <li>
                                    <a href="<?= BASE_URL . "contact.php"?>">Liên hệ</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- header-search & total-cart -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="search-top-cart  f-right">
                            <!-- header-search -->
                            <div class="header-search f-left">
                                <div class="header-search-inner">
                                    <button class="search-toggle">
                                    <i class="zmdi zmdi-search"></i>
                                    </button>
                                    <form action="<?= BASE_URL . "shop.php" ?>" method="GET">
                                        <div class="top-search-box">
                                            <input type="text" name="search" placeholder="Nhập tên sản phẩm...">
                                            <button type="submit">
                                                <i class="zmdi zmdi-search"></i>
                                            </button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                            <!-- total-cart -->
                            <div class="total-cart f-left">
                                <div class="total-cart-in">
                                    <div class="cart-toggler">
                                        <a href="<?= BASE_URL . "cart.php" ?>">
                                            <span class="cart-quantity"><?= isset($_SESSION['cart'])?count($_SESSION['cart']):0 ?></span><br>
                                            <span class="cart-icon">
                                                <i class="zmdi zmdi-shopping-cart-plus"></i>
                                            </span>
                                        </a>                            
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER AREA -->

<!-- START MOBILE MENU AREA -->
<div class="mobile-menu-area hidden-lg hidden-md">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="index.php">Home</a>
                                <ul>
                                    <li>
                                        <a href="index.php">Home Version 1</a>
                                    </li>
                                    <li>
                                        <a href="index-2.html">Home Version 2</a>
                                    </li>
                                    <li>
                                        <a href="index-3.html">Home Version 3</a>
                                    </li>
                                    <li>
                                        <a href="index-4.html">Home 4 Animated Text</a>
                                    </li>
                                    <li>
                                        <a href="index-5.html">Home 5 Animated Text Ovlerlay</a>
                                    </li>
                                    <li>
                                        <a href="index-6.html">Home 6 Background Video</a>
                                    </li>
                                    <li>
                                        <a href="index-7.html">Home 7 BG-Video Ovlerlay</a>
                                    </li>
                                    <li>
                                        <a href="index-8.html">Home 8 Boxed-1</a>
                                    </li>
                                    <li>
                                        <a href="index-9.html">Home 9 Gradient</a>
                                    </li>
                                    <li>
                                        <a href="index-10.html">Home 10 Boxed-2</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="shop.html">Products</a>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul>
                                    <li>
                                        <a href="shop.html">Shop</a>
                                    </li>
                                    <li>
                                        <a href="shop-left-sidebar.html">Shop Left Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="shop-right-sidebar.html">Shop Right Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="shop-list.html">Shop List</a>
                                    </li>
                                    <li>
                                        <a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="single-product.html">Single Product</a>
                                    </li>
                                    <li>
                                        <a href="single-product-left-sidebar.html">Single Product Left Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="single-product-no-sidebar.html">Single Product No Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="cart.html">Shopping Cart</a>
                                    </li>
                                    <li>
                                        <a href="wishlist.html">Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="checkout.html">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="order.html">Order</a>
                                    </li>
                                    <li>
                                        <a href="login.html">Login</a>
                                    </li>
                                    <li>
                                        <a href="My-account.html">My Account</a>
                                    </li>
                                    <li>
                                        <a href="about.html">About us</a>
                                    </li>
                                    <li>
                                        <a href="404.html">404</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</a>
                                <ul>
                                    <li>
                                        <a href="blog.html">Blog</a>
                                    </li>
                                    <li>
                                        <a href="blog-left-sidebar.html">Blog Left Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="blog-right-sidebar.html">Blog Right Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="blog-2.html">Blog style 2</a>
                                    </li>
                                    <li>
                                        <a href="blog-2-left-sidebar.html">Blog 2 Left Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="blog-2-right-sidebar.html">Blog 2 Right Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="blog-details.html">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="about.html">About Us</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MOBILE MENU AREA -->