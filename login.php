<?php
class Login {
    private $auth;

    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            return $this->auth->login($email, $password);
        }
        return '';
    }
}

require_once 'Database.php';
require_once 'Auth.php';

$db = new Database();
$pdo = $db->connect();
$auth = new Auth($pdo);
$login = new Login($auth);
$message = $login->handleRequest();
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
