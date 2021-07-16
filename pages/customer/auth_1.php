<?php

session_start();

$customer_name = $_SESSION['customer'];
$phone_number = $_SESSION['number'];
$business_name = $_SESSION['business'];

//this file is for appending the user to the database
include_once '../assets_global/connection.php';
//all validation is passed so a new business is added to the database
$stmt = $conn->prepare("INSERT INTO customers (business_name, customer_tell_number, customer_name) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $business_name, $phone_number, $customer_name);
$stmt->execute();


//information that the customer has successfully registered their number and name on the desired company
$success_message = $_SESSION['success_message'];
$success_message2 = $_SESSION['success_message_2'];

session_regenerate_id();

$stmt->close();
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets_global/bc.css">
    <title>Complete registration</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div class="main">BC</div>
            <div class="sub">Business Com</div>
        </div>
        <div class="text"><?php echo $success_message; ?></div>
        <div class="text"><?php echo $success_message2; ?></div>
        <form action="../home/" method="POST">
            <button type="submit">Home</button>
        </form>
    </div>
</body>

</html>