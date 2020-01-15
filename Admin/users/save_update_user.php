<?php
require_once '../public/verify.php';
require_once '../public/db.php';
require_once '../public/common.php';
error_reporting(0);
$idu = $_POST['idu'];
$data = executeQuery("select * from $table_users where id=$idu");
$name = isset($_POST['name']) ? getConnect()->quote($_POST['name']) : getConnect()->quote($data['name']);
$role = isset($_POST['role']) ? getConnect()->quote($_POST['role']) : getConnect()->quote($data['role']);
$address = isset($_POST['address']) ? getConnect()->quote($_POST['address']) : getConnect()->quote($data['address']);
$gender = isset($_POST['gender']) ? getConnect()->quote($_POST['gender']) : getConnect()->quote($data['gender']);
$phone_number = isset($_POST['phone_number']) ? getConnect()->quote($_POST['phone_number']) : getConnect()->quote($data['phone_number']);
$avatar = $_FILES['avatar'];
if ($avatar['size'] <= 0) {
	$avatar = $data['avatar'];
}
$ename = '';
$eaddress = '';
$ephone_number = '';
$eavatar = '';
if (strlen(trim($name)) == 0) {
	$ename = "không được để trống tên";
}

if (strlen(trim($name)) >= 100) {
	$ename = "Tên phải ít hơn 100 ký tự";
}

if (strlen(trim($address)) == 0) {
	$eaddress = "không được để trống địa chỉ";
}

if (strlen(trim($phone_number)) == 0) {
	$ephone_number = "không được để trống số điện thoại";
}
if ($avatar['size'] > 0) {
	$allowed = ['gif', 'png', 'jpg', 'jpeg'];
	$nametpm = $avatar['name'];
	$ext = pathinfo($nametpm, PATHINFO_EXTENSION);
	if (!in_array($ext, $allowed)) {
		$eavatar = "Vui lòng chọn đúng định dạng ảnh (gif, png, jpg, jpeg)";
	}
}

if ($ename . $eaddress . $ephone_number . $eavatar != '') {
	header("location:profile.php?idu=$idu&&ename=$ename&&eaddress=$eaddress&&ephone_number=$ephone_number&&eavatar=$eavatar");die;
}
if ($avatar['size'] > 0) {
	$saveurl = '../../uploads/users/' . uniqid() . '-' . $avatar['name'];
	move_uploaded_file($avatar['tmp_name'], $saveurl);
	$avatar = str_replace("../../", WEB_URL , "$saveurl");
}
$query_update_user = "update $table_users
								 set
								 	name = $name,
								 	role = $role,
								 	avatar = '$avatar',
								 	address = $address,
								 	gender = $gender,
								 	phone_number = $phone_number
								 where
								 	id = $idu";
// var_dump($query_update_user);die;
executeQuery($query_update_user);
if ($idu == $_SESSION['auth']['id']) {
	$_SESSION['auth']['name'] = trim($name,'\'');
	$_SESSION['auth']['role'] = trim($role,'\'');
	$_SESSION['auth']['address'] = trim($address,'\'');
	$_SESSION['auth']['gender'] = trim($gender,'\'');
	$_SESSION['auth']['phone_number'] = trim($phone_number,'\'');
	$_SESSION['auth']['avatar'] = $avatar;
}
if (trim($name,'\'') == $data['name'] &&
	trim($role,'\'') == $data['role'] &&
	trim($address,'\'') == $data['address'] &&
	trim($gender,'\'') == $data['gender'] &&
	trim($phone_number,'\'') == $data['phone_number'] &&
	$avatar == $data['avatar']) {
	header("location:profile.php?idu=$idu");die;
}
header("location:profile.php?idu=$idu&&update=success");

?>