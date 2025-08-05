<?php
header("Content-type:application/json");
include("../conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $result_posts = $mysqli->query("SELECT id, title, content FROM posts");
    $post_info = [];

    while ($row = $result_posts->fetch_assoc()) {
        $id = $row['id'];
        $result_comments = $mysqli->query("SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = $id");
        $comment_data = $result_comments->fetch_assoc();
        $row['comment_count'] = $comment_data['comment_count'];
        $post_info[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "message" => "Got posts with comment counts successfully",
        "data" => $post_info
    ]);
}
?>
