<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Settings 
    <small><!--Control panel --></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Settings</li>
  </ol>
</section>


<section class="content">       
  <!-- Main row -->
  <div class="row">        
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          	<form class="form-horizontal" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" name="settings">
            <div class="nav-tabs-custom">
            
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs"><!-- pull-right -->
              <li class="active"><a href="#general" data-toggle="tab">General</a></li>
              <li class=""><a href="#email" data-toggle="tab">Email / SMS</a></li>
              <li><a href="#payopt" data-toggle="tab">Payment Options</a></li>
              <li><a href="#siteopt" data-toggle="tab">Site Options</a></li>
              
              <li class=" pull-right header"> <button class="btn btn-danger"  name="update_settings" value="">Update</button></li>  
            </ul>
            
            <div class="tab-content no-padding">
            
            <!--Detail Tab -->
              <div class="chart tab-pane active" id="general">
                  <div class="box-body">
                  
                  <?php 
				  	if(isset($_POST['update_settings'])){
						# Collect Variables 
						$site_title = $_POST['site_title']; $meta_title = $_POST['meta_title'];
						$meta_desc = mysql_real_escape_string ($_POST['meta_desc']); 
						$meta_keyword = mysql_real_escape_string ($_POST['meta_keyword']);						
						$tracking_id = mysql_real_escape_string ($_POST['tracking_id']); 
						$adwords_std_code = mysql_real_escape_string ($_POST['adwords_std_code']);
						$adwords_conv_code = mysql_real_escape_string ($_POST['adwords_conv_code']); 
						$widget = mysql_real_escape_string ($_POST['widget']);
						
						#------------------------------------------------------------------------------------
						$rev_em = $_POST['rev_em']; $res_em_alert = $_POST['res_em_alert'];
						$guest_em_alert = $_POST['guest_em_alert']; $sms_domain = $_POST['sms_domain'];						
						$api = $_POST['api']; $base_em = $_POST['base_em']; $subac = $_POST['subac']; 
						$sub_pw = $_POST['sub_pw']; $sender_id = $_POST['sender_id'];
						$res_sms_alert = $_POST['res_sms_alert']; $respt_sms_no = $_POST['respt_sms_no'];
						$guest_sms_alert = $_POST['guest_sms_alert']; 
						
						$slide_title = $_POST['slide_title']; $about_menu = $_POST['about_menu'];
						
						#------------------------------------------------------------------------------------
						$master = $_POST['master']; $visa = $_POST['visa']; $verve = $_POST['verve']; 
						$disabled = $_POST['disabled']; $promo_rate = $_POST['promo_rate'];
						
						# Validate input Variables =====================================================================
						if(empty($site_title)){echo alert("info", "Please enter your site title.");}
						elseif(empty($meta_title)){echo alert("info", "Meta title is required.");}
						elseif(empty($meta_desc)){echo alert("info", "Please enter meta description for your site.");}
						elseif(empty($meta_keyword)){echo alert("info", "Enter key words for your site to be easily found online");
						
						}else{
							# Update property details with new data ====================================================											
							mysql_query("UPDATE property_setting SET site_title='$site_title', meta_title='$meta_title', 
							meta_desc='$meta_desc', meta_keyword='$meta_keyword', analytics_id='$tracking_id', 
							adword_std='$adwords_std_code', adword_conv='$adwords_conv_code', slide_title='$slide_title',
							widget='$widget', about_menu='$about_menu',							
							
							rev_em='$rev_em', res_em_alert='$res_em_alert', guest_em_alert='$guest_em_alert', 
							sms_domain='$sms_domain', api='$api',base_em='$base_em', subac='$subac', sub_pw='$sub_pw', 
							sender_id='$sender_id', res_sms_alert='$res_sms_alert',respt_sms_no='$respt_sms_no', 
							guest_sms_alert='$guest_sms_alert', master='$master', visa='$visa', verve='$verve', 
							disabled='$disabled', promo_rate='$promo_rate'							
							
							WHERE settings='settings'") or 
							die(mysql_error()); echo alert("success", "Property settings was successfully updated.");
							//echo '<meta http-equiv="refresh" content="0; settings.php">';	
						}						
					}				  
				  ?>
                  
                  
                  
                  <?php
					# check if the setup record exist in the database, otherwise insert it.
					try { 
						$query=mysql_query("SELECT * FROM property_setting WHERE settings='settings'") or die(mysql_error());
						if(mysql_num_rows($query) == 0){
							mysql_query("INSERT INTO property_setting SET settings='settings'") or die(mysql_error());		
						}else{
							while($row=mysql_fetch_array($query)){
							# Session input variables ==========================================================================
							$_SESSION['site_title'] = $row['site_title']; $_SESSION['meta_title'] = $row['meta_title'];
							$_SESSION['meta_desc'] = $row['meta_desc']; $_SESSION['meta_keyword'] = $row['meta_keyword']; 			
							$_SESSION['tracking_id'] = $row['analytics_id']; $_SESSION['adwords_std_code'] = $row['adword_std']; 
							$_SESSION['adwords_conv_code'] = $row['adword_conv']; $_SESSION['widget'] = $row['widget'];
							$slide_title = $row['slide_title'];
							
							# ------------------------------------------------------------------------------------------------- 
							$_SESSION['rev_em'] = $row['rev_em']; $res_em_alert = $row['res_em_alert'];
							$guest_em_alert = $row['guest_em_alert']; $guest_em_alert = $row['guest_em_alert']; 			
							$_SESSION['sms_domain'] = $row['sms_domain']; $_SESSION['api'] = $row['api']; $_SESSION['base_em'] = $row['base_em'];
							$_SESSION['subac'] = $row['subac']; $_SESSION['sub_pw'] = $row['sub_pw']; $_SESSION['sender_id'] = $row['sender_id'];							 							$res_sms_alert = $row['res_sms_alert']; $_SESSION['respt_sms_no'] = $row['respt_sms_no'];							
							$guest_sms_alert = $row['guest_sms_alert']; 
							
							# ------------------------------------------------------------------------------------------------- 
							$master = $row['master']; $visa = $row['visa']; $verve = $row['verve']; 
							$disabled = $row['disabled']; $promo_rate = $row['promo_rate'];
							
								
							}		
						}	
					}
					catch(PDOException $e){
						echo $e->getMessage();
					}
					?>
                  
                   	<legend>Meta Keyword setting</legend>
                    
                    <div class="form-group">
                        <label for="site_title" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-5">
                           <div id="vmsg"></div>
                        </div>
                      </div>
                    
                  
                      <div class="form-group">
                        <label for="site_title" class="col-sm-2 control-label">Site title:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="site_title" id="site_title" 
                          value="<?php echo $_SESSION['site_title']; ?>" placeholder="Welcome to Le-Prime ">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="meta_title" class="col-sm-2 control-label">Meta Title:</label>
                        <div class="col-sm-5">
                          <textarea class="form-control" name="meta_title" id="meta_title" 
                          rows="1"><?php echo $_SESSION['meta_title']; ?></textarea>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label for="meta_desc" class="col-sm-2 control-label">Meta Description:</label>
                        <div class="col-sm-5">
                          <textarea class="form-control" name="meta_desc" id="meta_desc" 
                          rows="1"><?php echo $_SESSION['meta_desc']; ?></textarea>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword:</label>
                        <div class="col-sm-5">
                          <textarea class="form-control" name="meta_keyword" id="meta_keyword" 
                          rows="1"><?php echo $_SESSION['meta_keyword']; ?></textarea>
                        </div>
                      </div>
                      
                    <br>   
                    <legend>Google Code setting</legend> 
                    
                    <div class="form-group">
                        <label for="tracking_id" class="col-sm-2 control-label">Google Analytics id:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control"  value="<?php echo $_SESSION['tracking_id']; ?>" 
                          name="tracking_id" id="" placeholder="Eg: 'UA-43042689-3">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="adwords_std_code" class="col-sm-2 control-label">Google Adwords standard code:</label>
                        <div class="col-sm-5">
                          <textarea class="form-control" name="adwords_std_code" rows="3"><?php echo $_SESSION['adwords_std_code']; ?></textarea>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label for="adwords_conv_code" class="col-sm-2 control-label">Google Adwords Conversion code:</label>
                        <div class="col-sm-5">
                          <textarea class="form-control" name="adwords_conv_code" rows="3"><?php echo $_SESSION['adwords_conv_code']; ?></textarea>
                        </div>
                      </div>
                      
                       <br>   
                    <legend>Footer Widget</legend> 
                    
                    <div class="form-group">
                     <label for="adwords_conv_code" class="col-sm-2 control-label">Eg: TripAdvisor etc</label>
                     <div class="col-sm-5">
                       <textarea class="form-control" name="widget" rows="3"><?php echo $_SESSION['widget']; ?></textarea>
                     </div>
                    </div>
                      
                  </div><!-- /.box-body -->  
              </div><!-- Detail Tab-->
             
              
              
              <!--Address Tab -->
              <div class="chart tab-pane" id="email">                
                <div class="box-body">
                
                 <legend>Email</legend>
                 
                 	<div class="row">
                    
                      <div class="col-md-6">                      
                       <div class="form-group">
                            <label for="rev_em" class="col-sm-3 control-label">Res Email:</label> 
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo $_SESSION['rev_em']; ?>" 
                              name="rev_em" placeholder="Enter reservation email(s)">
                              <span class="help-block">Seperate email with comma if more than one.</span>
                            </div>
                          </div>
                      </div>                    
                    
                    <div class="col-md-6">
                    	<div class="checkbox">
                          <label>
                            <input type="checkbox" name="res_em_alert" <?php if($res_em_alert==1){echo 'checked';}?> value="1">
                            Send Email notification to <strong>reservation email(s)</strong> for new reservation
                          </label>
                          <br /> <br /> 
                        
                          <label>
                            <input type="checkbox" name="guest_em_alert" <?php if($guest_em_alert==1){echo 'checked';}?> value="1">
                            Email reservation summary to <strong>guest</strong> for successful reservation
                          </label>
                          <br /> 
                        </div>                        
                    </div>
                    
                 </div><!--/row -->	              
                               
                 
                 <legend>SMS</legend>
                 	<div class="row">
                      <div class="col-md-6">
                      
                      	  <div class="form-group">
                            <label for="api" class="col-sm-3 control-label">SMS Domain:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="sms_domain">
                                  <option selected="selected" value="<?php echo $_SESSION['sms_domain']; ?>">
                                  	<?php echo $_SESSION['sms_domain']; ?>
                                  </option>
                                  <option value="smsluxury.com">smsluxury.com</option>
                                </select>
                            </div>
                          </div>
                                            
                      	  <div class="form-group">
                            <label for="api" class="col-sm-3 control-label">SMS API:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="api" value="<?php echo $_SESSION['api']; ?>" name="api">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="base_em" class="col-sm-3 control-label">Base Email:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="base_em" value="<?php echo $_SESSION['base_em']; ?>" name="base_em">
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="subac" class="col-sm-3 control-label">Sub Account:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="subac" value="<?php echo $_SESSION['subac']; ?>" name="subac">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="sub_pw" class="col-sm-3 control-label">Password:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="sub_pw" value="<?php echo $_SESSION['sub_pw']; ?>" name="sub_pw">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="sender_id" class="col-sm-3 control-label">Sender ID:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sender_id" value="<?php echo $_SESSION['sender_id']; ?>" name="sender_id">
                            </div>
                          </div>
                          
                      
                      </div>
                      
                      
                      <div class="col-md-6">
                      
                      	<div class="checkbox">
                          <label>
                          	<input type="checkbox" <?php if($res_sms_alert==1){echo 'checked';}?> name="res_sms_alert" value="1">
                            Send SMS notification to <strong>receptionist number(s)</strong> for new reservation
                          </label>
                          <br /> <br />
                        </div>                          
                          
                          <div class="form-group">
                            <!--<label for="respt_no" class="col-sm-3 control-label">Receptionist No:</label> -->
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="respt_sms_no" 
                              value="<?php echo $_SESSION['respt_sms_no']; ?>" placeholder="Enter receptionist number(s)">
                              <span class="help-block">Seperate numbers with comma if more than one.</span>
                            </div>
                          </div>
                          
                         <div class="checkbox">
                          <label>
                          	<input type="checkbox" <?php if($guest_sms_alert==1){echo 'checked';}?> name="guest_sms_alert" value="1">
                            Send reservation summary to <strong>guest</strong> for  successful reservation
                          </label>
                          <br /> <br /> <br />
                        </div>  
                      
                      </div>
                    </div><!-- end of row -->
                 
                
               </div><!-- box-body -->
              </div><!-- /Address Tab -->
              
              
              <!--Payment Option Tab -->
              <div class="chart tab-pane" id="payopt">
              	<div class="box-body">
                
                	<br />
                    <div class="checkbox">
                    &nbsp;  &nbsp;  &nbsp; 
                      <label>
                        <input type="checkbox" <?php if($master==1){echo 'checked';}?> name="master" value="1">
                        Master Card
                      </label>
                      
                       &nbsp;  &nbsp;  &nbsp; 
                      <label>
                        <input type="checkbox" <?php if($visa==1){echo 'checked';}?> name="visa" value="1">
                        Visa Card
                      </label>
                                            
                      &nbsp;  &nbsp;  &nbsp; 
                      
                      <label>
                        <input type="checkbox" <?php if($verve==1){echo 'checked';}?> name="verve" value="1">
                        Verve Card
                      </label>
                    </div>    
                    
                    <br />   <br />    
              	</div>
              </div>
              
              
              
            <!--Site Option Tab -->
            <div class="chart tab-pane" id="siteopt">
              <div class="box-body">
              	
                 <br>   
                <legend>More Control</legend>                     
                <div class="row">
                  <div class="col-md-6"> &nbsp;  &nbsp;  &nbsp; 
                    <label>
                        <input type="checkbox" name="slide_title" <?php if($slide_title==1){echo 'checked';}?> value="1">
                        Show slide title 
                    </label>  &nbsp;  &nbsp;  &nbsp; 
                    
                    <label>
                        <input type="checkbox" name="about_menu" <?php if($about_menu==1){echo 'checked';}?> value="1">
                        Show About Us Menu 
                    </label>  &nbsp;  &nbsp;  &nbsp;  
                  
                  </div>
                  
                  
                  <div class="col-md-6">   
                  	<label>
                        <input type="checkbox" <?php if($disabled==1){echo 'checked';}?> name="disabled" value="1">
                        Show <u>Disabled</u> icon on footer
                    </label> &nbsp;  &nbsp;  &nbsp; 
                    
                    <label>
                        <input type="checkbox" <?php if($promo_rate==1){echo 'checked';}?> name="promo_rate" value="1">
                        Show promo rate on site
                    </label>
                    
                  
                  
                  </div>
                  
                </div>
              
              
              </div>
            </div>
            
            
            
            
        		
            </div><!-- tab-content no-padding -->            
            </div><!-- /.nav-tabs-custom -->            
        	</form>
        </section>
  </div><!-- /.row (main row) -->          
</section><!-- /.content -->   

<script>
function validateForm(){
	var site_title = document.forms["settings"]["site_title"].value;
	var meta_title = document.forms["settings"]["meta_title"].value;
	var meta_desc = document.forms["settings"]["meta_desc"].value;
	var meta_keyword = document.forms["settings"]["meta_keyword"].value;
	var vmsg = document.getElementById('vmsg').value;
	
	if (site_title == null || site_title == "") {		
        document.getElementById("vmsg").innerHTML = "<div style='color:red;'>Enter your site title; This shows at the top of titlt bar.</div>";
        return false;
    }else if (meta_title == null || meta_title == "") {
        document.getElementById("vmsg").innerHTML = "<div style='color:red;'>Enter site meta_title; This might be same as  site title.</div>";
        return false;
    }else if (meta_desc == null || meta_desc == "") {
        document.getElementById("vmsg").innerHTML = "<div style='color:red;'>Enter site meta description.</div>";
        return false;
    }else if (meta_keyword == null || meta_keyword == "") {
        document.getElementById("vmsg").innerHTML = "<div style='color:red;'>Enter key words for your site to be easily found online.</div>";
        return false;
    }	
	
}
</script>