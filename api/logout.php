<?php

session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Return JSON response
header("Content-Type: application/json");

echo json_encode([
    "success" => true,
    "message" => "Logout Successful."
]);

?>