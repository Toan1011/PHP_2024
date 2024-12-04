<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thành viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-center text-primary">Sửa thông tin thành viên</h2>

    <?php
    // Kết nối cơ sở dữ liệu
    require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/Model/function.php';
    $db = new Database();
    $conn = $db->connect();

    // Lấy thông tin thành viên dựa trên ID
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Lấy ID từ URL
    $member = null;
    if ($id > 0) {
        $sql = "SELECT * FROM thanhvien WHERE id = $id";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $member = $result->fetch_assoc();
        } else {
            echo "<p class='text-center text-danger'>Thành viên không tồn tại.</p>";
            exit;
        }
    } else {
        echo "<p class='text-center text-danger'>ID không hợp lệ.</p>";
        exit;
    }

    // Xử lý cập nhật thông tin
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
        $hoten = $conn->real_escape_string($_POST['hoten']);
        $namsinh = $conn->real_escape_string($_POST['namsinh']);
        $quequan = $conn->real_escape_string($_POST['quequan']);

        // Cập nhật dữ liệu
        $update_sql = "UPDATE thanhvien SET hoten = '$hoten', namsinh = '$namsinh', quequan = '$quequan' WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {
            echo "<p class='text-center text-success'>Cập nhật thành công!</p>";
            header("Location: index.php?controller=thanh-vien&action=list"); // Điều hướng về danh sách thành viên
            exit;
        } else {
            echo "<p class='text-center text-danger'>Lỗi: " . $conn->error . "</p>";
        }
    }
    ?>

    <!-- Form sửa thành viên -->
    <form action="" method="POST">
        <div class="mb-3">
            <label for="hoten" class="form-label">Tên Thành Viên</label>
            <input type="text" class="form-control" id="hoten" name="hoten" value="<?php echo htmlspecialchars($member['hoten']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="namsinh" class="form-label">Năm sinh</label>
            <input type="text" class="form-control" id="namsinh" name="namsinh" value="<?php echo htmlspecialchars($member['namsinh']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="quequan" class="form-label">Quê quán</label>
            <input type="text" class="form-control" id="quequan" name="quequan" value="<?php echo htmlspecialchars($member['quequan']); ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" name="update_user" class="btn btn-primary btn-lg">Cập nhật</button>
        </div>
    </form>

</div>
</body>
</html>

