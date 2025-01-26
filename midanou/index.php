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
    <title>MidanuApp</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar" style="background-color: #F8F8F8;">
        <div class="navbar-container">
            <div class="navbar-brand">
               <a href="index.php"> <img src="img/log.png" alt="logo" class="logo"></a>
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="#" class="nav-link">Recettes
                    <ul class="dropdown">
                        <li><a href="liste.php">Voire les recettes</a></li>
                        <li><a href="publier.php">Publier une recette</a></li>
                    </ul>
                </div>
                <a href="profil.php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M12 14c-5 0-8 2-8 4v1h16v-1c0-2-3-4-8-4z"></path>
                    </svg>
                    Profil
                </a><br>
                <p class="username"><?php echo htmlspecialchars($username); ?>
            </div>
        </div>
    </nav><br>

    
        <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Faites des recherches pour commencer...">
            </div>
        </div><br><br>
        <div class="police">
            <h2>Bienvenue sur Midanu! qu'elle recette désirez-vous partager ou apprendre aujourd'hui ?🤷‍♂️</h2>
        </div><br><br>
        <div class="main-title">
        <h1>Explorez les repas par continent</h1>
        </div><br><br>
        
    <div class="container">
        <div class="card">
            <img src="img/imag.png" alt="Image de la carte 1" class="card-image">
            <div class="card-content">
                <h2>Bienvenu en Afrique</h2>
                <p>Decourir les recettes africaines.</p>
            </div>
            <div class="card-footer">
            <button class="bton" onclick="window.location.href='index.php';">Voir</button>
            </div>
        </div>

        <div class="card">
            <img src="img/imag2.avif" alt="Image de la carte 2" class="card-image">
            <div class="card-content">
                <h2>Bienvenu en Europe</h2>
                <p>Decouvrir les recettes européennes.</p>
            </div>
            <div class="card-footer">
            <button class="bton" onclick="window.location.href='index.php';">Voir</button>
            </div>
        </div>
        <div class="card">
            <img src="img/imag4.jpg" alt="Image de la carte 2" class="card-image">
            <div class="card-content">
                <h2>Bienvenu en Asie</h2>
                <p>Decouvrir les recettes Asiatiques.</p>
            </div>
            <div class="card-footer">
            <button class="bton" onclick="window.location.href='index.php';">Voir</button>
            </div>
        </div>
        <div class="card">
            <img src="img/imag33.+©+Shutterstock" alt="Image de la carte 2" class="card-image">
            <div class="card-content">
                <h2>Bienvenu en Amerique</h2>
                <p>Decouvrir les recettes Americaines.</p>
            </div>
            <div class="card-footer">
            <button class="bton" onclick="window.location.href='index.php';">Voir</button>
            </div>
        </div>
    </div>
       

    <br><br>

    <div class="container">
        <button class="btn" onclick="window.location.href='login.php';">Commencer</button>
    </div>

    <footer class="footer">
        <div class="footer-link">
            <a href="#">A propos de nous</a>
        </div>
        <div class="footer-content">
            &copy; Midanu App. Tous droits réservés.
        </div>
        <div class="footer-social">
            <p>Suivez nous sur👉</p>
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/" target="_blank"><i class="fab fa-x"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/" target="_blank"><i class="fab fa-tiktok"></i></a>
        </div>
</footer>
</body>
</html>
