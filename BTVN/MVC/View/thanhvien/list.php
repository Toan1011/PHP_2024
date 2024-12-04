<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/Model/function.php';

$db = new Database();
$data = $db->getAllData('thanhvien'); // Lấy toàn bộ dữ liệu từ bảng 'thanhvien'

// Phần HTML hiển thị dữ liệu sẽ sử dụng biến $data như hiện tại.
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Danh sách thành viên</title>
</head>
<body class="bg-light">
<div class="container mt-4">
    <h1 class="text-center text-primary">Danh sách thành viên</h1>
    <a href="index.php?controller=thanh-vien&action=add" class="btn btn-success">Thêm mới</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên thành viên</th>
                    <th scope="col">Năm sinh</th>
                    <th scope="col">Quê quán</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($data) && is_array($data)) {
                $stt = 1;
                foreach($data as $value) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $stt; ?></td>
                        <td><?php echo $value['hoten']; ?></td>
                        <td><?php echo $value['namsinh']; ?></td>
                        <td><?php echo $value['quequan']; ?></td>
                        <td>
                            <a href="index.php?controller=thanh-vien&action=update&id=<?php echo $value['id']; ?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="index.php?controller=thanh-vien&action=delete&id=<?php echo $value['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                    $stt++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Không có dữ liệu</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
