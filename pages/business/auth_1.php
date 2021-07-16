<?php

session_start();

$randomid = $_SESSION['code'];
$phone_number = $_SESSION['number'];
$business_name = $_SESSION['business'];

//this file is for appending the user to the database
include_once '../assets_global/connection.php';

//all validation is passed so a new business is added to the database
$stmt = $conn->prepare("INSERT INTO business (business_name, business_tell_number, pass_code) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $business_name, $phone_number, $randomid);
$stmt->execute();


//starting a new sesstion
session_regenerate_id();

//setting the session so the php scripts later on will be able to know which business is logged in.
$_SESSION['business'] = $business_name;

//closing all statements and connections to the database
$stmt->close();
$conn->close();

header('Location: auth_2.php');
exit();