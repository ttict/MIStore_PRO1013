<?php
require_once '../public/verify.php';
require_once '../public/db.php';
// $query_invoices_detail
$query_invoices = "select status, $table_users.avatar as Uavatar, $table_users.`name` as Uname, $table_invoices.id as id, $table_invoices.total_price as total FROM $table_invoices JOIN $table_users ON $table_invoices.user_id=$table_users.id";
if (isset($_GET['q'])) {
	$q = $_GET['q'];
	$query_invoices .= " where $table_users.`name` like '%$q%'";
}
$query_invoices .= " order by $table_invoices.id asc";
$row = executeQuery("select count(id) as total from ($query_invoices) as ab");
$total_records = $row['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}
$start = ($current_page - 1) * $limit;
$query_invoices .= " LIMIT $start, $limit";
$data_invoices = executeQuery($query_invoices, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MiStore | Danh sách hóa đơn</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require_once '../public/style.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php';?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-print"></i>Quản lý hóa đơn</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý hóa đơn</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-xs-12">
        <div class="col-xs-12">
          <div class="box bg-light">
            <!-- box-header -->
            <div class="box-header">
              <h3 class="box-title">Danh sách hóa đơn</h3>
              <form class="search" id="search_u" method="get" action="">
                <div class="search__wrapper">
                  <input type="text" name="q" placeholder="Tìm hóa đơn theo tên khách hàng..." class="search__field">
                  <button type="submit" class="fa fa-search search__icon"></button>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
            <!-- box-body -->
            <div class="box-body">
              <div class="col-xs-12">
                <div class="col-xs-12">
                  <div class="col-xs-12 bg-gray">
                    <div class="invoice_tit col-xs-9 mg-10">
                      <div class="col-xs-3">Sản phẩm</div>
                      <div class="col-xs-3">Giá sản phẩm</div>
                      <div class="col-xs-3">Số lượng</div>
                      <div class="col-xs-3">Tổng giá sản phẩm</div>
                    </div>
                    <div class="col-xs-3 pd-0 mg-10">
                      <div class="col-xs-8 pd-0">Tình trạng đơn</div>
                      <div class="col-xs-4 pd-0">Thao tác</div>
                    </div>
                  </div>
                  <?php foreach ($data_invoices as $i): ?>
                    <div class="box col-xs-12 mg-10 invoice-bw" id="invoice">
                      <?php
                        $id_invoice = $i['id'];
                        $query_invoice_detail = "select * from $table_invoice_detail where invoice_id ='$id_invoice'";
                        $data_invoice_detail = executeQuery($query_invoice_detail, true);
                      ?>
                      <div class="col-xs-6 pd-0">
                        <img class="img-circle invoice_avatar" src="<?=$i['Uavatar']?>" alt="" width="50px"><?=$i['Uname']?>
                      </div>
                      <div class="col-xs-6 invoice_id">
                        <span>ID hóa đơn #<?=$i['id']?></span>
                      </div>
                      <div class="col-xs-12" style="border-bottom: 1px solid #ccc; margin-bottom: 5px"></div>
                      <div class="col-xs-12 pd-0">
                        <!-- product -->
                        <?php foreach ($data_invoice_detail as $i_p): ?>
                          <div class="col-xs-9 mg-10">
                            <div class="col-xs-1 pd-0">
                              <img src="<?=$i_p['image']?>" alt="product" width="100%">
                            </div>
                            <div class="col-xs-2"><?=$i_p['name']?></div>
                            <div class="col-xs-3"><?=$i_p['price']?> VND</div>
                            <div class="col-xs-3">x <?=$i_p['quantity']?></div>
                            <div class="col-xs-3"><?=$i_p['total']?> VND</div>
                          </div>
                        <?php endforeach?>
                        <!-- /.product -->
                        <div class="col-xs-3 pd-0 mg-10">
                          <div class="col-xs-8 pd-0"><?=$i['status']?></div>
                          <div class="col-xs-4 pd-0"><a class="btn btn-success" href="invoice_detail.php?id=<?=$i['id']?>">Chi tiết</a></div>
                        </div>
                      </div>
                      <div class="col-xs-12 invoice_footer">Tổng giá trị hóa đơn: <?=$i['total']?></div>
                    </div>
                  <?php endforeach?>
                </div>
              </div>
              <!-- phân trang  -->
              <div class="phantrang">
                <?php if ($current_page > 1 && $total_page > 1): ?>
                  <a href="list_invoice.php?page=<?=$current_page - 1?>">Prev</a> |
                <?php endif?>
                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                <?php if ($i == $current_page): ?>
                  <span><?=$i?></span>|
                <?php else: ?>
                  <a href="list_invoice.php?page=<?=$i?>"><?=$i?></a> |
                <?php endif?>
                <?php endfor?>
                <?php if ($current_page < $total_page && $total_page > 1): ?>
                  <a href="list_invoice.php?page=<?=$current_page + 1?>">Next</a>
                <?php endif?></div>
              <!-- hết phân trang -->
            </div>
            <!-- /.box-body -->
          </div>
          <!--/.bg-light-->
        </div>
      </div>
      <!--/.col-xs-12 -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once '../public/footer.php';?>
</div>
<?php require_once '../public/script.php';?>
<script type="text/javascript">
    if ($('#invoice').length == 0) {
      $('.box-body').empty();
      $('.box-body').css('text-align', 'center');
      $('.box-body').css('line-height', '400px');
      $('.box-body').css('font-size', '25px');
      $('.box-body').append("<b>không tìm thấy hóa đơn của <?php if (isset($_GET['q'])): ?><?=$q?><?php endif?></b>");
    };
</script>

</body>
</html>