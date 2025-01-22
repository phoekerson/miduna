<?php
// Connexion à la base de données
$host = "localhost"; // Remplacez par votre hôte
$dbname = "miduna"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur
$password = ""; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dossier où les fichiers seront enregistrés
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Crée le dossier s'il n'existe pas
    }

    // Variables pour les fichiers
    $videoPath = null;
    $thumbnailPath = null;

    // Vérifier et gérer l'upload de la vidéo
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $videoTmpPath = $_FILES['video']['tmp_name'];
        $videoName = uniqid() . "_" . basename($_FILES['video']['name']);
        $videoPath = $uploadDir . $videoName;

        if (move_uploaded_file($videoTmpPath, $videoPath)) {
            echo "Vidéo uploadée avec succès !<br>";
        } else {
            echo "Erreur lors de l'upload de la vidéo.<br>";
        }
    }

    // Vérifier et gérer l'upload de la miniature
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
        $thumbnailName = uniqid() . "_" . basename($_FILES['thumbnail']['name']);
        $thumbnailPath = $uploadDir . $thumbnailName;

        if (move_uploaded_file($thumbnailTmpPath, $thumbnailPath)) {
            echo "Miniature uploadée avec succès !<br>";
        } else {
            echo "Erreur lors de l'upload de la miniature.<br>";
        }
    }

    // Insérer les chemins des fichiers dans la base de données
    if ($videoPath && $thumbnailPath) {
        try {
            $stmt = $pdo->prepare("INSERT INTO uploads (video_path, thumbnail_path, upload_date) VALUES (:video_path, :thumbnail_path, NOW())");
            $stmt->bindParam(':video_path', $videoPath);
            $stmt->bindParam(':thumbnail_path', $thumbnailPath);
            $stmt->execute();

            echo "Les fichiers ont été enregistrés dans la base de données avec succès !<br>";
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
        }
    } else {
        echo "Les fichiers n'ont pas pu être uploadés correctement.<br>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploader une vidéo et une miniature</title>
</head>
<body>
    <h1>Uploader une vidéo et une miniature</h1>
    <form action="publier.php" method="POST" enctype="multipart/form-data">
        <label for="video">Sélectionnez une vidéo :</label><br>
        <input type="file" name="video" id="video" accept="video/*" required><br><br>

        <label for="thumbnail">Sélectionnez une miniature :</label><br>
        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required><br><br>

        <button type="submit">Uploader</button>
    </form>
</body>
</html>

