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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/inscription.css"> 
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
                    <a href="logout.php" class="nav-link">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                        Deconnexion
                    </a>
                </div>
            </div>
        </nav><br>
        <div class="container">
            <div class="profile-card">
                <!-- Profile Picture -->
                <div class="profile-picture-container">
                    <div class="profile-picture-border"></div>
                    <img src=".jpg" alt="Profile" class="profile-picture">
                </div>

                <!-- User Name -->
                <h1 class="username"><?php echo htmlspecialchars($username); ?></h1><br>
                <button class="btn" onclick="window.location.href='publier.php'">Nouvelle publication</button>

                <!-- Stats -->
                <div class="stats-container">
                    <div class="stat-card purple">
                        <div class="stat-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Abonnés</span>
                        </div>
                        <span class="stat-value">0</span>
                    </div>

                    <div class="stat-card pink">
                        <div class="stat-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                            <span>Likes</span>
                        </div>
                        <span class="stat-value">0</span>
                    </div>

                    <div class="stat-card blue">
                        <div class="stat-header">
                            <span>Votre email</span>
                        </div>
                        <span class="stat-value"><?php echo htmlspecialchars($email); ?></span>
                    </div>
                </div>
            </div>
        </div>
       <?php
       $host = "localhost";
       $dbname = "miduna";
       $username = "root";
       $password = "";
   
       try {
           $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $query = "SELECT id, video_title, video_path, thumbnail_path FROM uploads";
        if (!empty($search)) {
            $query .= " WHERE video_title LIKE :search";
        }
        $query .= " ORDER BY upload_date DESC LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($query);
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $videoId = $row['id'];
                $title = htmlspecialchars($row['video_title']);
                $videoPath = htmlspecialchars($row['video_path']);
                $thumbnailPath = htmlspecialchars($row['thumbnail_path']);
                echo '<div class="video-item">';
                echo '<h3>' . $title . '</h3>';
                echo '<video controls width="400" poster="' . $thumbnailPath . '">';
                echo '<source src="' . $videoPath . '" type="video/mp4">';
                echo "Votre navigateur ne supporte pas la lecture vidéo.";
                echo '</video>
                <button> <a href="delete.php?id=' . $videoId . '"> Supprimer la vidéo </a> </button>
                <button><a href="update.php?id=' . $videoId . '">Modifier la vidéo</a></button>';
                
               
            }
        } else {
            echo '<p>Aucune recette trouvée.</p>';
        }

        $countQuery = "SELECT COUNT(*) FROM uploads";
        if (!empty($search)) {
            $countQuery .= " WHERE video_title LIKE :search";
        }
        $countStmt = $pdo->prepare($countQuery);
        if (!empty($search)) {
            $countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        $countStmt->execute();
        $totalResults = $countStmt->fetchColumn();
        $totalPages = ceil($totalResults / $limit);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '"' . ($i == $page ? ' class="active"' : '') . '>' . $i . '</a> ';
        }
        echo '</div>';
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
    </body>
</html>
