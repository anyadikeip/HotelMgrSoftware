</p>
<?php
if(isset($_FILES['filename']))
{
 $Dest = dirname('upload/');
 if(!isset($_FILES['filename']) || !is_uploaded_file($_FILES['filename']['tmp_name'][0]))
 {
 die('Something went wrong with Upload!');
 }
 $RandomNum = rand(0, 9999999999);

 $ImageName = str_replace(' ','-',strtolower($_FILES['filename']['name'][0]));
 $ImageType = $_FILES['filename']['type'][0]; //"image/png", image/jpeg etc.

 $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
 $ImageExt = str_replace('.','',$ImageExt);

 $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

 //Create <span id="IL_AD8" class="IL_AD">new image</span> name (with random number added).
 $NewName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

 move_uploaded_file($_FILES['filename']['tmp_name'][0], "$Dest/$NewName");

 $base_path="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
 $base=$base_path.'/'.'upload/'.$NewName;
 //echo '<img src="'.$base.'">';
 echo "<div id='sucess' class='sucess' > Successfully uploaded.</div>";
 }
?>
<p style="text-align: justify;">