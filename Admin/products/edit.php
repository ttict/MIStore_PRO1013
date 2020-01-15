<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	$productId = $_GET['id'];

	$sqlQuery = "select * from products where `id` = $productId";
	$product = executeQuery($sqlQuery, false);

	$sqlQueryProductGalleries = "select * from product_galleries where `product_id` = $productId";
	$productGalleries = executeQuery($sqlQueryProductGalleries, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sửa sản phẩm</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require_once '../public/style.php' ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
	<style type="text/css">
		.avatar {
			height: 100px;
			width: 100px;
			float: left;
			object-fit: cover;
			margin: 0 20px 15px 0;
		}
		.avatar img{
			width: 100%;
			height: 100%;
		}
		.clear {
			clear: both;
		}
		.box-image-input {
			margin: 10px 0;
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
		.remove-img-product img {
			top: 1px;
			right: -3px;
			width: 18px;
			height: 18px;
			position: absolute;
			-webkit-transition: -webkit-transform 0.25s, opacity 0.25s;
			-moz-transition: -moz-transform 0.25s, opacity 0.25s;
			transition: transform 0.25s, opacity 0.25s;
			opacity: 0.8;
		}
		.remove-img-product img:hover {
			-webkit-transform: rotate(270deg);
			-moz-transform: rotate(270deg);
			transform: rotate(270deg);
			opacity: 1;
		}
	</style>
	<script type="text/javascript">
		function ChangeToSlug(){
			var productName, slug;
			productName = document.getElementById("productName").value;
			slug = productName.toLowerCase();
			slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
			slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
			slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
			slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
			slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
			slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
			slug = slug.replace(/đ/gi, 'd');
			slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
			slug = slug.replace(/ /gi, "-");
			slug = slug.replace(/\-\-\-\-\-/gi, '-');
			slug = slug.replace(/\-\-\-\-/gi, '-');
			slug = slug.replace(/\-\-\-/gi, '-');
			slug = slug.replace(/\-\-/gi, '-');
			slug = '@' + slug + '@';
			slug = slug.replace(/\@\-|\-\@|\@/gi, '');
			document.getElementById('slug').value = slug;
		}
		$(document).ready(function () {
			ChangeToSlug();
		});
	</script>	
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<script type="text/javascript">
		$(document).ready(function() {
			var max_fields = 6;
			var wrapper = $(".input_fields_wrap");
			var add_button = $(".add_field_button");
			var x = 1; 
			$(add_button).click(function(e){ 
				e.preventDefault();
				if(x < max_fields){
					x++;
					$(wrapper).append('<div class="box-image-input"><input class="image-input" type="file" name="galleries[]" style="float:left; margin-right:5px;"><a href="#" class="remove_field"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>');
				}
			});

			$(wrapper).on("click",".remove_field", function(e){
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
		});
	</script>
	<?php require_once '../public/header.php'; ?>
	<div class="wrapper">
		<?php require_once '../public/sidebar.php'; ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1><i class="fa fa-list-alt"></i>
					Sửa sản phẩm
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
					<li class="active">Sửa sản phẩm</li>
				</ol>
			</section>
			<section class="content">
				<div class="box row">
					<div class="col-md-12">
						<form action="<?= 'save-edit.php'?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $product['id']?>">
							<div class="form-group">
								<label for="productName">Tên sản phẩm</label>
								<input id="productName" type="text" name="productName" value="<?= $product['name']?>" placeholder="Nhập tên sản phẩm" class="form-control" onkeyup="ChangeToSlug();">
								<?php if(isset($_GET['productNameErr'])):?>
									<span class="text-danger"><?= $_GET['productNameErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="image">Ảnh đại diện</label>
								<div class="clear"></div>
								<div class="avatar">
									<img src="<?= $product['image']?>" alt="" class="img-responsive">
								</div>
								<div class="clear"></div>
								<input id="avatarInput" type="file" name="avatarInput">
								<?php if(isset($_GET['imgErr'])):?>
									<span class="text-danger"><?= $_GET['imgErr'] ?></span>
								<?php endif?>
							</div>
							<div class="clear"></div>
							<div class="form-group">
								<label for="">Ảnh sản phẩm</label>
								<div class="clear"></div>
								<?php foreach ($productGalleries as $key => $g): ?>
									<div id="box-gallery-<?= $g['id']  ?>" style="height: 100px; width: 100px; float: left;object-fit: cover;	margin: 0 20px 15px 0; position: relative;">
										<img id="box-img-<?= $g['id']  ?>" src="<?= $g['url']?>" alt="" class="img-responsive" style="width: 100%; height: 100%;">
										<input type="checkbox" name="deleteCheckbox[]" id="<?= $g['id']  ?>" value="<?= $g['id'] ?>" style="visibility: hidden;">
										<label class="remove-img-product" for="<?= $g['id']  ?>" style="position: absolute; top: 5px; right: 10px; cursor: pointer;"><img src="http://cdn3.iconfinder.com/data/icons/iconic-1/32/x_alt-128.png" alt="X" /></label>
									</div>
									<script type="text/javascript">
										$().ready(function(){
											$( "#<?= $g['id'] ?>" ).click(function() {
												$("#box-gallery-<?= $g['id']  ?>").attr('style','height:0');
												$("#<?= $g['id']  ?>").attr('style','visibility:hidden');
												$("#box-img-<?= $g['id']  ?>" ).remove();
											});
										});
									</script>
								<?php endforeach ?>
								<div class="clear"></div>
								<br>
								<div class="input_fields_wrap">
									<button class="add_field_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
									<div style="clear: both;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="slug">Liên kết tĩnh</label>
								<input id="slug" type="text" name="slug" placeholder="" class="form-control" value="<?= $product['slug']?>" readonly>
							</div>
							<div class="form-group">
								<label for="shortDesc">Mô tả ngắn</label>
								<textarea id="shortDesc" name="shortDesc" rows="3" class="form-control"><?= $product['short_desc']?></textarea>
								<?php if(isset($_GET['shortDescErr'])):?>
									<span class="text-danger"><?= $_GET['shortDescErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="detail">Chi tiết sản phẩm</label>
								<textarea id="detail" name="detail" rows="10" class="form-control"><?= $product['detail']?></textarea>
								<?php if(isset($_GET['detailErr'])):?>
									<span class="text-danger"><?= $_GET['detailErr'] ?></span>
								<?php endif?>
								<script>
									CKEDITOR.replace('detail');
								</script>
							</div>
							<div class="form-group">
								<label for="oriPrice">Giá gốc</label>
								<input id="oriPrice" type="number" name="oriPrice" class="form-control" value="<?= $product['ori_price']?>">
								<?php if(isset($_GET['oriPriceErr'])):?>
									<span class="text-danger"><?= $_GET['oriPriceErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="sellPrice">Giá khuyến mãi</label>
								<input id="sellPrice" type="number" name="sellPrice" class="form-control" value="<?= $product['sell_price']?>">
								<?php if(isset($_GET['sellPriceErr'])):?>
									<span class="text-danger"><?= $_GET['sellPriceErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="in_stock">Số lượng</label>
								<input id="in_stock" type="number" name="in_stock" class="form-control" value="<?= $product['in_stock']?>">
								<?php if(isset($_GET['inStockErr'])):?>
									<span class="text-danger"><?= $_GET['inStockErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="colour">Màu sắc</label><br>
								<span id="color_front" style="background-color: <?= $product['color']?>; "></span>
								<input id="colour" type="color" name="color"value="<?= $product['color']?>">
							</div>
							<div class="form-group">
								<label for="cpu">CPU</label>
								<input id="cpu" type="text" name="cpu" class="form-control" value="<?= $product['cpu']?>">
								<?php if(isset($_GET['cpuErr'])):?>
									<span class="text-danger"><?= $_GET['cpuErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="ram">RAM</label>
								<input id="ram" type="text" name="ram" class="form-control" value="<?= $product['ram']?>">
								<?php if(isset($_GET['ramErr'])):?>
									<span class="text-danger"><?= $_GET['ramErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="screen_size">Kích thước màn hình</label>
								<input id="screen_size" type="text" name="screen_size" class="form-control" value="<?= $product['screen_size']?>">
								<?php if(isset($_GET['screenSizeErr'])):?>
									<span class="text-danger"><?= $_GET['screenSizeErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="operating_sys">Hệ điều hành</label>
								<input id="operating_sys" type="text" name="operating_sys" class="form-control" value="<?= $product['operating_sys']?>">
								<?php if(isset($_GET['operatingSysErr'])):?>
									<span class="text-danger"><?= $_GET['operatingSysErr'] ?></span>
								<?php endif?>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-sm btn-primary">Lưu</button>
								<a href="<?= "list.php"?>" class="btn btn-sm btn-danger">Hủy</a>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		<?php require_once '../public/footer.php'; ?>
	</div>
	<?php require_once '../public/script.php'; ?>
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
