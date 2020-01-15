<?php 
require_once '../public/verify.php';
require_once '../public/db.php';
require_once '../public/common.php';
error_reporting(0);
$data = executeQuery("select * from $table_sliders order by sort_order desc");

// var_dump($data['sort_order']);die;
$sort_order = $data['sort_order']+1;
// var_dump($sort_order);die;

$image_url = $_FILES['image_url'];
$id = getConnect()->quote($_POST['id']);
$title = getConnect()->quote($_POST['title']);
$url = getConnect()->quote($_POST['url']);
$short_desc = getConnect()->quote($_POST['short_desc']);
$data = executeQuery("select * from $table_sliders where id = $id");
if ($image_url['size'] <= 0) {
		$elogo = "vui lòng chọn một ảnh";
	}
if ($image_url['size'] > 0) {
		$allowed =  ['gif','png' ,'jpg', 'jpeg'];
		$nametpm = $image_url['name'];
		$ext = pathinfo($nametpm, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) ) {
	    $elogo = "Vui lòng chọn đúng định dạng ảnh (gif, png, jpg, jpeg)";
		}
	}
if ($elogo != '') {
		header("location:add_slider.php?elogo=$elogo");die;
	}
if($image_url['size'] > 0){
		$saveurl = '../../uploads/settings/' . uniqid() . '-' . $image_url['name'];
		move_uploaded_file($image_url['tmp_name'], $saveurl);
		$image_url = str_replace("../../", WEB_URL ,"$saveurl");
	}
	$query_insert_slider = "insert into $table_sliders 
								 	(image_url,title,url,short_desc,sort_order)
								 	value('$image_url',$title,$url,$short_desc,$sort_order) ";
								 	// var_dump($query_update_sliders);die;
	executeQuery($query_insert_slider);
	header("location:slider.php");
 ?>