<?php 
require_once("../helpers/common.php");
require_once("../helpers/db.php");

$id = $_GET['id'];
$tempCart = $_SESSION['cart'];
$index = null;
foreach ($tempCart as $key => $prod) {
    if ($prod['id'] == $id) {
        array_splice($tempCart, $key, 1);
        break;
    }
}
$_SESSION['cart'] = $tempCart;
if (count($_SESSION['cart'])>0) {
    $_SESSION['cartSum'] = 0;
    foreach ($_SESSION['cart'] as $Value){
       $_SESSION['cartSum'] += $Value['qty'] * $Value['sell_price'];
    }
}
header("location: " . BASE_URL . "cart.php");
?>