<?php 
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

$sqlQuery = "select * from products";

if ($keyword != null){
	$sqlQuery .= " where name like '%$keyword%'";
}

$products = executeQuery($sqlQuery, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm sản phẩm</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require_once '../public/style.php' ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
	<style type="text/css">
		.box-image-input {
			margin: 10px 0;
		}
		input[type=color] {
			border: none;
			background-color: transparent;
		}
	</style>
	<script type="text/javascript">
		function ChangeToSlug()	{
			var productName, slug;
			//Lấy text từ thẻ input title 
			productName = document.getElementById("productName").value;

			//Đổi chữ hoa thành chữ thường
			slug = productName.toLowerCase();

			//Đổi ký tự có dấu thành không dấu
			slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
			slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
			slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
			slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
			slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
			slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
			slug = slug.replace(/đ/gi, 'd');
			//Xóa các ký tự đặt biệt
			slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
			//Đổi khoảng trắng thành ký tự gạch ngang
			slug = slug.replace(/ /gi, "-");
			//Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
			//Phòng trường hợp người nhập vào quá nhiều ký tự trắng
			slug = slug.replace(/\-\-\-\-\-/gi, '-');
			slug = slug.replace(/\-\-\-\-/gi, '-');
			slug = slug.replace(/\-\-\-/gi, '-');
			slug = slug.replace(/\-\-/gi, '-');
			//Xóa các ký tự gạch ngang ở đầu và cuối
			slug = '@' + slug + '@';
			slug = slug.replace(/\@\-|\-\@|\@/gi, '');
			//In slug ra textbox có id “slug”
			document.getElementById('slug').value = slug;
		}
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
					Thêm sản phẩm
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
					<li class="active">Thêm sản phẩm</li>
				</ol>
			</section>
			<section class="content">
				<div class="box row">
					<div class="col-md-12">
						<form action="<?= 'save-add.php'?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="productName">Tên sản phẩm</label>
								<input id="productName" type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="form-control" onkeyup="ChangeToSlug();">
								<?php if(isset($_GET['productNameErr'])):?>
									<span class="text-danger"><?= $_GET['productNameErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="image">Ảnh đại diện</label>
								<input id="image" type="file" name="image">
								<?php if(isset($_GET['imgErr'])):?>
									<span class="text-danger"><?= $_GET['imgErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="">Ảnh sản phẩm</label>
								<div class="input_fields_wrap">
									<button class="add_field_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
									<div style="clear: both;"></div>
								</div>
								<?php if(isset($_GET['galleryNameErr'])):?>
									<span class="text-danger"><?= $_GET['galleryNameErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="slug">Liên kết tĩnh</label>
								<input id="slug" type="text" name="slug" placeholder="" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label for="shortDesc">Mô tả ngắn</label>
								<textarea id="shortDesc" name="shortDesc" rows="3" class="form-control" placeholder="Hãy nhập nội dung mô tả cho sản phẩm..."></textarea>
								<?php if(isset($_GET['shortDescErr'])):?>
									<span class="text-danger"><?= $_GET['shortDescErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="detail">Chi tiết sản phẩm</label>
								<textarea id="detail" name="detail" rows="10" class="form-control"></textarea>
								<?php if(isset($_GET['detailErr'])):?>
									<span class="text-danger"><?= $_GET['detailErr'] ?></span>
								<?php endif?>
								<script>
									CKEDITOR.replace('detail');
								</script>
							</div>
							<div class="form-group">
								<label for="oriPrice">Giá gốc</label>
								<input id="oriPrice" type="number" name="oriPrice" class="form-control">
								<?php if(isset($_GET['oriPriceErr'])):?>
									<span class="text-danger"><?= $_GET['oriPriceErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="sellPrice">Giá khuyến mãi</label>
								<input id="sellPrice" type="number" name="sellPrice" class="form-control">
								<?php if(isset($_GET['sellPriceErr'])):?>
									<span class="text-danger"><?= $_GET['sellPriceErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="in_stock">Số lượng</label>
								<input id="in_stock" type="number" name="in_stock" class="form-control">
								<?php if(isset($_GET['inStockErr'])):?>
									<span class="text-danger"><?= $_GET['inStockErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="color">Màu sắc</label><br>
								<input id="color" type="color" name="color">
								<?php if(isset($_GET['colorErr'])):?>
									<span class="text-danger"><?= $_GET['colorErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="cpu">CPU</label>
								<input id="cpu" type="text" name="cpu" class="form-control">
								<?php if(isset($_GET['cpuErr'])):?>
									<span class="text-danger"><?= $_GET['cpuErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="ram">RAM</label>
								<input id="ram" type="text" name="ram" class="form-control">
								<?php if(isset($_GET['ramErr'])):?>
									<span class="text-danger"><?= $_GET['ramErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="screen_size">Kích thước màn hình</label>
								<input id="screen_size" type="text" name="screen_size" class="form-control">
								<?php if(isset($_GET['screenSizeErr'])):?>
									<span class="text-danger"><?= $_GET['screenSizeErr'] ?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label for="operating_sys">Hệ điều hành</label>
								<input id="operating_sys" type="text" name="operating_sys" class="form-control">
								<?php if(isset($_GET['operatingSysErr'])):?>
									<span class="text-danger"><?= $_GET['operatingSysErr'] ?></span>
								<?php endif?>
							</div>
							<div class="text-center" style="padding-bottom: 15px;">
								<button type="submit" class="btn btn-sm btn-primary">Lưu</button>
								<a href="list.php" class="btn btn-sm btn-danger">Hủy</a>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		<?php require_once '../public/footer.php'; ?>
	</div>
	<?php require_once '../public/script.php'; ?>
</body>
</html>