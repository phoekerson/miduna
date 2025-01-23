<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="opensource_project/style.css" type="text/css">
</head>
<body>
    <p class="container-center">Admin Dashboard</p>
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
            <a href="index.php"> <img src="../IMG/log.png" alt="logo" class="logo"></a>
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
        </div>
    </div>
</nav>
<br>
<div class="search-container">
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Faites des recherches pour commencer...">
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
        $stmt = $pdo->query("SELECT video_path, thumbnail_path FROM uploads ORDER BY upload_date DESC");

        // Afficher chaque vidéo
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $videoPath = $row['video_path'];
            $thumbnailPath = $row['thumbnail_path'];
            $id = $row['id'];

            echo '<div class="video-item">';
            echo '<video controls width="400" poster="' . htmlspecialchars($thumbnailPath) . '">';
            echo '<source src="' . htmlspecialchars($videoPath) . '" type="video/mp4">';
            echo "Votre navigateur ne supporte pas la lecture vidéo.";
            echo '</video>';
            echo '</br> </br> <button> <a href="delete.php?deleteid='.$id.'"Supprimer</button></div>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</div>
</body>
</html>

</body>
</html>