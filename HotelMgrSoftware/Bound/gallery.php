<?php
include_once("../dashboard/sublets/general.php"); 
include_once("inc/public_qry.php");  
include_once("inc/headtag.php"); 
include_once("../dashboard/sublets/pagination.php"); 
?>


<?php 
# Pagination Parameters--------------------------------------------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 3; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page; 
?>

<body>
    <div class="gwrapper">
        <?php include_once("inc/menutag.php"); ?>
        
        
        <div class="container clearfix">
            <div class="sixteen columns">
                <h1 class="page-title">
                    Property <span class="gray2"> Gallery</span>
                </h1>
            </div>
            
            <div class="clearfix">
            </div>
            
            <div class="portfolio">
                <div class="gallery" id="contain">
                
					<?php
					$statement = "gallery WHERE logo=0 ORDER BY id DESC";
                    $qryam=mysql_query("SELECT * FROM {$statement} LIMIT  
					{$startpoint},{$per_page}") or die(mysql_error());
                    while($row=mysql_fetch_array($qryam)){	
                    ?>
                
                    <!-- item 1 -->
                    <div class="one-third column">
                        <div class="caption">
                            <a href="<?php echo $back_dir; ?>dashboard/media/gallery/<?php echo $row['img_nm']; ?>" rel="prettyPhoto[gallery]">
                                <img src="<?php echo $back_dir; ?>dashboard/media/gallery/<?php echo $row['img_nm']; ?>" class="pic" alt="" />
                            </a>
                        </div>                        
                    </div>
                    <!-- End -->
                   
                   <?php } ?>               
                    
                    
<!-- PAGINATION -->
    <div class="pagination color">
        <ul>      
            <?php echo pagination($statement,$per_page,$page,$url='?');?>
        </ul>
    </div>
<!-- /PAGINATION -->
                   
                    
                    
                </div>
                <!-- End contain-->                
            </div>
            <!-- End portfolio -->
        </div>
        <!-- <<< End Container >>> -->
           
<?php 
include_once("inc/footer.php");
?>    
    </div>
    
<?php 
include_once("inc/footag.php"); 
?>