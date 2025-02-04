<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour commenter.");
}

$host = "localhost";
$dbname = "miduna";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['video_id']) && isset($_POST['comment'])) {
        $videoId = $_POST['video_id'];
        $comment = trim($_POST['comment']);
        $userId = $_SESSION['user_id'];

        if (!empty($comment)) {
            $stmt = $pdo->prepare("INSERT INTO comments (video_id, user_id, comment, created_at) VALUES (:video_id, :user_id, :comment, NOW())");
            $stmt->bindParam(':video_id', $videoId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

header("Location: liste.php");
exit();
