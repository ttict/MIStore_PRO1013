<?php 
require_once "./helpers/common.php";
require_once "./helpers/db.php";

$qty = isset($_GET['qtybutton']) ? $_GET['qtybutton'] : 1;

if (isset($_GET["id"])) {
    
    $proId= $_GET["id"] ;
    if (is_numeric($proId)){
        // lay san pham voi id truyen vao
        $productQuery = "select * from products where id = $proId";
        $product = executeQuery($productQuery, false);
    }
    $arrayValue = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    if (!isset($_SESSION["cart"])) {//kiem tra xem session gio hang co tin tai ko
        $product["qty"]=$qty;
        array_push($arrayValue,$product);// them san pham co qty =1 vao gio hang
    }else{
        //$_SESSION["cart"]= $arrayValue ;

        // kiem tra xem san pham da ton tai trong session chua
        $index = -1;
        for ($i=0; $i < count($arrayValue); $i++) { 
            $item = $arrayValue[$i];
            if ($item["id"]==$proId) {
                $index=$i;
                break;
            }
        }
        if ($index >= 0 ) {
            $arrayValue[$index]["qty"] += $qty;
        }else {
            $product["qty"] = $qty;
            array_push($arrayValue,$product);// them san pham co qty =1 vao gio hang

        }
    }
    $_SESSION["cart"]= $arrayValue;
    
}
$UNIT_URL=$_SESSION['UNIT_URL'];
header("location: $UNIT_URL");

// var_dump($_SERVER['REQUEST_URI']);
// die;
