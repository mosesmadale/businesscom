<?php

session_start();

include_once '../assets_global/connection.php';

function err($message){
    $_SESSION['err-sub'] = $message;
    header('Location: auth_2.php');
    exit();
}

//statement to check if the user accessed the page correctly
if(isset($_POST['submit'])){

    $business = $_SESSION['business'];
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
            //user got the incorrect code
            err('Incorrect Code!');
        }
    }else{
        err('Something in the server went wrong!');
    }

}else{
    header('Location: auth_2.php');
    exit();
}

