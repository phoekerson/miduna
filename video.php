<?php
session_start(); // Démarre la session

require_once 'Database.php';
require_once 'VideoManager.php';

$db = new Database();
$pdo = $db->connect();
$videoManager = new VideoManager($pdo);

$videoId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$video = $videoManager->getVideoById($videoId);
$comments = $videoManager->getComments($videoId);

if (!$video) {
    echo "Vidéo introuvable.";
    exit;
}

// Vérifie si l'utilisateur est connecté et récupère son email
$userEmail = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['video_title']); ?></title>
    <link rel="stylesheet" href="styles/video.css">
</head>
<body>

    <div class="video-container">
        <div class="video-player">
            <video controls>
                <source src="<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture vidéo.
            </video>
            <h1 class="video-title"><?php echo htmlspecialchars($video['video_title']); ?></h1>
        </div>

        <div class="comments-section">
            <h2>Commentaires</h2>
            <?php foreach ($comments as $comment) : ?>
                <div class="comment-container">
                    <p class="comment"><?php echo htmlspecialchars($comment['comment']); ?></p>

                    <?php
                        // Vérifie si l'utilisateur est connecté et si son email correspond à celui qui a posté le commentaire
                        if ($userEmail && $userEmail == $comment['user_email']) :
                    ?>
                        <!-- Si l'utilisateur est connecté et que c'est son commentaire, afficher les boutons -->
                        <form class="edit-comment-form" action="update_comment.php" method="POST">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <input type="text" name="comment" value="<?php echo htmlspecialchars($comment['comment']); ?>" required>
                            <button type="submit">Modifier</button>
                        </form>
                        <form class="delete-comment-form" action="delete_comment.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <form class="comment-form" action="submit_comment.php" method="POST">
                <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                <input type="text" name="comment" placeholder="Écrivez un commentaire..." required>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>

</body>
</html>
