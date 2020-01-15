<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	$productId = $_GET['id'];
	$sqlQuery = "select * from products where id = $productId";
	$product = executeQuery($sqlQuery, false);

	if($product != false){
		// Xoá Gallery sản phẩm có product_id = $productId
		$sqlRemoveProductGallerry = "delete from product_galleries where product_id = $productId";
  	executeQuery($sqlRemoveProductGallerry, false);

  	// Xoá bình luận sản phẩm có product_id = $productId
  	$sqlRemoveComments = "delete from comments where product_id = $productId";
  	executeQuery($sqlRemoveComments, false);

    // Xóa sản phẩm có id = $productId
    $sqlRemoveProducts = "delete from products where id = $productId";
    executeQuery($sqlRemoveProducts, false);
	}
	header("location: list.php");
?>