<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	if (isset($_POST['checkbox'])) {
	 	$checkbox = $_POST['checkbox'];
	 	$listCheck = "'" . implode("','", $checkbox) . "'";

	 	$sqlRemoveProductGallerry = "delete from product_galleries where product_id in ($listCheck)";
	 	executeQuery($sqlRemoveProductGallerry, false);

		$sqlRemoveComments = "delete from comments where product_id in ($listCheck)";
		executeQuery($sqlRemoveComments, false);

	 	$sqlRemoveProducts = "delete from products where id in ($listCheck)";
	 	executeQuery($sqlRemoveProducts, false);
  	
	} 
	header("location: list.php");
?>