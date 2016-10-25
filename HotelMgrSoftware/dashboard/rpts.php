<?php 
require('sublets/general.php');
include_once("sublets/headtag.php");
$arr=$_GET['arr']; $arrt=$_GET['arrt'];
$mnth=$_GET['mnth']; $yr=$_GET['yr']; 
?>

<div class="wrapper">  
  <div class="content-wrapper">
  
  <!-- Main content -->
    <section class="invoice">
    
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Reservation Report
             <?php 		  
			  if(isset($arr) && isset($arrt)){
			 ?>
            <small class="pull-right"><strong>From: &nbsp; </strong>  <?php echo $arr. ' &nbsp; <strong>To</strong> &nbsp; '. $arrt; ?></small>
            <?php }elseif(isset($mnth) && isset($yr)){ ?>
            <small class="pull-right"><strong>For: &nbsp; </strong>  <?php echo $mnth. '<strong>/</strong>'. $yr; ?></small>
            <?php }elseif(!isset($mnth) && isset($yr)){ ?>
            <small class="pull-right"><strong>For: &nbsp; </strong>  <?php echo $yr; ?></small>
            <?php } ?>
          </h2>
        </div><!-- /.col -->
      </div>
      <!-- info row -->		
  
  		  
  		  <table class="table table-condensed ">
          <thead>
            <tr>
              <th>Res #</th>
              <th>Guest Name</th>
              <th>Room Type</th>
              <th>Pax</th>              
              <th>Arrival</th>
              <th>Departure</th>
              <th>Rate</th>
            </tr>
          </thead>
          
          <?php 		  
		  if(isset($arr) && isset($arrt)){
		  ?>
                    
          <tbody>
          	<?php 
			$result = mysql_query("SELECT SUM(rate) AS value_sum FROM reservations WHERE arr>='$arr' AND 
			arr<='$arrt' AND status='0' AND void='0' AND cancel='0'"); $row = mysql_fetch_assoc($result); 
			$sum = $row['value_sum'];
						
			$query=mysql_query("SELECT * FROM reservations WHERE arr>='$arr' AND arr<='$arrt'") or 
			die(mysql_error()); $line="style='text-decoration:line-through;'";
			while($row = mysql_fetch_array($query)){
			?>
            <tr>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['res_no']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['guest_nm']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
			  <?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['adult'].'/'.$row['child'] ; ?></td>             
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['arr']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['dept']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo number_format($row['rate']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
          
          <?php }elseif(isset($mnth) && isset($yr)){ ?>
          
          <tbody>
          	<?php 
			$result = mysql_query("SELECT SUM(rate) AS value_sum FROM reservations WHERE month='$mnth' AND 
			year<='$yr' AND status='0' AND void='0' AND cancel='0'"); $row = mysql_fetch_assoc($result); 
			$sum = $row['value_sum'];
						
			$query=mysql_query("SELECT * FROM reservations WHERE month='$mnth' AND year<='$yr'") or 
			die(mysql_error()); $line="style='text-decoration:line-through;'";
			while($row = mysql_fetch_array($query)){
			?>
            <tr>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['res_no']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['guest_nm']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
			  <?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['adult'].'/'.$row['child'] ; ?></td>             
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['arr']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['dept']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo number_format($row['rate']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
          
          <?php }elseif(isset($yr) && !isset($mnth)){ ?>
          
          <tbody>
          	<?php 
			$result = mysql_query("SELECT SUM(rate) AS value_sum FROM reservations WHERE year='$yr' 
			AND status='0' AND void='0' AND cancel='0'"); $row = mysql_fetch_assoc($result); 
			$sum = $row['value_sum'];
						
			$query=mysql_query("SELECT * FROM reservations WHERE year='$yr'") or 
			die(mysql_error()); $line="style='text-decoration:line-through;'";
			while($row = mysql_fetch_array($query)){
			?>
            <tr>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['res_no']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['guest_nm']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
			  <?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['adult'].'/'.$row['child'] ; ?></td>             
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['arr']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['dept']; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo number_format($row['rate']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
          
          <?php } ?>
          
          <tfoot>
              <tr>
                <th><?php if(isset($sum)){echo 'TRANSACTION TOTAL'; }?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php if(isset($sum)){echo number_format($sum);} ?></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          
        </table>
  		
  
  
  
  	</section><!-- /.content -->
  
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
<?php include_once("sublets/footag.php"); ?> 