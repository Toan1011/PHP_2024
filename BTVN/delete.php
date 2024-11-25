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

// Lấy chỉ số sản phẩm cần xóa
$index = (int)$_GET['index'];

// Kiểm tra chỉ số hợp lệ
if (!isset($products[$index])) {
    die("Product not found.");
}

// Lấy thông tin sản phẩm cần xóa
$productToDelete = $products[$index];

// Xử lý khi form được submit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xóa sản phẩm khỏi danh sách
    unset($products[$index]);

    // Cập nhật lại session sau khi xóa
    $_SESSION["products"] = array_values($products); // Reset lại key cho mảng

    // Chuyển hướng về trang index
    header("Location: index.php");
    exit;
}
?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Xóa sản phẩm</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card" style="width: 50%; height: 60%; max-width: 600px; max-height: 400px;">
    <div class="card-body">
        <h1 class="card-title text-center" style="font-size: 40px; color: crimson;">Xóa sản phẩm</h1>
        <form action="delete.php?index=<?= $index ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 20px; color: blue;">Name</label>
                <!-- Điền tên sản phẩm vào ô input -->
                <input type="text" class="form-control" id="name" value="<?= htmlspecialchars($productToDelete['name']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label" style="font-size: 20px; color: blue;">Price</label>
                <!-- Điền giá sản phẩm vào ô input -->
                <input type="text" class="form-control" id="price" value="<?= htmlspecialchars($productToDelete['price']) ?>" readonly>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger btn-sm" style="padding: 5px 15px; font-size:20px;">Delete</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
