<!-- db/DBConnection.php -->

<?php
class DBConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "news";
    private  $port = 3306;
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}
?>