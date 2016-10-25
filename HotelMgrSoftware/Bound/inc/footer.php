<!-- footer starts -->
        <footer>
    <div class="container">
      <div class="five columns">
      
        <div class="about">
          <h3 class="title">About Us </h3>
          <p><?php echo myWrap($hotel_desc, 232, true); ?>
          ...<a href="about" class="color"> Read More</a> </p>
        </div>
      </div>
      <!-- about ends -->
      
      <div class="six columns">
        <div class="tweets">
          <h3 class="title">Facebook Plugin </h3>
          <div class='tweet query footer'>
          
          <div class="fb-page" data-href="<?php echo $fb_link; ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $fb_link; ?>"><a href="<?php echo $fb_link; ?>"><?php echo $site_title; ?></a></blockquote></div></div>
          
          </div>
        </div>
      </div>
      <!-- twitter ends -->
      
      <!--<div class="four columns">
        <div class="flickr">
          <h3 class="title">Widget </h3>
          <script type="text/javascript" src=''></script> 
        </div>
      </div>-->
      <!-- flickr ends --> 
      
      
      <div class="five columns">
        <div class="subscribe">
          <h3 class="title">Widget </h3>
          <?php echo $widget; ?>          
          
          <!--<p>Subscribe to our e-mail newsletter for updates.</p>
          <form action="#">
            <input type="text" class="mail" value="Enter your Email" onBlur="if(this.value == '') { this.value = 'Enter your Email'; }" 
            onfocus="if(this.value == 'Enter your Email') { this.value = ''; }"/>
            <input type="submit" value="Submit" class="submit" />
          </form> -->
        </div>
      </div>
      <!-- subscribe ends -->
      
      <div class="sixteen columns">
        <hr class="bottom" />
      </div>
      <div class="sixteen columns">
      	<span class="copyright"> © <?php echo date("Y"); ?>  <a href="."><?php echo $property_nm; ?></a> by 
        <a href="http://exploreteq.com" target="_blank">Explore Web Technologies</a>
        
        <div class=" pull-right">
            <?php if($master==1){?><img src="<?php echo $back_dir; ?>dashboard/media/cards/master.png" /><?php } ?> &nbsp;  
            <?php if($visa==1){?><img src="<?php echo $back_dir; ?>dashboard/media/cards/visa.png" /><?php } ?> &nbsp;
            <?php if($verve==1){?><img src="<?php echo $back_dir; ?>dashboard/media/cards/verve.png" /><?php } ?> &nbsp;&nbsp; 
            <?php if($disabled==1){?><img src="<?php echo $back_dir; ?>dashboard/media/cards/disabled.jpg" /><?php } ?>  &nbsp;      
      	</div>
        
        </span>
        
        
        
        
    </div>
    
  </footer>
        <!-- footer ends -->
    