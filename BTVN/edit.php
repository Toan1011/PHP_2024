<?php
session_start();

// Kiểm tra nếu không có dữ liệu sản phẩm trong session
if (!isset($_SESSION["products"])) {
    die("No product data found.");
}

// Lấy danh sách sản phẩm từ session
$products = $_SESSION["products"];

// Kiểm tra xem có `index` được truyền qua URL không
if (!isset($_GET['index']) || !is_numeric($_GET['index'])) {
    die("Invalid product index.");
}

// Lấy chỉ số sản phẩm cần sửa
$index = (int)$_GET['index'];

// Kiểm tra chỉ số hợp lệ
if (!isset($products[$index])) {
    die("Product not found.");
}

// Lấy thông tin sản phẩm cần sửa
$productToEdit = $products[$index];

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';

    // Cập nhật thông tin sản phẩm
    $products[$index]['name'] = $name;
    $products[$index]['price'] = $price;

    // Lưu lại vào session
    $_SESSION["products"] = $products;

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Sửa sản phẩm</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card" style="width: 50%; height: 60%; max-width: 600px; max-height: 400px;">
    <div class="card-body">
        <h1 class="card-title text-center" style="font-size: 40px; color: lightcoral;">Sửa sản phẩm</h1>
        <form action="edit.php?index=<?= $index ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 20px; color: green;">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($productToEdit['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label" style="font-size: 20px; color: green;">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($productToEdit['price']) ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning btn-sm" style="padding: 5px 15px; font-size:20px;">Save Changes</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
