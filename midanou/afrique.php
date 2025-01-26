<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MidanuApp</title>
    <link rel="stylesheet" href="acd.css">
  
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
               <a href="index.php"> <img src="log.png" alt="logo" class="logo"></a>
            </div>
            <div class="nav-links">
                <a href="index.php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Accueil
                </a>
                <a href="connexion.php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    Se connecter
                </a>
                <a href=".php" class="nav-link">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    À propos
                </a>
            </div>
        </div>
    </nav>

    <main>
        <div class="background-image">
            <div class="search-container">
                <div class="search-bar">
                    <svg class="search-icon" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Faites des recherches pour commencer...">
                </div>
            </div>
        </div>
        <h1 class="main-title">Explorez les repas africains</h1>
    </main>

    <footer class="footer">
        <div class="footer-content">
            &copy; Midanu App. Tous droits réservés.
        </div>
    </footer>

    <script src="acj.js"></script>
  
</body>
</html>