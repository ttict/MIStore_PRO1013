<?php require_once 'common.php'; require_once 'geturl.php'; require_once 'db.php';

?>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=$_SESSION['auth']['avatar']?>" class="img-circle" alt="User">
      </div>
      <div class="pull-left info">
        <p><?=$_SESSION['auth']['name']?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="tìm kiếm...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </button>
        </span>
      </div>
    </form>

    <ul class="sidebar-menu" data-widget="tree">
      <li <?php if (strpos(getURL(), 'Admin/index.php')): ?>class="active"<?php endif ?>>
        <a href="<?=BASE_URL?>index.php">
          <i class="fa fa-dashboard"></i> 
          <span>Trang chủ</span>
        </a>
      </li>
      <li <?php if (strpos(getURL(), 'Admin/users/')): ?>class="active"<?php endif ?>>
        <a href="<?=BASE_URL?>users/list_user.php">
          <i class="fa fa-users"></i> 
          <span>Quản lý users</span>
        </a>
      </li>
      <li class="treeview <?php if (strpos(getURL(), 'Admin/products/')):?>active<?php endif ?>">
        <a>
          <i class="fa fa-cubes"></i>
          <span>Quản lý sản phẩm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?=BASE_URL?>products/list.php"><i class="fa fa-list-alt"></i> Danh sách sản phẩm</a>
          </li>
          <li>
            <a href="<?=BASE_URL?>products/add.php"><i class="fa fa-plus-square"></i> Thêm sản phẩm</a>
          </li>
        </ul>
      </li>
      <li <?php if (strpos(getURL(), 'Admin/invoices/')): ?>class="active"<?php endif ?>>
        <a href="<?=BASE_URL?>invoices/list_invoice.php">
          <i class="fa fa-print"></i> <span>Quản lý hóa đơn</span>
        </a>
      </li>
      <li>
        <a href="<?=BASE_URL?>comments/list.php">
          <i class="fa  fa-paper-plane-o"></i> <span>Quản lý bình luận</span>
        </a>
      </li>
      <li class="treeview <?php if (strpos(getURL(), 'Admin/settings/')):?>active<?php endif ?>">
        <a>
          <i class="fa fa-gears"></i>
          <span>Quản lý website</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if (strpos(getURL(),'slider.php')):?>class="active"<?php endif ?>>
            <a href="<?=BASE_URL?>settings/slider.php"><i class="fa fa-sliders"></i> Slider</a>
          </li>
          <li <?php if (strpos(getURL(), 'setting.php')):?>class="active"<?php endif ?>>
            <a href="<?=BASE_URL?>settings/setting.php"><i class="fa fa-gear"></i> Cài đặt chung</a>
          </li>
        </ul>
      </li>
    </ul>
    <!-- /.sidebar menu -->
  </section>
</aside>