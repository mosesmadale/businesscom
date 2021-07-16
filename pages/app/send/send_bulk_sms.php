<?php

//starting a session to access predefined variables
session_start();
//accessing the currently logged in business
$business = $_SESSION['logged_in_user'];

include_once '../../assets_global/connection.php';


//checking if user accessed the page illegaly
if(isset($_POST['submit'])){

    //grabbing the list of recipients and converting the from json format to php arrays and objects
    $recipients = json_decode($_POST['recipients']);
    //grabbing the sms as text
    $sms = $_POST['sms'];

    //initializing the recipients array
    $recipients_arr = [];
    $id = 1;
    foreach($recipients as $recipient){
        //pushing into the array in the format of the beem api for the list of recipients
        $recipients_arr[] = ['recipient_id' => "$id",'dest_addr'=>$recipient->number];
        $id++;
    }

    echo '<pre>';
    var_dump($recipients_arr);
    echo '</pre>';

    //api and secret keys
    $api_key='ea72f00d3ba9f960';
    $secret_key = 'MTU2ZTBkYTBiZDhhODEwZjY5ZTNhZGJkOTU1NDMyNjI3YjNkMDdlMjQzMmI5MjYyMWZlMDQ2MTBkNzIxYTJjYQ==';
    $postData = array(
        'source_addr' => 'INFO',
        'encoding'=>0,
        'schedule_time' => '',
        'message' => $sms,
        'recipients' => $recipients_arr
    );
    //beem sms api end point
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

        //saving the message to the database for reference as inbox

    $stmt = $conn->prepare("INSERT INTO messages (business_name, message_data) VALUES (?, ?)");
    $stmt->bind_param('ss', $business, $sms);
    $stmt->execute();

    header('Location: ../view/view.php');

}else{
    header('Location: send.php');
    exit();
}