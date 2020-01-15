<?php 
function getConnect(){
    try{
        // $connect = new PDO("mysql:host=127.0.0.1;dbname=demo;charset=utf8","root", "");
        $connect = new PDO("mysql:host=209.97.164.76;dbname=mistore;charset=utf8","root", "Thienth1234");
        return $connect;
    }catch(Exception $ex){
        echo "không kết nối được cơ sở dữ liệu";die;
    }
}
function executeQuery($sqlQuery, $getAll = false){
    $conn = getConnect();
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    if($getAll){
        return $stmt->fetchAll();
    }else{
        return $stmt->fetch();
    }
}
// tạo biến cho các bảng trong cơ sở dữ liệu để tiện lợi cho việc update website

$table_users                = "users";

$table_web_setting          = "web_setting";

$table_sliders              = "sliders";

$table_contact_form         = "contact_form";

$table_products             = "products";

$table_comments             = "comments";

$table_invoices             = "invoices";

$table_invoice_detail       = "invoice_detail";

$table_product_galleries    = "product_galleries";
?>