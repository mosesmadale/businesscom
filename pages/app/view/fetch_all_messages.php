<?php
session_start();
//fetching universal connection file to reduce code repetition

include_once '../../assets_global/connection.php';

$business = $_SESSION['logged_in_user'];

//preparing sql statements to prevent sql injections
$stmt = $conn->prepare("SELECT * FROM messages WHERE business_name=?");
$stmt->bind_param('s',$business);
$stmt->execute();
$result = $stmt->get_result();

//business array declared
$messages = [];


//while loop to interate over all the messages ever sent by the current business
while ($row = $result->fetch_assoc()) {
    $messages[] = array('message-data'=>$row['message_data'], 'date'=>$row['date']);
}

//using json format so that javascript will be able to understand the data format
echo json_encode($messages);

//closing the statement and closing the connection to increase security
$stmt->close();
$conn->close();

exit();

