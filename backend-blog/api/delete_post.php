<?php
include("../conn.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode([
            "status" => "error",
            "message" => "No user ID provided"
        ]);
        exit;
    }

    $post_id = $data['id'];
    $stmt_comments = $mysqli->prepare("DELETE FROM comments WHERE post_id = ?");
    $stmt_comments->bind_param("i", $post_id);
    $stmt_comments->execute();
    $stmt_comments->close();
    $stmt = $mysqli->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Post deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to delete post"
        ]);
    }

    $stmt->close();
}
?>
