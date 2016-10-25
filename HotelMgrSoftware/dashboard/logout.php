<?php
$return_url=$_GET['return_url'];
session_start();
unset($_SESSION["login_cache"]);
session_destroy();
header("Location: .?return_url=".$return_url);
exit
?>