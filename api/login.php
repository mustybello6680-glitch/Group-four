<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

session_start();

require_once("../config/database.php");

// Read JSON sent from JavaScript
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "No data received."
    ]);
    exit();
}

$regno = trim($data["regno"] ?? "");
$password = trim($data["password"] ?? "");

if (empty($regno) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Please enter Registration Number and Password."
    ]);
    exit();
}

// Search for the user
$sql = "SELECT * FROM users WHERE regno = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => $conn->error
    ]);
    exit();
}

$stmt->bind_param("s", $regno);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];
        $_SESSION["regno"] = $user["regno"];

        echo json_encode([
            "success" => true,
            "message" => "Login Successful."
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => "Incorrect Password."
        ]);

    }

} else {

    echo json_encode([
        "success" => false,
        "message" => "No registered account found."
    ]);

}

$stmt->close();
$conn->close();

?>