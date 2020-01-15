<?php 
	session_start();
	require_once 'public/db.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember'])? $_POST['remember'] : '';
	$query_user = "select * from $table_users where email like '$email'";
	$data_user = executeQuery($query_user, false);
	if ($data_user == false) {
		$err = "Sai email vui lòng nhập lại";
		header("location:login.php?err=$err");die;
	};
	if (password_verify($password, $data_user['password']) == false) {
		$err = "Sai mật khẩu vui lòng nhập lại";
		header("location:login.php?err=$err");die;
	};
	$_SESSION['auth'] = $data_user;
	if (isset($_POST['remember'])) {
		setcookie('auth', $data_user['password'], strtotime("+15 days"), "/");
	}
	if ($data_user['role'] >= 2) {
		header("location:index.php");die;
	};
	header("location:../Client/");die;

	function rand_string($length) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$str = "";
	$size = strlen($chars);
	for ($i = 0; $i < $length; $i++) {
		$str .= $chars[rand(0, $size - 1)];
	}
	return $str;
	}
?>