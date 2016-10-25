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
            <div class="sixteen columns">
                <h1 class="page-title">
                    Contact Us
                </h1>
            </div>
            
            
            <!-- contact form ends -->
            <div class="ten columns  bottom">
            
            
            <div class="info hideit">
                <?php 
				if(isset($_POST['send-message'])){
					$name = $_POST['name']; $email = $_POST['email'];
					$subject = $_POST['subject']; $message = $_POST['message'];
					
					if(empty($name) || empty($email)  || 
						empty($subject)  || empty($message)){
							alert("info", "Please enter all required fields");
						}else{
							
						$email_args = array(
						'from' => $email.' <'.$name.'>',
						'to' => $pty_em .'<FrontDesk>',
						'cc' =>'',
						'subject' => $subject,
						'message' =>$message,
						);
						alert("success","Thank you for contacting us, we will get back to you soon.");
					}
				}			
				?>
               </div> 
                
                <div class="form">   
                    <!-- for messages/notifications -->
                    <div id="fields">
                        <form id="contact-form" action="#" method="post" class="form-horizontal">
                        <div class="form-box">
                            <label>
                                Name <small>(required)</small></label>
                            <input type="text" id="name" name="name" class="text" />
                        </div>
                        <div class="form-box">
                            <label>
                                Email <small>(required)</small></label>
                            <input type="text" id="email" name="email" class="text" />
                        </div>
                        <div class="form-box last">
                            <label>
                                Subject
                            </label>
                            <input type="text" id="subject" name="subject" class="text" />
                        </div>
                        <div class="form-box big">
                            <label>
                                Message <small>(required)</small>
                            </label>
                            <textarea id="message" name="message"></textarea>
                        </div>
                        <div class="clearfix">
                        </div>
                        <input type="submit" id="send-message" name="send-message" value="Send Message" class="button medium color" />
                        </form>
                    </div>
                </div>
                <!-- contact form ends -->
            </div>
            
            
            <div class="six columns bottom">
                <h2 class="title bottom-2">
                    Contact Details
                </h2>
                
                <address>
                  <strong><?php echo $property_nm; ?></strong><br>
                  <?php echo $address1; ?><br>
                  <?php if(!empty($address2)){ ?>
                  <?php echo $address2; ?><br>
                  <?php } ?>
                  <?php echo $pty_city .', '.$pty_state .',<br> '.$pty_country.'.'; ?><br><br>
                  
                  <abbr title="Phone">Phone</abbr> :  <?php echo $pty_pn; ?><br>
                  <abbr title="Fax:">Fax</abbr> : <?php echo $pty_fax; ?><br><br>                  
                  
                  <abbr title="Email">Email</abbr> : <a href="mailto:<?php echo $pty_em; ?>"><?php echo $pty_em; ?></a><br>
                  <abbr title="Website">Website</abbr> : <a href="<?php echo $pty_web; ?>"><?php echo $pty_web; ?></a>
                </address>
                
                              
                <!--
                <br>
                 
                <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Sea&amp;aq=&amp;sll=35.101934,-95.712891&amp;sspn=40.301301,86.572266&amp;ie=UTF8&amp;hq=Sea&amp;ll=47.443765,-122.30257&amp;spn=0.065809,0.169086&amp;t=m&amp;z=13&amp;iwloc=A&amp;cid=11084442547078838199&amp;output=embed">
                </iframe>  -->
           
                
                
            </div>
            <div class="clearfix">
            </div>
        </div>

<?php 
include_once("inc/footer.php");
include_once("inc/footag.php"); 
?>