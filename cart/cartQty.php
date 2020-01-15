<?php 
require_once("../helpers/common.php");
require_once("../helpers/db.php");
// echo '<pre>';
// var_dump($_SESSION['cart']);die;
$qty = $_GET['qty'];
$id = $_GET['id'];
if ($qty == "increase") {
    $prodId = searchProd($id, $_SESSION['cart']);
    $_SESSION['cart'][$prodId]['qty'] += 1;
    header("location: " . BASE_URL . "cart.php");die;
} else if ($qty == "decrease") {
    $prodId = searchProd($id, $_SESSION['cart']);
    if ($_SESSION['cart'][$prodId]['qty'] <= 1) {
        header("location: remove-cart.php?id=$id");die;
    } else {
        $_SESSION['cart'][$prodId]['qty'] -= 1;
        header("location: " . BASE_URL . "cart.php");die;
    }

}

function searchProd($id, $arr)
{
    foreach ($arr as $key => $value) {
        if ($value['id'] == $id) {
            return $key;
        }
    }
    return null;
}
?>