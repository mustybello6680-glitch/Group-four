<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

session_start();

require_once("../config/database.php");

// Check if user is logged in
if (!isset($_SESSION["regno"])) {

    echo json_encode([
        "success" => false,
        "message" => "Please login first."
    ]);

    exit();

}

$regno = $_SESSION["regno"];

// Get user information
$stmt = $conn->prepare("SELECT fullname, regno, email, phone, faculty, department, level FROM users WHERE regno = ?");

$stmt->bind_param("s", $regno);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    echo json_encode([
        "success" => true,
        "fullname" => $user["fullname"],
        "regno" => $user["regno"],
        "email" => $user["email"],
        "phone" => $user["phone"],
        "faculty" => $user["faculty"],
        "department" => $user["department"],
        "level" => $user["level"]
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "User not found."
    ]);

}

$stmt->close();

$conn->close();

?>