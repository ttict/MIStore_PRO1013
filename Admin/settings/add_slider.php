<?php 
  require_once '../public/verify.php';
  require_once '../public/db.php';
  require_once '../public/geturl.php';
  // var_dump($data_slider);die;
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
              <h3 class="box-title">Slider</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <form class="form-horizontal" action="save_add_slider.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" >
                  <div class="form-group">
                    <label for="inputtitle" class="col-sm-2 control-label">Tiêu đề</label>

                    <div class="col-sm-10">
                      <input name="title" type="text" class="form-control" id="inputtitle" placeholder="Tiêu đề">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputurl" class="col-sm-2 control-label">liên kết</label>

                    <div class="col-sm-10">
                      <input name="url" type="text" class="form-control" id="inputurl" placeholder="url">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputshort_desc" class="col-sm-2 control-label">Mô tả</label>

                    <div class="col-sm-10">
                      <input name="short_desc" type="text" class="form-control" id="inputshort_desc" placeholder="Địa chỉ" >
                    </div>
                  </div>

                  <div class="form-group"> 
                    <label for="inputtitle" class="col-sm-2 control-label">Ảnh slider</label>
                    <div class="col-sm-10">
                      <div class="div-logo">
                        <?php if (isset($_GET['elogo'])): ?>
                          <p class="aha"><?= $_GET['elogo'] ?></p>
                        <?php endif ?>
                        <img src="" alt="" class="img-logo" id="logo">
                          <input name="image_url" type="file" class="input-logo" id="fileUpload">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                      <button type="submit" class="btn btn-danger">Lưu</button>
                    </div>
                  </div>
                </form>
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
    $('.aha').css('display', 'none');
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#logo").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
});
</script>
</body>
</html>