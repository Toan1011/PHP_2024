<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm thành viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-center text-primary">Thêm thành viên mới</h2>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="hoten" class="form-label">Tên Thành Viên</label>
            <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên thành viên" required>
        </div>
        <div class="mb-3">
            <label for="namsinh" class="form-label">Năm sinh</label>
            <input type="text" class="form-control" id="namsinh" name="namsinh" placeholder="Năm sinh" required>
        </div>
        <div class="mb-3">
            <label for="quequan" class="form-label">Quê quán</label>
            <input type="text" class="form-control" id="quequan" name="quequan" placeholder="Quê quán" required>
        </div>
        <button type="submit" name="add_user" class="btn btn-success btn-lg">Thêm mới</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
        // Lấy dữ liệu từ form
        $hoten = $_POST['hoten'];
        $namsinh = $_POST['namsinh'];
        $quequan = $_POST['quequan'];

        // Kết nối với cơ sở dữ liệu
        require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/Model/function.php';
        // Đảm bảo class Database đã được bao gồm
        $db = new Database();
        $conn = $db->connect();

        // Thực hiện truy vấn SQL để thêm dữ liệu vào cơ sở dữ liệu
        $r = $db->AddData($hoten, $namsinh, $quequan);

        if ($r) {
            // Hiển thị thông báo thành công
            echo "<p class='text-center text-success'>Thêm mới thành công!</p>";

            // Chuyển hướng về trang danh sách thành viên sau khi thêm thành công
            header("Location: index.php?controller=thanh-vien&action=list");
            exit(); // Dừng việc thực thi mã sau khi chuyển hướng
        } else {
            echo "<p class='text-center text-danger'>Lỗi khi thêm dữ liệu!</p>";
        }

        // Đóng kết nối
        $conn->close();
    }
    ?>

</div>
</body>
</html>