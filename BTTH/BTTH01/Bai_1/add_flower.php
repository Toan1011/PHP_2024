<?php
global $flowers;
$flowers = json_decode(file_get_contents('flower.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Decode Error: " . json_last_error_msg();
    exit;
}

$itemsPerPage = 3;

$totalItems = count($flowers);
$totalPages = ceil($totalItems / $itemsPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $totalPages)); // Đảm bảo trang nằm trong giới hạn

$startIndex = ($page - 1) * $itemsPerPage;
$currentItems = array_slice($flowers, $startIndex, $itemsPerPage);

// Xử lý khi người dùng gửi form thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Xử lý ảnh được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $uploadDir = 'images/'; // Thư mục lưu ảnh
        $uploadFile = $uploadDir . $fileName;

        // Di chuyển ảnh từ thư mục tạm thời tới thư mục lưu ảnh
        if (move_uploaded_file($tmpName, $uploadFile)) {
            $image = $uploadFile;
        } else {
            echo "Lỗi khi tải ảnh lên.";
            exit;
        }
    } else {
        echo "Chưa chọn ảnh.";
        exit;
    }

    // Tạo ID mới cho sản phẩm (lấy ID lớn nhất + 1)
    $newId = max(array_column($flowers, 'id')) + 1;

    // Thêm sản phẩm vào mảng $flowers
    $flowers[] = [
        'id' => $newId,
        'name' => $name,
        'description' => $description,
        'image' => $image
    ];

    // Lưu mảng $flowers vào tệp flower.json dưới dạng JSON
    file_put_contents('flower.json', json_encode($flowers, JSON_PRETTY_PRINT));

    // Chuyển hướng về trang admin sau khi thêm sản phẩm
    header('Location: admin.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flower</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center mb-4">Thêm Sản Phẩm Hoa</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Tên Hoa</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên hoa" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" placeholder="Mô tả về hoa" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Chọn Ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" name="add" class="btn btn-primary">Thêm Sản Phẩm</button>
            <a href="admin.php" class="btn btn-secondary ms-2">Hủy</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
