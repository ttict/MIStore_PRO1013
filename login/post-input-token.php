<?php 
require_once "../helpers/common.php";
require_once "../helpers/db.php";

$token = $_POST['token'];
$id = $_POST['id'];

$userQuery = "select password_reset_token from users where id = $id";
$user = executeQuery($userQuery);

if ($user) {
    if ($user['password_reset_token'] == $token) {
        header("location: reset-password.php?token=$token");die;
    } else {
        $err = "Mã đặt lại mật khẩu không đúng";
        header("location: input-token.php?err=$err");die;
    }
} else {
    header("location: " . BASE_URL . "login.php");die;
}


?>