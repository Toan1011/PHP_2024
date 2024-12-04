<?php
class Database
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'qltv_mvc';

    private $conn = null;
    private $result = null;

    private function ensureConnection()
    {
        if ($this->conn === null) {
            $this->connect();
        }
    }

    public function connect()
    {
        if ($this->conn === null) {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("Kết nối thất bại: " . $this->conn->connect_error);
            }
            $this->conn->set_charset("utf8");
        }
        return $this->conn;
    }


    // Thực thi câu lệnh truy vấn
    public function execute($sql)
    {
        if ($this->conn === null) {
            $this->connect();
        }
        $this->result = $this->conn->query($sql);
        if ($this->result === false) {
            echo "Lỗi truy vấn: " . $this->conn->error;
            return false;
        }
        return $this->result;
    }

    // Phương thức lấy dữ liệu một dòng
    public function getData($table)
    {
        $sql = "SELECT * FROM $table";
        $this->execute($sql);
        if ($this->result) {
            return $this->result->fetch_assoc();
        }
        return null;
    }

    // Phương thức lấy toàn bộ dữ liệu
    public function getAllData($table)
    {
        $data = [];
        $sql = "SELECT * FROM $table";
        $this->execute($sql);
        if ($this->result) {
            while ($row = $this->result->fetch_assoc()) {
                $data[] = $row;
            }
        }
//        var_dump($data);
        return $data;
    }

    // Phương thức thêm dữ liệu
    // Phương thức thêm dữ liệu với Prepared Statements để tránh SQL Injection
    public function AddData($hoten, $namsinh, $quequan){
        if ($this->conn === null) {
            $this->connect();
        }

        // Chuẩn bị câu lệnh SQL với placeholders (?)
        $stmt = $this->conn->prepare("INSERT INTO thanhvien (hoten, namsinh, quequan) VALUES (?, ?, ?)");
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->conn->error;
            return false;
        }

        // Liên kết tham số với câu lệnh SQL (chuẩn bị cho ?)
        $stmt->bind_param("sss", $hoten, $namsinh, $quequan);

        // Thực thi câu lệnh SQL
        $result = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($result === false) {
            echo "Lỗi thực thi câu lệnh: " . $stmt->error;
            return false;
        }

        // Đóng statement sau khi thực thi
        $stmt->close();
        $this->conn->close();
        echo "Thanh cong";
        return true; // Trả về true nếu thêm thành công
    }
    // Phương thức sửa dữ liệu
    public function UpdateData($id, $hoten, $namsinh, $quequan) {
        $sql = "UPDATE thanhvien SET hoten = '$hoten', namsinh = '$namsinh', quequan = '$quequan' WHERE id = '$id'";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Lỗi chuẩn bị truy vấn: " . $this->conn->error;
            return false;
        }

        // Gán giá trị cho các placeholder
        $stmt->bind_param("sssi", $hoten, $namsinh, $quequan, $id);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Thành công
        } else {
            echo "Lỗi khi thực thi truy vấn: " . $stmt->error;
            $stmt->close();
            return false; // Thất bại
        }
    }

    // Phương thức xóa dữ liệu
    public function DeleteData($id) {
        $sql = "DELETE FROM thanhvien WHERE id = '$id'";
        return $this->execute($sql);
    }
}
?>
