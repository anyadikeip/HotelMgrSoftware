<?php 
require('sublets/general.php');
include_once("sublets/headtag.php");
$res=$_GET['res']; 
?>
<div class="wrapper">  
  <div class="content-wrapper">
  
  		 <?php 
		  if(isset($_POST['confirm_res'])){
			$hid=$_POST['hid'];
		  	mysql_query("UPDATE reservations SET status=1 
			WHERE id='$hid'") or die(mysql_error());
			alert("success", "Reservation confirmation was successful");
		  }
		  ?>
  
  
  
		<?php 
        $query=mysql_query("SELECT *  FROM reservations WHERE id='$res'") or 
		die(mysql_error()); $line="text-decoration:line-through;";
		while($row = mysql_fetch_array($query)){
        ?>     
        <!-- Main content -->
        <section class="invoice">
        
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-tag"></i> Reservation Detail
                <small class="pull-right">Date:  <?php echo $row['rev_date']; ?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          
                  
          <div class="row">
          
          <div class="col-xs-6">            
           <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><strong>Guest Information</strong></h3>
              </div>
              <div class="panel-body">
                <address>
                <strong><?php echo ucwords($row['title'].' '. $row['guest_nm']); ?> </strong><br>
                <?php echo ucwords($row['addr']); ?><br>
                <strong>Phone</strong>: &nbsp;  <?php echo $row['phone']; ?><br/>
                <strong>Email</strong>: &nbsp;  <?php echo $row['email']; ?><br/>
                
              </address>
              </div>
            </div>
          </div><!-- /.col -->
          
          
          <div class="col-xs-6">            
           <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><strong>Res Information - </strong>
                <span class="badge label-primary pull-right"> <?php echo $row['res_no']; ?></span></h3>
              </div>
              <div class="panel-body">
                <address>
                <strong><?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></strong><br>
                <strong>Arrival</strong>: &nbsp;  <?php echo $row['arr']; ?><br/>
                <strong>Departure</strong>: &nbsp; <?php echo $row['dept']; ?><br/>
                
                 <strong>Nights</strong>: &nbsp;  <?php echo $row['nights']; ?> &nbsp;&nbsp;
                <strong>Pax</strong>: &nbsp;  <?php echo $row['adult'].'/'.$row['child']; ?> <small>(A/C)</small><br/>
              </address>
              </div>
            </div>
          </div><!-- /.col -->
            
           
           
            
          </div><!-- /.row -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><strong>Other Information</strong></h3>
              </div>
              <div class="panel-body">
                <address>
                <strong>Reservation Type</strong><br><?php if($row['status']==1){
					echo '<span class="label label-success">Confirm Booking</span>';}
					else{echo '<span class="label label-danger">Un-confirmed</span>';} ?>
                <br>				
                <?php if($row['void']==1){echo '<strong>Status</strong>: <span class="label label-danger">Voided</span>';
				  }elseif($row['cancel']==1 || $row['cancel']==1){echo '<strong>Status</strong>: <span class="label label-warning">Cancelled</span>';}   ?><br/>               
              </address>
              </div>
            </div>
            </div><!-- /.col -->
            
            
            <div class="col-xs-6">              
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Room Charge(N):</th>
                    <td style="text-align:right; <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ">
					<?php echo number_format($row['rate']); ?></td>
                  </tr>
                  <tr>
                    <th>Voucher </th>
                    <td style="text-align:right; <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ">
					<?php echo number_format($row['vou_rate']); ?></td>
                  </tr>
                  <tr>
                    <th>Extra Charge(s):</th>
                    <td style="text-align:right; <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ">
					<?php echo number_format($row['extra']); ?></td>
                  </tr>
                  <tr>
                    <th>Total(N):</th>
                    <td style="text-align:right; <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> " 
					<?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
					<?php echo number_format(($row['rate'] - $row['vou_rate']) + $row['extra']); ?></td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
            <form method="post" class="pull-right">
            <input name="hid" type="hidden" value="<?php echo $res; ?>"  />
            <?php if($row['status']==0){ ?>            
            <input type="submit" name="confirm_res" class="btn btn-success" value="Confirm Reservation"  />
            <?php } ?>
              <a href="javascript:window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            </div>
          </div>
        </section><!-- /.content -->
               
        <?php } ?>   
                

  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
<?php include_once("sublets/footag.php"); ?> 