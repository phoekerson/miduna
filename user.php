<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($username, $email, $password)
    {
        // Vérifier si l'email existe déjà
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            return "Cet email est déjà utilisé.";
        } else {
            // Insérer l'utilisateur
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

            if ($stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ])) {
                return "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } else {
                return "Une erreur est survenue. Veuillez réessayer.";
            }
        }
    }
}
