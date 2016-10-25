<?php
include_once("../dashboard/sublets/general.php"); 
include_once("inc/public_qry.php");  
include_once("inc/headtag.php"); 
?>

<body>
<div class="gwrapper">
	<?php 
		include_once("inc/menutag.php");
	?>

  <div class="container clearfix">
  
    <!-- Start Posts -->
    <div class="eleven columns top bottom">       
      	<?php 
		$qry=mysql_query("SELECT * FROM services WHERE
		status=0") or die(mysql_error());
		while($row=mysql_fetch_array($qry)){	
		?>
            <div class="post">
            <h2 class="title MB0"><a href="single_post.html"><?php echo $row['title']; ?></a> </h2>               
            <div class="post-content">          
              <div class="flex-container">
                <div class="flexslider3">
                  <ul class="slides">
                    <li><a href="#"><img src="<?php echo $back_dir; ?>dashboard/media/services/<?php echo $row['img_nm']; ?>" ></a></li>
                  </ul>
                </div>
              </div>
              
             <p> <?php echo $row['descr']; ?> </p>
            </div>
            <!-- End post-content --> 
            </div>      
     	<?php } ?>      
    </div>
    <!-- End Posts --> 
    
    
    
    <!-- Start Sidebar Widgets -->
    <div class="five columns bottom"> 
      
      <!-- Text Widget -->
      <h2 class="title bottom-2"> <br/> </h2>
      
          <div id="horizontal-tabs">          
            <ul class="tabs">
              <li id="tab1">Hotel Facilities</li>
            </ul>            
            
            <div class="contents">
              <div id="content1" class="tabscontent">
                <ul class="check-list">
                    <?php 
                    $qryam=mysql_query("SELECT * FROM amenities WHERE
                    type=1 AND status=0") or die(mysql_error());
                    while($arw=mysql_fetch_array($qryam)){	
                    ?>
                  <li>
                    <?php echo $arw['name']; ?>
                  </li>                  
                  <?php } ?>
                </ul>
              </div>
             
             </div>
          </div>
      
    </div>
    <!-- End Sidebar Widgets -->
    
    <div class="clearfix"></div>
  </div>
  <!-- <<< End Container >>> -->  
  
<?php include_once("inc/footer.php"); ?>  
</div>
<?php 
include_once("inc/footag.php"); 
?>