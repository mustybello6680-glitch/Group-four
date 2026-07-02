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

$item=trim($data["item"] ?? "");
$category=trim($data["category"] ?? "");
$description=trim($data["description"] ?? "");
$location=trim($data["location"] ?? "");

if($item==""||$category==""||$description==""||$location==""){

    echo json_encode([
        "success"=>false,
        "message"=>"All fields are required."
    ]);

    exit();

}

$regno=$_SESSION["regno"];

$stmt=$conn->prepare("INSERT INTO lostfound(regno,item,category,description,location)
VALUES(?,?,?,?,?)");

$stmt->bind_param(
"sssss",
$regno,
$item,
$category,
$description,
$location
);

if($stmt->execute()){

    echo json_encode([
        "success"=>true,
        "message"=>"Report Submitted Successfully."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Unable to Submit Report."
    ]);

}

$stmt->close();

$conn->close();

?>