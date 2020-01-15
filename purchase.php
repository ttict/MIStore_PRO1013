<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// require '../vendor/autoload.php';
require_once("./helpers/common.php");
require_once("./helpers/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'] . ", " . $city;

$total_price = $_SESSION['cartSum'] + 50;
if(!isset($_SESSION['auth'])) {
    header("location: " . BASE_URL . "login.php");die;
}
$userId = $_SESSION['auth']['id'];
$newInvoiceQuery = "insert into invoices (`name`, `email`, `phone_number`, `address`, total_price, user_id, `status`)
                        values ('$name', '$email', '$phone', '$address', $total_price, $userId, 'chờ xác nhận')";
$conn = getConnect();
$stmt = $conn->prepare($newInvoiceQuery);
$stmt->execute();
$id = $conn->lastInsertId();
// echo '<pre>';
// var_dump($_SESSION['cart']);die;
foreach ($_SESSION['cart'] as $key => $prod) {
    $prodName = $prod['name'];
    $prodDesc = getConnect()->quote($prod['short_desc']);
    $prodImg = $prod['image'];
    $prodColor = $prod['color'];
    $prodCpu = $prod['cpu'];
    $prodRam = $prod['ram'];
    $prodScreen = $prod['screen_size'];
    $prodOs = $prod['operating_sys'];
    $qty = $prod['qty'];
    $price = $prod['sell_price'];
    $total = $qty * $price;
    $newInvoiceDetailQuery = "insert into invoice_detail
                                (invoice_id, total, price, quantity, `name`, `short_desc`, `image`, `color`, `cpu`, `ram`, `screen_size`, `operating_sys`)
                                values
                                ($id, $total, $price, $qty, '$prodName', $prodDesc, '$prodImg', '$prodColor', '$prodCpu', '$prodRam', '$prodScreen', '$prodOs')";
                                // var_dump($newInvoiceDetailQuery);die;
    executeQuery($newInvoiceDetailQuery);
}


$content = "Đặt hàng thành công!<br>" . "Danh sách mặt hàng:<br>" . "<table><tr><td>Tên</td><td>Số lượng</td><td>Giá bán</td><td>Thành tiền</td></tr>";
foreach ($_SESSION['cart'] as $key => $prod) {
    $prodName = $prod['name'];
    $qty = $prod['qty'];
    $price = $prod['sell_price'];
    $total = $qty * $price;
    $content .= "<tr><td>$prodName</td><td>$qty</td><td>$price</td><td>$total</td></tr>";
}
$content .= "</table><br>Tổng tiền: " . $_SESSION['cartSum'];
// var_dump($content);die;

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
$mail->addAddress( "$email", "$name");
//Set the subject line
$mail->Subject = 'Thông tin mua hàng';
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
    header("location: " . BASE_URL . "order-complete.php?id=$id");die;
}

// header("location: " . BASE_URL . "order-complete.php?id=$id");

?>