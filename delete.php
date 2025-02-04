<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si non connecté, rediriger vers la page de connexion
    header('Location: login.php');
    exit();
}

// Vérifier si l'ID de la vidéo est passé dans l'URL
if (isset($_GET['id'])) {
    $videoId = $_GET['id'];

    // Connexion à la base de données
    $host = "localhost";
    $dbname = "miduna";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Rechercher la vidéo à supprimer
        $query = "SELECT video_path FROM uploads WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':id', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $video = $stmt->fetch(PDO::FETCH_ASSOC);
            $videoPath = $video['video_path'];

            // Supprimer la vidéo du serveur (si nécessaire)
            if (file_exists($videoPath)) {
                unlink($videoPath); // Supprimer le fichier vidéo du serveur
            }

            // Supprimer la vidéo de la base de données
            $deleteQuery = "DELETE FROM uploads WHERE id = :id";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindValue(':id', $videoId, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Rediriger vers la page de profil après suppression
            header('Location: profil.php');
            exit();
        } else {
            echo "Vidéo introuvable.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "ID de vidéo manquant.";
}
?>
