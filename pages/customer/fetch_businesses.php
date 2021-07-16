<?php
//fetching universal connection file to reduce code repetition
include_once '../assets_global/connection.php';


//preparing sql statements to prevent sql injections
$stmt = $conn->prepare("SELECT * FROM business");
$stmt->execute();
$result = $stmt->get_result();

//business array declared
$businesses = [];

while ($row = $result->fetch_assoc()) {
    $businesses[] = $row['business_name'];
}

//using json format so that javascript will be able to understand the data format
echo json_encode($businesses);

//closing all database connections and sql statements to make the security better
$stmt->close();
$conn->close();
//preventing anything else from being executed if any after all the connection to the database is closed
exit();

