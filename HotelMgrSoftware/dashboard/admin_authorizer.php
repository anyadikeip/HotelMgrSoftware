<?php
if(empty($_SESSION['login_cache'])){
	$return_url=basename($_SERVER['PHP_SELF']);;
	header("Location: logout.php?return_url=".$return_url); 
	exit; 
}
?>