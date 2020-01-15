<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';
  	
	$query_comment = "select comments.`id`, users.`id` as `user_id`, users.`name` as `user_name`, products.`id` as `product_id`, products.`name` as `product_name`, comments.`content`, comments.`star`, comments.`status`
from users join comments on users.`id` = comments.`user_id` join products on comments.`product_id` = products.`id`
where users.`id` = comments.`user_id` order by comments.`id` asc";
	$comments = executeQuery($query_comment, true);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Danh sách bình luận</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php require_once '../public/style.php' ?>
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

			.switch {
				position: relative;
				display: inline-block;
				width: 44px;
				height: 24px;
			}

			.switch input { 
				opacity: 0;
				width: 0;
				height: 0;
			}

			.slider {
				position: absolute;
				cursor: pointer;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: #ccc;
				-webkit-transition: .4s;
				transition: .4s;
			}

			.slider:before {
				position: absolute;
				content: "";
				height: 20px;
				width: 20px;
				left: 2px;
				bottom: 2px;
				background-color: white;
				-webkit-transition: .4s;
				transition: .4s;
			}

			input:checked + .slider {
				background-color: #2196F3;
			}

			input:focus + .slider {
				box-shadow: 0 0 1px #2196F3;
			}

			input:checked + .slider:before {
				-webkit-transform: translateX(20px);
				-ms-transform: translateX(20px);
				transform: translateX(20px);
			}

			/* Rounded sliders */
			.slider.round {
				border-radius: 20px;
			}

			.slider.round:before {
				border-radius: 50%;
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
						Danh sách bình luận
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
						<li class="active">Danh sách bình luận</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<table id="mydata" class="table table-bordered table-striped table-responsive">
										<thead>
											<tr>
												<th></th>
												<th>ID</th>
												<th>User</th>
												<th>Product</th>
												<th>Content</th>
												<th>Star</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($comments as $key => $c): ?>
												<tr id="list-row">
													<td class="products-list-td avatar">
														<input type="checkbox" name="checkbox[]" class="child" value="<?= $c['id']?>" form="deleteCheckboxRequest"></td>
													<td class="products-list-td"><?= $c['id'] ?></td>
													<td class="products-list-td"><a href="<?= BASE_URL . "users/profile.php?idu=" . $c['user_id']?>"><?= $c['user_name']?></a></td>
													<td class="products-list-td" ><a href="<?= WEB_URL . "single-product.php?id=" . $c['product_id']?>"><?= $c['product_name']?></a></td>
													<td class="products-list-td"><?= $c['content']?></td>
													<td class="products-list-td"><?= $c['star']?></td>
													<td>
														<form name="selectStatusRequest" method="post" action="selectStatus.php?id=<?= $c['id'] ?>" enctype="multipart/form-data">
															<label class="switch">
																<input type="hidden" name="selectStatus" value="0">
																<input onchange="this.form.submit();" type="checkbox" name="selectStatus" 
																<?= ($c['status'] == 1) ? 'checked="checked" value="1"' : ""; ?> 
																/>
																<span class="slider round"></span>
															</label>
														</form>
													</td>
													<td class="products-list-td">
														<a href="javascript:;" url="<?= 'remove.php?id=' . $c['id'] ?>" class="btn btn-remove btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
												</tr>
											<?php endforeach?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th>ID</th>
												<th>User</th>
												<th>Product</th>
												<th>Content</th>
												<th>Star</th>
												<th>Status</th>
												<th></th>
											</tr>
										</tfoot>
									</table>
									<form name="deleteCheckboxRequest" action="<?= 'deleteCheckbox.php'?>" method="post" enctype="multipart/form-data" id="deleteCheckboxRequest">
										<a href="javascript:;" class="btn btn-remove btn-xs btn-danger deleteCheckbox"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected</a>
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
		$(document).ready( function () {
			$('#mydata').DataTable();
		} );
	</script>

	<script type="text/javascript">
		$('#parent').click(function(){
			var parentStatus = $(this).prop('checked');
			$('.child').prop('checked', parentStatus);
		});
		$('.child').click(function(){
			var status = $(this).prop('checked');
			if(!status){
				$('#parent').prop('checked', status);
			}else{
				if($('.child').length === $('.child:checked').length){
					$('#parent').prop('checked', status);
				}
			}
		});
	</script>

	<script type="text/javascript">
		$('.btn-remove').click(function(){
			var hrefUrl = $(this).attr('url');
			swal({
				title: "Thông báo!",
				text: "Bạn có chắc chắn muốn xóa bình luận này?",
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
				text: "Bạn có chắc chắn muốn xóa các bình luận này?",
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

	<script type="text/javascript">
		$("#colour").change(function(event) {
			console.log($(this).val());
			$("#color_front").css('background-color',$(this).val());
		});
		$("#color_front").click(function(event) {
			$("#colour").click();
		});
	</script>
	</body>
</html>