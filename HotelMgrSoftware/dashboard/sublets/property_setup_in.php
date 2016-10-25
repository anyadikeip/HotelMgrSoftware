<?php 
# Pagination Parameters-------------------------------------------------- 
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 30; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page; 
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Property Setup
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Property Setup</li>
  </ol>
</section>

<section class="content-header">
<?php	
if(isset($_POST["save_details"])){
	try {
		# Collects variables for input ==================================================================
		$property_nm = $_POST['property_nm']; $pn = $_POST['pn']; $fax = $_POST['fax'];
		$rev_pn = $_POST['rev_pn']; $em = $_POST['em']; $property_type = $_POST['property_type']; 
		$website = $_POST['website']; $property_grade = $_POST['property_grade'];  
		$fb_link = $_POST['fb_link']; $yt_link = $_POST['yt_link'];
		$address1 = $_POST['address1']; $address2 = $_POST['address2'];	$city = $_POST['city']; 
		$state = $_POST['state']; $zipcode = $_POST['zipcode']; $country = $_POST['country'];
		$book_condition = $_POST['book_condition']; $checkin_policy = $_POST['checkin_policy'];
		$can_policy = $_POST['can_policy']; $hotel_policy = $_POST['hotel_policy'];
		$hotel_desc = $_POST['hotel_desc']; $parking_policy = $_POST['parking_policy'];
		$confirm_msg = $_POST['confirm_msg'];						
		
		# Validate input Variables =====================================================================
		if(empty($property_nm)){echo alert("info", "Please you need to enter property name.");}
		elseif(empty($em)){echo alert("info", "Please you need to enter email address.");}
		elseif(empty($em)){echo alert("info", "Please you need to enter address1.");}
		elseif(empty($country)){echo alert("info", "Please you need to select your country.");
		
		}else{
			# Update property details with new data ====================================================											
			mysql_query("UPDATE property_setup SET property_nm='$property_nm', pn='$pn', fax='$fax', 
			rev_pn='$rev_pn', em='$em', property_type='$property_type', website='$website', 
			property_grade='$property_grade', fb_link='$fb_link', yt_link='$yt_link', 
			address1='$address1', address2='$address2', city='$city', state='$state', 
			zipcode='$zipcode', country='$country', book_condition='$book_condition', 
			checkin_policy='$checkin_policy', can_policy='$can_policy', hotel_policy='$hotel_policy', 
			hotel_desc='$hotel_desc', parking_policy='$parking_policy', confirm_msg='$confirm_msg' 
			WHERE rec_type='setup'") or die(mysql_error()); 
			echo alert("success", "Property details was successfully edited.");
			//echo '<meta http-equiv="refresh" content="0; property_setup.php">';				
		}
	}
	catch(PDOException $e)
	{
	echo $e->getMessage();
	}
}
		
	
	
?>
</section>


<?php
# check if the setup record exist in the database, otherwise insert it.
try { 
	$query=mysql_query("SELECT * FROM property_setup WHERE rec_type='setup'") or die(mysql_error());
	if(mysql_num_rows($query) == 0){
		mysql_query("INSERT INTO property_setup SET rec_type='setup'") or die(mysql_error());		
	}else{
		while($row=mysql_fetch_array($query)){
			# Session input variables ==========================================================================
			$_SESSION['property_nm'] = $row['property_nm']; $_SESSION['pn'] = $row['pn'];
			$_SESSION['fax'] = $row['fax']; $_SESSION['rev_pn'] = $row['rev_pn']; $_SESSION['em'] = $row['em'];
			$_SESSION['property_type'] = $row['property_type']; $_SESSION['website'] = $row['website']; 
			$_SESSION['property_grade'] = $row['property_grade'];  $_SESSION['fb_link'] = $row['fb_link']; 
			$_SESSION['yt_link'] = $row['yt_link'];	$_SESSION['address1'] = $row['address1']; 
			$_SESSION['address2'] = $row['address2']; $_SESSION['city'] = $row['city']; 
			$_SESSION['state'] = $row['state']; $_SESSION['zipcode'] = $row['zipcode']; 
			$_SESSION['country'] = $row['country']; $_SESSION['book_condition'] = $row['book_condition']; 
			$_SESSION['checkin_policy'] = $row['checkin_policy']; $_SESSION['can_policy'] = $row['can_policy']; 
			$_SESSION['hotel_policy'] = $row['hotel_policy']; $_SESSION['hotel_desc'] = $row['hotel_desc']; 
			$_SESSION['parking_policy'] = $row['parking_policy']; $_SESSION['confirm_msg'] = $row['confirm_msg'];
		}		
	}	
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>




<?php if($_POST['add_img']){$gallery='active'; $general='';}else{$general='active'; $gallery='';} ?>

<?php 
 # --------------------------------------------------------
 # DELETE IMAGE FROM DATABASE/FOLDER
 # --------------------------------------------------------	 
 if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
	deleteimg('gallery', $_REQUEST['pid'], 'media/gallery_thumb/', 'media/gallery/', 'thmub_nm');
	$gallery='active'; $general='';
 }					
?>

<section class="content">       
  <!-- Main row -->
  <div class="row">        
        <section class="col-lg-12 connectedSortable1">
          <!-- Custom tabs (Charts with tabs)-->
          	<form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="nav-tabs-custom">
            
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs"><!-- pull-right -->
              <li class="<?php echo $general; ?>"><a href="#details" data-toggle="tab">Property Details</a></li>
              <li class=""><a href="#address" data-toggle="tab">Address</a></li>
              <li><a href="#description" data-toggle="tab">Description</a></li>
              <li><a href="#confirm-msg" data-toggle="tab">Booking Email on Reservation</a></li>
              <li class="<?php echo $gallery; ?>"><a href="#images" data-toggle="tab">Gallery</a></li>
              
              <li class=" pull-right header"> <button class="btn btn-danger" name="save_details" value="">Edit Record</button></li> 
            </ul>
            
            <div class="tab-content no-padding">
              <div class="chart tab-pane <?php echo $general; ?>" id="details">             
                
                
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Property Name:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="property_nm"  id="" value="<?php echo $_SESSION['property_nm']; ?>">
                      </div><span class="text-danger">*</span>
                    </div>
                    
                   <div class="form-group">
                      <label class="col-sm-2 control-label">Phone:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="pn"  id="" value="<?php echo $_SESSION['pn']; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Fax:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="fax"  id="" value="<?php echo $_SESSION['fax']; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Reservation Phone:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="rev_pn" value="<?php echo $_SESSION['rev_pn']; ?>"  id="" placeholder="eg: +2348064342060">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Email:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="em"  id="" value="<?php echo $_SESSION['em']; ?>" placeholder="eg: myname@mysite.com">
                      </div><span class="text-danger">*</span>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Property Type:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="property_type"  id="" value="<?php echo $_SESSION['property_type']; ?>" placeholder="eg: Hotel, Resort">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Website:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="website"  id="" value="<?php echo $_SESSION['website']; ?>" placeholder="eg: http://mysite.com">
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Grade:</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="property_grade">
                          <option><?php echo $_SESSION['property_grade']; ?></option>
                          <option>Not Rated</option>
                          <option>1 star</option>
                          <option>2 stars</option>
                          <option>3 stars</option>
                          <option>4 stars</option>
                          <option>5 stars</option>
                        </select>
                      </div>
                    </div>
                    
                    
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Facebook Page:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="fb_link" value="<?php echo $_SESSION['fb_link']; ?>"  id="" placeholder="eg: https://facebook.com/propertyname">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Youtube Video:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="yt_link" value="<?php echo $_SESSION['yt_link']; ?>"  id="" placeholder="eg: https://youtube.com/oNTr7JH8hY">
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->                 
                
              </div>
              
              
              <!--Address Tab -->
              <div class="chart tab-pane" id="address">                
                <div class="box-body">
                
                    <div class="col-lg-7">
                    	<div class="form-group">
                          <label class="col-sm-2 control-label">Address1:</label> 
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="address1"  id="" value="<?php echo $_SESSION['address1']; ?>">
                          </div><span class="text-danger">*</span>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Address2:</label> 
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="address2"  id="" value="<?php echo $_SESSION['address2']; ?>">
                          </div>
                       </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">City:</label> 
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="city"  id="" value="<?php echo $_SESSION['city']; ?>">
                          </div>
                       </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">State:</label> 
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="state"  id="" value="<?php echo $_SESSION['state']; ?>">
                          </div>
                       </div>
                       
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Zipcode:</label> 
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="zipcode"  id="" value="<?php echo $_SESSION['zipcode']; ?>">
                          </div>
                       </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Country:</label> 
                          <div class="col-sm-9">
                            <select class="form-control" name="country">
                              <option><?php echo $_SESSION['country']; ?></option>
                              <option>Nigeria</option>
                              <option>Ghana</option>
                            </select>
                        </div><span class="text-danger">*</span>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label"> </label> 
                          <div class="col-sm-9">
                            <button type="submit" class="btn btn-default">Set map according to address</button>
                        </div>
                      </div>
                      
                    </div>
                    
                    <div class="col-lg-5">
                    Place Map Here
                    </div>
                
               </div><!-- box-body -->
              </div><!-- /Address Tab -->
              
              
              <!--Description Tab -->
              <div class="chart tab-pane" id="description">
              	<div class="box-body">
                
                    <div class="col-lg-6">
                        Booking Conditions:
                        <textarea name="book_condition" class="form-control ckeditor" rows="3" tabindex="1"><?php echo $_SESSION['book_condition']; ?></textarea>                         
                         <br />
                        Check-In Policy:
                        <textarea name="checkin_policy" class="form-control ckeditor" rows="3" tabindex="2"><?php echo $_SESSION['checkin_policy']; ?></textarea> 
                         <br />
                        Cancellation Policy:
                        <textarea name="can_policy" class="form-control ckeditor" rows="3" tabindex="3"><?php echo $_SESSION['can_policy']; ?></textarea>                                               
                    </div>

                    
                        
                    <div class="col-lg-6">
                    Hotel Policy:
                    <textarea name="hotel_policy" class="form-control ckeditor" rows="3" tabindex="4"><?php echo $_SESSION['hotel_policy']; ?></textarea>                         
                     <br />
                    Hotel Description:
                    <textarea name="hotel_desc" class="form-control ckeditor" rows="3" tabindex="5"><?php echo $_SESSION['hotel_desc']; ?></textarea>
                    <br />
                    Parking Details/Policy:
                    <textarea name="parking_policy" class="form-control ckeditor" rows="3" tabindex="5"><?php echo $_SESSION['parking_policy']; ?></textarea>                    
                    </div>
                    
                    <div class="form-group">
                      <!--<label class="col-sm-2 control-label"> </label> --> 
                      <div class="col-sm-9">
                        <!--<input type="text" class="form-control" name="city"  id="" placeholder=""> -->
                      </div>
                   </div>   
                    
              	</div>
              </div>
              
              <!-- Confirmation Msg Tab -->
              <div class="chart tab-pane" id="confirm-msg">
              	<div class="box-body">
                	<textarea name="confirm_msg" class="form-control ckeditor" rows="44" tabindex="7" ><?php echo $_SESSION['confirm_msg']; ?></textarea>
                </div>
              </div>
              
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        		
</form>
              
              <!-- Images Tab -->
              <div class="chart tab-pane <?php echo $gallery; ?>" id="images">
              	<div class="box-body">
                      <div class="col-sm-6">                        	
                           <div id="msg"> </div>
                           
                    	<form class="form-inline" method="post" enctype="multipart/form-data">
                        
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Browse Image:</label>
                            <div class="input-group">
                              <div class="input-group-addon">Browse Image: </div>
                              <input type="file" name="imgry" class="form-control" id="exampleInputAmount" placeholder="Amount">
                            </div>                   
                            <input type="submit" name="add_img" class="btn btn-primary" value="Upload Image">
                          </div>                  
                       
                      </div> 
                      
                       <div class="col-sm-6"> 
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="logo" value="1"> Use as Property Logo
                            </label>
                          </div>                       
                        </div>
                      
                     </form>  
                      
                      <br /><br /><hr />
                      
                     
                      
                      
                      <?php 
					  if(isset($_POST['add_img'])){
						# Collect variable for image upload -----------------------------------				
						$randname=mysql_escape_string(date("dmY").time().mt_rand(0,25));
											
						define("_IMAGE_PATH","media/gallery/");
						define("_IMAGE_PATH2","media/gallery_thumb/");
						// max dimensions allowed:
						define("_IMAGE_WIDTH","840");
						define("_IMAGE_HEIGHT","680");
						define("_IMAGE_THUMB_WIDTH","100");
						define("_IMAGE_THUMB_HEIGHT","90");
						
						// grab the path to the temporary file (image) that the user uploaded
						$photo = $_FILES['imgry']['tmp_name']; $ipax = $_POST['ipax'];
											
						// check if it exists
						if(is_uploaded_file($photo)){
							//the real image file name
							$real_name = strtolower($_FILES['imgry']['name']);
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
						$logo = $_POST['logo'];
						mysql_query("INSERT gallery SET img_nm='$img_nm', 
						thmub_nm='$thmub_nm', logo='$logo'") or die(mysql_error());
						//echo alert("success","Image upload was successful.");
						}
					}
					?> 
                      
                    
                    
                    <form method="post" name="formimg" id="formimg">
                        <input type="hidden" name="pid" />
                        <input type="hidden" name="command" /> 
                    <?php
                    $statement = "gallery ORDER BY id DESC"; 
                    $query=mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint},{$per_page}") or 
                    die(mysql_error()); $folder_path = 'media/gallery_thumb/';
                    while($row = mysql_fetch_array($query)){?>               
                    <div class="col-md-2 media">
                        
                        
                        <img src="<?php echo $folder_path.$row['thmub_nm']; ?>" class="img-responsive img-thumbnail">
                        <a href="javascript:delimg(<?php echo $row['id'] ?>)" class="close"><span>&times;</span></a>
                   </form>
                        
                        
                    </div>
                    <?php } ?>
                                              
              	</div> 
            </div><!-- /.nav-tabs-custom -->
        	
            
        </section>
  </div><!-- /.row (main row) -->          
</section><!-- /.content -->           

<script>
function fileread(file){
var fsize = file.files[0].size;
var fname = file.files[0].name;
var ftype = file.files[0].type;
var fielArray = ["image/png", "image/jpeg", "image/gif", "image/jpg"];
var fileTrue = fielArray.indexOf(ftype);
 
if(fileTrue>=0){
 var reader = new FileReader();
 reader.element = $(file).parent().find('thumb');
 reader.onload = function(e) {
 var div = document.getElementById("thumb");
 div.innerHTML = "<img class='thumb' src='" + e.target.result + "'" +
 "title='" + fname + "'/>";

var formData = new FormData();
 for (var i = 0; i < file.files.length; i++) {
 var fileup = file.files[i];
 // Check the file type.
 if (!fileup.type.match('image.*')) {
 continue;
 }
 // Add the file to the request.
 formData.append('filename[]', fileup, fileup.name);

}
 uploadajax(formData)
 };
 reader.onerror = function(e) {
 alert("error: " + e.target.error.code);
 };
 reader.readAsDataURL(file.files[0]);
 }else{
 document.getElementById("error").innerHTML = "Incorrect file format, Please select an image file format..";
}
 }


 function uploadajax(formData){
 var xhr = new XMLHttpRequest();
xhr.open('POST', 'upload.php', true);
xhr.onload = function () {
 if (xhr.status === 200) {
 //<span id="IL_AD3" class="IL_AD">console</span>.log(xhr.responseText);
 } else {
 alert('An error occurred!');
 }
};

xhr.upload.addEventListener("progress", imageprogress, false);
xhr.addEventListener("load", Completed, false);
xhr.addEventListener("error", failstatus, false);
 xhr.addEventListener("abort", Abortedstatus, false);
xhr.send(formData);

}

 function imageprogress(event){
 document.getElementById('complete').style.display = 'none';
document.getElementById('progress_status').style.display = 'block';
 //document.getElementById("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
 var percent = (event.loaded / event.total) * 100;
 document.getElementById("status").value = <span id="IL_AD5" class="IL_AD">Math</span>.round(percent);
 $("#progressbar").progressbar({value: document.getElementById("status").value});
 document.getElementById("status").innerHTML = Math.round(percent)+"%";
}
</script>


<script>
function delimg(pid){
	if(confirm('Do you really mean to delete this image')){
		document.formimg.pid.value=pid;
		document.formimg.command.value='delete';
		document.formimg.submit();
	}
}
</script>