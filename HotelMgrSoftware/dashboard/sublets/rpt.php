<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Reports
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Reports </li>
  </ol>  
</section>



<section class="content">
	<div class="box box-default">
    
        <div class="box-header with-border">
          <i class="fa fa-th-list1"></i>
          <h3 class="box-title"><!--Reports --></h3>
          <!--<a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm pull-right" ><strong>Add New</strong></a> -->       
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <div class="col-md-12">
            
            <?php 
			 # ----------------------------------------------------------
			 if(isset($_REQUEST['days'])){			
			?>
            <form class="form-inline" method="post" name="res_frm">            
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
                          
            <button type="submit" name="days_rpt"  class="btn btn-danger">Generate Report</button>
                      
            
            </form>
            <?php } ?>
            
            
            
            
            
            
             <?php 
			 # ----------------------------------------------------------
			 if(isset($_REQUEST['mnths'])){			
			?>
            <form class="form-inline" method="post" name="res_frm">            
            <div class="input-group">
              <span class="input-group-addon">Month:</span>
                <select class="form-control" name="mnth">
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
            </div>            
            &nbsp;
            
            <div class="input-group">
              <span class="input-group-addon">Year: &nbsp;</span>
              <select class="form-control" name="yr">
              <?php 
			   for($i = 2015; $i < date("Y")+1; $i++){
				  echo '<option value="'.$i.'">'.$i.'</option>';
			  }
			  ?>
            </select>
            </div>
                          
            <button type="submit" name="mnth_rpt"  class="btn btn-danger">Generate Report</button>
            </form>
            <?php } ?>
            
            
            
            
            
            
             <?php 
			 # ----------------------------------------------------------
			 if(isset($_REQUEST['yrs'])){			
			?>
            <form class="form-inline" method="post" name="res_frm">            
            <div class="input-group">
              <span class="input-group-addon">Year:</span>
              <select class="form-control" name="yrs">
              <?php
              for($i = 2015; $i < date("Y")+1; $i++){
				  echo '<option value="'.$i.'">'.$i.'</option>';
			  }
			  ?>
             
            </select> 
            </div>       
                          
            <button type="submit" name="yr_rpt"  class="btn btn-danger">Generate</button>
                        
            </form>
            <?php } ?>
            
            <hr>
           
           	<div class="row">
              <div class="col-md-5"> </div>
              <div class="col-md-4">              
              
              <?php 
			  if(isset($_POST['days_rpt'])){
				  $arr = $_POST['arr'];  $arrt = $_POST['arrt']; ?>
            	  <a class="btn btn-success" 
                  href="javascript:window.open('rpts.php?arr=<?php echo $arr; ?>&arrt=<?php 
				  echo $arrt; ?>', 'modal=yes', 'height=500', 'width=800', 'toolbar=no', 'status=no', 'scrollbars=no','resizable=no')">
                  Open Report</a>
            <?php } ?>
            
            
            <?php 
			  if(isset($_POST['mnth_rpt'])){
				  $mnth = $_POST['mnth'];  $yr = $_POST['yr']; ?>
            	  <a class="btn btn-success" 
                  href="javascript:window.open('rpts.php?mnth=<?php echo $mnth; ?>&yr=<?php 
				  echo $yr; ?>', 'modal=yes', 'height=500', 'width=800', 'toolbar=no', 'status=no', 'scrollbars=no','resizable=no')">
                  Open Report</a>
            <?php } ?>
            
            <?php 
			  if(isset($_POST['yr_rpt'])){
				  $yr = $_POST['yrs'];  ?>
            	  <a class="btn btn-success" 
                  href="javascript:window.open('rpts.php?yr=<?php echo $yr; 
				  ?>', 'modal=yes', 'height=500', 'width=800', 'toolbar=no', 'status=no', 'scrollbars=no','resizable=no')">
                  Open Report</a>
            <?php } ?>
            
              </div>
              <div class="col-md-3"> </div>
            </div>
            
                
          </div>
       </div> 
    

                
                
	</div>
</section>
