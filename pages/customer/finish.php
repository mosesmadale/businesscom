<?php

session_start();

include_once '../assets_global/connection.php';
//function to make sure that errors to the user are handled carefully and the script cancels being executed after an error has been found
function err($message){
    $_SESSION['err-verifiy-code'] = $message;
    echo $message;
    header('Location: auth_2.php');
    exit();
}
//obtaining all the session variables
$number = $_SESSION['number'];
$customer = $_SESSION['customer'];
$business = $_SESSION['business'];

if(isset($_POST['submit'])){
    $correct_code = $_SESSION['code'];
    $code = $_POST['code'];

    if($code == $correct_code){
        //proceed
        //user has entered the correct code at this point and the success messages are now being made
        $success_message = "The number: $number has been registered on $business as $customer.";
        $success_message2 = "You will now receive notifications $business needs you to receive via SMS.";
        $_SESSION['success_message'] = $success_message;
        $_SESSION['success_message_2'] = $success_message2;
        header('Location: auth_1.php');
        exit();
    }else{
        err('Incorrect Code!');
    }

}else{
    header('Location: auth_2.php');
    exit();
}

