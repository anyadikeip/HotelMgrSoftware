<?php 
require('sublets/general.php');
include_once("sublets/headtag.php"); 
include_once("sublets/pagination.php");
include_once("sublets/imgresizer.php"); 
?>  
    <div class="wrapper">	
	<?php include_once("sublets/header.php"); ?>       
      <?php include_once("sublets/aside.php"); ?> 

      	<!-- Content Wrapper. Contains page content -->
      	<div class="content-wrapper">
                            
                <?php include_once("sublets/privilege_inside.php"); ?> 

      </div><!-- /.content-wrapper -->
      
      <?php include_once("sublets/footer.php"); ?>      
    <?php include_once("sublets/aside_right_flip.php"); ?>            
    </div><!-- ./wrapper -->
<?php include_once("sublets/footag.php"); ?> 