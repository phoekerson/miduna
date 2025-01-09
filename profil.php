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
</head>
<body>
    <h1>Bienvenue sur votre profil Miduna </br>
    Commencez à créer et partager vos recettes de cuisine</h1>
    <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($username); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
    <input type="file"> </br> </br>
    <input type="text" placeholder="Entrez le titre de la vidéo"> </br> </br>
    <input type="submit" value = "publier la video"> </br> </br>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
