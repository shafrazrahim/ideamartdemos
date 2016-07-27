<?php
/*
Author : Shafraz Rahim
*/

ini_set('error_log', 'sms-app-error-demo.log');

include 'lib/SMSSender.php';
include 'lib/SMSReceiver.php';


date_default_timezone_set("Asia/Colombo");


$serverurl= 'http://api.dialog.lk:8080/sms/send';
$password= "XYZ";
$applicationId = "APP_12345";

   	 

try{

	/*************************************************************/

	// Initializing SMS Receiver class object

	$receiver = new SMSReceiver(file_get_contents('php://input'));

	$content =$receiver->getMessage();

	$content=preg_replace('/\s{2,}/',' ', $content); 

	$address = $receiver->getAddress();

	$address = $receiver->getAddress();

	$requestId = $receiver->getRequestID();

	$applicationId = $receiver->getApplicationId();

	/*************************************************************/
	


	// Initializing Sender class object 
	
	$sender = new SMSSender( $serverurl, $applicationId, $password);
	
	

	list($key, $message) = explode(" ",$content);

										
		
	if($message=="push"){

	     $boradmsg = substr($content,9);
       
	     error_log("Broadcast Message ".$content);

	     $response=$sender->broadcastMessage($boradmsg);



	}else{
				

							
	}						



}catch(SMSServiceException $e){


//$logger->WriteLog($e->getErrorCode().' '.$e->getErrorMessage());

}

?>