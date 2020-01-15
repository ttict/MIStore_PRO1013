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
$user_email = $_SESSION['user_email']['email'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];
if ($password == "") {
	header("location:creat_new_password.php?err=Vui lòng điền đầy đủ thông tin vào các trường");die;
}
if ($re_password != $password) {
	header("location:creat_new_password.php?err=Nhập lại mật khẩu không khớp nhau");die;
}
$password = password_hash($password, PASSWORD_DEFAULT);
$query_update_passwrod = "update users set password = '$password', password_reset_token = 'null' where email ='$user_email'";
executeQuery($query_update_passwrod);
$_SESSION['auth'] = executeQuery("select * from users where email = '$user_email'");
unset($_SESSION['user_email']);
unset($_SESSION['verify_coded']);
header("location:../index.php");die;
?>