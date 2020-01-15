<?php
require_once "../helpers/db.php";
session_start();

// Thu thập data từ form
$email = $_POST['email'];
$password = $_POST['password'];

// Dựa vào email để lấy ra tài khoản trong csdl
$sqlQuery = "select * from users where email = '$email'";
$user = executeQuery($sqlQuery, false);
// var_dump($sqlQuery);die;
// So sánh 2 mật khẩu (mk từ form và mk trong db)
if(!$user){
    header('location: ../login.php?msg=Sai thông tin email');
    die;
}
if(!password_verify($password, $user['password'])){
    header('location: ../login.php?msg=Sai thông tin mk');
    die;
}
// tạo session và điều hướng về trang quản trị
$_SESSION['auth'] = $user;

if($user['role'] == 1){
    header('location: ../index.php');
    die;
}

header('location: ../index.php');



// echo password_hash('secret', PASSWORD_DEFAULT);



?>