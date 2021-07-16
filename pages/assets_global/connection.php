<?php

//change these when deploying the app on infinity free or show it locally
$host_name = 'localhost';
$db_name = 'bc';
$db_username = 'root';
$db_password = '';

//using OOP to make the code more understanding
$conn = new mysqli($host_name, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die('Connection to database has failed' . mysqli_connect_error());
}