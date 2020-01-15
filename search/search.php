<?php 
require_once("../helpers/common.php");
require_once("../helpers/db.php");
$search = $_GET['search'];
$searchQuery = "select id from products where name like '%$search%'";

$searchResult = executeQuery($searchQuery, true);
function takeId($element)
{
    return $element['id'];
}
$result = array_map("takeId", $searchResult);
// var_dump($result);die;

if (!$searchResult) {
    header("location: search-result.php?result=none");
    die;
} else {
    $response = implode(",", $result);
    // var_dump($response);die;
    header("location: search-result.php?result=$response");
    die;
}
?>