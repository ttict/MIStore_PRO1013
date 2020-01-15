<?php
	require_once '../public/verify.php';
	require_once '../public/db.php';
	require_once '../public/geturl.php';

	$commentId = $_GET['id'];
	$sqlQuery = "select * from comments where `id` = $commentId";
	$comment = executeQuery($sqlQuery, false);

	if($comment != false){
	    // Xóa sản phẩm có id = $commentId
	    $sqlRemovecomments = "delete from comments where `id` = $commentId";
	    executeQuery($sqlRemovecomments, false);
	}
	header("location: list.php");
?>