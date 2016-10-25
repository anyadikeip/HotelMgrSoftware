<script>
function del(pid){
	if(confirm('Do you really mean to delete this item')){
		document.formimg.pid.value=pid;
		document.formimg.command.value='delete';
		document.formimg.submit();
	}
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
    Property Services
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Services  </li>
  </ol>
  
</section>




<section class="content">
	<div class="box box-default">
    
        <div class="box-header with-border">
          <i class="fa fa-th-list"></i>
          <h3 class="box-title">Service List &nbsp; &nbsp;  &nbsp; &nbsp; <small class="text-danger">Image Dimension: (800 x 425)px</small></h3> 
          <a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm pull-right" ><strong>Add New</strong></a>        
        </div><!-- /.box-header -->
        
       
        <div class="box-body">
            <div class="col-md-12">
            
            <?php 
			if(isset($_POST['save_service'])){
				# Collect variable for image upload -----------------------------------				
				$randname=mysql_escape_string(date("Ymd").time().mt_rand(0,25));
				$stitle = ucfirst(trim($_POST['stitle'])); $sdescr = mysql_escape_string($_POST['sdescr']);
				$qry=mysql_query("SELECT * FROM services WHERE title='$stitle'") or die(mysql_error());				
				$photo = $_FILES['simg']['tmp_name'];
				
				if(mysql_num_rows($qry) == 1){echo alert('danger', 'Sorry: services already exist.');}					
				else{
				
				define("_IMAGE_PATH","media/services/");
				// max dimensions allowed:
				define("_IMAGE_WIDTH","800");
				define("_IMAGE_HEIGHT","425");
				
				// check if it exists
				if(is_uploaded_file($photo)){
					//the real image file name
					$real_name = strtolower($_FILES['simg']['name']);
					// image type based on image file name extension:
					if(strstr($real_name,".png")){
						$image_type = "png";
					}else if(strstr($real_name,".jpg")){
						$image_type = "jpg";
					}else if(strstr($real_name,".gif")){
						$image_type = "gif";
					}else{
						die("Unsupported image type");
						
					}
					
					// find the next image name we are going to save
					$x=1;
					while(true){
						$image_name = _IMAGE_PATH."${randname}.jpg";
						if(!is_file($image_name))break;
						$x++;
					}
					
					// start processing the main bigger image:
					$max_width = _IMAGE_WIDTH; $max_height = _IMAGE_HEIGHT;
					$size = getimagesize($photo);
					$width = $size[0];
					$height = $size[1];
					$x_ratio = $max_width / $width;
					$y_ratio = $max_height / $height;
					if(($width <= $max_width)&&($height <= $max_height)){
						$tn_width = $width;
						$tn_height = $height;
					}else{
						if(($x_ratio * $height) < $max_height){
							$tn_height = ceil($x_ratio * $height);
							$tn_width = $max_width;
						}else{
							$tn_width = ceil($y_ratio * $width);
							$tn_height = $max_height;
						}
					}
					
					switch($image_type){
						case "png": $src=imagecreatefrompng($photo); break;
						case "jpg": $src=imagecreatefromjpeg($photo); break;
						case "gif": $src=imagecreatefromgif($photo); break;
					}						
					
					// destination resized image:
					$dst = imagecreatetruecolor($tn_width, $tn_height);
					// resize original image onto $dst
					imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
					// write the final jpeg image..
					imagejpeg($dst, $image_name, 100) or die("Error: your photo 
					has not been saved. Please contact the administrator");
					// time to clean up
					imagedestroy($src);
					imagedestroy($dst);
					
				# Save service/image to database ----------------------------					   
				$img_nm = $randname.".jpg";  
				mysql_query("INSERT services SET title='$stitle', 
				descr='$sdescr',img_nm='$img_nm'") or die(mysql_error());
				echo alert("success","Service created successful.");
				}
					}
			}
			?>
            
            <?php 
			# ----------------------------------------------------------------------------------------------------
			 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
				$folder='media/services/';
				deleteimg('services', $_REQUEST['pid'], $folder, $folder1, 'img_nm');
			 }
			 # ----------------------------------------------------------------------------------------------------
			 if($_REQUEST['command']=='toggle' && $_REQUEST['pid']>0){
				toggle_access('services', $_REQUEST['pid'], 'status');
			 }
			
			?>
              
              </hr>
              <form method="post" name="formimg" id="formimg">
                <input type="hidden" name="pid" />
                <input type="hidden" name="command" /> 
              <table class="table  table-hover">         
              <thead>
                <tr>
                  <th>SN</th>
                  <th>SERVICES TITLE</th>
                  <th>STATUS</th>
                  <th style="text-align:right;">FUNCTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               $query=mysql_query("SELECT * FROM services ORDER BY id DESC") or 
               die('Unable to list services ' . mysql_error());  $j=0;	  
              while($row=mysql_fetch_array($query, MYSQL_ASSOC)){  $j++;		  
              ?>
                <tr>
                  <td>&nbsp;<?php echo $j; ?></td>
                  <td><a title="<?php echo $row['descr']; ?>" data-toggle="tooltip" data-placement="top"><?php echo $row['title']; ?></a></td>
                  <td><?php if($row['status']==1){echo '<span class="label label-danger">Hidden</span>';}
                  else{ echo '<span class="label label-success">Visible</span>';} ?></td>
                  <td style="text-align:right;">
                  <div class="btn-group">
                  <a href="javascript:tog(<?php echo $row['id'] ?>)" 
                  class="btn btn-xs btn-info glyphicon glyphicon-off" title="Enable/Disable"></a>
                  <a href="javascript:del(<?php echo $row['id'] ?>)" 
                  class="btn btn-xs btn-danger glyphicon glyphicon-trash" title="Delete Service"></a>
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







<form class="form-horizontal" name="services" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD SERVICES</h4>
      </div>
      <div class="modal-body">
      
          	<div class="form-group">
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <div style="color:red;" id="msging"></div>
                </div>
              </div>
      
             
          <div class="form-group">
            <label for="stitle" class="col-sm-3 control-label">Services Title:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="stitle" placeholder="Enter title" >
            </div>
          </div>
          
          <div class="form-group">
            <label for="sdescr" class="col-sm-3 control-label">Description:</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="3" name="sdescr"></textarea>
            </div>
          </div>
         
          <div class="form-group">
            <label for="simg" class="col-sm-3 control-label">Services Image:</label>
            <div class="col-sm-6">
              <input type="file" name="simg" class="form-control" >
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
      	<input type="submit" name="save_service" class="btn btn-success" value="Save changes" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
</form>


<script type="text/javascript">
// Validate compose form on submit -----------------------------------------
function validateForm() {
	var stitle = document.forms["services"]["stitle"].value;
	var sdescr = document.forms["services"]["sdescr"].value;
	var simg = document.forms["services"]["simg"].value;
	
	if (stitle == null || stitle == "") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please enter service title</div>";			
		return false;
	}else if (sdescr == null || sdescr == "") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please enter service description</div>";			
		return false;		
	}else if (simg == null || simg == "") {
		document.getElementById("msging").innerHTML = "<div style='color:red;'>Please browse service image</div>";			
		return false;
	}
}
</script>