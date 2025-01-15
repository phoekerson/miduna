<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
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
                <a href="../Main/publier.php" class="nav-link">
                    Publier une recette
                </a>
            </div>
        </div>
    </nav><br>
    <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Faites des recherches pour commencer...">
            </div>
    </div>
   <h1>Les recettes publiées seront affichées ici</h1>
</body>
</html>