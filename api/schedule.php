<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$course=trim($data["course"] ?? "");
$day=trim($data["day"] ?? "");
$time=trim($data["time"] ?? "");
$venue=trim($data["venue"] ?? "");

if($course=="" || $day=="" || $time=="" || $venue==""){

    echo json_encode([
        "success"=>false,
        "message"=>"All fields are required."
    ]);

    exit();

}

$regno=$_SESSION["regno"];

$stmt=$conn->prepare("INSERT INTO schedules(regno,course,day,time,venue)
VALUES(?,?,?,?,?)");

$stmt->bind_param("sssss",$regno,$course,$day,$time,$venue);

if($stmt->execute()){

    echo json_encode([
        "success"=>true,
        "message"=>"Schedule Saved Successfully."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Unable to Save Schedule."
    ]);

}

$stmt->close();

$conn->close();

?>