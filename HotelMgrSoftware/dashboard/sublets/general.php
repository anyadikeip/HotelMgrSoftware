<?php 
session_start(); ob_start();
include("connection.php");

# ---------------------------------------------------
$constant=mysql_query("SELECT * FROM property_setting 
WHERE settings='settings'") or die("Err: ".mysql_error());
	while($var=mysql_fetch_array($constant)){
	define("ONWNERMAIL", htmlspecialchars(trim($var['base_em']))); define("SUBACCT", trim($var['subac']));
	define("SUBACCTPWD", trim($var['sub_pw'])); define("SENDER", $var['sender_id']);
}

#----------------------------------------------------
# dynamic notification
#----------------------------------------------------
function alert($alertype, $msg){
echo '<div class="alert alert-'.$alertype.'" alert-dismissible role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
'.$msg.'</div>';}

#----------------------------------------------------
# Toggle Access  
#----------------------------------------------------
function toggle_access($table, $skey, $column){
	$query=mysql_query("SELECT * FROM {$table} WHERE 
	id='$skey'") or die(mysql_error());
	while($row=mysql_fetch_array($query)){$col=$row[$column];}
		
	if($col==0){$new_value=1;}elseif($col==1){$new_value=0;}
	mysql_query("UPDATE {$table} SET {$column}='$new_value' 
	WHERE id='$skey'");			
	echo alert('success','Operation was performed successfully.'); 
}

#----------------------------------------------------
# Delete database item
#----------------------------------------------------
function delete_item($table, $ref){$ref=intval($ref);
	mysql_query("DELETE FROM {$table} WHERE id='$ref'") or die(mysql_error());
	echo alert('success','Selected record deleted successfully');
}

#----------------------------------------------------
# Delete database item / Image from folder
#----------------------------------------------------
function deleteimg($table, $ipax, $folder, $folder1, $filename){
$qry=mysql_query("SELECT * FROM {$table} WHERE id='$ipax'") or 
die("Unable to get image path " . mysql_error());
	while($row=mysql_fetch_array($qry)){
	$file=$folder.$row[$filename]; $file1=$folder1.$row[$filename]; 
	}	
    if(is_file($file) || is_file($file1)){
	   @unlink($file); @unlink($file1);
	   delete_item($table, $ipax);  
	}  	
}

#----------------------------------------------------
# Make menu active
#----------------------------------------------------
function active_menu($link){
	$page = basename($_SERVER['PHP_SELF']);
	if($page == $link){
		return 'active';
	}	
}

#----------------------------------------------------
# Get value from record using record ID
#----------------------------------------------------
function get_value_using_id($table, $ser_id, $output){
$rst=mysql_query("SELECT * FROM {$table} WHERE id='$ser_id'")  or 
die("Unable to load {$table} table " . mysql_error());
while($row=mysql_fetch_array($rst)){return $row[$output];}}

#----------------------------------------------------
# Populate combo from db
#----------------------------------------------------
function load_combo_list($table, $column){
$qry=mysql_query("SELECT * FROM {$table} WHERE 
status = 0 ORDER BY {$column} ASC") or die(mysql_error());
while($row=mysql_fetch_array($qry)){	
echo '<option value='.$row[id].'>'.$row[$column].'</option>';}
}

#----------------------------------------------------
# Get record count using one condition
#----------------------------------------------------
function recordcount($table, $sid, $quotient){
$count= mysql_query("SELECT * FROM {$table} WHERE {$sid}='$quotient'");
if(!$count){die("Cant query the {$table} table " . mysql_error());}
return mysql_num_rows($count);}

#----------------------------------------------------
# Get record count using one condition <
#----------------------------------------------------
function recordcount1($table, $sid, $quotient){
$count= mysql_query("SELECT * FROM {$table} WHERE {$sid} > '$quotient'");
if(!$count){die("Cant query the {$table} table " . mysql_error());}
return mysql_num_rows($count);}
#----------------------------------------------------
# Generate random string
#----------------------------------------------------
function generateRandomString($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz
	ABCDEFGHIJKLMNOPQRSTUVWXYZ'; $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


#================================================
# USE FOR TEXT WRAPPING STRING
#================================================
function myWrap($input, $chars, $lines = false)
  {
    # the simple case - return wrapped words
    if(!$lines) return wordwrap($input, $chars, "\n");

    # truncate to maximum possible number of characters
    $retval = substr($input, 0, $chars * $lines);

    # apply wrapping and return first $lines lines
    $retval = wordwrap($retval, $chars, "\n");
    preg_match("/(.+\n?){0,$lines}/", $retval, $regs);
    return $regs[0];
}

#================================================
# Send PHP HTML email 1
#================================================
function php_html_email($email_args) {
    $headers  = 'MIME-Version: 1.0' . "rn";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "rn";
    $headers .=  'To:'.$email_args['to'] . "rn";
    $headers .=  'From:'.$email_args['from'] . "rn";
    if(!empty($email_args['cc'])){$headers .= 'Cc:'.$email_args['cc'] . "rn";}
    $message_body = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    $message_body .= '<title>'.$email_args["subject"].'</title>';
    $message_body .= '</head><body>';
    $message_body .= $email_args["message"];
    $message_body .= '</body></html>';
    if(@mail($email_args['to'], $email_args['subject'], $message_body, $headers))
    {
        return true;
    }else{
        return false;
    }
}

# ******USAGE*********
/*$email_args = array(
'from'=>'my_email@testserver.com <mr. Sender>',
'to' =>'test_recipient@testgmail.com <camila>, test_recipient2@testgmail.com <anderson>',
'cc' =>'test_cc123_recipient@testgmail.com <christopher>, test_cc321_recipient2@testgmail.com <francisca>',
'subject' =>'This is my Subject Line',
'message' =>'<b style="color:red;">This</b> is my <b>HTML</b> message. <br />This message will be sent using <b style="color:green;">PHP mail</b>.',
);*/



#================================================
# Send PHP HTML email 2
#================================================

function mailSender($frmEM, $frmNM, $frmCC, $toEM, $toNM, $subj, $msg){
	 $to = $toEM ." <".$toNM.">". " \r\n";
	 $subject = $subj;	 
	 $message = $msg;
	 
	 $header = "From:" .$frmEM ." <".$frmNM.">". " \r\n";
	 $header = "Cc:" . $frmCC . " \r\n";
	 $header .= "MIME-Version: 1.0\r\n";
	 $header .= "Content-type: text/html\r\n";	 
	 mail($to,$subject,$message,$header);
}





#================================================
# Send SMS VIA API 
#================================================
function sendsms($sendto, $message){
	$owneremail=ONWNERMAIL;
	$subacct=SUBACCT;
	$subacctpwd=SUBACCTPWD;
	$sendto=$sendto; /* destination number */
	$sender=SENDER; /* sender id */
	$message=$message; /* message to be sent */
	/* create the required URL */
	$url = "http://www.smsluxury.com/api/index.php?"
	. "cmd=sendquickmsg"
	. "&owneremail=" .$owneremail
	. "&subacct=" .$subacct
	. "&subacctpwd=" .$subacctpwd
	. "&sendto=" . $sendto
	. "&sender=" . UrlEncode($sender)
	. "&message=" . UrlEncode($message)
	. "&msgtype=" . '0';
	/* call the URL */
	if ($f = @fopen($url, "r")){
		$answer = fgets($f, 255);
		/*if (substr($answer, 0, 1) == "+"){
			echo "SMS to $dnr was successful.";
		}else{
			echo "an error has occurred: [$answer].";	
		}*/
	}else{
		echo "Error: URL could not be opened.";
	}
}



























?>


