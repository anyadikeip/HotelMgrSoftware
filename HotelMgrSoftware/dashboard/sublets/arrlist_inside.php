<script language="javascript">	
	function voidRes(pid){
		if(confirm('Do you really mean to void this reservation')){
		document.reslist.pid.value=pid;
		document.reslist.command.value='voidRes';
		document.reslist.submit();
		}
	}	
	function cancel(pid){
		if(confirm('Do you really mean to cancel this reservation')){
		document.reslist.pid.value=pid;
		document.reslist.command.value='cancel';
		document.reslist.submit();
		}
	}
</script>



<?php 
# Pagination Parameters--------------------------------------------------
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1; 
$per_page = 20; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page; 
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Arrival List
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Arrival List  </li>
  </ol>  
</section>


<section class="content">
	<div class="box box-default">
    
        <div class="box-header with-border">
          <i class="fa fa-th-list"></i>
          <h3 class="box-title">Arrival List</h3>
          <!--<a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm pull-right" ><strong>Add New</strong></a> -->       
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <div class="col-md-12">
            
           <!-- <form class="form-inline" method="post" name="res_frm">            
            <div class="input-group">
              <span class="input-group-addon">Arrival:</span>
              <input type="text" class="form-control datepicker" id="arr" name="arr" placeholder="MM/DD/YYYY">
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
            </div>
            
            &nbsp; &nbsp;
            
            <div class="input-group">
              <span class="input-group-addon">To: &nbsp;</span>
              <input type="text" class="form-control datepicker" id="arrt" name="arrt" placeholder="MM/DD/YYYY">
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
            </div>
                          
            <button type="submit" name="fetch_res"  class="btn btn-danger">Fetch List</button>
            </form> -->
            
            <hr />
            
             <?php			
			 # ----------------------------------------------------------
			 if($_REQUEST['command']=='voidRes' && $_REQUEST['pid']>0){
				toggle_access('reservations', $_REQUEST['pid'], 'void');
			 }	
			  # ---------------------------------------------------------
			 if($_REQUEST['command']=='cancel' && $_REQUEST['pid']>0){
				toggle_access('reservations', $_REQUEST['pid'], 'cancel');
			 }			 		
			?>            
            
            <form method="post" name="arrlist" id="arrlist">
            <input type="hidden" name="pid" />
            <input type="hidden" name="command" />
            <div class="table-responsive">
            <table class="table table-hover ">
              <thead>
                <tr>
                  <th>Res #</th> 
                  <th>Arrival</th>
                  <th>Departure</th>
                  <th>Guest Name</th>
                  <th>Room Type</th>
                  <th>Pax</th>
                  <!--<th>Vou #</th> -->
                  <th>Rate(N)</th>
                  <th>Status</th>
                  <th style="text-align:right;">Ctrl(s)</th>
                </tr>
              </thead>
              <tbody>
              	<?php				
				$arr = date("m/d/Y"); 
				$statement = "reservations WHERE arr='$arr' ORDER BY arr DESC"; 
				$query=mysql_query("SELECT * FROM {$statement} LIMIT 
				{$startpoint},{$per_page}") or die(mysql_error()); 
				$line='style="text-decoration:line-through;"';
				while($row = mysql_fetch_array($query)){
				?>
                <tr>
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
                  <div class="<?php if($row['status']==1){echo 'label label-success';}?>"><?php echo $row['res_no']; ?></div></td> 
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['arr']; ?></td>
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['dept']; ?></td>
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['guest_nm']; ?></td>
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> >
				  <?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?></td>
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo $row['adult'].'/'.$row['child'] ; ?></td>
                  <!--<td><?php echo $row['vou']; ?></td> -->
                  <td <?php if($row['void']==1 || $row['cancel']==1){echo $line;} ?> ><?php echo number_format($row['rate']); ?></td>
                  <td><?php if($row['void']==1){echo '<span class="label label-danger">Voided</span>';
				  }elseif($row['cancel']==1 || $row['cancel']==1){echo '<span class="label label-warning">Cancelled</span>';} ?></td>                  
                  <td style="text-align:right;">
                   <div class="btn-group" role="group">
                  <a data-toggle="modal" href="javascript:window.open('res_detail.php?res=<?php echo $row['id'].'&'.$row['res_no']; ?>','Reservation Detail', 'height=550,width=750, toolbar=no, directories=no, status=no, continued from previous linemenubar=no, scrollbars=no,resizable=no ,modal=yes');" title="View Reservation"
                   class="btn btn-success btn-xs glyphicon glyphicon-folder-open"></a>
                   
                   <!--
                   <a href="javascript:cancel(<?php echo $row['id']; ?>)" title="Cancel Reservation" aria-hidden="true" 
                   class="btn btn-warning btn-xs glyphicon glyphicon-remove"></a>
                   <a href="javascript:voidRes(<?php echo $row['id']; ?>)" title="Void Reservation" aria-hidden="true" 
                   class="btn btn-danger btn-xs glyphicon glyphicon-trash"></a>  -->
                   </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           </div>
           </form>
                
          </div>
       </div> 
    
<!-- PAGINATION -->
<div class="btn-toolbar" style="text-align:center;">
    <div class="pagination  pagination-sm">
        <ul>        
            <?php echo @pagination($statement,$per_page,$page,$url='?');?>
        </ul>
    </div>
</div> 
<!-- /PAGINATION -->
                
                
                
	</div>
</section>
