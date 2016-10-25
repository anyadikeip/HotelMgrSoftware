<div id="slider">
<div class="container clearfix">
    <div class="sixteen columns">
        <div class="flex-container">
            <div class="flexslider">
            
                <ul class="slides">
                <?php 
				$qry_slides=mysql_query("SELECT * FROM slides WHERE status=0") or die(mysql_error());
				while($slides=mysql_fetch_array($qry_slides)){	
				?>
                    <li><a href="#">
                        <img src="<?php echo $back_dir; ?>dashboard/media/slides/<?php echo $slides['img_nm']; ?>" alt="Property Slide"></a>
                        
						<?php if($slide_title==1){# Show if set in settings ?>
                        <p class="flex-caption">
                            <span><?php echo $slides['title']; ?></span> 
                        </p>
                        <?php } ?>
                    </li>
                 <?php } ?>   
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
</div>
<!-- End Slider -->