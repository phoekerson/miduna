<?php
class VideoManager {
    private $pdo;
    private $limit = 5;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getVideos($search = '', $page = 1) {
        $offset = ($page - 1) * $this->limit;
        $query = "SELECT id, video_title, video_path, thumbnail_path FROM uploads";
        
        if (!empty($search)) {
            $query .= " WHERE video_title LIKE :search";
        }
        
        $query .= " ORDER BY upload_date DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($query);
        
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        
        $stmt->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPages($search = '') {
        $query = "SELECT COUNT(*) FROM uploads";
        
        if (!empty($search)) {
            $query .= " WHERE video_title LIKE :search";
        }
        
        $stmt = $this->pdo->prepare($query);
        
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $totalResults = $stmt->fetchColumn();
        
        return ceil($totalResults / $this->limit);
    }

    public function getComments($videoId) {
        $stmt = $this->pdo->prepare("SELECT comment FROM comments WHERE video_id = :video_id ORDER BY created_at DESC");
        $stmt->bindValue(':video_id', $videoId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
