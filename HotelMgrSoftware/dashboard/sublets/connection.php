<?php
require("constants.php");
// server connection string
$con=mysql_connect(DB_SERVER,DB_USER,DB_PW);
if(!$con){
	die("Can not connect to database server " . mysql_error());
}
	
// database selection string
$db_select=mysql_select_db(DB_NAME, $con);
if(!$db_select){
	die("Can not select database server " . mysql_error());
}

?>