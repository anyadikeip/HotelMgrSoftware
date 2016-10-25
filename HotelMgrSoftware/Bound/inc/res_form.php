<style>
.plan-name-bronze {
  padding: 8px;
  color: #FFF;
  background-color: #FC0;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
 }
</style>

<?php 
if($_SESSION['sel_rm']==''){
header("Location: ."); exit;
}
?>

<div class="meet-team">
	<div class="sixteen columns"> 
    
    <?php
        if(isset($_POST['rm_reserve'])){			
			$res_no = strtoupper(trim(generateRandomString($length = 6)));
            $arr = $_POST['arr']; $adult = $_POST['adult']; $sel_rm = $_POST['sel_rm'];
            $child = $_POST['child']; $rooms =$_POST['rooms'];	
            $nights =$_POST['nights']; $dept = date('m/d/Y', strtotime($arr. ' + '.$nights.' days'));
			
			$title = $_POST['title']; $guest_nm = $_POST['guest_nm']; 
			$fulname = $title. ' ' .$guest_nm;
			$email = $_POST['email']; $phone = $_POST['phone'];
			$addr = $_POST['addr']; $pax = ($adult + $child); 
			
			$rev_date = date("m/d/Y"); $month = date("m"); $year = date("Y");			
			
			$rate = get_value_using_id('room_type', $sel_rm, 'rack_rate');
			$rate = ($rate * $rooms * $nights); 
			
			# SESSION VARIABLES FOR CONFIRMATION =============================================================
			$_SESSION['res_no'] = $res_no; $_SESSION['arr'] = $arr; $_SESSION['adult'] = $adult; 
			$_SESSION['child'] = $child; $_SESSION['rooms'] = $rooms; $_SESSION['nights'] = $nights; 
			$_SESSION['dept'] = $dept; $_SESSION['title'] = $title; $_SESSION['guest_nm'] = $guest_nm; 
			$_SESSION['fulname'] = $fulname; $_SESSION['email'] = $email; $_SESSION['phone'] = $phone; 
			$_SESSION['addr'] = $addr; $_SESSION['pax'] = $pax; $_SESSION['rev_date'] = $rev_date;
			$_SESSION['month'] = $month; $_SESSION['year'] = $year; $_SESSION['rate'] = $rate;			
			# Move to step two ==============================================================================
			header("Location: reservation?review"); exit;
		  }
        ?>			
       
		<?php 
		if(isset($_POST['reserve_now'])){
			if($_SESSION['rate']<>""){				
				mysql_query("INSERT INTO reservations SET res_no='$_SESSION[res_no]', 
				title='$_SESSION[title]', guest_nm='$_SESSION[guest_nm]', email='$_SESSION[email]', 
				phone='$_SESSION[phone]', addr='$_SESSION[addr]', arr='$_SESSION[arr]', dept='$_SESSION[dept]', 
				adult='$_SESSION[adult]', child='$_SESSION[child]',	room='$_SESSION[sel_rm]', 
				nights='$_SESSION[nights]', pax='$_SESSION[pax]', rate='$_SESSION[rate]', no_of_rm='$_SESSION[rooms]', 
				rev_date='$_SESSION[rev_date]', month='$_SESSION[month]', year='$_SESSION[year]'") or die(mysql_error());
								
				# Send SMS notification to receptionist number(s) for new reservation [HOTEL SMS]  ($respt_sms_no)
				if($res_sms_alert==1){
					$rmsg = 'Bravo! '.$_SESSION['guest_nm'].' Just made a reservation on '.$property_nm.
					' website, please login into your dashboard for details.';
					sendsms($respt_sms_no, $rmsg);
				}				
				# Send reservation summary to guest for successful reservation [GUEST SMS]  
				if($guest_sms_alert==1){
					$gmsg = 'Dear '.$_SESSION['guest_nm'].', your reservation was made successfully '. 
					'with Res. No. ['.$_SESSION['res_no'].']. Thank You.'; 
					sendsms($_SESSION['phone'],$gmsg);
				}
				
				
				
				# Send Email notification to reservation email(s) for new reservation [HOTEL EMAIL]  ($rev_em)
				if($res_em_alert==1){
					$newResMsg = 'Dear FrontDesk,<br>New reservation was made on your 
					website, please login into your dashboard for details. <br/> Thank You.';
										
					 $to = $rev_em ." <FrontDesk>". " \r\n";
					 $subject = 'New Reservation';	 
					 $message = $newResMsg;
					 
					 $header = "From:" .$_SESSION['email'] ." <".$_SESSION['fulname'].">". " \r\n";
					 $header = "Cc:" . $frmCC . " \r\n";
					 $header .= "MIME-Version: 1.0\r\n";
					 $header .= "Content-type: text/html\r\n";	 
					 mail($to,$subject,$message,$header);										
				}	
							
				# Email reservation summary to guest for successful reservation  [GUEST EMAIL]
				if($guest_em_alert==1){
					
					 $to = $_SESSION['email'] ." <".$_SESSION['fulname'].">". " \r\n";
					 $subject = 'Reservation Confirmation';	 
					 $message = $confirm_msg;
					 
					 $header = "From:" .$pty_em ." <FrontDesk>". " \r\n";
					 $header = "Cc:" . $frmCC . " \r\n";
					 $header .= "MIME-Version: 1.0\r\n";
					 $header .= "Content-type: text/html\r\n";	 
					 mail($to,$subject,$message,$header);
				}
				
				# Clear all session 
				$_SESSION['res_no'] = ""; $_SESSION['arr'] = ""; $_SESSION['adult'] = 1; 
				$_SESSION['child'] = 0; $_SESSION['rooms'] = 1; $_SESSION['nights'] = 1; 
				$_SESSION['dept'] = 1; $_SESSION['title'] = ""; $_SESSION['guest_nm'] = ""; 
				$_SESSION['fulname'] = ""; $_SESSION['email'] = ""; $_SESSION['phone'] = ""; 
				$_SESSION['addr'] = ""; $_SESSION['pax'] = ""; $_SESSION['rev_date'] = "";
				$_SESSION['month'] = ""; $_SESSION['year'] = ""; $_SESSION['rate'] = "";	
				
				echo '<script>
						alert("Thank you for your reservation, we will get back to you soon. ");
						window.location = "."
				</script>
				';					
			}
		}
		?>
       
        
        
        
        <?php if(!isset($_GET['review'])){ ?>
        
        <div id="msg" style="padding:1px; text-align:center;">        
        </div>
        
         <div class="sixteen columns">          
           <blockquote>
            You are reserving: -
             <h2>  
                <span class="text-warning">
                    <?php echo strtoupper(get_value_using_id('room_type', $_SESSION['sel_rm'], 'type_nm'));  ?>  - 
                   #<u><?php echo number_format(get_value_using_id('room_type', $_SESSION['sel_rm'], 'rack_rate')); ?></u>
                </span>
             </h2>
          </blockquote>      
        </div>
     
        
		<form class="form-inline" method="post" name="res" onsubmit="return validateForm()">
        	
            <input type="hidden" name="sel_rm" value="<?php echo $_SESSION['sel_rm']; ?>" />
            <input type="hidden" name="action" value="step2" />
        	<div class="input-prepend">
              <span class="add-on">Arrival: </span>
              <input class="span2 datepicker" readonly="readonly" name="arr" value="<?php echo date('m/d/Y'); ?>" id="prependedInput" type="text" placeholder="mm/dd/yyyy">
            </div>
            &nbsp; &nbsp;
            <div class="input-prepend">
              <span class="add-on">Adult(s): </span>
              <select class="span1" name="adult">
              <!--<option><?php echo $_SESSION['adult'] ?></option> -->
              <?php for ($i=1; $i<=10; $i++){ ?> {
              	<option><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            &nbsp; &nbsp; 
        	<div class="input-prepend">
              <span class="add-on">Children: </span>
              <select class="span1" name="child">
              <!--<option><?php echo $_SESSION['child'] ?></option> -->
              <?php for ($i=0; $i<=4; $i++){ ?> {
              	<option><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            &nbsp; &nbsp; 
        	<div class="input-prepend">
              <span class="add-on">No of Rooms: </span>
              <select class="span1" name="rooms">
              <!--<option><?php echo $_SESSION['rooms'] ?></option> -->
              <?php for ($i=1; $i<=20; $i++){ ?> {
              	<option><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            &nbsp; &nbsp;
        	<div class="input-prepend">
              <span class="add-on">No of Nights: </span>
              <select class="span1" name="nights">
              <!--<option><?php echo $_SESSION['nights'] ?></option> -->
              <?php for ($i=1; $i<=30; $i++){ ?> {
              	<option><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            &nbsp; &nbsp;
                
   
     	<h2 class="title">Personal Information    </h2>
      	
            <div class="span5">
            	
                <div class="form-horizontal1">
                  <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                    <select name="title" class="span2">
                    	<!--<option selected="selected"><?php echo $_SESSION['title'] ?></option> -->
                    	<option>Mr</option>
                        <option>Mrs</option>
                        <option>Miss</option>
                        <option>Sir</option>
                        <option>Chief</option>
                        
                    </select>
                    
                    </div>
                  </div>                  
                  
                  <div class="control-group">
                    <label class="control-label" for="gname">Full Name:</label>
                    <div class="controls">
                      <input type="text" name="guest_nm" value="<?php echo $_SESSION['guest_nm'] ?>" placeholder="">
                    </div>
                  </div>
                  
                   <div class="control-group">
                    <label class="control-label" for="email">Email:</label>
                    <div class="controls">
                      <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="">
                    </div>
                  </div>
                  
                 
              
                </div>
            </div>
  			
            <div class="form-horizontal1">
        	<div class="span6">
            <div class="control-group">
                    <label class="control-label" for="phone">Phone:</label>
                    <div class="controls">
                      <input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>" placeholder="">
                    </div>
                 </div>
                  
               <div class="control-group">
                <label class="control-label" for="addr">Address:</label>
                <div class="controls">
                  <textarea rows="2" class="span3" name="addr"><?php echo $_SESSION['addr'] ?></textarea>
                </div>
              </div>
            
            </div>
            </div>
            
            
       <div class="row">
  		<div class="span12"><input type="submit" class="btn btn-danger pull-right" name="rm_reserve" value="Review Reservation"> </div>
	   </div>     
         </form> 
         <?php }if(isset($_GET['review'])){ ?>
         
         
         <form method="post" >
         <h2 class="">Review Reservation - <span class="label label-important"><?php echo $_SESSION['res_no']; ?> </span>
         
         <div class="btn-group pull-right">
          <a href="reservation" type="button" class="btn btn-primary"> Retrun </a>
          <input type="submit" name="reserve_now" class="btn btn-danger" value="Reserve Now" />
        </div>
         </h2>
        </form> 
         
         <hr /><br />
           			         
         <div class="row-fluid">
          <div class="span5">
              <blockquote>                    
                <strong>Check In:</strong>&nbsp; <u><?php echo $_SESSION['arr']; ?></u> &nbsp;|&nbsp; 
                <strong>Check Out:</strong>&nbsp; <u><?php echo $_SESSION['dept']; ?></u> <br />
                
                <strong>No of Nights:</strong> &nbsp; <span class="badge badge-warning"><?php echo $_SESSION['nights']; ?></span> | 
                <strong>No of Rooms:</strong> &nbsp; <span class="badge badge-warning"><?php echo $_SESSION['rooms']; ?></span> <br />
                <strong>Guest(s):  &nbsp;</strong> Adult: <span class="label label-inverse">[<?php echo $_SESSION['adult']; ?>]</span>; &nbsp; 
                Children: <span class="label label-inverse">[<?php echo $_SESSION['child']; ?>]</span> 
            </blockquote>
          </div>
          
          <div class="span4">
          	 <blockquote>
             	<strong><?php echo $_SESSION['fulname']; ?></strong><br />
                <?php echo $_SESSION['email']; ?> | <?php echo $_SESSION['phone']; ?><br />
                <?php echo $_SESSION['addr']; ?>
             </blockquote>         
          </div>
          
          <div class="span3">
          <blockquote>
          	<div class="plan-name-bronze" style="text-align:center;">
            	<span>Bill Amount</span>
            	<h2>#<?php echo @number_format($_SESSION['rate']); ?></h2>            
          	</div>
            </blockquote>
          </div>
          
                    
        </div>
         
         <?php } ?>
     
    
    </div>
</div>   
        
        
      
<hr /><br />
      
<!-- Tab Row -->
<div class="bottom">
<div id="horizontal-tabs">
  
    <ul class="tabs">
      <li id="tab1">Facilities</li>
      <li id="tab2">Check-In Policy</li>
      <li id="tab3">Parking Details/Policy</li>
      <li id="tab4">Hotel Policy</li>
      <li id="tab5">Cancellation Policy</li>
    </ul>
    
    <div class="contents">
    
      <!--Facilities Tab-->
      <div id="content1" class="tabscontent">
       <ul class="check-list button-2"> 
            <?php
             $qy=mysql_query("SELECT * FROM amenities WHERE 
             status=0") or die(mysql_error());
             while($ame=mysql_fetch_array($qy)){
            ?>			
            <li class="label">
              <?php echo $ame['name'].'&nbsp; &nbsp; &nbsp;'; ?> 
            <?php } ?>
            </li> 
        </ul>                
      </div>
      
      <!--Check-In Policy Tab-->
      <div id="content2" class="tabscontent">
       <?php echo $checkin_policy; ?>
      </div>
      
      <!--Parking Details/Policy Tab-->
      <div id="content3" class="tabscontent">
        <?php echo $parking_policy; ?>
      </div>
      
      <!--Hotel Policy Tab-->
       <div id="content4" class="tabscontent">
        <?php echo $hotel_policy; ?>
      </div>
      
      <!--Cancellation Policy Tab-->
       <div id="content5" class="tabscontent">
        <?php echo $can_policy; ?>
      </div>
      
    </div>
    
</div>
</div>
      
      
      
<div class="clearfix"></div>        
</div> 
<!--<div class="clearfix"></div> -->


<script type="text/javascript">
// Validate compose form on submit -----------------------------------------
	function validateForm() {
		var adult = document.forms["res"]["adult"].value;
		var child = document.forms["res"]["child"].value;		
		var rooms = document.forms["res"]["rooms"].value;
		var nights = document.forms["res"]["nights"].value;		
		
		var guest_nm = document.forms["res"]["guest_nm"].value;
		var email = document.forms["res"]["email"].value;		
		var phone = document.forms["res"]["phone"].value;	
				
		if (adult == null || adult == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please select expected number of adults</div>";			
			return false;
		}else if (child == null || child == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please select expected number of children</div>";			
			return false;
		}else if (rooms == null || rooms == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please select number of room you are reserving</div>";			
			return false;
		}else if (nights == null || nights == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please select the number of nights you wish to stay</div>";			
			return false;			
			
		}else if (guest_nm == null || guest_nm == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>Please enter your name in the box provided</div>";			
			return false;
		}else if (email == null || email == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>We will need your email please</div>";			
			return false;
		}else if (phone == null || phone == "") {
			document.getElementById("msg").innerHTML = "<div style='color:red;'>We will need your phone number please</div>";			
			return false;
		}		
	}

</script>