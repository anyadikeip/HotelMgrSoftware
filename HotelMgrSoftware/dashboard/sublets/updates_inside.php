<?php 
# Pagination Parameters-------------------------------------------------- 
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 30; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page; 
?>

<?php 
$rtA = get_value_using_id('room_type', $_REQUEST['_forame'], 'type_nm') .' Amenities';
$rtI = get_value_using_id('room_type', $_REQUEST['_forimg'], 'type_nm') .' Images';
?>

<section class="content-header">
  <h1>
    <?php 
	if(isset($_REQUEST['_forame'])){echo ucwords($rtA);}
	elseif(isset($_REQUEST['_forimg'])){echo ucwords($rtI);}
	?> 
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Updates </li>
  </ol>  
</section>



<section class="content">
	<div class="box box-default">
    
    
    <div class="box-header with-border">
      <i class="fa fa-pencil"></i>
      <h3 class="box-title">Update Features </h3>
      <a href="rmtype" class="btn btn-danger btn-sm pull-right" ><strong> Close </strong></a>        
    </div><!-- /.box-header -->
    
    
    
    <?php	 
   # ----------------------------------------------------------------------------------------------------
   # DISPLAY AMENITIES FORM FOR UPDATE
   # ----------------------------------------------------------------------------------------------------
   if(isset($_REQUEST['_forame'])){
   ?>
    <section class="content">           
       <div class="col-md-12">
       	<?php 
		if(isset($_POST['update_ame'])){
			 $amenities=$_POST['amenities']; $hid=$_POST['hid']; 
			 @$selected= implode(", ", $amenities);
			
			 mysql_query("UPDATE room_type SET amenities='$selected' WHERE id='$hid'") or die(mysql_error()); 
			 $rtype = get_value_using_id('room_type', $hid, 'type_nm');
			 echo alert('success', 'Selected amenities has been added as <strong>'.$rtype.'</strong> amenities');
		}	
		?>
       
    	<div class="form-group">
        <form method="post" class="form-inline">
            <input type="hidden" name="hid" value="<?php echo $_GET['_forame']; ?>" > 
                               
            <?php 
            $qry=mysql_query("SELECT * FROM amenities WHERE type=0 OR type=2 AND status=0 ORDER BY name ASC") or die(mysql_error());
			$sel_rm_ame = get_value_using_id('room_type', $_GET['_forame'], 'amenities');			
			while($row=mysql_fetch_array($qry)){						
            ?>
            
            <div class="checkbox col-md-2">            
            <input type="checkbox" name="amenities[]"
            <?php    
            	$ame_array = explode( ',', $sel_rm_ame); 
				foreach($ame_array as $value){					
					if($row['id']==$value){echo 'checked';}
				}
			?> 				
             value="<?php echo $row['id']; ?>" /> <?php echo $row['name']; ?>
            </div>
            <?php }?>
            
            <br />
            </div><hr />
            
          <button type="submit" class="btn btn-success btn-sm pull-right" name="update_ame">
           <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> &nbsp; Update
          </button>
          <br /> <br />
        </form>       
       </div>
    </section>
   <?php } ?>  
    
    
    
    
    
	<?php
    # ----------------------------------------------------------------------------------------------------
    # DISPLAY PICTURES FORM FOR UPDATE
    # ----------------------------------------------------------------------------------------------------
    if(isset($_REQUEST['_forimg'])){
    ?> 
    
   <section class="content">           
     <div class="col-md-12">    
   <?php 
   # -------------------------------------------------------
   # Upload Raw/Resized Image verot.net/php_class_upload.htm
   # dtbaker.net/web-development/php-simple-image-resize-thumbnail-generator/
   # --------------------------------------------------	----		     
	if(isset($_POST['upload']) ){
		# Collect variable for image upload -----------------------------------				
		$randname=mysql_escape_string(date("Ymd").time().mt_rand(0,25));
							
		define("_IMAGE_PATH","media/rm_img/");
		define("_IMAGE_PATH2","media/rm_img_thumb/");
		// max dimensions allowed:
		define("_IMAGE_WIDTH","840");
		define("_IMAGE_HEIGHT","680");
		define("_IMAGE_THUMB_WIDTH","100");
		define("_IMAGE_THUMB_HEIGHT","90");
		
		// grab the path to the temporary file (image) that the user uploaded
		$photo = $_FILES['picture']['tmp_name']; $ipax = $_POST['ipax'];
							
		// check if it exists
		if(is_uploaded_file($photo)){
			//the real image file name
			$real_name = strtolower($_FILES['picture']['name']);
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
									
			// and now we do it alll again for the thumbnail:
			$max_width = _IMAGE_THUMB_WIDTH; $max_height = _IMAGE_THUMB_HEIGHT;
			$size = GetImageSize($photo);
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
			
			$dst = imagecreatetruecolor($tn_width, $tn_height);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
			//$thumbfile = $image_name . ".thumb.jpg";
			$thumbfile = _IMAGE_PATH2.$randname.".jpg";
			if(file_exists($thumbfile))unlink($thumbfile);
			imagejpeg($dst, $thumbfile, 100) or die("Error: your photo thumb has not been saved. 
			   Please contact the administrator");
			imagedestroy($src);
			imagedestroy($dst);
			
		# Save picture name to database ----------------------------					   
		$img_nm = $randname.".jpg"; $thmub_nm = $randname.".jpg"; 
		mysql_query("INSERT rmtype_imgs SET rmtype_id='$ipax', 
		img_nm='$img_nm',thmub_nm='$thmub_nm'") or die(mysql_error());
		echo alert("success","Picture upload was successful.");
		}
	}
	?> 
    
    
    <?php 
	 # --------------------------------------------------------
	 # DELETE IMAGE FROM DATABASE/FOLDER
	 # --------------------------------------------------------	 
	 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		deleteimg('rmtype_imgs', $_REQUEST['pid'], 'media/rm_img_thumb/', 'media/rm_img/', 'thmub_nm');
	 }
	
	?>
       
    <form class="form-inline" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ipax" value="<?php echo $_REQUEST['_forimg']; ?>" />
      <div class="form-group">
        <label class="sr-only" for="picture">Picture</label>
        <input type="file" class="form-control" id="picture" name="picture"> 
      </div>                  
      
      <button type="submit" name="upload" class="btn btn-primary"> Upload </button>
    </form>
    
    <hr /> 
    <form method="post" name="formimg" id="formimg">
        <input type="hidden" name="pid" />
  		<input type="hidden" name="command" /> 
	<?php
	$statement = "rmtype_imgs WHERE rmtype_id = {$_REQUEST['_forimg']} ORDER BY id DESC"; 
	$query=mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint},{$per_page}") or 
	die(mysql_error()); $folder_path = 'media/rm_img_thumb/';
	while($row = mysql_fetch_array($query)){?>               
	<div class="col-md-2 media">
		
        
        <img src="<?php echo $folder_path.$row['thmub_nm']; ?>" class="img-responsive img-thumbnail">
		<a href="javascript:delimg(<?php echo $row['id'] ?>)" class="close"><span>&times;</span></a>
   </form>
        
        
	</div>
	<?php } ?>
	</div>
</section>    
    
<section class="content">           
     <div class="col-md-12">     
  <?php } ?>  
	</div>
</section>

	        
               
                
			

    </div>        
</div>

<script>
function delimg(pid){
	if(confirm('Do you really mean to delete this item')){
		document.formimg.pid.value=pid;
		document.formimg.command.value='delete';
		document.formimg.submit();
	}
}
</script>
 



