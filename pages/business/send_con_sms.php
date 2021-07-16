<?php
session_start();
$code = $_SESSION['code'];
$number = $_SESSION['number'];
$business = $_SESSION['business'];
$api_key='ea72f00d3ba9f960';
$secret_key = 'MTU2ZTBkYTBiZDhhODEwZjY5ZTNhZGJkOTU1NDMyNjI3YjNkMDdlMjQzMmI5MjYyMWZlMDQ2MTBkNzIxYTJjYQ==';
function err($message){
    $_SESSION['err-main'] = $message;
    header('Location: signup.php');
    exit();
}

//create message string;
$sms = "$business has been registered on BusinessCom and we have sent this code below to verify its you. This code will also be your password everytime you want to log in to BusinessCom as $business. The code is: $code";
$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $sms,
    'recipients' => [['recipient_id' => '1','dest_addr'=>$number]]
);

$Url ='https://apisms.beem.africa/v1/send';

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);

if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
//error handling for the existance of the number
if(strlen($response) == 2){
    err('Invalid number');
}else{
    //number exists so account can now be created
    header('Location: auth_1.php');
    exit();
}