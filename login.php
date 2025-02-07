<?php
class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($email, $password) {
        // Requête pour vérifier les identifiants de l'utilisateur
        $stmt = $this->pdo->prepare("SELECT id, email, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Si les identifiants sont corrects, démarrer la session et stocker l'email
            session_start();
            $_SESSION['user_email'] = $user['email']; // Stocke l'email de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id']; // Stocke également l'ID de l'utilisateur pour l'identifier dans les commentaires
            return ''; // Connexion réussie, pas de message d'erreur
        }

        return 'Identifiants invalides.';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="logo">
        <a href="index.php">
            <img src="img/log.png" alt="logo" class="logo">
        </a>
    </div>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (!empty($message)) echo "<p style='color: red;'>$message</p>"; ?>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="button-group">
                <button type="submit">Se connecter</button>
            </div>
            <p>N'avez-vous pas un compte? <a href="register.php">Créer un compte</a></p>
        </form>
    </div>
</body>
</html>
