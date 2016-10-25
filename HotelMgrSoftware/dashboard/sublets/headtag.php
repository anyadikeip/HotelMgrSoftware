<?php
include("admin_authorizer.php");
# Fetch Privilege Role & Settings ======================================
$qryuser=mysql_query("SELECT * FROM privileges WHERE 
id={$_SESSION[login_cache]} AND status=0") or die(mysql_error());
while($recset = mysql_fetch_array($qryuser)){
$fulname = $recset['fulname']; $username = $recset['username'];	
$mobile_no=$recset['mobile_no']; $user_role=trim($recset['user_role']);	
$status=$recset['status'];	$xdate=$recset['xdate'];
define("USEROLE", $recset['user_role']);
}

if($user_role == 'administrator'){$role='Administrator';}
if($user_role == 'content_mgr'){$role='Content Manager';}
if($user_role == 'frontdesk'){$role='FrontDesk Clerk';}
# ======================================================================
?>

<?php 
$today = date("m/d/Y");
$yesterday = date('m/d/Y', strtotime('-1 day', strtotime($today)));
$last30 = date('m/d/Y', strtotime('-30 day', strtotime($today)));
$last90 = date('m/d/Y', strtotime('-90 day', strtotime($today)));
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Explore Reservation | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    
  </head>

<body class="skin-blue sidebar-mini">