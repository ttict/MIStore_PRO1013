<?php 
	session_start();
	unset($_SESSION['auth']);
	setcookie('auth', "", strtotime("-15 days"), "/");
	header('location:login.php');die;
 ?>