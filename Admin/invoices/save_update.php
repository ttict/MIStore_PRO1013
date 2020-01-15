<?php
require_once '../public/verify.php';
require_once '../public/db.php';
$id_invoice = getConnect()->quote($_GET['id']);
$status = getConnect()->quote($_GET['status']);
$update_invoice_query = "update $table_invoices set status = $status where id = $id_invoice";
// var_dump($update_invoice_query);die;
executeQuery($update_invoice_query);
header("location: invoice_detail.php?id=$id_invoice");
?>