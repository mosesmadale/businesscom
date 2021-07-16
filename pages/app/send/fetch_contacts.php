<?php

//fetching universal connection file to reduce code repetition
include_once '../../assets_global/connection.php';

$hint = $_GET['hint'];
$business = $_GET['business'];



//preparing sql statements to prevent sql injections
$stmt = $conn->prepare("SELECT * FROM customers WHERE business_name = ? AND customer_name LIKE '%$hint%'");
$stmt->bind_param('s',$business);
$stmt->execute();
$result = $stmt->get_result();

//contacts array declared
$contacts = [];


//while loop to iterate over the result and push into the contacts array an associative array with the customer name and customer number
while ($row = $result->fetch_assoc()) {
    $contacts[] = array('name'=>$row['customer_name'], 'number'=>$row['customer_tell_number']);
}

//using json format so that javascript will be able to understand the data format
echo json_encode($contacts);

//closing all connections and statements to increase security level
$stmt->close();
$conn->close();

exit();