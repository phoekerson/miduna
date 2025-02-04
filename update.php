<?php
session_start();

// Classe de connexion à la base de données
class Database {
    private $host = "localhost";
    private $dbname = "miduna";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function connect() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}

// Classe pour gérer les vidéos
class VideoManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getVideoById($videoId) {
        $query = "SELECT video_title, video_path, thumbnail_path FROM uploads WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $videoId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function updateVideo($videoId, $newTitle, $videoPath, $thumbnailPath) {
        $query = "UPDATE uploads SET video_title = :title, video_path = :video_path, thumbnail_path = :thumbnail_path WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':title', $newTitle, PDO::PARAM_STR);
        $stmt->bindValue(':video_path', $videoPath, PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail_path', $thumbnailPath, PDO::PARAM_STR);
        $stmt->bindValue(':id', $videoId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function uploadFile($file, $destinationDir) {
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $filePath = $destinationDir . uniqid() . "_" . $fileName;
        move_uploaded_file($fileTmpName, $filePath);
        return $filePath;
    }
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Vérifier si l'ID de la vidéo est passé dans l'URL
if (isset($_GET['id'])) {
    $videoId = $_GET['id'];

    $database = new Database();
    $pdo = $database->connect();
    $videoManager = new VideoManager($pdo);

    // Récupérer les informations de la vidéo
    $video = $videoManager->getVideoById($videoId);

    if ($video) {
        $title = htmlspecialchars($video['video_title']);
        $videoPath = htmlspecialchars($video['video_path']);
        $thumbnailPath = htmlspecialchars($video['thumbnail_path']);

        // Traitement du formulaire de modification
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newTitle = $_POST['video_title'];

            // Vérification de la nouvelle miniature
            if (!empty($_FILES['thumbnail']['name'])) {
                $thumbnailPath = $videoManager->uploadFile($_FILES['thumbnail'], 'thumbnails/');
            }

            // Vérification de la nouvelle vidéo
            if (!empty($_FILES['video']['name'])) {
                $videoPath = $videoManager->uploadFile($_FILES['video'], 'videos/');
            }

            // Mettre à jour les informations de la vidéo dans la base de données
            if ($videoManager->updateVideo($videoId, $newTitle, $videoPath, $thumbnailPath)) {
                header('Location: profil.php');
                exit();
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        }
    } else {
        echo "Vidéo introuvable.";
        exit();
    }
} else {
    echo "ID de vidéo manquant.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la vidéo</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h1>Modifier la vidéo</h1>
        <form action="update.php?id=<?php echo $videoId; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="video_title">Titre de la vidéo :</label>
                <input type="text" id="video_title" name="video_title" value="<?php echo $title; ?>" required>
            </div>

            <div>
                <label for="video">Nouvelle vidéo :</label>
                <input type="file" id="video" name="video">
                <small>Format accepté: mp4</small>
            </div>

            <div>
                <label for="thumbnail">Nouvelle miniature :</label>
                <input type="file" id="thumbnail" name="thumbnail">
                <small>Formats acceptés: jpg, png</small>
            </div>

            <div>
                <button type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</body>
</html>
