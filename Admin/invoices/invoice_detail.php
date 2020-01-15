<?php
require_once '../public/verify.php';
require_once '../public/db.php';
$id_invoice = isset($_GET['id']) ? $_GET['id'] : '1';
$query_invoices = "select status, $table_users.email as Uemail, $table_users.address as Uaddress,$table_users.phone_number as Uphone, $table_users.avatar as Uavatar, $table_users.`name` as Uname, $table_invoices.id as id, $table_invoices.total_price as total, $table_invoices.created_at as date FROM $table_invoices JOIN $table_users ON $table_invoices.user_id=$table_users.id where invoices.id = $id_invoice";
$data_invoices = executeQuery($query_invoices, false);
$query_invoice_detail = "select * from $table_invoice_detail where invoice_id ='$id_invoice'";
$data_invoice_detail = executeQuery($query_invoice_detail, true);

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
  <style type="text/css">
    .search {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .search__icon {
      position: absolute;
      top: 0px;
      right: 0px;
      background-color: transparent;
      width: 30px;
      height: 30px;
      font-size: 1.35em;
      text-align: center;
      border-color: transparent;
      display: inline-block;
    }
    .search * {
      outline: none;
      box-sizing: border-box;
    }
    .search__field {
      border: 0px;
      border-bottom: 1px solid #ccc;
      width: 50vw;
      height: 30px;
      color: transparent;
      font-family: Lato, sans-serif;
      font-size: 1.35em;
      padding: 0.35em 30px 0.35em 5px;
      border-radius: 0;
      color: #2b2b2b;
      transition: all 0.5s ease-in-out;
    }
    #example2 th{
      text-align: center;
    }
    .avatar{
      width: 50px;
      text-align: center;
      font-size: 25px;
    }
    .avatar a i{
      padding-top: 35%;
    }
    .phantrang{
      position: absolute;
      bottom: -30px;
      right: 5px;
    }
  </style>
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
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> MiStore,  <span>Mã hóa đơn #<?=$data_invoices['id']?> <span class="btn
              <?php if ($data_invoices['status'] == 'đã hủy'): ?>
                btn-danger
              <?php elseif ($data_invoices['status'] == 'đang vận chuyển'): ?>
                btn-warning
              <?php elseif ($data_invoices['status'] == 'chờ xác nhận'): ?>
                btn-warning
              <?php elseif ($data_invoices['status'] == 'đã xác nhận'): ?>
                btn-primary
              <?php elseif ($data_invoices['status'] == 'hoàn thành'): ?>
                btn-success
              <?php else: ?>

              <?php endif?>"> <?=$data_invoices['status']?></span></span>
            <small class="pull-right">Thời điểm tạo hóa đơn: <?=$data_invoices['date']?></small>


          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-5 invoice-col">
          <div class="col-sm-12">Thông tin người nhận</div>
          <address>
            <div class="col-sm-4"><strong>Tên:</strong></div><div class="col-sm-8"><?=$data_invoices['Uname']?></div>
            <div class="col-sm-4"><strong>Địa chỉ:</strong></div><div class="col-sm-8"><?=$data_invoices['Uaddress']?></div>
            <div class="col-sm-4"><strong>Email:</strong></div><div class="col-sm-8"><?=$data_invoices['Uemail']?></div>
            <div class="col-sm-4"><strong>Số điện thoại:</strong></div><div class="col-sm-8"><?=$data_invoices['Uphone']?></div>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12">
         <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th style="padding-left: 0px">Số lượng</th>
              <th>Tên sản phẩm</th>
              <th>giá</th>
              <th>Mô tả ngắn</th>
              <th>Tổng giá sản phẩm</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data_invoice_detail as $i_p): ?>
              <tr>
              <td><?=$i_p['quantity']?></td>
              <td><?=$i_p['name']?></td>
              <td><?=$i_p['price']?></td>
              <td><?=$i_p['short_desc']?></td>
              <td><?=$i_p['total']?></td>
            </tr>
            <?php endforeach?>
            </tbody>
          </table>
        </div>
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Thông tin thanh toán</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Tổng hóa đơn:</th>
                <td><?=$data_invoices['total']?></td>
              </tr>
              <tr>
                <th>VAT (10%)</th>
                <td><?=$data_invoices['total'] / 10?></td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>300</td>
              </tr>
              <tr>
                <th>Tổng người mua thanh toán:</th>
                <td><?=$data_invoices['total'] + $data_invoices['total'] / 10 + 300?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a onclick="window.print()" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

          <?php if ($data_invoices['status'] == 'chờ xác nhận'): ?>
          <button onclick="xac_nhan('save_update.php?id=<?=$id_invoice?>&status=đã xác nhận','xác nhận')" type="button" class="btn btn-primary" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Xác nhận đơn hàng
          </button>
          <?php endif?>

          <?php if ($data_invoices['status'] == 'đã xác nhận'): ?>
          <button onclick="xac_nhan('save_update.php?id=<?=$id_invoice?>&status=đang vận chuyển','đang vận chuyển')" type="button" class="btn btn-primary" style="margin-right: 5px;">
            <i class="fas fa-shipping"></i> Xác nhận vận chuyển
          </button>
          <?php endif?>

          <?php if ($data_invoices['status'] == 'đang vận chuyển'): ?>
          <button onclick="xac_nhan('save_update.php?id=<?=$id_invoice?>&status=hoàn thành','hoàn thành')" type="button" class="btn btn-primary" style="margin-right: 5px;">
            <i class="fas fa-shipping"></i> Xác nhận đơn hàng đã hoàn thành
          </button>
          <?php endif?>

          <?php if ($data_invoices['status'] != 'đã hủy' && $data_invoices['status'] != 'hoàn thành'): ?>
          <button onclick="xac_nhan('save_update.php?id=<?=$id_invoice?>&status=đã hủy','hủy')" type="button" class="btn btn-danger pull-right">
            <i class="fa fa-remove"></i> Hủy đơn hàng
          </button>
          <?php endif?>


        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once '../public/footer.php';?>
</div>
<?php require_once '../public/script.php';?>
<script type="text/javascript">
    if ($('#invoice').length == 0) {
      $('.aka').css('text-align', 'center');
      $('.aka').css('line-height', '400px');
      $('.aka').css('font-size', '25px');
      $('.aka').append("<b>không tìm thấy hóa đơn của <?php if (isset($_GET['q'])): ?><?=$q?><?php endif?></b>");
    };
    function xac_nhan(url,btn) {
      swal({
        title: "bạn có chắc chắn muốn "+btn+" đơn hàng này không?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    }
</script>

</body>
</html>