<?php require_once 'common.php'; ?>
<header class="main-header">
  <a href="<?=BASE_URL?>index.php" class="logo">
    <span class="logo-mini"><b>A</b>LT</span>
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?=$_SESSION['auth']['avatar']?>" class="user-image" alt="User">
            <span class="hidden-xs"><?=$_SESSION['auth']['name']?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="<?=$_SESSION['auth']['avatar']?>" class="img-circle" alt="User">
              <p>
                <?=$_SESSION['auth']['name']?> - <?=$_SESSION['auth']['gender']?>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?=BASE_URL?>users/profile.php" class="btn btn-default btn-flat">Tài khoản của tôi</a>
              </div>
              <div class="pull-right">
                <a href="<?=BASE_URL?>logout.php" class="btn btn-default btn-flat">Đăng xuất</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>