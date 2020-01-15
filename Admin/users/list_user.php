<?php 
  require_once '../public/verify.php';
  require_once '../public/db.php';
  require_once '../public/geturl.php';
  $pageURL = getURL();
  $id_user = $_SESSION['auth']['id'];
  $query_user = "select * from $table_users where id<>'$id_user'";
  if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $query_user.= "and name like '%$q%'";
  }
  $row = executeQuery("select count(id) as total from ($query_user) as ab");
  $total_records = $row['total'];
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
  $total_page = ceil($total_records / $limit);
  if ($current_page > $total_page){
    $current_page = $total_page;
  }
  else if ($current_page < 1){
    $current_page = 1;
  }
  $start = ($current_page - 1) * $limit;
  $query_user.= "LIMIT $start, $limit";
  $data_user = executeQuery($query_user,true);
  
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
        Quản lý người dùng
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý người dùng</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách người dùng</h3>
              <form class="search" id="search_u" method="get" action="">
                <div class="search__wrapper">
                  <input type="text" name="q" placeholder="Search for..." class="search__field">
                  <button type="submit" class="fa fa-search search__icon"></button>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th>Avatar</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>số điện thoại</th>
                    <th>giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>
                <tbody id="list_u">
                <?php foreach ($data_user as $u): ?>
                    <tr id="user">
                      <td class="avatar"><img class="img-circle" src="<?=$u['avatar']?>" alt="" width="100%"></td>
                      <td width="100/10%"><?=$u['name']?></td>
                      <td width="100/10%"><?=$u['email']?></td>
                      <td width="100/10%"><?=$u['phone_number']?></td>
                      <td width="100/10%"><?=$u['gender']?></td>
                      <td width="100/10%"><?=$u['address']?></td>
                      <td width="100/10%" class="avatar"><a href="profile.php?idu=<?=$u['id']?>"><i class="fa  fa-user"></i></a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Avatar</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>số điện thoại</th>
                    <th>giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Chi tiết</th>
                  </tr>
                </tfoot>
                
              </table>
              <div class="phantrang">
                <?php if ($current_page > 1 && $total_page > 1): ?>
                  <a href="list_user.php?page=<?=$current_page-1?>">Prev</a> |
                <?php endif ?>
                <?php for ($i = 1; $i <= $total_page; $i++):?>
                <?php if ($i == $current_page): ?>
                  <span><?=$i?></span>|
                <?php else: ?>
                  <a href="list_user.php?page=<?=$i?>"><?=$i?></a> |
                <?php endif ?>
                <?php endfor ?>
                 <?php if ($current_page < $total_page && $total_page > 1): ?>  
                  <a href="list_user.php?page=<?=$current_page+1?>">Next</a>
                 <?php endif ?>
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
    if ($('#user').length == 0) {
      $('#example2').css('display', 'none');  
      $('.box-body').css('text-align', 'center');  
      $('.box-body').css('line-height', '350px');  
      $('.box-body').css('font-size', '25 px');  
      $('.box-body').append("<b>không tìm thấy người dùng</b>");
    };
</script>

</body>
</html>