<?php 
session_start(); ob_start();
require('sublets/general.php');
?>  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="."><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
        
        <?php 
		if(isset($_POST['login'])){
			 $un=trim(mysql_real_escape_string($_POST["admin_un"]));
			 $pw=trim(mysql_real_escape_string($_POST["admin_pw"]));
			
			$query=mysql_query("SELECT * FROM privileges WHERE username='$un' AND 
			password='$pw'") or die("Privileges login error: " . mysql_error());
				
			$_SESSION['admin_un']=$un; //$_SESSION['apw']=$pw;
				
			if(empty($un) || empty($pw)){
				echo alert('danger', 'Err: wrong user privilege');	 	
			}elseif(mysql_num_rows($query)==0){
				echo alert("danger","Login authentication failed");
				$_SESSION['admin_un']="";
			}else{
				
			# Get database value ----------------------------------------																													
				while($row = mysql_fetch_array($query)){						
					if($row['username'] == $un && $row['password'] == $pw){
					$username=$row['username']; $password=$row['username'];
					$login_cache = $row['id']; $status = $row['status'];							
					}
				} 
			# while statement -------------------------------------------
							
			if($username != $un && $password != $pw){ # wrong matching
					echo alert("info","Invalid account info, Retry.");
			}elseif($status == 1){ # Blocked Access
					echo alert("info","Account Blocked. Contact support team.");
			}else{	
							
				switch ($status){
					case 0:
						$return_url=$_GET['return_url']; $_SESSION['apw']='';
						$_SESSION['login_cache'] = $login_cache; 
						if(empty($return_url)){
							header("Location: overview");					
							exit;
						}else{							
							header("Location: ".$return_url);
							exit;
						}	
					break;
						
				} # Switch ends	
						
			} # if statement ends	
		  } # empty
		} 
		?>
		
        </p>
        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" name="admin_un" value="<?php echo $_SESSION['admin_un']; ?>" class="form-control" placeholder="Email" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="admin_pw" class="form-control" placeholder="Password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
