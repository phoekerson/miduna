<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication de Contenu Vidéo</title>
    <link rel="stylesheet" href="../STYLES/publier.css">
    <link rel="stylesheet" href="../STYLES/styles.css">
</head>
<body>
    <nav class="navbar">
            <div class="navbar-container">
                <div class="navbar-brand">
                <a href="../Main/index.php"> <img src="../IMG/log.png" alt="logo" class="logo"></a>
                </div>
                <div class="nav-links">
                    <a href="../Main/index.php" class="nav-link">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Accueil
                    </a>
                    <a href="#" class="nav-link">
                        Retoure
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

            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="video">Sélectionner une vidéo</label>
                    <div class="upload-zone">
                        <div class="upload-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="upload-icon">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <div class="upload-text">
                                <label for="video-upload" class="upload-label">
                                    Télécharger un fichier
                                    <input type="file" id="video-upload" name="video" accept="video/*" required>
                                </label>
                            </div>
                            <p class="upload-info">MP4, WebM ou OGG jusqu'à 2GB</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Titre de la vidéo</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre de votre vidéo" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Décrivez votre vidéo..." required></textarea>
                </div>

                <button type="submit" class="submite-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="send-icon">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Publier la vidéo
                </button>
            </form>
        </div>
    </div>
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
        $description = $_POST["description"];
    
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
            /*
            $db = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
            $stmt = $db->prepare("INSERT INTO videos (title, description, file_path) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $target_file]);
            */
    
            echo "La vidéo a été uploadée avec succès.";
        } else {
            echo "Erreur lors de l'upload de la vidéo.";
        }
    } else {
        echo "Erreur: Aucun fichier n'a été envoyé.";
    }
    ?>
</body>
</html>