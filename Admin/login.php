<?php
session_start();
require_once 'public/db.php';
if (isset($_COOKIE['auth'])) {
	$auth = $_COOKIE['auth'];
	$query_user = "select * from users where password like '$auth'";
	$_SESSION['auth'] = executeQuery($query_user);
}
if (isset($_SESSION['auth'])) {
	if ($_SESSION['auth']['role'] > 1) {
		header('location: index.php');die;
	}
	header('location: ../client/');die;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin MiStore | Log in</title>
  <?php require_once 'public/style.php';?>
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
        Nhập đầy đủ Email và Mật khẩu
      <?php endif?>
    </p>
    <form action="check_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email ..." name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Mật Khẩu ..." name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
    <a href="forgot_password/forgot_password.php">I forgot my password</a><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php require_once 'public/script.php';?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
