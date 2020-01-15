<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	if (isset($_POST['checkbox'])) {
	 	$checkbox = $_POST['checkbox'];
	 	$listCheck = "'" . implode("','", $checkbox) . "'";
		$sqlRemoveComments = "delete from comments where `id` in ($listCheck)";
		executeQuery($sqlRemoveComments, false);  	
	} 
	header("location: list.php");
?>