<?php
include("../conn.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode([
            "status" => "error",
            "message" => "No post ID provided"
        ]);
        exit;
    }

    $post_id = $data['id'];
    $stmt_post = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt_post->bind_param("i", $post_id);
    $stmt_post->execute();
    $result_post = $stmt_post->get_result();

    if (!$result_post || $result_post->num_rows === 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Post not found"
        ]);
        exit;
    }

    $post = $result_post->fetch_assoc();
    $stmt_comments = $mysqli->prepare("SELECT * FROM comments WHERE post_id = ?");
    $stmt_comments->bind_param("i", $post_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();

    $comments = [];
    while ($row = $result_comments->fetch_assoc()) {
        $comments[] = $row;
    }


    echo json_encode([
        "status" => "success",
        "data" => [
            "post" => $post,
            "comments" => $comments
        ]
    ]);

    $stmt_post->close();
    $stmt_comments->close();
}
?>
