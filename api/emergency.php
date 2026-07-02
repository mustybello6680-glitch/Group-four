<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

header("Content-Type: application/json");

session_start();

require_once("../config/database.php");

if(!isset($_SESSION["regno"])){

    echo json_encode([
        "success"=>false,
        "message"=>"Please login first."
    ]);

    exit();

}

$data=json_decode(file_get_contents("php://input"),true);

$type=trim($data["type"] ?? "");
$location=trim($data["location"] ?? "");
$description=trim($data["description"] ?? "");

if($type==""||$location==""||$description==""){

    echo json_encode([
        "success"=>false,
        "message"=>"All fields are required."
    ]);

    exit();

}

$regno=$_SESSION["regno"];

$stmt=$conn->prepare("INSERT INTO emergency(regno,type,location,description)
VALUES(?,?,?,?)");

$stmt->bind_param(
"ssss",
$regno,
$type,
$location,
$description
);

if($stmt->execute()){

    echo json_encode([
        "success"=>true,
        "message"=>"Emergency Alert Sent Successfully."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Unable to Send Alert."
    ]);

}

$stmt->close();

$conn->close();

?>