<?php 
  session_start();
  require_once 'db.php';
  if (isset($_COOKIE['auth'])) {
  $auth = $_COOKIE['auth'];
  $query_user = "select * from users where password like '$auth'";
  $_SESSION['auth'] = executeQuery($query_user);
  }
  if (!isset($_SESSION['auth'])) {
    header('location: login.php');die;
  }
  if ($_SESSION['auth']['role']<2) {
    header('location:../../index.php');die;
  }
 ?>