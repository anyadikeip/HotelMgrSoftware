<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=323712174484639";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- header starts -->
<header>
 <div class="topmost">
    <div class="container clearfix">
        <div class="eight columns ">
      <h4>Pn: <?php echo $rev_pn; ?> | Em: <?php echo $pty_em; ?></h4>
    </div>
        <div class="eight columns">
      <ul class="social">
        <li class="facebook"><a href="<?php echo $fb_link; ?>" target="_blank">facebook</a></li>
        <!--<li class="twitter"><a href="#">twitter</a></li> -->
        <li class="youtube"><a href="<?php echo $yt_link; ?>" target="_blank">youtube</a></li>
        <li class="email"><a href="mailto:<?php echo $pty_em; ?>">email</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="container clearfix">   
  <!-- Logo starts -->
  <div class="four columns">
    <!--<div class="logo"> <a href="index-2.html"> <img src="images/logo.png" alt="Logo" /> </a> </div> -->
    <?php
	$logo=mysql_query("SELECT * FROM gallery 
	WHERE logo=1 LIMIT 1") or die(mysql_error());
	while($row=mysql_fetch_array($logo)){	
	?>    
    <div class="logo"> <a href=".">
    <img src="<?php echo $back_dir; ?>dashboard/media/gallery/<?php echo $row['img_nm']; ?>" alt="Logo" /> </a> </div>
    <?php } ?>
  </div>
  <!-- Logo ends --> 
  
  <!-- Navigation starts -->
  <div class="twelve columns">
    <nav id="menu" class="navigation">
      <ul id="nav">
        <li><a href="." class="<?php echo active_menu('index.php'); ?>">Home</a></li>
        <?php if($about_menu==1){?><li><a href="about" class="<?php echo active_menu('about.php'); ?>">About</a></li><?php } ?>
        <li><a href="javascript:" class="<?php echo active_menu('rmtype.php'); ?>">Apartments</a>
          <ul>
          	<?php 
			$rms=mysql_query("SELECT * FROM room_type  
			ORDER BY sort ASC") or die(mysql_error());
			while($rw=mysql_fetch_array($rms)){	
			?>
            <li><a href="rmtype?_handler=<?php echo $rw['id']; ?>#<?php echo urlencode($rw['type_nm']); ?>"><?php echo $rw['type_nm']; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <!--<li><a href="reserve" class="<?php echo active_menu('reserve.php'); ?>">Reservation</a></li> -->
        <li><a href="services" class="<?php echo active_menu('services.php'); ?>">Services</a></li>
        <li><a href="gallery" class="<?php echo active_menu('gallery.php'); ?>">Gallery</a></li>
        <li><a href="contact" class="<?php echo active_menu('contact.php'); ?>">Contact</a></li>
      </ul>
    </nav>
  </div>
  <!-- Navigation ends--> 
  
</div>
</header>
<!-- header ends -->