<!-- services/CategoryService -->

<?php
require_once 'db/DBConnection.php';
require_once 'models/Category.php';

class CategoryService
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $result = $this->db->getConnection()->query($query);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name']);
        }

        return $categories;
    }
}
?>