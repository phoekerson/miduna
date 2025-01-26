<?php
    // Vérifier si un fichier a été uploadé
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
        $target_dir = "uploads/"; // Assurez-vous que ce dossier existe et a les permissions appropriées
        
        // Créer le dossier s'il n'existe pas
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    
        $video = $_FILES["video"];
        $title = $_POST["title"];
    
        // Générer un nom de fichier unique
        $video_name = uniqid() . "_" . basename($video["name"]);
        $target_file = $target_dir . $video_name;
        
        // Vérifier le type de fichier
        $allowed_types = ["video/mp4", "video/webm", "video/ogg"];
        if (!in_array($video["type"], $allowed_types)) {
            die("Erreur: Type de fichier non autorisé.");
        }
    
        // Vérifier la taille du fichier (2GB max)
        if ($video["size"] > 2 * 1024 * 1024 * 1024) {
            die("Erreur: Le fichier est trop volumineux (max 2GB).");
        }
    
        // Déplacer le fichier uploadé
        if (move_uploaded_file($video["tmp_name"], $target_file)) {
            // Ici, vous pouvez ajouter le code pour sauvegarder les informations dans une base de données
            // Par exemple:
            
            $db = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
            $stmt = $db->prepare("INSERT INTO videos (title, description, file_path) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $target_file]);
            
    
            echo "La vidéo a été uploadée avec succès.";
        } else {
            echo "Erreur lors de l'upload de la vidéo.";
        }
    } else {
        echo "Erreur: Aucun fichier n'a été envoyé.";
    }
    ?>

    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication de Contenu Vidéo</title>
    <link rel="stylesheet" href="styles/publier.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="index.php"><img src="img/log.png" alt="logo" class="logo"></a>
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
                    <input type="file" name="video" placeholder="Inserez votre video"> </br> </br>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Sélectionner une miniature</label> 
                    <input type="file" name="thumbnail" placeholder="Inserez votre miniature"> </br> </br>
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
</body>
</html>
