<?php 
	require_once '../public/db.php';
	$id = $_GET['id'];
	$selectStatus = $_POST['selectStatus'];
	if (isset($_POST['selectStatus'])) {
		if ($_POST['selectStatus'] == 1 || $_POST['selectStatus'] == "on") {
			$selectStatus = 1;
		} elseif ($_POST['selectStatus'] == 0) {
			$selectStatus = 0;
		}
	}
	$sqlQuery = "update comments set `status` = '$selectStatus' where `id` = '$id'";
	executeQuery($sqlQuery, false);
	header("location: list.php");
	die;
?>