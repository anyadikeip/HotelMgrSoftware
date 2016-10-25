<?php 
# Other things ===========================================
$back_dir = "../";

# Fetch data from property_setup ========================
$qry_setup=mysql_query("SELECT * FROM property_setup 
WHERE rec_type='setup'") or die(mysql_error());
while($setup=mysql_fetch_array($qry_setup)){
	$property_nm = $setup['property_nm'];
	$address1 = $setup['address1']; $address2 = $setup['address2'];
	$pty_city = $setup['city']; $pty_state = $setup['state']; 
	$pty_country = $setup['country']; $pty_pn = $setup['pn']; 
	$pty_fax = $setup['fax']; $pty_web = $setup['website'];
	
	$rev_pn = $setup['rev_pn']; $pty_em = $setup['em'];
	$fb_link = $setup['fb_link']; $yt_link = $setup['yt_link'];
	
	$book_condition = $setup['book_condition']; $checkin_policy = $setup['checkin_policy'];
	$can_policy = $setup['can_policy']; $hotel_policy = $setup['hotel_policy'];  
	$hotel_desc = $setup['hotel_desc']; $parking_policy = $setup['parking_policy']; 
	$confirm_msg = $setup['confirm_msg']; 
	
	
	}

# Fetch data from property_setting ======================= 
$qry_setting=mysql_query("SELECT * FROM property_setting 
WHERE settings='settings'") or die("Err: ".mysql_error());
	while($setting=mysql_fetch_array($qry_setting)){
		$site_title = $setting['site_title']; $meta_title = $setting['meta_title'];
		$meta_desc = $setting['meta_desc']; $meta_keyword = $setting['meta_keyword'];
		$slide_title = $setting['slide_title']; $about_menu = $setting['about_menu'];
		
		$analytics_id = $setting['analytics_id']; $widget = $setting['widget'];
		# ------------------------------------------------------------------------------------------
		$res_sms_alert = $setting['res_sms_alert']; $guest_sms_alert = $setting['guest_sms_alert'];
		$respt_sms_no = $setting['respt_sms_no']; 
		# ------------------------------------------------------------------------------------------
		$res_em_alert = $setting['res_em_alert']; $guest_em_alert = $setting['guest_em_alert'];
		$rev_em = $setting['rev_em'];
		# ------------------------------------------------------------------------------------------
		$master = $setting['master']; $visa = $setting['visa']; $verve = $setting['verve'];
		$disabled = $setting['disabled']; $promo_rate = $setting['promo_rate']; 
		# ------------------------------------------------------------------------------------------
		
				
	}




	

	
?>