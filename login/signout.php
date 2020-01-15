<?php
require_once "../helpers/db.php";
require_once "../helpers/common.php";
unset($_SESSION['auth']);
unset($_SESSION['cart']);

header('location: ../index.php');
?>