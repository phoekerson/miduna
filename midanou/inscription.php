<?php
// Configuration de la base de données
$serveur = "localhost"; // Adresse du serveur
$dbname = "midanu_db"; // Nom de votre base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données

try {
    // Connexion à la base de données
    $dbco = new PDO("mysql:host=localhost;dbname=midanu_db", "root", "");
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $nom_utilisateur = $_POST["Username"]; // Corrigé pour correspondre au nom du champ
    $email = $_POST["Email"]; // Corrigé pour correspondre au nom du champ
    $mot_de_passe = password_hash($_POST["Password"], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Préparation de la requête d'insertion
    $sth = $dbco->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

    // Liaison des paramètres
    $sth->bindParam(':username', $nom_utilisateur); // Corrigé pour correspondre à la colonne
    $sth->bindParam(':email', $email);
    $sth->bindParam(':password', $mot_de_passe); // Corrigé pour correspondre à la colonne

    // Exécution de la requête
    if ($sth->execute()) {
        echo "Nouvel utilisateur créé avec succès.";
    } else {
        echo "Erreur lors de la création de l'utilisateur.";
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles/connexion.css">
    <link rel="stylesheet" href="styles/inscription.css"> 
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
        <img src="img/log.png" alt="logo" class ="logo">
        </a>
    </div>
    <div class="login-container">
        <h2>Inscription</h2>
        <form action="register.php" method="post">
            <div class="profile-pic">
                <label for="username">Ajouter une photo de profile:</label>
                <input type="file" id="file">
            </div>
            <br><br>
            <div class="input-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="Username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="Email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="Password" name="password" required>
            </div><br><br>
            <div class="button-group">
                <button type="submit" onclick="window.location.href='connexion.php'">S'inscrire</button>
            </div>
        </form>
        <p>Avez-vous déjà un compte? <a href="connexion.php">Se connecter</a></p>
    </div>
</body>
</html>
?>
