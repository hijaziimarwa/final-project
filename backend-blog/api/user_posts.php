<?php
include("../connection.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode([
            "status" => "error",
            "message" => "No user ID provided"
        ]);
        exit;
    }

    $user_id = intval($data['id']);

    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY id DESC LIMIT 10");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    if (!empty($posts)) {
        echo json_encode([
            "status" => "success",
            "data" => $posts
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No posts found"
        ]);
    }

    $stmt->close();
}
?>
