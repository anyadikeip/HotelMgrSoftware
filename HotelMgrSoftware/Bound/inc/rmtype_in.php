<?php 
if(isset($_POST['rvRM'])){
$_SESSION['sel_rm'] = $_POST['sel_rm'];
header("Location: reservation"); 
exit;
}
?>

<?php
$handler=$_GET['_handler']; 
$qry_rm=mysql_query("SELECT * FROM room_type 
WHERE id='$handler'") or die(mysql_error());
while($rmrow=mysql_fetch_array($qry_rm)){
?> 

<div class="container clearfix">

    <div class="sixteen columns">
        <h1 class="page-title">
        <?php echo $rmrow['type_nm'];  ?> &nbsp;    
        <div class="highlight-color right">&nbsp;#<?php echo number_format($rmrow['rack_rate']); ?>&nbsp;</div>  
        <?php if($promo_rate==1){?>
        	<div class="label label-warning">&nbsp; $<?php echo number_format($rmrow['promo_rate']); ?>&nbsp;</div>
		<?php } ?>
        </h1>
        
    </div>
    
    
    <!-- Page Title --	>
    <!-- Start Project Slider -->
    <div class="nine columns top bottom">
        <div class="slider-project">
            <div class="flex-container">
                <div class="flexslider2">
                    <ul class="slides">
                    	<?php 
						$typeimg=mysql_query("SELECT * FROM rmtype_imgs WHERE 
						rmtype_id='$handler' AND status=0") or die(mysql_error());
						while($irow=mysql_fetch_array($typeimg)){
						?> 
                        <li>
                            <div class="caption">
                                <img src="<?php echo $back_dir; ?>dashboard/media/rm_img/<?php echo $irow['img_nm']; ?>" alt="">
                            </div>
                            <!-- hover effect -->
                        </li>
                      <?php } ?>  
                    </ul>
                </div>
            </div>
        </div>
        <!-- End slider-project -->
    </div>
    <!-- End -->
    
    
    <!-- Start Project Details -->
    <div class="seven columns  bottom">
        <!--<h2 class="title top-5  bottom-2">
            Project Details</h2> -->
        <div class="about-project bottom">       
          <p><?php echo $rmrow['descr'];  ?></p>
        </div>        
        
        <h2 class="title bottom-2">
            Room Amenities
            
            <div class="btn-group right">
            <form method="post" action="">
            	<input type="hidden" name="sel_rm" value="<?php echo $handler; ?>" />
            	<input type="submit" name="rvRM" class="btn btn-danger" value="Reserve" />                
            </form>
            </div> 
                   
        </h2>        
        
        
        <ul class="check-list button-2"> 
         	<?php 
			$ame_array = explode( ',', $rmrow['amenities']); 
			foreach($ame_array as $value){			
			?>
                <li class="label">             
					<?php
                    $qy=mysql_query("SELECT * FROM amenities WHERE 
                    status=0") or die(mysql_error());
                    while($ame=mysql_fetch_array($qy)){                
                        if($ame['id']== $value){echo $ame['name'].'&nbsp;';}
                    }
                    ?>
            	</li> 
            <?php } ?>
        </ul> 
        <!-- End square-list -->
        <br />
        <!--<a href="#" class="button medium color">#<?php echo number_format($rmrow['rack_rate']); ?></a> -->
    </div>
    <!-- End Project Details -->
    <div class="clearfix"></div>
    
       
    
   
</div>
<!-- <<< End Container >>> -->
<?php } ?>