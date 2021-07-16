<?php

session_start();
include_once '../assets_global/connection.php';

function err($message){
    $_SESSION['err-login'] = $message;
    header('Location: login.php');
    exit();
}



if(isset($_POST['submit'])){

    $business = $_POST['business-name'];
    $code = $_POST['code'];

    $stmt = $conn->prepare("SELECT pass_code FROM business WHERE business_name = ?");
    $stmt->bind_param('s', $business);
    $stmt->execute();
    #store the result so we can check if this account exsists in the table
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($correct_code);
        $stmt->fetch();
        if($correct_code == $code){
            //user is authenticated!
            session_regenerate_id();
            $_SESSION['logged_in_user'] = $business;
            header('Location: ../app/send/send.php');
            $stmt->close();
            $conn->close();
            exit();
        }else{
            err('Business does not exsist in BusinessCom or the code is incorrect!');
        }
    }else{
        err('Business does not exsist in BusinessCom or the code is incorrect!');
    }

}else{
    header('Location: login.php');
    exit();
}