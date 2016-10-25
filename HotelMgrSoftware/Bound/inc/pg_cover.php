<div id="slider">
<div class="container clearfix">
    <!--<div class="sixteen columns"> -->
                <div class="row-fluid">
                
                  <div class="span9">
					<?php # pg_cover = 1
                    $qry_slides=mysql_query("SELECT * FROM slides WHERE status=0 LIMIT 1") or die(mysql_error());
                    while($slides=mysql_fetch_array($qry_slides)){	
                    ?>
                        <a href="">
                            <img src="<?php echo $back_dir; ?>dashboard/media/slides/<?php 
							echo $slides['img_nm']; ?>" class="img-polaroid1 img-responsive" alt="Page Cover"></a>
                        
                     <?php } ?> 
                  </div>
                  
                   <div class="span3">
                  	<?php
					$logo=mysql_query("SELECT * FROM gallery 
					WHERE logo=1 LIMIT 1") or die(mysql_error());
					while($row=mysql_fetch_array($logo)){	
					?>    
					<div class="logo"> <a href=".">
					<img src="<?php echo $back_dir; ?>dashboard/media/gallery/<?php 
					echo $row['img_nm']; ?>" class="img-polaroid1" alt="Logo" /></a> </div>
					<?php } ?>
                  </div> 
                  
                </div>
        
    <!--</div> -->
</div>
<!-- End Container -->
</div>
<!-- End Slider -->