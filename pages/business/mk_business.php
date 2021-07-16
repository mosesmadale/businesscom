<?php

if(isset($_POST['submit'])){

    include_once '../assets_global/connection.php';
    session_start();
    //creating a function to handle errors during validation
    function err($message){
        $_SESSION['err-main'] = $message;
        header('Location: signup.php');
        exit();
    }
    //checking if a person exists with this code and tries to produce the code again
    $code_is_identical = TRUE;

    while($code_is_identical){
        //producing a unique random 6-digit code
        $randomid = mt_rand(100000,999999);
        //changing the code to a string to match database datatypes
        $randomid = strval($randomid);
        $stmt = $conn->prepare("SELECT * FROM business WHERE pass_code = ?");
        $stmt->bind_param('s', $randomid);
        $stmt->store_result();
        if (!($stmt->num_rows > 0)) {
            $code_is_identical = FALSE;
        }
    }

    //grabbing all the inputs from the form

    $business_name = $_POST['business-name'];
    $phone_number = $_POST['phone-number'];

    //validation

    //checking if business name already exists
    $stmt = $conn->prepare("SELECT * FROM business WHERE business_name = ?");
    $stmt->bind_param('s', $business_name);
    $stmt->execute();
    $stmt->store_result();
    if (!($stmt->num_rows > 0)) {
        //checking if the phone number satifies the length
        if(strlen($phone_number) == 12){
            
            $_SESSION['business'] = $business_name;
            $_SESSION['code'] = $randomid;
            $_SESSION['number'] = $phone_number;
            $conn->close();
            $stmt->close();
            header('Location: send_con_sms.php');
            exit();
        }else{
            err('Phone number is invalid, it needs to be 12 characters!');
            $stmt->close();
            $conn->close();
        }
    }else{
        err('Business name already exsists!');
        $stmt->close();
        $conn->close();
    }

}else{
    header('Location: signup.php');
    exit();
}