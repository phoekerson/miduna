<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../STYLES/styles.css">
    <link rel="stylesheet" href="../STYLES/inscription.css"> 
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
                <h1 class="username">Amah KWATCHA</h1><br>
                <button class="btn" onclick="window.location.href='../Main/liste.php'">Nouvelle publication</button>

                <!-- Stats -->
                <div class="stats-container">
                    <div class="stat-card purple">
                        <div class="stat-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Abonnés</span>
                        </div>
                        <span class="stat-value">12.4K</span>
                    </div>

                    <div class="stat-card pink">
                        <div class="stat-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                            <span>Likes</span>
                        </div>
                        <span class="stat-value">48.6K</span>
                    </div>

                    <div class="stat-card blue">
                        <div class="stat-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 8-6 4 6 4V8Z"/><rect width="14" height="12" x="2" y="6" rx="2" ry="2"/></svg>
                            <span>Vidéos</span>
                        </div>
                        <span class="stat-value">156</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>