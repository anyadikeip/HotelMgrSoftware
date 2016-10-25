<script>
function del(pid){
	if(confirm('Do you really mean to delete this item')){
		document.formimg.pid.value=pid;
		document.formimg.command.value='delete';
		document.formimg.submit();
	}
}

function fetch(pid){
	document.formimg.pid.value=pid;
	document.formimg.command.value='fetch';
	document.formimg.submit();
}

function tog(pid){
	document.formimg.pid.value=pid;
	document.formimg.command.value='toggle';
	document.formimg.submit();
}	
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Privilege
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Privilege  </li>
  </ol>
  
</section>




<section class="content">
	<div class="box box-default">
    
        <div class="box-header with-border">
          <i class="fa fa-th-list"></i>
          <h3 class="box-title">Privilege List </h3> 
          <a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm pull-right" ><strong>Add New</strong></a>        
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <div class="col-md-12 responsive">            
            <?php 
			if(isset($_POST['save_privilege'])){
				# Collect variable for privilege  ---------------------------------------------------------------			
				$fulname = ucwords(trim($_POST['fulname'])); $username = mysql_escape_string($_POST['username']);
				$password = trim($_POST['password']); $mobile_no = trim($_POST['mobile_no']);
				$user_role = trim($_POST['user_role']);				
				$qry=mysql_query("SELECT * FROM privileges WHERE username='$username'") or die(mysql_error());
				
				if(mysql_num_rows($qry) == 1){echo alert('danger', 'Sorry: Someone has already choose this username.');}					
				else{					
				# Save privilege to database ----------------------------					   
				$img_nm = $randname.".jpg";  
				mysql_query("INSERT INTO privileges SET fulname='$fulname', username='$username', password='$password',
				mobile_no='$mobile_no', user_role='$user_role'") or die(mysql_error());
				echo alert("success","User privilege created successfully.");
				}					
			}
			 # -------------------------------------------------------------------------------------------------------
			 # UPDATE SELECTED PRIVILEGE TO DATABASE
			 # -------------------------------------------------------------------------------------------------------
			 if(isset($_POST['edit_privilege'])){
				 $fulname = ucwords(trim($_POST['efulname'])); $username = mysql_escape_string($_POST['eusername']);
				 $password = trim($_POST['epassword']); $emobile = trim($_POST['emobile']); 
				 $eprivilege = trim($_POST['eprivilege']); $hid = $_POST['hid']; 
				 
				 $query=mysql_query("SELECT * FROM privileges WHERE id='$hid'") or die(mysql_error()); 
				 # Validate variables for input ================================================================== 				
					if(empty($username)){echo alert('info', 'Please enter username');}
						elseif(empty($password)){echo alert('info', 'Please enter password');					
					}else{	
						mysql_query("UPDATE privileges SET fulname='$fulname', username='$username', 
						password='$password', mobile_no='$emobile', user_role='$eprivilege' WHERE 
						id='$hid'") or die(mysql_error()); echo alert('success','Privilege updated successully');
						$_SESSION['efulname']=''; $_SESSION['eusername']=''; $_SESSION['eprivilege']='';
						$_SESSION['epassword']='';  $_SESSION['emobile']=''; $_SESSION['hid']='';
					}		 
			 }		
			?>
            
            <?php 
			# ----------------------------------------------------------------------------------------------------
			 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
				delete_item('privileges', $_REQUEST['pid']);
			 }
			 # ----------------------------------------------------------------------------------------------------
			 if($_REQUEST['command']=='toggle' && $_REQUEST['pid']>0){
				toggle_access('privileges', $_REQUEST['pid'], 'status');
			 }			  			
			?>
              
              
              
               <?php if($_REQUEST['command']=='fetch' && $_REQUEST['pid']>0){ 
			   $_SESSION['hid']=get_value_using_id('privileges', $_REQUEST['pid'], 'id');
			   $_SESSION['efulname']=get_value_using_id('privileges', $_REQUEST['pid'], 'fulname');
			   $_SESSION['eusername']=get_value_using_id('privileges', $_REQUEST['pid'], 'username');
			   $_SESSION['epassword']=get_value_using_id('privileges', $_REQUEST['pid'], 'password');
			   $_SESSION['emobile']=get_value_using_id('privileges', $_REQUEST['pid'], 'mobile_no');
			   $_SESSION['eprivilege']=get_value_using_id('privileges', $_REQUEST['pid'], 'user_role');
			   ?>          
                <form class="form-inline" method="post" name="editp">
                <br>
                
                  <div class="form-group">
                    <input type="hidden" name="hid" value="<?php echo $_SESSION['hid']; ?>">
                    <label class="sr-only" for="efulname">Fulname</label>
                    <input type="text" class="form-control" name="efulname" id="efulname" 
                    value="<?php echo $_SESSION['efulname']; ?>" placeholder="Enter Fulname">
                  </div>
                  
                 <div class="form-group">
                    <label class="sr-only" for="eusername">Username</label>
                    <input type="text" class="form-control" id="eusername" name="eusername" 
                    value="<?php echo $_SESSION['eusername']; ?>" placeholder="Enter username">
                  </div>
                  
                  <div class="form-group">
                    <label class="sr-only" for="epassword">Password</label>
                    <input type="password" class="form-control" id="epassword" name="epassword" 
                    value="<?php echo $_SESSION['epassword']; ?>" placeholder="Password">
                  </div>
                  
                  <div class="form-group">
                    <label class="sr-only" for="emobile">Mobile No</label>
                    <input type="text" class="form-control" id="emobile" name="emobile"  
                    value="<?php echo $_SESSION['emobile']; ?>" placeholder="Phone number">
                  </div>
                  
                  <div class="form-group">
                    <label for="privilege">&nbsp;</label>
                    <select class="form-control" name="eprivilege" id="eprivilege">
                      <option selected="selected" value="<?php echo $_SESSION['eprivilege']; ?>">
					  <?php if($_SESSION['eprivilege']=='administrator'){echo 'Administrator';}elseif($_SESSION['eprivilege']=='content_mgr')
						{echo 'Content Manager';}elseif($_SESSION['eprivilege']=='frontdesk'){echo 'Front Desk Clerk';} ?>
                      </option>
                      <option value="administrator">Administrator</option>
                      <option value="content_mgr">Content Manager</option>
                      <option value="frontdesk">Front Desk Clerk</option> 
                    </select>&nbsp;
                  </div>
                  
                  <input type="submit" class="btn btn-success" name="edit_privilege" value="Update" >
                  
                </form>
                <legend>&nbsp;</legend>    
                   
                   
               <?php } ?> 
              
              
              
              <form method="post" name="formimg" id="formimg">
                <input type="hidden" name="pid" />
                <input type="hidden" name="command" /> 
              <table class="table  table-hover responsive">         
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Fulname</th>
                  <th>Username</th>
                  <th>Mobile No</th>
                  <th>Parent Role</th>
                  <th>Status</th>
                  <th style="text-align:right;">Function</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               $query=mysql_query("SELECT * FROM privileges") or 
               die('Unable to list privilege ' . mysql_error());  $j=0;	  
              while($row=mysql_fetch_array($query, MYSQL_ASSOC)){  $j++;		  
              ?>
                <tr>
                  <td>&nbsp;<?php echo $j; ?></td>
                  <td><?php echo ucwords($row['fulname']); ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['mobile_no']; ?></td>
                  <td><?php if($row['user_role'] == 'administrator'){echo 'Administrator';}
				  		elseif($row['user_role'] == 'content_mgr'){echo 'Content Manager';}
						elseif($row['user_role'] == 'frontdesk'){echo 'Front Desk Clerk';} 
					  ?></td> 
                  <td><?php if($row['status']==0){echo '<span class="label label-success">Enabled</span>';}
                       else{echo '<span class="label label-danger">Disabled</span>';}  
                       ?></td>                                   
                  <td style="text-align:right;">
                  <div class="btn-group">
                  <a href="javascript:fetch(<?php echo $row['id'] ?>)" 
                  class="btn btn-xs btn-primary glyphicon glyphicon-edit" title="Edit Privilege"></a>
                  <a href="javascript:tog(<?php echo $row['id'] ?>)" 
                  class="btn btn-xs btn-info glyphicon glyphicon-off" title="Enable/Disable"></a>
                  <a href="javascript:del(<?php echo $row['id'] ?>)" 
                  class="btn btn-xs btn-danger glyphicon glyphicon-trash" title="Delete Privilege"></a>
                  </div>
                  </td>
                </tr>            
                <?php }?>
              </tbody>
            </table>
            </form>
            
            
            </div>
        </div>
                 
        
    </div>
</section>







<form class="form-horizontal" name="privilege" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD  PRIVILEGE</h4>
      </div>
      <div class="modal-body">
      
          	<div class="form-group">
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <div style="color:red;" id="msging"></div>
                </div>
              </div>
      
             
          <div class="form-group">
            <label for="fulname" class="col-sm-3 control-label">Fulname:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="fulname" placeholder="Enter fulname" >
            </div>
          </div>
          
          
          <div class="form-group">
            <label for="username" class="col-sm-3 control-label">Username:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="username"  >
            </div>
          </div>
          
          
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password:</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" name="password"  >
            </div>
          </div>
          
          
          <div class="form-group">
            <label for="mobile_no" class="col-sm-3 control-label">Mobile No:</label>
            <div class="col-sm-6">
              <input type="text" name="mobile_no" class="form-control" >
            </div>
          </div>
         
         
          <div class="form-group">
            <label for="user_role" class="col-sm-3 control-label">Parent Role:</label>
            <div class="col-sm-6">
                <select name="user_role" class="form-control">
                  <option value="-select-">-select-</option>
                  <option value="administrator">Administrator</option>
                  <option value="content_mgr">Content Manager</option>
                  <option value="frontdesk">Front Desk Clerk</option>                  
                </select>
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
      	<input type="submit" name="save_privilege" class="btn btn-success" value="Save Privilege" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
</form>


<script type="text/javascript">
// Validate compose form on submit -----------------------------------------
function validateForm() {
	var username = document.forms["privilege"]["username"].value;
	var password = document.forms["privilege"]["password"].value;
	var user_role = document.forms["privilege"]["user_role"].value;
	
	if (username == null || username == "") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please enter username</div>";			
		return false;
	}else if (password == null || password == "") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please choose a password</div>";			
		return false;		
	}else if (user_role == null || user_role == "-select-") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please select user role</div>";			
		return false;
	}
}
</script>