<?php
session_start();
//obtaining all the sessions and storing them in variables so that messages can be composed dynamically
$code = $_SESSION['code'];
$number = $_SESSION['number'];
$business = $_SESSION['business'];
$customer = $_SESSION['customer'];

//the api key and the secret key
$api_key='ea72f00d3ba9f960';
$secret_key = 'MTU2ZTBkYTBiZDhhODEwZjY5ZTNhZGJkOTU1NDMyNjI3YjNkMDdlMjQzMmI5MjYyMWZlMDQ2MTBkNzIxYTJjYQ==';
//function to make sure the user gets informed of the errors
function err($message){
    $_SESSION['err-cust-main'] = $message;
    header('Location: register.php');
    exit();
}


//create message string;
$sms = "Dear $customer, we thank you for choosing BusinessCom to connect with $business. There is one step left to complete your registration, just enter the code below on the form that has just come on your browser. The code is: $code";
$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $sms,
    'recipients' => [['recipient_id' => '1','dest_addr'=>$number]]
);
//api endpoint
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
    echo 'Please Check your internet connection!';
}

//conditional to check if the number the user entered is actually a registered valid number
if(strlen($response) == 2){
    header('Location: finish_fail.php');
    exit();
}else{
    header('Location: auth_2.php');
    exit();
}