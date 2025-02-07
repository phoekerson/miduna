<?php
require_once 'Database.php';
require_once 'VideoManager.php';

$db = new Database();
$pdo = $db->connect();
$videoManager = new VideoManager($pdo);

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$videos = $videoManager->getVideos($search, $page);
$totalPages = $videoManager->getTotalPages($search);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Vidéos</title>
    <link rel="stylesheet" href="styles/liste.css">
</head>
<body>
    <h2>Liste des Vidéos</h2>

    <form method="GET">
        <input type="text" name="search" placeholder="Rechercher une vidéo" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
    </form>

    <div class="video-container">
        <?php if (!empty($videos)) : ?>
            <?php foreach ($videos as $video) : ?>
                <div class="video-item">
                    <a href="video.php?id=<?php echo $video['id']; ?>">
                        <img src="<?php echo htmlspecialchars($video['thumbnail_path']); ?>" alt="Miniature de la vidéo">
                        <h3><?php echo htmlspecialchars($video['video_title']); ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucune vidéo trouvée.</p>
        <?php endif; ?>
    </div>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>
