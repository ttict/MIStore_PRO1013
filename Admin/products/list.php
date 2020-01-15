<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	$query_product = "select * from products";
	$products = executeQuery($query_product, true);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Danh sách sản phẩm</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php require_once '../public/style.php' ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<style type="text/css">
			.products-list-td:nth-child(4){
				text-align: left;
			}
			th, table tbody tr td.products-list-td{
				vertical-align: middle;
				text-align: center;
				overflow: hidden;
			}
			.avatar{
				text-align: center;
			}
			td .img-square{
				width: 50px;
				height: 50px;
				overflow: hidden;
				object-fit: cover;
			}
			.search-bar {
				height: 30px;
			}
			#color_front{
				border-radius: 50%;
				width: 30px;
				height: 30px; 
				display:inline-block;
			}
			input[type=color]  {
				display: none;
			}
			.pagination {
				position: absolute;
				bottom: -48px;
				right: 5px;
			}
		</style>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<?php require_once '../public/header.php'; ?>
		<div class="wrapper">
			<?php require_once '../public/sidebar.php'; ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1><i class="fa fa-list-alt"></i>
						Danh sách sản phẩm
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
						<li class="active">Danh sách sản phẩm</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<form name="deleteCheckboxRequest" action="<?= 'deleteCheckbox.php'?>" method="post" enctype="multipart/form-data">
										<table id="mydata" class="table table-bordered table-striped table-responsive">
											<thead>
												<tr>
													<th></th>
													<th>ID</th>
													<th>Avatar</th>
													<th>Name</th>
													<th>Color</th>
													<th>CPU</th>
													<th>RAM</th>
													<th>Screen</th>
													<th>OS</th>
													<th>Sell Price</th>
													<th>Star</th>
													<th>In Stock</th>
													<th>
														<a href="add.php" class="btn btn-xs btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($products as $key => $p): ?>
													<tr>
														<td class="products-list-td avatar"><input type="checkbox" name="checkbox[]" class="child" value="<?= $p['id']?>"></td>
														<td class="products-list-td"><?= $p['id'] ?></td>
														<td class="products-list-td">
															<img class="img-square" src="<?= $p['image'] ?>" height="50">
														</td>
														<td class="products-list-td"><?= $p['name']?></td>
														<td class="products-list-td">
															<span id="color_front" style="background-color: <?= $p['color']?>; "></span>
															<input id="colour" type="color" name="" disabled="disabled" value="<?= $p['color']?>">
														</td>
														<td class="products-list-td"><?= $p['cpu']?></td>
														<td class="products-list-td"><?= $p['ram']?></td>
														<td class="products-list-td"><?= $p['screen_size']?></td>
														<td class="products-list-td"><?= $p['operating_sys']?></td>
														<td class="products-list-td"><?= number_format($p['sell_price']) . " VNĐ"?></td>
														<td class="products-list-td"><?= $p['star'] ?></td>
														<td class="products-list-td"><?= $p['in_stock'] ?></td>
														<td class="products-list-td">
															<a href="<?= 'edit.php?id=' . $p['id']?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
															<a href="javascript:;" url="<?= 'remove.php?id=' . $p['id'] ?>" class="btn btn-remove btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														</td>
													</tr>
												<?php endforeach?>
											</tbody>
											<tfoot>
												<tr>
													<th></th>
													<th>#</th>
													<th>Avatar</th>
													<th>Name</th>
													<th>Color</th>
													<th>CPU</th>
													<th>RAM</th>
													<th>Screen</th>
													<th>OS</th>
													<th>Sell Price</th>
													<th>Star</th>
													<th>In Stock</th>
													<th>
														<a href="add.php" class="btn btn-xs btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
													</th>
												</tr>
											</tfoot>
										</table>
										<a href="javascript:;" class="btn btn-remove btn-xs btn-danger deleteCheckbox"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected</a>
										<!-- <button type="submit" class="btn btn-danger">Delete Selected</button> -->
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php require_once '../public/footer.php'; ?>
	</div>
	<?php require_once '../public/script.php'; ?>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	
	<script type="text/javascript">
		// DataTable
		$(document).ready( function () {
			$('#mydata').DataTable();
		} );

		$('.btn-remove').click(function(){
			var hrefUrl = $(this).attr('url');
			swal({
				title: "Thông báo!",
				text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then(function(willDelete){
				if(willDelete === true){
					window.location.href = hrefUrl;
				}
			});
		});

		$('.deleteCheckbox').click(function(){
			swal({
				title: "Thông báo!",
				text: "Bạn có chắc chắn muốn xóa các sản phẩm này?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then(function(willDelete){
				if(willDelete === true){
					document.deleteCheckboxRequest.submit();
				}
			});
		});
	</script>
	</body>
</html>