<?php

class VideoUploader
{
    private $pdo;
    private $uploadDir = "uploads/";

    public function __construct($host, $dbname, $username, $password)
    {
        $this->connectToDatabase($host, $dbname, $username, $password);
    }

    private function connectToDatabase($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function uploadFile($file, $allowedTypes, $filePrefix)
    {
        $filePath = "";
        if (!empty($file['name'])) {
            $fileName = basename($file['name']);
            $filePath = $this->uploadDir . uniqid() . "_" . $fileName;
            $fileTmp = $file['tmp_name'];

            if (in_array($file['type'], $allowedTypes)) {
                if (move_uploaded_file($fileTmp, $filePath)) {
                    return $filePath;
                } else {
                    return "Erreur lors de l'upload du fichier $filePrefix.";
                }
            } else {
                return "Seuls les fichiers de type $filePrefix sont autorisés.";
            }
        }
        return null;
    }

    public function insertData($title, $videoPath, $thumbnailPath)
    {
        if (!empty($title) && !empty($videoPath) && !empty($thumbnailPath)) {
            $stmt = $this->pdo->prepare("INSERT INTO uploads (video_title, video_path, thumbnail_path, upload_date) 
                                         VALUES (:video_title, :video_path, :thumbnail_path, NOW())");
            $stmt->bindParam(':video_title', $title);
            $stmt->bindParam(':video_path', $videoPath);
            $stmt->bindParam(':thumbnail_path', $thumbnailPath);

            if ($stmt->execute()) {
                return "Vidéo et miniature enregistrées avec succès dans la base de données !";
            } else {
                return "Erreur lors de l'enregistrement dans la base de données.";
            }
        } else {
            return "Veuillez remplir tous les champs et uploader les fichiers.";
        }
    }
}

// Instanciation de la classe
$videoUploader = new VideoUploader("localhost", "miduna", "root", "");

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']); // Récupération et sécurisation du titre

    // Vérification et upload de la vidéo
    $videoPath = $videoUploader->uploadFile($_FILES['video'], ['video/mp4', 'video/webm', 'video/ogg'], 'vidéo');

    // Vérification et upload de la miniature
    $thumbnailPath = $videoUploader->uploadFile($_FILES['thumbnail'], ['image/jpeg', 'image/png', 'image/gif'], 'miniature');

    // Insérer les données dans la base de données
    $message = $videoUploader->insertData($title, $videoPath, $thumbnailPath);
    echo $message;
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
