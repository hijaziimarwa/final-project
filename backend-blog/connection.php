<?php

$mysqli = new mysqli("localhost", "root", "", "blog");

if ($mysqli->connect_error) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode([
        "status" => "failed",
        "message" => "Failed to connect to database"
    ]);
    exit;
}
echo json_encode([
    "status" => "success",
    "message" => "Connected to the database"
]);
?>