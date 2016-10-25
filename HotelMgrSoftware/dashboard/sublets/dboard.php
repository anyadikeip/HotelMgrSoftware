<section class="content">

<div class="col-md-8">

    <div class="box box-default">
      <!-- Default box -->
      <div class="box">
      
        <div class="box-header with-border">
          <h3 class="box-title">Recent 10 Reservations</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        
        <div class="box-body">
        
        <div class="table-responsive">
          <table class="table table-bordered table-condensed table-striped">
          <thead>
            <tr>
              <th> </th>
              <th>Room Type</th>
              <th>Pax</th>
              <th>Rate(N)</th>
            </tr>
          </thead>
          <tbody>
          <?php 
		  	$query=mysql_query("SELECT * FROM reservations ORDER 
			BY id DESC LIMIT 10 ") or die("Err: " . mysql_error()); 
			$line='style="text-decoration:line-through;"';
			while($row = mysql_fetch_array($query)){
		  ?>
            <tr>
              <td>
              <?php 
			  echo " <strong>[ ".$row['res_no'] ." ]</strong> &nbsp; ". strtoupper($row['title'] ." ". $row['guest_nm'])."<br/>";
			  echo "[ Arr | Dept ] <strong>" .$row['arr'] ." | ". $row['dept']."</strong>"; 			  
			  ?>
              </td>
              <td><?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['adult'].'/'.$row['child'] ; ?></td>
              <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo number_format($row['rate']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>    
          
        </div><!-- /.box-body -->
    
      </div>
    </div><!-- /.box -->

</div>
   
   
   
   
   
   
    

<div class="col-md-4">

    <div class="box box-default">
      <div class="box">
      
        <div class="box-header with-border">
          <h3 class="box-title">Reservation Summary</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        
        <div class="box-body">        	 
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa "><?php echo recordcount('reservations', 'rev_date', $today); ?></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Today's Reservation</span>
              <span class="info-box-number"><?php echo date("jS \ M Y"); ?></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                Yesterday's Reservation: <?php echo recordcount('reservations', 'rev_date', $yesterday); ?>
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div>
        
        
        <div class="box-body">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa "><?php echo recordcount1('reservations', 'rev_date', $last30); ?></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Last 30 Days Reservation</span>
              <span class="info-box-number">Since: <?php echo $last30; ?></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                Previous Interval Booking: <?php echo recordcount1('reservations', 'rev_date', $last30); ?>
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box --> 
        </div><!-- /.box-body -->
        
        
        <div class="box-body">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa "><?php echo recordcount1('reservations', 'rev_date', $last90); ?></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Last 90 days Reservation</span>
              <span class="info-box-number">Since: <?php echo $last90; ?></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                Previous Interval Booking: <?php echo recordcount1('reservations', 'rev_date', $last90); ?>
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.box-body -->
    
      </div>
    </div><!-- /.box -->    

</div><!-- col-xs-4 -->





  
  
  
  
  
  
  
  
  
  
  
  
</section><!-- /.content -->