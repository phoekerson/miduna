<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication de Contenu Vidéo</title>
    <link rel="stylesheet" href="styles/publier.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="index.php"><img src="../IMG/log.png" alt="logo" class="logo"></a>
            </div>
            <div class="nav-links">
                <a href="index.php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Accueil
                </a>
            </div>
        </div>
    </nav><br>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1>Publication d'une nouvelle recette</h1>
                <p>Partagez votre recette avec la communauté</p>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="video">Sélectionner une vidéo</label>
                    <input type="file" name="video" placeholder="Inserez votre video">
                </div>

                <div class="form-group">
                    <!-- <label for="thumbnail">Sélectionner une miniature</label> -->
                    <input type="file" name="thumbnail" placeholder="Inserez votre miniature">
                </div>
                <div class="form-group">
                    <label for="title">Titre de la vidéo</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre de votre vidéo" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Décrivez votre vidéo..." required></textarea>
                </div>

                <button type="submit" name="submit" class="submite-button">Publier la vidéo</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        try {
            // Configuration de la base de données
            $db = new PDO("mysql:host=localhost;dbname=miduna", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Répertoire pour les fichiers uploadés
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Upload de la vidéo
            $video = $_FILES['video'];
            $video_name = uniqid() . "_" . basename($video['name']);
            $video_path = $target_dir . $video_name;

            if (!move_uploaded_file($video['tmp_name'], $video_path)) {
                throw new Exception("Erreur lors de l'upload de la vidéo.");
            }

            // Upload de la miniature
            $thumbnail = $_FILES['thumbnail'];
            $thumbnail_name = uniqid() . "_" . basename($thumbnail['name']);
            $thumbnail_path = $target_dir . $thumbnail_name;

            if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnail_path)) {
                throw new Exception("Erreur lors de l'upload de la miniature.");
            }

            // Insertion dans la base de données
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);

            $stmt = $db->prepare("INSERT INTO videos (title, description, video_path, thumbnail_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $video_path, $thumbnail_path]);

            echo "<p>La vidéo a été publiée avec succès.</p>";
        } catch (Exception $e) {
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
    }
    ?>
</body>
</html>
