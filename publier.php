<?php
// Connexion à la base de données
$host = "localhost"; // Remplacez par votre hôte
$dbname = "miduna"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur
$password = ""; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']); // Récupération et sécurisation du titre
    $uploadDir = "uploads/";
    $videoPath = "";
    $thumbnailPath = "";

    // Vérification et upload de la vidéo
    if (!empty($_FILES['video']['name'])) {
        $videoName = basename($_FILES['video']['name']);
        $videoPath = $uploadDir . uniqid() . "_" . $videoName; // Chemin unique
        $videoTmp = $_FILES['video']['tmp_name'];

        // Vérifier que le fichier est une vidéo
        $allowedVideoTypes = ['video/mp4', 'video/webm', 'video/ogg'];
        if (in_array($_FILES['video']['type'], $allowedVideoTypes)) {
            if (move_uploaded_file($videoTmp, $videoPath)) {
                echo "Vidéo uploadée avec succès !<br>";
            } else {
                echo "Erreur lors de l'upload de la vidéo.<br>";
            }
        } else {
            echo "Seules les vidéos MP4, WEBM, et OGG sont autorisées.<br>";
        }
    }

    // Vérification et upload de la miniature
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnailName = basename($_FILES['thumbnail']['name']);
        $thumbnailPath = $uploadDir . uniqid() . "_" . $thumbnailName; // Chemin unique
        $thumbnailTmp = $_FILES['thumbnail']['tmp_name'];

        // Vérifier que le fichier est une image
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['thumbnail']['type'], $allowedImageTypes)) {
            if (move_uploaded_file($thumbnailTmp, $thumbnailPath)) {
                echo "Miniature uploadée avec succès !<br>";
            } else {
                echo "Erreur lors de l'upload de la miniature.<br>";
            }
        } else {
            echo "Seules les images JPEG, PNG, et GIF sont autorisées.<br>";
        }
    }

    // Insérer les données dans la base de données
    if (!empty($title) && !empty($videoPath) && !empty($thumbnailPath)) {
        $stmt = $pdo->prepare("INSERT INTO uploads (video_title, video_path, thumbnail_path, upload_date) VALUES (:video_title, :video_path, :thumbnail_path, NOW())");
        $stmt->bindParam(':video_title', $title);
        $stmt->bindParam(':video_path', $videoPath);
        $stmt->bindParam(':thumbnail_path', $thumbnailPath);

        if ($stmt->execute()) {
            echo "Vidéo et miniature enregistrées avec succès dans la base de données !";
        } else {
            echo "Erreur lors de l'enregistrement dans la base de données.";
        }
    } else {
        echo "Veuillez remplir tous les champs et uploader les fichiers.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une vidéo</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Publier une vidéo</h1>
    <form action="publier.php" method="post" enctype="multipart/form-data">
        <label for="title">Titre de la vidéo :</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="video">Vidéo (MP4, WEBM, OGG) :</label><br>
        <input type="file" id="video" name="video" accept="video/mp4,video/webm,video/ogg" required><br><br>

        <label for="thumbnail">Miniature (JPEG, PNG, GIF) :</label><br>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/gif" required><br><br>

        <button type="submit">Publier</button>
    </form>
</body>
</html>
