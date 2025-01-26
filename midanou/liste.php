<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si non connecté, rediriger vers la page de connexion
    header('Location: login.php');
    exit();
}

// Récupérer les informations utilisateur depuis la session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
               <a href="index.php"> <img src="img/log.png" alt="logo" class="logo"></a>
            </div>
            <div class="nav-links">
                <a href="index.php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Accueil
                </a>
                <a href="publier.php" class="nav-link">
                    Publier une recette
                </a>
                <p class="username"><?php echo htmlspecialchars($username); ?>
            </div>
        </div>
</nav><br>
    <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher une recette...">
            </div>
    </div>
   <h1>Les recettes publiées seront affichées ici</h1>

<div class="video-container">
    <?php
    // Connexion à la base de données
    $host = "localhost"; // Remplacez par votre hôte
    $dbname = "miduna"; // Nom de la base de données
    $username = "root"; // Nom d'utilisateur
    $password = ""; // Mot de passe

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les vidéos depuis la base de données
        $stmt = $pdo->query("SELECT video_title, video_path, thumbnail_path FROM uploads ORDER BY upload_date DESC");

        // Afficher chaque vidéo avec son titre
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $title = $row['video_title'];
            $videoPath = $row['video_path'];
            $thumbnailPath = $row['thumbnail_path'];

            echo "div class=\"video-card\">
                    <div class=\"video-thumbnail\">
                        <img src=\"$thumbnailPath\" alt=\"Miniature video\">
                        <div class=\"play-overlay\">▶</div>
                    </div>
                    <div class=\"video-title\">$title</div>
                    <div class=\"video-actions\">
                        <button class=\"like-button\">❤️</button>
                </div>
                </div>";
            }
        
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
   
    ?>
</div>
</body>
