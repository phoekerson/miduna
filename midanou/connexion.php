<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel ="stylesheet" href="styles/login.css">
</head>
<body>
    <div class ="logo">
        <a href="../Main/index.php">
        <img src="img/log.png" alt="logo" class ="logo">
        </a>
    </div>
        <div class="login-container">
            <h2>Connexion</h2>
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
                    <button type="submit" >Se connecter</button>
                </div>
                <p>N'avez-vous pas un compte? <a href="register.php">Créer un compte</a></p>
            </form>
        </div>
</body>
</html>