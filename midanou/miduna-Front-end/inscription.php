<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../STYLES/connexion.css">
    <link rel="stylesheet" href="../STYLES/inscription.css"> 
    <style>
         body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #6a11cb, #2575fc); /* Dégradé de fond */
    margin: 0;
    padding: 0;
} 
    </style>
</head>
<body>
    <div class ="logo">
        <a href="../Main/index.php">
        <img src="../IMG/log.png" alt="logo" class ="logo">
        </a>
    </div>
    <div class="login-container">
        <h2>Inscription</h2>
        <form action="register.php" method="post">
            <div class="profile-pic">
                <img id="profileImage" src="" alt="Profile Picture">
            </div>

            <span class="upload-text" onclick="document.getElementById('file').click();">Ajouter une photo de profil</span>
            <input type="file" id="file" class="file-input" accept="image/*" onchange="loadFile(event)" style="display:none;">
            <br><br>
            <div class="input-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="profil">Choisissez un type de recette :</label>
                <select id="profil" name="profil" required>
                    <option value="">Choisir un type</option>
                    <option value="africaine">Recette africaine</option>
                    <option value="européenne">Recette européenne</option>
                    <option value="americaine">Recette américaine</option>
                    <option value="asiatique">Recette asiatique</option>
                </select>
            </div><br><br>
            <div class="button-group">
                <button type="submit">S'inscrire</button>
            </div>
        </form>
        <p>Avez-vous déjà un compte? <a href="connexion.php">Se connecter</a></p>
    </div>
    <script src="../Main/script.js"></script>
</body>
</html>

