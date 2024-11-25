<?php
include 'flower.php';
global $flowers;

// Kiểm tra nếu có tham số `id` trong URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Lấy ID từ URL và ép kiểu thành số nguyên
    $flowerToEdit = null;

    // Tìm sản phẩm tương ứng với ID
    foreach ($flowers as $flower) {
        if ($flower['id'] === $id) {
            $flowerToEdit = $flower;
            break;
        }
    }

    // Nếu không tìm thấy sản phẩm, hiển thị thông báo lỗi
    if ($flowerToEdit === null) {
        die('Sản phẩm không tồn tại.');
    }
} else {
    die('Không có ID sản phẩm được cung cấp.');
}

// Xử lý khi gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Cập nhật thông tin sản phẩm trong mảng `$flowers`
    foreach ($flowers as &$flower) {
        if ($flower['id'] === $id) {
            $flower['name'] = $name;
            $flower['description'] = $description;
            $flower['image'] = $image;
            break;
        }
    }

    // Ghi mảng `$flowers` vào tệp `flower.php`
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center mb-4">Sửa thông tin sản phẩm</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $flowerToEdit['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= $flowerToEdit['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" id="image" name="image" value="<?= $flowerToEdit['image']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
