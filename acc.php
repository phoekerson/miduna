<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .navbar {
    list-style-type: none;
    padding: 0;
    margin: 0;
    background-color: #333;
}

.navbar > li {
    float: left;
    position: relative;
}

.navbar > li > a {
    display: block;
    padding: 14px 16px;
    color: white;
    text-decoration: none;
}

.navbar > li:hover > a {
    background-color: #575757;
}

.dropdown {
    display: none; /* Masquer le sous-menu par défaut */
    position: absolute; /* Positionner le sous-menu */
    background-color: #333;
    list-style-type: none;
    padding: 0;
}

.navbar > li:hover .dropdown {
    display: block; /* Afficher le sous-menu au survol */
}

.dropdown li {
    float: none; /* Les éléments du sous-menu ne doivent pas être alignés horizontalement */
}

.dropdown li a {
    padding: 12px 16px; /* Ajuster le padding pour le sous-menu */
}

</style>
</head>
<body>
    <h1>uyhbgdvfdcs</h1>
<nav>
    <ul class="navbar">
        <li><a href="#">Accueil</a></li>
        <li>
            <a href="#">Connexion</a>
            <ul class="dropdown">
                <li><a href="#">S'inscrire</a></li>
                <li><a href="#">Se connecter</a></li>
                <li><a href="#">Mot de passe oublié</a></li>
            </ul>
        </li>
        <li><a href="#">À propos</a></li>
    </ul>
</nav>
 
</body>
</html>