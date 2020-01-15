<?php 
  require_once '../public/verify.php';
  require_once '../public/db.php';
  $user_id = $_SESSION['auth']['id'];
  if (isset($_GET['idu'])) {
    if ($_GET['idu']<1) {
      header("location:profile.php?idu=1");die;
    }
    $user_id = $_GET['idu'];
  }
  $query_user = "select * from $table_users where id='$user_id'";
  $data_user = executeQuery($query_user);
  $query_invoice = "select count(id) as total from $table_invoices where user_id='$user_id'";
  $data_invoice = executeQuery($query_invoice);
  $query_comment = "select count(id) as total from $table_comments where user_id='$user_id'";
  $data_comment = executeQuery($query_invoice);
  // var_dump($data_invoice);die;
  // var_dump($user_id);die;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE  | Trang chủ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require_once '../public/style.php'; ?>

  <style type="text/css">
    .form-control{
      cursor: pointer !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-dashboard"></i>
        Thông tin cá nhân
      </h1>
    </section>

    <!-- Main content -->
        <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=$data_user['avatar']?>" alt="User">

              <h3 class="profile-username text-center"><?=$data_user['name']?></h3>

              <p class="text-muted text-center"><?=$data_user['phone_number']?></p>

              <p class="text-muted text-center"><?=$data_user['email']?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Tổng số hóa đơn</b> <a class="pull-right"><?=$data_invoice['total']?></a>
                </li>
                <li class="list-group-item">
                  <b>Tổng số bình luận</b> <a class="pull-right"><?=$data_invoice['total']?></a>
                </li>
              </ul>
              <?php if ($data_user['id']==$_SESSION['auth']['id']): ?>
                <a href="update_password.php" class="btn btn-primary btn-block"><b>Đổi mật khẩu</b></a>
              <?php endif ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="save_update_user.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputname" class="col-sm-2 control-label">Tên</label>

                    <div class="col-sm-10">
                      <input <?php if ($user_id != $_SESSION['auth']['id']): ?>disabled <?php endif ?> name="name" type="text" class="form-control" id="inputname" placeholder="Tên" value="<?=$data_user['name']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input <?php if ($user_id != $_SESSION['auth']['id']): ?>disabled <?php endif ?> name="email" type="text" class="form-control" id="inputEmail" placeholder="Email" value="<?=$data_user['email']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputaddress" class="col-sm-2 control-label">Địa chỉ</label>

                    <div class="col-sm-10">
                      <input <?php if ($user_id != $_SESSION['auth']['id']): ?>disabled <?php endif ?> name="address" type="text" class="form-control" id="inputaddress" placeholder="Địa chỉ" value="<?=$data_user['address']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputgender" class="col-sm-2 control-label">Giới tính</label>
                    <div class="col-sm-10">
                      <select <?php if ($user_id != $_SESSION['auth']['id']): ?>disabled <?php endif ?> name="gender" id="inputrole" class="form-control" id="inputgender">
                        <option <?php if ($data_user['gender'] == 'men'): ?> selected <?php endif ?> value="men">Nam</option>
                        <option <?php if ($data_user['gender'] == 'women'): ?> selected <?php endif ?> value="women">Nữ</option>
                      </select>
                    </div>
                  </div>
                  <?php if ($user_id == $_SESSION['auth']['id']): ?>
                    <div class="form-group">
                    <label for="inputavatar" class="col-sm-2 control-label">Ảnh đại diện</label>

                    <div class="col-sm-10">
                      <input name="avatar" type="file" class="form-control" id="inputavatar">
                    </div>
                  </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="inputphone" class="col-sm-2 control-label">Số điện thoại</label>

                    <div class="col-sm-10">
                      <input <?php if ($user_id != $_SESSION['auth']['id']): ?>disabled <?php endif ?> name="phone_number" type="text" class="form-control" id="inputphone" placeholder="Số điện thoại" value="<?=$data_user['phone_number']?>">
                    </div>
                  </div>
                  <?php if ($user_id != $_SESSION['auth']['id'] && $_SESSION['auth']['role']==1000): ?>
                  <div class="form-group">
                    <label for="inputrole" class="col-sm-2 control-label">Tác vụ</label>
                    <div class="col-sm-10">
                      <select name="role" id="inputrole" class="form-control" id="inputrole">
                        <option <?php if ($data_user['role'] == 1): ?> selected <?php endif ?> value="1">người dùng thường</option>
                        <option <?php if ($data_user['role'] == 2): ?> selected <?php endif ?> value="2">người Quản lý</option>
                      </select>
                    </div>
                  </div>
                  <?php endif ?>
                  <!-- <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div> -->
                  <!-- <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div> -->
                  <input type="hidden" value="<?=$user_id?>" name="idu">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                      <button type="submit" class="btn btn-danger">cập nhật thông tin</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once '../public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php require_once '../public/script.php'; ?>
<?php if (isset($_GET['update'])): ?>
    <script type="text/javascript">
      $(document ).ready(function() {
      swal({
        title:"cập nhật thành công!",
        icon: "success",
        timer: 1500
      });
      
      });
    </script>
  <?php endif?>
</body>
</html>