<?php 
  require_once '../public/verify.php';
  require_once '../public/db.php';
  require_once '../public/geturl.php';
  $pageURL = getURL();
  $query_setting ="select * from $table_web_setting";
  // var_dump($query_setting);die;
  $data_setting=executeQuery($query_setting);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require_once '../public/style.php'; ?>
  <style type="text/css">
    .div-logo{
      width: 100%;
      height: 200px;
      position: relative;
      border: 2px dashed #ccc;
      text-align: center;
    }
    .img-logo{
      height: 100%;
      margin: 0 auto;
    }
    .input-logo{
      position: absolute;
      width: 100%;
      height: 100%;
      top:0;
      right: 0;
      opacity: 0;
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
      <h1><i class="fa fa-users"></i>
        Quản lý website
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý website</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Thông số website</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="save_update_setting.php" method="post" enctype="multipart/form-data">


                  <div class="form-group"> 
                        <label for="inputavatar" class="col-sm-2 control-label">Logo</label>


                        <div class="col-sm-1"> </div>
                        <div class="col-sm-10">
                          <div class="div-logo">
                            <img src="<?=$data_setting['logo_url']?>" alt="" class="img-logo" id="logo" style="width: 100%">
                              <input name="logo" type="file" class="input-logo" id="fileUpload">
                          </div>
                        </div>
                  </div>


                  <div class="form-group">
                    <label for="inputname" class="col-sm-2 control-label">Hotline</label>

                    <div class="col-sm-10">
                      <input name="hotline" type="text" class="form-control" id="inputname" placeholder="Tên" value="<?=$data_setting['hotline']?>">
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Email" value="<?=$data_setting['email']?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputaddress" class="col-sm-2 control-label">Địa chỉ</label>

                    <div class="col-sm-10">
                      <input name="address" type="text" class="form-control" id="inputaddress" placeholder="Địa chỉ" value="<?=$data_setting['address']?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputaddress" class="col-sm-2 control-label">Facebook</label>

                    <div class="col-sm-10">
                      <input name="facebook" type="text" class="form-control" id="inputaddress" placeholder="Địa chỉ" value="<?=$data_setting['facebook']?>">
                    </div>
                  </div>


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
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<?php require_once '../public/script.php'; ?>
<script type="text/javascript">
$('#fileUpload').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#logo").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
});
</script>
<?php if (isset($_GET['update'])): ?>
    <script type="text/javascript">
      $(document).ready(function() {
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