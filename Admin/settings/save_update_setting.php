<?php 
require_once '../public/verify.php';
require_once '../public/db.php';
require_once '../public/common.php';
error_reporting(0);
$logo_url = $_FILES['logo'];
$hotline = getConnect()->quote($_POST['hotline']);
$email = getConnect()->quote($_POST['email']);
$facebook = getConnect()->quote($_POST['facebook']);
$address = getConnect()->quote($_POST['address']);
$data = executeQuery("select * from $table_web_setting");
if ($logo_url['size'] <= 0) {
		$logo_url = $data['logo_url'];
	}
if ($logo_url['size'] > 0) {
	$allowed =  ['gif','png' ,'jpg', 'jpeg'];
	$nametpm = $logo_url['name'];
	$ext = pathinfo($nametpm, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ) {
    $elogo = "Vui lòng chọn đúng định dạng ảnh (gif, png, jpg, jpeg)";
	}
	}
if ($elogo != '') {
		header("location:setting.php?elogo=$elogo");die;
	}
if($logo_url['size'] > 0){
		$saveurl = '../../uploads/settings/' . uniqid() . '-' . $logo_url['name'];
		move_uploaded_file($logo_url['tmp_name'], $saveurl);
		$logo_url = str_replace("../../", WEB_URL ,"$saveurl");
	}
	$query_update = "update $table_web_setting 
								 set
								 	logo_url = '$logo_url',
								 	hotline = $hotline,
								 	email = $email,
								 	facebook = $facebook,
								 	address = $address";
								 	// var_dump($query_update_sliders);die;
	executeQuery($query_update);
	$data_2 = executeQuery("select * from $table_web_setting");
	if ($data == $data_2) {
	header("location:setting.php");die;
	}
	header("location:setting.php?update=success");die;

 ?>