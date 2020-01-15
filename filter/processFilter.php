<?php 
require_once "../helpers/common.php";
require_once "../helpers/db.php";

$select = "select *";
$from = " from products";
$where = " where true";
$opts = isset($_POST['filterOpts']) ? $_POST['filterOpts'] : [];
$searchTerm = $_POST['search'];
// $prices = "";
// var_dump($_POST['priceRange']);die;
$prices = " and (sell_price between " . $_POST['priceRange'][0] . " and " . $_POST['priceRange'][1] . ")";

// $opts = ['os8', 'os7', 'os71'];
if ($opts) {
    $where = " where" . getCheckboxQuery($opts);
}
$order = $_POST['order'];
$orderQuery = "";
if ($order == "new") {
    $orderQuery = " order by id desc";
} elseif ($order == "hot") {
    $orderQuery = " order by views desc";
} elseif ($order == "priceUp") {
    $orderQuery = " order by sell_price asc";
} else {
    $orderQuery = " order by sell_price desc";
}

$search = " and name like '%$searchTerm%'";

$query = $select . $from . $where . $prices . $search . $orderQuery;
$json = json_encode(executeQuery($query, true));
echo ($json);

function getCheckboxQuery($arr)
{
    $result = "";
    if (in_array("os7", $arr)) $result .= " or operating_sys like 'Android 7%'";
    if (in_array("os71", $arr)) $result .= " or operating_sys like 'Android 7.1%'";
    if (in_array("os8", $arr)) $result .= " or operating_sys like 'Android 8.0%'";
    if (in_array("os81", $arr)) $result .= " or operating_sys like 'Android 8.1%'";
    if (in_array("os9", $arr)) $result .= " or operating_sys like 'Android 9.0%'";
    if (in_array("os1", $arr)) $result .= " or operating_sys like 'Android One%'";
    return "(" . substr($result, 3) . ")"; 
}
?>