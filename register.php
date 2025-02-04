<?php
class Register {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            return $this->user->register($username, $email, $password);
        }
        return '';
    }
}

require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$pdo = $db->connect();
$user = new User($pdo);
$register = new Register($user);
$message = $register->handleRequest();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/register.css"> 
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
        } 
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php">
            <img src="img/log.png" alt="logo" class="logo">
        </a>
    </div>
    <div class="login-container">
        <h2>Inscription</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form action="register.php" method="post">
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
                <button type="submit">S'inscrire</button>
            </div>
        </form>
        <p>Avez-vous déjà un compte? <a href="connexion.php">Se connecter</a></p>
    </div>
    <script src="../Main/script.js"></script>
</body>
</html>
