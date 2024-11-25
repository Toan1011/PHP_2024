<?php
session_start();
include("product.php");
// Khởi tạo danh sách sản phẩm trong session nếu chưa tồn tại
if (!isset($_SESSION["products"])) {
    $_SESSION["products"] = [];
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? "");
    $price = trim($_POST['price'] ?? "");

    if (empty($name) || empty($price)) {
        $error = "Tên sản phẩm và giá không được để trống!";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Giá sản phẩm phải là một số dương!";
    } else {
        // Thêm sản phẩm mới nếu dữ liệu hợp lệ
        $addProduct = ['name' => $name, 'price' => $price];
        $_SESSION["products"][] = $addProduct;

        // Chuyển hướng về trang index sau khi thêm thành công
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Thêm sản phẩm</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card" style="width: 50%; height: 60%; max-width: 600px; max-height: 400px;">
    <div class="card-body">
        <h1 class="card-title text-center" style="font-size: 40px; color: indianred;">Thêm sản phẩm mới</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Form thêm sản phẩm -->
        <form action="add.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 20px; color: blue;">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= htmlspecialchars($name ?? "") ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label" style="font-size: 20px; color: blue;">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="<?= htmlspecialchars($price ?? "") ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm" style="padding: 5px 15px; font-size:20px;">Save</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
