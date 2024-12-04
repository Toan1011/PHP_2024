<!-- services/UserService -->

<?php
require_once 'db/DBConnection.php';
require_once 'models/User.php';

class UserService
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new User($row['id'], $row['username'], $row['password'], $row['role']);
        }
        return null;
    }
}
?>