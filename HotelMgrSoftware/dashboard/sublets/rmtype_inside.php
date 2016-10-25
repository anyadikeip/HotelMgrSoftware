<script language="javascript">
	function load_data(pid){
		document.frm_rmtype.pid.value=pid;
		document.frm_rmtype.command.value='load';
		document.frm_rmtype.submit();
	}
	
	function tog(pid){
		document.frm_rmtype.pid.value=pid;
		document.frm_rmtype.command.value='toggle';
		document.frm_rmtype.submit();
	}	
		
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.frm_rmtype.pid.value=pid;
			document.frm_rmtype.command.value='delete';
			document.frm_rmtype.submit();
		}
	}
	
	function featured(pid){
			document.frm_rmtype.pid.value=pid;
			document.frm_rmtype.command.value='featured';
			document.frm_rmtype.submit();
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
    Room Type
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Room Type  </li>
  </ol>
  
</section>



<section class="content">
	<div class="box box-default">
    
        <div class="box-header with-border">
          <i class="fa fa-th-list"></i>
          <h3 class="box-title">Room Type List</h3>
          <a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm pull-right" ><strong>Add New</strong></a>       
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <div class="col-md-12">
            	<?php 
				# -------------------------------------------------------------------------------------------------------
			    # SAVE ROOM TYPE TO DATABASE
				# -------------------------------------------------------------------------------------------------------
				if(isset($_POST['add_rmtype'])){
					$rmtype=trim(ucwords($_POST['rmtype'])); $descr=$_POST['descr']; 
					$m_adult=$_POST['m_adult']; $m_child=$_POST['m_child'];	
					$rack_rate=$_POST['rack_rate']; $promo=$_POST['promo']; $sort=$_POST['skey'];						
														
					$qry=mysql_query("SELECT * FROM room_type WHERE type_nm='$rmtype'") or die("Err I: ".mysql_error());					  
					# Validate variables for input --------------------------------------------------------------------- 				
					if(mysql_num_rows($qry) == 1){echo alert('danger', 'Sorry: Room type already exist.');					
					}else{	
						mysql_query("INSERT INTO room_type SET type_nm='$rmtype', descr='$descr', 
						m_adult='$m_adult', m_child='$m_child', rack_rate='$rack_rate',	
						promo_rate='$promo_rate', sort='$sort'") or die("Err II: " . mysql_error()); 
						echo alert('success','Room type was added successully');
					}				
				}
				
				# -------------------------------------------------------------------------------------------------------
				# UPDATE SELECTED ROOM TYPE TO DATABASE
				# -------------------------------------------------------------------------------------------------------
				 if(isset($_POST['edit_rmtype'])){
					 $room_type = trim(ucwords($_POST['room_type'])); $maxA=$_POST['maxA']; $maxC=$_POST['maxC'];
					 $sortkey=$_POST['sortkey']; $rack_rate=$_POST['rack_rate']; $promo_rate=$_POST['promo_rate']; 
					 $descr=$_POST['descr']; $active_id = $_POST['active_id'];	
					 				 				 
					 mysql_query("UPDATE room_type SET type_nm='$room_type', m_adult='$maxA', m_child='$maxC',
					 sort='$sortkey',rack_rate='$rack_rate',promo_rate='$promo_rate', descr='$descr' 
					 WHERE id='$active_id'") or die(mysql_error()); 
					 echo alert('success','Room type updated successully');								 
				 }
				 # ----------------------------------------------------------------------------------------------------
				 # TOGGLE/DELETE ROOM TYPE FROM DATABASE
				 # ----------------------------------------------------------------------------------------------------
				 if($_REQUEST['command']=='toggle' && $_REQUEST['pid']>0){
					toggle_access('room_type', $_REQUEST['pid'], 'status');
				 }
				 # ----------------------------------------------------------------------------------------------------
				 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
					delete_item('room_type', $_REQUEST['pid']);
				 }
				 # ----------------------------------------------------------------------------------------------------
				 if($_REQUEST['command']=='featured' && $_REQUEST['pid']>0){
					toggle_access('room_type', $_REQUEST['pid'], 'featured');
				 }			
				?>
                
          </div>
          
          <?php 
		  # ----------------------------------------------------------------------------------------------------
		  # LOAD ROOM TYPE FROM DATABASE
		  # ----------------------------------------------------------------------------------------------------
		  if($_REQUEST['command']=='load' && $_REQUEST['pid']>0){
			  $room_type = get_value_using_id('room_type', $_REQUEST['pid'], 'type_nm');
			  $maxA = get_value_using_id('room_type', $_REQUEST['pid'], 'm_adult');
			  $maxC = get_value_using_id('room_type', $_REQUEST['pid'], 'm_child');			  
			  $rack_rate = get_value_using_id('room_type', $_REQUEST['pid'], 'rack_rate');
			  $promo_rate = get_value_using_id('room_type', $_REQUEST['pid'], 'promo_rate');
			  $descr = get_value_using_id('room_type', $_REQUEST['pid'], 'descr');
			  $sortkey = get_value_using_id('room_type', $_REQUEST['pid'], 'sort');
		  ?>          
          	<div class="col-md-12">
              <form class="" method="post">
              
            	<div class="col-md-6">
                <input type="hidden" value="<?php echo $_REQUEST['pid']; ?>" name="active_id" />
                  <div class="form-group">
                    <label class="sr-only" for="room_type">Room Type</label>
                    <input type="text" class="form-control" name="room_type" value="<?php echo $room_type; ?>" placeholder="Enter Room Type">
                  </div>
                  
                  <div class="form-group">
                    <div class="input-group">
      				<div class="input-group-addon">Max &nbsp;Adult:</div>
                    <input type="number" min="1" max="10" class="form-control" name="maxA" value="<?php echo $maxA; ?>" id="maxA">
                    <div class="input-group-addon"> &nbsp;Max &nbsp; Child: </div>
                    <input type="number" min="0" max="10" class="form-control" name="maxC" value="<?php echo $maxC; ?>" id="maxC">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="input-group">
      				<div class="input-group-addon">Rack Rate:</div>
                    <input type="number" min="1"  class="form-control" name="rack_rate" value="<?php echo $rack_rate; ?>" id="rack_rate">
                    <div class="input-group-addon">Promo Rate:</div>
                    <input type="number" min="0" class="form-control" name="promo_rate" value="<?php echo $promo_rate; ?>" id="promo_rate">
                    </div>
                  </div>
                </div><!-- -->
                        
            	<div class="col-md-6">
                <div class="form-group">
                  <label class="sr-only" for="room_type">Description:</label>
                  <textarea class="form-control" name="descr" rows="3"><?php echo $descr; ?></textarea>
                </div>
                                
                <div class="form-group">
                 <div class="input-group">
                 <div class="input-group-addon">Sort &nbsp;Key: &nbsp;</div>
                 <input type="number" min="0" max="50"  class="form-control" name="sortkey" value="<?php echo $sortkey; ?>" id="sortkey">
                 <div class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></div>
                 <div class="btn-group pull-right" role="group">
                  <button type="submit" name="edit_rmtype" class="btn btn-success">Update</button>
                 <a href="rmtype" class="btn btn-danger ">Close</a>
                </div>
                 
                </div>                
               </div>
               </div><!-- -->
             </form> 
          	</div>       
           <?php } ?> 
           
         
           
    	<div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr style=" font-weight:bold;">
                        <td style="text-align:center;"><input type="checkbox" name=""  /></td>
                        <td>ROOM TYPE</td>
                        <td style="text-align:right">RACK</td>
                        <td style="text-align:right">PROMO</td>
                        <td style="text-align:center">A / C</td>
                        <td style="text-align:center">FEATURED</td> 
                        <td style="text-align:center">STATUS</td> 
                        
                        <td style="text-align:right;">ITEM CONTROLS</td>
                    </tr>
                </thead>        
                <tbody>        
                    <?php
                    $statement = "room_type ORDER BY sort ASC"; 
                    $query=mysql_query("SELECT * FROM {$statement} LIMIT 
                    {$startpoint},{$per_page}") or die(mysql_error());
                    while($row = mysql_fetch_array($query)){
                    ?>
                    <tr>
                      <td style="text-align:center;"><input type="checkbox" name=""  /></td>
                      <td><?php echo $row['type_nm']; ?></td>
                      <td style="text-align:right"><span class=""><?php echo number_format($row['rack_rate']); ?></span></td>
                      <td style="text-align:right"><span class=""><?php echo number_format($row['promo_rate']); ?></span></td>
                      <td style="text-align:center"><strong><?php echo $row['m_adult'].' / '.$row['m_child']; ?></strong></td>
                      <td style="text-align:center"><?php if($row['featured']==1){echo '<span class="label label-warning">Featured</span>';} ?></td>
                      <td style="text-align:center"><?php 
                       if($row['status']==0){echo '<span class="label label-success">Active</span>';}
                       else{echo '<span class="label label-danger">Inactive</span>';}  
                       ?></td> 
                                                
                      <td> 
                        <div class="btn-group pull-right" role="group">
                          <a href="javascript:load_data(<?php echo $row['id'] ?>)" data-toggle="tooltip" data-placement="top"   
                          title="Edit" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>   
                          <a href="javascript:tog(<?php echo $row['id'] ?>)" data-toggle="tooltip" data-placement="top"
                          title="<?php if($row['status']==0){echo 'Disable';}else{echo 'Enable';}?>" 
                          class="btn btn-xs btn-default glyphicon glyphicon-off"></a>
                          
                          <a href="javascript:featured(<?php echo $row['id'] ?>)" data-toggle="tooltip" data-placement="top"
                          title="Featured" class="btn btn-xs btn-primary glyphicon glyphicon-asterisk"></a>
                          
                          <a  href="updates?_forame=<?php echo $row['id'].'#'.$row['type_nm'] ?>" data-toggle="tooltip" data-placement="top"
                          title="Amenities" class="btn btn-xs btn-success glyphicon glyphicon-tags"></a>   
                          <a href="updates?_forimg=<?php echo $row['id'].'#'.$row['type_nm'] ?>" data-toggle="tooltip" data-placement="top"
                          title="Images" class="btn btn-xs btn-info glyphicon glyphicon-picture"></a>
                          
                          <a href="javascript:del(<?php echo $row['id'] ?>)" data-toggle="tooltip" data-placement="top"
                          title="Delete" class="btn btn-xs btn-danger glyphicon glyphicon-trash"></a>
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
        </div>
        
	</div>
</section>


<!-- Modal --> 

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<div class="modal-content"> 
    
     <form class="form-horizontal" name="frm_rmtype" enctype="multipart/form-data" id="frm_rmtype" method="post" onsubmit="return validateForm()"> 
     <input type="hidden" name="pid" />
  	<input type="hidden" name="command" />   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span style="color:red;"  aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Add Room Type</h3>
      </div>
      
      
      <div class="modal-body">
          <div class="form-group">
            <label for="LBL" class="col-sm-3 control-label"> </label>
            <div class="col-sm-9" id="msg">
            
            </div>
          </div>
          
          <div class="form-group">
            <label for="rmtype" class="col-sm-3 control-label">Room Type: </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="rmtype" id="rmtype" placeholder="Eg: Deluxe Apartment">
            </div>
          </div>
          
           <div class="form-group">
            <label for="amenities" class="col-sm-3 control-label">Description: </label>
            <div class="col-sm-6">
             <textarea class="form-control" rows="3" name="descr"></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label for="m_adult" class="col-sm-3 control-label">Max Adult: </label>
            <div class="col-sm-2">
              <input type="number" min="1" max="10" class="form-control" id="m_adult" name="m_adult" >
            </div>
          </div>
          
          <div class="form-group">
            <label for="m_child" class="col-sm-3 control-label">Max Child: </label>
            <div class="col-sm-2">
              <input type="number" min="0" max="10"  class="form-control" id="m_child" name="m_child" >
            </div>
          </div>          
                             
          <div class="form-group">
            <label for="rack_rate" class="col-sm-3 control-label">Rack Rate: </label>
            <div class="col-sm-3">
            <div class="input-group">
      			<div class="input-group-addon">N</div>
              	<input type="number" class="form-control" id="rack_rate" name="rack_rate" >
            	</div>
          	</div>
          </div> 
          
          <div class="form-group">
            <label for="promo_rate" class="col-sm-3 control-label">Promo Rate: </label>
            <div class="col-sm-3">
            <div class="input-group">
      			<div class="input-group-addon">N</div>
              <input type="number" class="form-control" value="0" id="promo_rate" name="promo_rate" >
            </div>
          </div>
         </div> 
          
          
          <div class="form-group">
            <label for="skey" class="col-sm-3 control-label">Sort Key: </label>
            <div class="col-sm-2">
              <input type="number" min="0" max="25"  class="form-control" id="skey" name="skey" >
            </div>
          </div> 
          
          
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" name="add_rmtype" class="btn btn-success" value="Save Record">
      </div>      
    </form>
      
    </div>
  </div>
</div>


<script type="text/javascript">
// Validate compose form on submit -----------------------------------------
	function validateForm() {
		var rmtype = document.forms["frm_rmtype"]["rmtype"].value;
		var descr = document.forms["frm_rmtype"]["descr"].value;
		var m_adult = document.forms["frm_rmtype"]["m_adult"].value;
		var m_child = document.forms["frm_rmtype"]["m_child"].value;		
		var rack_rate = document.forms["frm_rmtype"]["rack_rate"].value;
		
		if (rmtype == null || rmtype == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>You need to enter room type name to proceed</div>";			
			return false;
		}else if (descr == null || descr == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please enter description for the room type</div>";			
			return false;		
		}else if (m_adult == null || m_adult == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please enter maximum adult for this room type</div>";			
			return false;
		}else if (m_child == null || m_child == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please enter maximum child for this room type</div>";			
			return false;
		}else if (rack_rate == null || rack_rate == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Enter room type rack rate</div>";			
			return false;
		}
	}

</script>
