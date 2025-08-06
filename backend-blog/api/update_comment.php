<?php
include("../conn.php");
header("Content-type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "PUT") {
 
    $data = json_decode(file_get_contents("php://input"), true);

   
    if (!isset($data['id']) || !isset($data['comment'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing comment ID or new content"
        ]);
        exit;
    }

    $comment_id = $data['id'];
    $new_content = $data['comment'];
    $stmt = $mysqli->prepare("UPDATE comments SET content = ? WHERE id = ?");
    $stmt->bind_param("si", $new_content, $comment_id);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Comment updated successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to update comment"
        ]);
    }

    $stmt->close();
}
?>
