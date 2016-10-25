 <div class="clearfix"></div>
    <div class="meet-team">
      <div class="sixteen columns">
        <h2 class="title">Featured Apartments</h2>
        
<!--<p class="MB20"> 
Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc et magna nisi.Aliquam at erat in          purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere vel vitae nibh.          Proin id condimentum sem. Morbi vitae dui in magna vestibulum suscipit vitae vel nunc. Integer ut risus nulla. malesuada tortor, nec          scelerisque lorem mattis. </p> --> 
      </div> 
      
<!--<div class="clearfix"></div> -->



<div id="slideshow" class="sixteen columns">
	<div class="container">

		<div id="ca-container" class="ca-container">
        	<div class="ca-wrapper">
            
            
            <?php 
			$featured=mysql_query("SELECT * FROM room_type WHERE featured=1 
			ORDER BY sort ASC LIMIT 3") or die(mysql_error());
			while($row=mysql_fetch_array($featured)){	
			?>   
                    
            <div class="ca-item ca-item-1">
                <div class="ca-item-main">
                    <div class="background"></div><!-- background color -->
                    
                    <div class="ca-icon">
						<?php 
                        $qryimg=mysql_query("SELECT * FROM rmtype_imgs WHERE 
						rmtype_id={$row[id]} LIMIT 1") or die(mysql_error());
                        while($rows=mysql_fetch_array($qryimg)){	
                        ?>
                        <a href="rmtype?_handler=<?php echo $row['id']; ?>#<?php echo $row['type_nm']; ?>" >
                        <img src="<?php echo $back_dir; ?>dashboard/media/rm_img/<?php echo $rows['img_nm']; ?>" alt="">
                        </a>
                        <?php } ?>
                    </div>
                    
                    <h3><a href="rmtype?_handler=<?php echo $row['id']; ?>#<?php echo $row['type_nm']; ?>">
                    	<small><?php echo $row['type_nm']; ?></small>
                    	</a>
                    </h3>
                    
                    <h4><?php echo myWrap($row['descr'], 188, true); ?> </h4>
                    
                   <!-- <a href="rmtype?_handler=<?php echo $row['id']; ?>#<?php echo $row['type_nm']; ?>" class="ca-more">
                    	#<?php echo number_format($row['rack_rate']); ?>
                    	<span class="ca-more1"></span>   
                    </a> -->
                    <br />
                    <?php if($promo_rate==1){?>
                    <a href="rmtype?_handler=<?php echo $row['id']; ?>#<?php echo $row['type_nm']; ?>" class="label label-warning pull-left">
                    $<?php echo number_format($row['promo_rate']); ?></a>
                    <?php } ?>
                    
                      <a href="rmtype?_handler=<?php echo $row['id']; ?>#<?php echo $row['type_nm']; ?>" class="label label-inverse pull-right">
                      #<?php echo number_format($row['rack_rate']); ?></a>
                    
                    <br />
                    
                     
                     
                     
                        </div><!-- end ca-item-main -->
                        <div class="ca-content-wrapper">
                            <div class="ca-content">
                                <h6><?php echo $row['type_nm']; ?></h6>
                                <a href="#" class="ca-close"><span class="icon-remove"></span></a>
                                <div class="ca-content-text">
                                <p><?php echo $row['descr']; ?></p>
                        	</div>
                        <a href="#">View More</a>
                    </div>
                </div><!-- end ca-content-wrapper -->
            </div><!-- end ca-item -->
                        
        <?php } ?>                
                        
                        
                    </div><!-- end ca-wrapper -->
                </div><!-- end circular content carousel -->

			</div>
        </div>
        <!-- End Slider -->
        
        
        
<!-- Start Circular Content Carousel code -->
   <link rel="stylesheet" type="text/css" href="sliders/circular_content_carousel/css/circular_content_carousel.css" />

	<script type="text/javascript" src="sliders/circular_content_carousel/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="sliders/circular_content_carousel/js/jquery.swipe.js"></script>
	<script type="text/javascript" src="sliders/circular_content_carousel/js/jquery.contentcarousel.js"></script>
	<script type="text/javascript">
		jQuery('#ca-container').contentcarousel();
		jQuery(window).load(function(){
        	setTimeout(function() {
                jQuery('#ca-container .ca-icon').css('backgroundImage', 'none');
            }, 1000);
         
		});
	</script>
<!-- End Circular Content Carousel code -->
