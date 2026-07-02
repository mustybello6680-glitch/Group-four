<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

require_once("../config/database.php");

// Read JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success"=>false,
        "message"=>"No data received."
    ]);
    exit();
}

// Get Data
$fullname   = trim($data["fullname"]);
$regno      = trim($data["regno"]);
$email      = trim($data["email"]);
$phone      = trim($data["phone"]);
$faculty    = trim($data["faculty"]);
$department = trim($data["department"]);
$level      = trim($data["level"]);
$password   = trim($data["password"]);

// Validate
if(
    empty($fullname) ||
    empty($regno) ||
    empty($email) ||
    empty($phone) ||
    empty($faculty) ||
    empty($department) ||
    empty($level) ||
    empty($password)
){

    echo json_encode([
        "success"=>false,
        "message"=>"Please fill all fields."
    ]);

    exit();

}

// Check Duplicate Registration Number
$check = $conn->prepare("SELECT id FROM users WHERE regno=?");

$check->bind_param("s",$regno);

$check->execute();

$check->store_result();

if($check->num_rows > 0){

    echo json_encode([
        "success"=>false,
        "message"=>"Registration Number already exists."
    ]);

    $check->close();

    exit();

}

$check->close();

// Encrypt Password
$hashedPassword = password_hash($password,PASSWORD_DEFAULT);

// Insert Student
$stmt = $conn->prepare("INSERT INTO users(fullname,regno,email,phone,faculty,department,level,password)
VALUES(?,?,?,?,?,?,?,?)");

$stmt->bind_param(
    "ssssssss",
    $fullname,
    $regno,
    $email,
    $phone,
    $faculty,
    $department,
    $level,
    $hashedPassword
);

if($stmt->execute()){

    echo json_encode([
        "success"=>true,
        "message"=>"Registration Successful."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$stmt->error
    ]);

}

$stmt->close();
$conn->close();

?>