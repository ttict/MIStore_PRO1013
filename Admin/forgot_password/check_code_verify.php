<?php
session_start();
require_once '../public/db.php';
if (isset($_COOKIE['auth'])) {
	$auth = $_COOKIE['auth'];
	$query_user = "select * from users where password like '$auth'";
	$_SESSION['auth'] = executeQuery($query_user);
}
if (isset($_SESSION['auth'])) {
	if ($_SESSION['auth']['role'] > 1) {
		header('location: ../index.php');die;
	}
	header('location: ../../client/');die;
}
if (!isset($_SESSION['user_email'])) {
	header('location: ../index.php');die;
}
$code = $_POST['code'];
$user_email = $_SESSION['user_email']['email'];
$query_email = "select * from users where email = '$user_email'";
// echo $query_email;die;
$user_email = executeQuery($query_email);
$password_reset_token = $user_email['password_reset_token'];
if (!password_verify($code, $password_reset_token)) {
	header("location:seen_code_verify.php?err=Mã xác nhận không đúng vui lòng nhập lại");die;
}
$_SESSION['verify_coded'] = 1;
header("location:creat_new_password.php");die;
?>