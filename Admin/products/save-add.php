<?php
	require_once '../public/db.php';
	require_once '../public/common.php';

	$sqlQueryProductName = "select name from products";
	$sqlQueryLastIdProduct = "select max(id) from products";
	$lastIdProduct = executeQuery($sqlQueryLastIdProduct, false);
	$cur_auto_id = $lastIdProduct['max(id)'] + 1;

	$productName = $_POST['productName'];
	$slug = $_POST['slug'];
	$image = $_FILES['image'];
	$filename = "";
	$shortDesc = $_POST['shortDesc'];
	$detail = $_POST['detail'];
	$oriPrice = $_POST['oriPrice'];
	$sellPrice = $_POST['sellPrice'];
	$inStock = $_POST['in_stock'];
	$color = $_POST['color'];
	$cpu = $_POST['cpu'];
	$ram = $_POST['ram'];
	$screenSize = $_POST['screen_size'];
	$operatingSys = $_POST['operating_sys'];
	$productNameErr ="";
	$imgErr ="";
	$shortDescErr="";
	$detailErr ="";
	$oriPriceErr="";
	$sellPriceErr="";
	$inStockErr="";
	$cpuErr="";
	$ramErr="";
	$screenSizeErr="";
	$operatingSysErr="";
	$galleryNameErr="";


	$sqlQueryProductName = executeQuery($sqlQueryProductName, true);

	// Validate Tên sản phẩm
	$err = false;
	if(strlen($productName) == 0){
		$err = true;
		$productNameErr = "Vui lòng nhập tên sản phẩm";
	} else if(strlen($productName) > 255){
		$err = true;
		$productNameErr = "Số lượng ký tự không vượt quá 255";
	}
	 foreach ($sqlQueryProductName as $key => $name) {
	 	 if ($name['name'] == $productName) {
	 	 	$err = true;
	 	 	$productNameErr = "Tên sản phẩm đã bị trùng. Vui lòng nhập lại";
	 	 }
	 }

	// Validate Ảnh đại diện
	$allowed =  ['gif','png' ,'jpg', 'jpeg'];
	$oriName = $image['name'];
	$ext = pathinfo($oriName, PATHINFO_EXTENSION);

	if($image['size'] == 0 || !in_array($ext,$allowed) ) {
		$err = true;
		$imgErr = "Vui lòng chọn đúng định dạng file (gif, png, jpg, jpeg)";
	}

	// Validate Galleries
	if (isset($_FILES['galleries'])) {
		$galleries = $_FILES['galleries'];
		$galleriesName = "";
		for ($i=0; $i < count($galleries['name']); $i++) { 
			$allowed =  ['gif','png' ,'jpg', 'jpeg'];
			$oriGalleryName = $galleries['name'][$i];
			$comp = pathinfo($oriGalleryName, PATHINFO_EXTENSION);
			if($galleries['size'][$i] == 0 || !in_array($comp,$allowed)){
				$err = true;
				$galleryNameErr = "Vui lòng chọn đúng định dạng file (gif, png, jpg, jpeg)";
			}
		}
	}

	// Validate Mô tả sản phẩm
	if(strlen($shortDesc) == 0){
		$err = true;
		$shortDescErr = "Vui lòng nhập mô tả của sản phẩm";
	} elseif (strlen($shortDesc) > 255) {
		$err = true;
		$shortDescErr = "Số lượng ký tự không vượt quá 255";
	}

	// Validate Chi tiết sản phẩm
	if(strlen($detail) == 0){
		$err = true;
		$detailErr = "Vui lòng nhập chi tiết của sản phẩm";
	}

	// Validate Giá gốc sản phẩm
	if(strlen($oriPrice) == 0){
		$err = true;
		$oriPriceErr = "Vui lòng nhập giá gốc của sản phẩm";
	} elseif (strlen($oriPrice) > 11) {
		$err = true;
		$oriPriceErr = "Số lượng ký tự không vượt quá 11";
	} elseif ($oriPrice < 0) {
		$err = true;
		$oriPriceErr = "Giá trị nhập vào là số nguyên lớn hơn 0";
	}

	// Validate Giá bán sản phẩm
	if(strlen($sellPrice) == 0){
		$err = true;
		$sellPriceErr = "Vui lòng nhập giá khuyến mãi của sản phẩm";
	} elseif (strlen($sellPrice) > 11) {
		$err = true;
		$sellPriceErr = "Số lượng ký tự không vượt quá 11";
	} elseif ($sellPrice < 0) {
		$err = true;
		$sellPriceErr = "Giá trị nhập vào là số nguyên lớn hơn 0";
	} 

	// Validate Số lượng sản phẩm
	if(strlen($inStock) == 0){
		$err = true;
		$inStockErr = "Vui lòng nhập số lượng của sản phẩm";
	} elseif (strlen($inStock) > 11) {
		$err = true;
		$inStockErr = "Số lượng ký tự không vượt quá 11";
	} elseif ($inStock < 0) {
		$err = true;
		$inStockErr = "Giá trị nhập vào là số nguyên lớn hơn 0";
	}

	// Validate CPU sản phẩm
	if(strlen($cpu) == 0){
		$err = true;
		$cpuErr = "Vui lòng nhập tên bộ vi xử lý của sản phẩm";
	} elseif (strlen($cpu) > 255) {
		$err = true;
		$cpuErr = "Số lượng ký tự không vượt quá 255";
	}

	// Validate RAM sản phẩm
	if(strlen($ram) == 0){
		$err = true;
		$ramErr = "Vui lòng nhập thông tin dung lượng bộ nhớ ngẫu nhiên của sản phẩm";
	} elseif (strlen($ram) > 255) {
		$err = true;
		$ramErr = "Số lượng ký tự không vượt quá 255";
	}

	// Validate kích thước màn hình của sản phẩm
	if(strlen($screenSize) == 0){
		$err = true;
		$screenSizeErr = "Vui lòng nhập thông tin kích thước màn hình của sản phẩm";
	} elseif (strlen($screenSize) > 255) {
		$err = true;
		$screenSizeErr = "Số lượng ký tự không vượt quá 255";
	}

	// Validate Hệ điều hành sản phẩm
	if(strlen($operatingSys) == 0){
		$err = true;
		$operatingSysErr = "Vui lòng nhập thông tin hệ điều hành của sản phẩm";
	} elseif (strlen($operatingSys) > 255) {
		$err = true;
		$operatingSysErr = "Số lượng ký tự không vượt quá 255";
	}

	// Kiểm tra nếu không có lỗi Validate
	if($err == false){
		// Sao chép ảnh từ bộ nhớ tạm đến đường dẫn
		if($image['size'] > 0){
			$filename = "../../uploads/products/" . uniqid() . "-" . $image['name'];
			move_uploaded_file($image['tmp_name'], $filename);
			$filename=str_replace("../../",WEB_URL, $filename);
		}
		$productName = getConnect()->quote($productName);
		$slug = getConnect()->quote($slug);
		$shortDesc = getConnect()->quote($shortDesc);
		$oriPrice = getConnect()->quote($oriPrice);
		$sellPrice = getConnect()->quote($sellPrice);
		$inStock = getConnect()->quote($inStock);
		$color = getConnect()->quote($color);
		$cpu = getConnect()->quote($cpu);
		$ram = getConnect()->quote($ram);
		$screenSize = getConnect()->quote($screenSize);
		$operatingSys = getConnect()->quote($operatingSys);
		// Viết câu lệnh SQL nhập vào Database
		$sqlQuery = "insert into products (name, slug, image, short_desc, detail, ori_price, sell_price, in_stock, color, cpu, ram, screen_size, operating_sys, views) 
		values ($productName, $slug, '$filename', $shortDesc, '$detail', $oriPrice, $sellPrice, $inStock, $color, $cpu, $ram, $screenSize, $operatingSys, 0)";
		// var_dump(htmlentities($sqlQuery));die;
		executeQuery($sqlQuery, false);

		if (isset($_FILES['galleries'])) {
			for ($i=0; $i < count($galleries['name']); $i++) { 
				if($galleries['size'][$i] > 0){
					$galleriesName = "../../uploads/products/" . uniqid() . "-" . $galleries['name'][$i];
					move_uploaded_file($galleries['tmp_name'][$i], $galleriesName);
					$galleriesName = str_replace("../../", WEB_URL, $galleriesName);
					$sqlQueryGalleries = "insert into product_galleries (product_id, url) 
					values ('$cur_auto_id','$galleriesName')";
					executeQuery($sqlQueryGalleries);
				}
			}
		}
		header("location:list.php");die;
	}

	// Kiểm tra nếu có lỗi Validate thì hiển thị link
	header("location:add.php?id=$cur_auto_id&productNameErr=$productNameErr&imgErr=$imgErr&shortDescErr=$shortDescErr&detailErr=$detailErr&oriPriceErr=$oriPriceErr&sellPriceErr=$sellPriceErr&inStockErr=$inStockErr&cpuErr=$cpuErr&ramErr=$ramErr&screenSizeErr=$screenSizeErr&operatingSysErr=$operatingSysErr&galleryNameErr=$galleryNameErr");
	?>