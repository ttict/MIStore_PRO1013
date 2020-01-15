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
	header('location: ../../index.php');die;
}
$uemail = $_POST['email'];
$user_email = getConnect()->quote($_POST['email']);
if (isset($_GET['email'])) {
	$uemail = $_GET['email'];
	$user_email = getConnect()->quote($_GET['email']);
}
$sql = "select * from $table_users where email = $user_email";
$data = executeQuery($sql);
$user_name =$data['name'];
if (!$data) {
	header("location:forgot_password.php?err=Không tìm thấy tài khoản $user_email");die;
}
$rand_str = rand_string(6);
// var_dump($rand_str);die;
$password_reset_token = password_hash($rand_str, PASSWORD_DEFAULT);
// var_dump($password_reset_token);die;
$sql_update_reset_token = "update $table_users set password_reset_token = '$password_reset_token' where email = $user_email";
// var_dump($sql_update_reset_token);die;
executeQuery($sql_update_reset_token);
$_SESSION['user_email'] = $data;

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mistore2019.shop@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "mistore12345";
//Set who the message is to be sent from
$mail->setFrom('mistore2019.shop@gmail.com', 'MiStore');
//Set an alternative reply-to address
$mail->addReplyTo('mistore2019.shop@gmail.com', 'MiStore');
//Set who the message is to be sent to
$mail->addAddress($uemail,  $user_name);
//Set the subject line
$mail->Subject = 'Phản hồi yêu lấy lại mật khẩu mật khẩu';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("Mã xác nhận của bạn là: " . $rand_str . " vui lòng không chia sẻ với bất kỳ ai!", __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'null';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	header("location:seen_code_verify.php");die;
	// echo "Message sent!";
	//Section 2: IMAP
	//Uncomment these to save your message in the 'Sent Mail' folder.
	#if (save_mail($mail)) {
	#    echo "Message saved!";
	#}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail) {
	//You can change 'Sent Mail' to any other folder or tag
	$path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
	//Tell your server to open an IMAP connection using the same username and password as you used for SMTP
	$imapStream = imap_open($path, $mail->Username, $mail->Password);
	$result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
	imap_close($imapStream);
	return $result;
}
function rand_string($length) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$str = "";
	$size = strlen($chars);
	for ($i = 0; $i < $length; $i++) {
		$str .= $chars[rand(0, $size - 1)];
	}
	return $str;
}
if (isset($_GET['email'])) {	
	header("location:seen_code_verify.php?err=đã gửi lại mã xác nhận! vui lòng kiểm tra email");die;
}
?>