<script language="javascript">
	function load_data(pid){
		document.form1.pid.value=pid;
		document.form1.command.value='load';
		document.form1.submit();
	}
	
	function tog(pid){
		document.form1.pid.value=pid;
		document.form1.command.value='toggle';
		document.form1.submit();
	}	
		
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
</script>


<?php 
# Pagination Parameters--------------------------------------------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 10; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page; 
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Setup Amenities
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Amenities  </li>
  </ol>
</section>

<section class="content-header">

</section>


<section class="content">

<div class="box box-default">
    
    <div class="box-header with-border">
      <i class="fa fa-tags"></i>
      <h3 class="box-title">Amenities List</h3>
      <!--<a data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm pull-right" >Add New</a> -->      
    </div><!-- /.box-header -->
    
    <div class="box-body">
    	<div class="col-md-12">
		<?php
		# -------------------------------------------------------------------------------------------------------
		# SAVE NEW AMENITY TO DATABASE
		# ------------------------------------------------------------------------------------------------------- 
          if(isset($_POST['add_amenities'])){
                # Collects variables for input ==================================================================
                $amenity_nm = trim(ucwords($_POST['amenity_nm'])); $amenity_type = $_POST['amenity_type'];
                $query=mysql_query("SELECT * FROM amenities WHERE name='$amenity_nm'") or die(mysql_error()); 				 
				#------------------------------------------------------------------------------------------------
				$_SESSION['amenity_nm']=$amenity_nm;  $addedby=$_SESSION['privellege_id'];
								                                  
                # Validate variables for input ================================================================== 				
                if(empty($amenity_nm)){echo alert('info', 'Please enter amenity name');}
                    elseif($amenity_type=='Select Type'){echo alert('info', 'Please select amenity type');}
                    elseif(mysql_num_rows($query) == 1){echo alert('danger', 'Sorry: Amenity already exist.');					
                }else{	
                    mysql_query("INSERT INTO amenities SET name='$amenity_nm', type='$amenity_type', 
					addedby='$addedby'") or die(mysql_error()); echo alert('success','Amenity added successully');
					$_SESSION['amenity_nm']='';  $_SESSION['amenity_type']=''; 
                }
         }
		 # -------------------------------------------------------------------------------------------------------
		 # UPDATE SELECTED AMENITY TO DATABASE
		 # -------------------------------------------------------------------------------------------------------
		 if(isset($_POST['edit_amenity'])){
			 $amenity_nm = trim(ucwords($_POST['amenity_nm'])); $amenity_type = $_POST['amenity_type'];
			 $active_id = $_POST['active_id']; 
			 $query=mysql_query("SELECT * FROM amenities WHERE name='$amenity_nm' 
			 AND type='$amenity_type'") or die(mysql_error()); 
			 # Validate variables for input ================================================================== 				
                if(empty($amenity_nm)){echo alert('info', 'Please enter amenity name');}
                    elseif($amenity_type=='Select Type'){echo alert('info', 'Please select amenity type');}
                    elseif(mysql_num_rows($query) == 1){echo alert('danger', 'Sorry: Amenity already added.');					
                }else{	
                    mysql_query("UPDATE amenities SET name='$amenity_nm', type='$amenity_type', 
					addedby='$addedby' WHERE id='$active_id'") or die(mysql_error()); 
					echo alert('success','Amenity edited successully');
					$_SESSION['amenity_nm']='';  $_SESSION['amenity_type']=''; 
                }		 
		 }			
		 # ----------------------------------------------------------------------------------------------------
		 # TOGGLE/DELETE/LOAD AMENITY FROM DATABASE
		 # ----------------------------------------------------------------------------------------------------
		 if($_REQUEST['command']=='toggle' && $_REQUEST['pid']>0){
			toggle_access('amenities', $_REQUEST['pid'], 'status');
		 }
		 # ----------------------------------------------------------------------------------------------------
		 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
			delete_item('amenities', $_REQUEST['pid']);
		 }
		 # ----------------------------------------------------------------------------------------------------		 
		 if($_REQUEST['command']=='load' && $_REQUEST['pid']>0){
			$_SESSION['amenity_nm']=get_value_using_id('amenities', $_REQUEST['pid'], 'name');
			$_SESSION['amenity_type']=get_value_using_id('amenities', $_REQUEST['pid'], 'type');
			$_SESSION['active_id']=$_REQUEST['pid'];
		}
        ?>
      </div>
    
    	<div class="row">
              <div class="col-md-12">
              	<form class="form-inline" method="post" name="form1"> 
                <input type="hidden" name="pid" />
  				<input type="hidden" name="command" /> 
                <input type="hidden" name="active_id" value="<?php echo $_SESSION['active_id']; ?>" />       
                  <div class="form-group">
                  <label for="amenity_nm"> &nbsp; </label>
                     <input type="text" class="form-control" name="amenity_nm" value="<?php echo $_SESSION['amenity_nm']; ?>" placeholder="Enter Amenity Name">  
                  </div>
                   
                  <div class="form-group">
                    <label for="exampleInputEmail2">&nbsp;</label>
                    <select class="form-control" name="amenity_type">
                      <option selected="selected" value="<?php echo $_SESSION['amenity_type']; ?>">
					  <?php if($_SESSION['amenity_type']==0){echo 'Room';}elseif($_SESSION['amenity_type']==1)
						{echo 'Hotel';}	elseif($_SESSION['amenity_type']==2){echo 'Both';} ?>
                      </option>
                      
                      <option value="0">Room</option>
                      <option value="1">Hotel</option>
                      <option value="2">Both</option>
                    </select>&nbsp;
                  </div>
                  <?php if($_REQUEST['command']=='load' && $_REQUEST['pid']>0){?>
                  <input type="submit" name="edit_amenity" class="btn btn-success" value="Edit Amenity"/>
                  <?php }else{ ?>
                  <input type="submit" name="add_amenities" class="btn btn-success" value="Save Amenity"/>  
                  <?php } ?>                
                </form>      
              </div>
        </div>
        
    <hr />
    
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-condensed">
        <thead>
        	<tr style=" font-weight:bold;">
            	<td style="text-align:center;"><input type="checkbox" name=""  /></td>
        		<td>AMENITIES NAME</td>
                <td>TYPE</td>
                <td>STATUS</td> 
                <!--<td>MODIFIED DATE</td> -->
                <td style="text-align:right;">ITEM CONTROLS</td>
            </tr>
        </thead>        
        <tbody>        
        	<?php
			$statement = "amenities ORDER BY name ASC"; 
			$query=mysql_query("SELECT * FROM {$statement} LIMIT 
			{$startpoint},{$per_page}") or die(mysql_error());
			while($row = mysql_fetch_array($query)){
			?>
        	<tr>
            	<td style="text-align:center;"><input type="checkbox" name=""  /></td>
        		<td><?php echo ucwords($row['name']); ?></td>
                <td><?php if($row['type']==0){echo 'Room';}elseif($row['type']==1)
					{echo 'Hotel';}	elseif($row['type']==2){echo 'Both';} ?> </td>
                <td><?php 
				if($row['status']==0){echo '<span class="label label-success">Active</span>';}
				else{echo '<span class="label label-danger">Inactive</span>';}  
                ?></td> 
                <!--<td><?php echo date($row['xdate']); ?> </td> -->
                <td> 
                	<div class="btn-group pull-right" role="group">
                      <a href="javascript:load_data(<?php echo $row['id'] ?>)" title="Edit" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>
                      <a href="javascript:tog(<?php echo $row['id'] ?>)" title="Hide/Show" class="btn btn-xs btn-default glyphicon glyphicon-off"></a>
                      <a href="javascript:del(<?php echo $row['id'] ?>)" title="Delete" class="btn btn-xs btn-danger glyphicon glyphicon-trash"></a>
                    </div>                
                </td>
            </tr>
        <?php } ?>        
        </tbody>
      </table>
    </div>
    
        <!-- PAGINATION -->
        <div class="btn-toolbar" style="text-align:center;">
        	<div class="pagination  pagination-sm">
        		<ul>        
        			<?php echo pagination($statement,$per_page,$page,$url='?');?>
        		</ul>
        	</div>
        </div> 
      <!-- /PAGINATION -->
      
    </div>     
</div><!-- /.box-body -->
</section>