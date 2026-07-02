<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "campusconnect";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>