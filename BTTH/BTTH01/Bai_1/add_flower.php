<?php
include 'flower.php';
global $flowers;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Tìm id lớn nhất trong danh sách hoa
    $maxId = 0;
    foreach ($flowers as $flower) {
        if ($flower['id'] > $maxId) {
            $maxId = $flower['id'];
        }
    }

    // Tạo sản phẩm mới với id tăng dần
    $newFlower = [
        'id' => $maxId + 1,
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image' => $_POST['image'],
    ];

    // Thêm sản phẩm mới vào danh sách
    $flowers[] = $newFlower;

    // Ghi lại danh sách hoa vào tệp flower.php
    file_put_contents('flower.php', '<?php $flowers = ' . var_export($flowers, true) . ';');

    // Chuyển hướng về trang quản lý
    header('Location: admin.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center mb-4">Thêm sản phẩm</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên hoa" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Mô tả về hoa" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Đường dẫn ảnh" required>
        </div>
        <div class = "d-flex justify-content-center">
        <button type="submit" name="add" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="admin.php" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
