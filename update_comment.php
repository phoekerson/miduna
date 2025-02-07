<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour modifier un commentaire.");
}

$host = "localhost";
$dbname = "miduna";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_id']) && isset($_POST['comment'])) {
        $commentId = $_POST['comment_id'];
        $newComment = trim($_POST['comment']);
        $userId = $_SESSION['user_id'];

        // Vérification que le commentaire appartient à l'utilisateur
        $stmt = $pdo->prepare("SELECT user_id FROM comments WHERE id = :comment_id");
        $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmt->execute();
        $comment = $stmt->fetch();

        if ($comment && $comment['user_id'] == $userId) {
            // Mise à jour du commentaire
            $stmt = $pdo->prepare("UPDATE comments SET comment = :comment WHERE id = :comment_id");
            $stmt->bindParam(':comment', $newComment, PDO::PARAM_STR);
            $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

header("Location: video.php?id=" . $_POST['video_id']);
exit();
