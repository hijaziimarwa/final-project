<?php
include("../conn.php");
header("Content-type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode([
            "status" => "error",
            "message" => "No post ID provided"
        ]);
        exit;
    }

    $id =$data['id'];

    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($post = $result->fetch_assoc()) {
        echo json_encode([
            "status" => "success",
            "data" => $post
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Post not found"
        ]);
    }

    $stmt->close();


}
?>
