<?php 
  require_once '../public/verify.php';
  require_once '../public/db.php';
  require_once '../public/geturl.php';
  $pageURL = getURL();
  $slider_query = "select * from $table_sliders order by sort_order asc";
  $data_sliders = executeQuery($slider_query,true);
  $total_recond = executeQuery('select count(id) as total from sliders as a');
  // var_dump($total_recond['total']);die;
  // var_dump($data_sliders);die;
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
    table th{
      text-align: center;
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
              <table class="table table-bordered table-hover" style="text-align: center;">
                <thead>
                  <th>Vị trí</th>
                  <th>Tiêu đề</th>
                  <th>Mô tả ngắn</th>
                  <th>Ảnh</th>   
                  <th><a href="add_slider.php" class="btn btn-success"><i class="fa fa-plus-square-o"></i></a></th>
                </thead>
                <tbody>
                  <form action="change_order.php" method="post">
                    <?php foreach ($data_sliders as $slider): ?>
                    <tr>
                      <td><?=$slider['sort_order']?></td>
                      <td><?=$slider['title'] ?></td>
                      <td><?=$slider['short_desc'] ?></td>
                      <td><img src="<?=$slider['image_url'] ?>" height="50" alt=""></td>
                      <td>
                        <a href="update.php?id=<?=$slider['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        <a onclick="remove_slider('remove.php?id=<?=$slider['id'] ?>')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </form>
                </tbody>
              </table>
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
  function remove_slider(url) {
    var conf= confirm('bạn có muốn xóa slider này không?');
    if (conf) {
      window.location = url;
    }
  }
</script>
</body>
</html>