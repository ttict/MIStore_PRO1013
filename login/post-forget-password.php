<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require_once "../helpers/common.php";
require_once "../helpers/db.php";

$email = $_POST['email'];
$searchEmailQuery = "select * from users where email = '$email'";
$user = executeQuery($searchEmailQuery);


if ($user) {
    $id = $user['id'];
    $name = $user['name'];
    $hash = bin2hex(random_bytes(16));
    $content = "<p>Mã đặt lại mật khẩu là: $hash</p>";
    
    $resetTokenQuery = "update users set password_reset_token = '$hash' where id = $id";
    executeQuery($resetTokenQuery);

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
    $mail->addAddress( "$email", "$name");
    //Set the subject line
    $mail->Subject = 'Đặt lại mật khẩu';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->isHTML(true);
    $mail->Body = $content;
    $mail->msgHTML("$content", __DIR__);
    //Replace the plain text body with one created manually
    $mail->AltBody = 'null';
    //Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        // echo "Message sent!";
        header("location: input-token.php?id=$id");die;
    }
}
$err = "Không tìm thấy email";
header("location: forget-password.php?err=$err");die;

?>