<!-- services/NewsService -->


<?php
require_once 'db/DBConnection.php';
require_once 'models/News.php';

class NewsService
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }


    public function getAllNews()
    {
        $query = "SELECT * FROM news";
        $result = $this->db->getConnection()->query($query);

        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
        }

        return $news;
    }

    public function getNewsById($id)
    {
        $query = "SELECT * FROM news WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {

            return new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
        }

        return null;
    }

    public function searchNews($keyword)
    {
        if (empty($keyword)) {
            $query = "SELECT * FROM news";
            $stmt = $this->db->getConnection()->prepare($query);
        } else {
            $query = "SELECT * FROM news WHERE title LIKE ? OR content LIKE ?";
            $stmt = $this->db->getConnection()->prepare($query);

            $searchTerm = "%" . $keyword . "%";
            $stmt->bind_param("ss", $searchTerm, $searchTerm);
        }
        $stmt->execute();

        $result = $stmt->get_result();
        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
        }

        return $news;
    }

    public function addNews($news)
    {
        $query = "INSERT INTO news (title, content, image, created_at, category_id ) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("ssssi", $news->getTitle(), $news->getContent(), $news->getImage(), $news->getCreatedAt(), $news->getCategoryId());
        return $stmt->execute();
    }

    public function deleteNews($id)
    {
        $query = "DELETE FROM news WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateNews($news)
    {
        $query = "UPDATE news SET title = ?, content = ?, image = ?, created_at = ?, category_id = ? WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bind_param("ssssii", $news->getTitle(), $news->getContent(), $news->getImage(), $news->getCreatedAt(), $news->getCategoryId(), $news->getId());
        return $stmt->execute();
    }
}
?>