<?php
// tao ket noi csdl
function getConnect(){
    try{
        $connect = new PDO("mysql:host=209.97.164.76;dbname=mistore;charset=utf8", "root", "Thienth1234");
        // $connect = new PDO("mysql:host=127.0.0.1;dbname=web204;charset=utf8", "root", "");
        return $connect;
    }catch(Exception $ex){
        echo "khong ket noi duoc csdl";
        die;
    }
}

function executeQuery($sqlQuery, $getAll = false){
    $conn = getConnect();
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    if($getAll){
        $result = $stmt->fetchAll();
    }else{
        $result = $stmt->fetch();
    }

    return $result;
}

define('USER_TABLE', 'users');
define('CATEGORY_TABLE', 'categories');
define('PRODUCT_TABLE', 'products');
define('PRODUCT_GALLERY_TABLE', 'product_galleries');
define('COMMENT_TABLE', 'comments');
define('INVOICE_TABLE', 'invoices');
define('INVOICE_DETAIL_TABLE', 'invoice_detail');
define('SLIDERS_TABLE', 'sliders');
define('WEBSETTING_TABLE', 'web_settings');

?>