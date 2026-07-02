<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

header("Content-Type: application/json");

session_start();

require_once("../config/database.php");

if(!isset($_SESSION["regno"])){

echo json_encode([

"success"=>false,

"message"=>"Please Login."

]);

exit();

}

$regno=$_SESSION["regno"];

$stmt=$conn->prepare("SELECT fullname FROM users WHERE regno=?");

$stmt->bind_param("s",$regno);

$stmt->execute();

$result=$stmt->get_result();

if($result->num_rows>0){

$user=$result->fetch_assoc();

echo json_encode([

"success"=>true,

"fullname"=>$user["fullname"]

]);

}else{

echo json_encode([

"success"=>false,

"message"=>"User Not Found."

]);

}

$stmt->close();

$conn->close();

?>