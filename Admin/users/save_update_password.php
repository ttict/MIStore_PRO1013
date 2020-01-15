<?php
require_once '../public/verify.php';
require_once '../public/db.php';
$email = $_SESSION['auth']['email'];
$password = $_POST['password'];
$Newpassword = $_POST['Newpassword'];
$ReNewpassword = $_POST['ReNewpassword'];
$data = executeQuery("select * from $table_users where email = '$email'");
if ($password == "" || $Newpassword == "" || $ReNewpassword == "") {
	header("location: update_password.php?err=Vui lòng nhập đầy đủ thông tin vào các trường");die;
}
// var_dump($email);
// var_dump($data['password']);die;
if (!password_verify($password, $data['password'])) {
	header("location: update_password.php?err=Sai mật khẩu cũ");die;
}
if ($Newpassword != $ReNewpassword) {
	header("location: update_password.php?err=Mật khẩu mới không khớp nhau");die;
}
$password = password_hash($Newpassword, PASSWORD_DEFAULT);
$query_update_password = "update $table_users set password = '$password' where email = '$email'";
executeQuery($query_update_password);
header("location:profile.php?update=true");die;
 ?>