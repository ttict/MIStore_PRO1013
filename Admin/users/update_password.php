<?php
require_once '../public/verify.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin MiStore | Log in</title>
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
        Đầy đủ thông tin vào các trường
      <?php endif?>
    </p>
    <form action="save_update_password.php" method="post">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Nhập Mật Khẩu Cũ ..." name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Nhập Mật Khẩu Mới ..." name="Newpassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Nhập Lại Mật Khẩu Mới ..." name="ReNewpassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Lưu</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php require_once '../public/script.php';?>
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
