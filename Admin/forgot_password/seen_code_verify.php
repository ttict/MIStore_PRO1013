<?php
session_start();
require_once '../public/db.php';
if (isset($_COOKIE['auth'])) {
	$auth = $_COOKIE['auth'];
	$query_user = "select * from users where password like '$auth'";
	$_SESSION['auth'] = executeQuery($query_user);
}
if (isset($_SESSION['auth'])) {
	if ($_SESSION['auth']['role'] > 1) {
		header('location: ../index.php');die;
	}
	header('location: ../../client/');die;
}
if (!isset($_SESSION['user_email'])) {
	header('location: ../index.php');die;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin MiStore | forgot-password</title>
  <?php require_once '../public/style.php';?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Admin</b>Mistore</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      <?php if (isset($_GET['err'])): ?>
        <i style="color: red"><?=$_GET['err']?></i>
      <?php else: ?>
        Nhập mã xác nhận đã được gửi về Email
      <?php endif?>
    </p>
    <form action="check_code_verify.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nhập mã xác nhận" name="code">
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Gửi</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php require_once '../public/script.php';?>
</body>
</html>