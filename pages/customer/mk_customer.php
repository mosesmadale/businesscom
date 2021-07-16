<?php

if(isset($_POST['submit'])){

    include_once '../assets_global/connection.php';
    session_start();
    //creating a function to handle errors during validation
    function err($message){
        $_SESSION['err-cust-main'] = $message;
        header('Location: register.php');
        exit();
    }
    

    //grabbing all the inputs from the form and producing a 6-digit code for verification
    $randomid = mt_rand(100000,999999);
    $customer_name = $_POST['customer-name'];
    $business_name = $_POST['business'];
    $phone_number = $_POST['phone-number'];

    //validation

    //checking if customer name already exists in a certain business
    $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_name = ? AND business_name = ?");
    $stmt->bind_param('ss', $customer_name, $business_name);
    $stmt->execute();
    $stmt->store_result();
    if (!($stmt->num_rows > 0)) {
        //checking if the phone number satifies the length
        if(strlen($phone_number) == 12){
            
            //everything is now verified so all variables get stored in session super globals
            $_SESSION['business'] = $business_name;
            $_SESSION['code'] = $randomid;
            $_SESSION['number'] = $phone_number;
            $_SESSION['customer'] = $customer_name;
            $conn->close();
            $stmt->close();
            header('Location: send_con_sms.php');
            exit();
        }else{
            err('Phone number is invalid, it needs to be 12 characters!');
            $conn->close();
            $stmt->close();
        }
    }else{
        err("A Cusomter with that name already exsists in $business_name! Please think of another name!");
        $conn->close();
        $stmt->close();
    }

}else{
    header('Location: register.php');
    exit();
}