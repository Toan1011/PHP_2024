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


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khách hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center mb-4">Gian hàng Hoa</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($currentItems as $flower): ?>
            <div class="col">
                <div class="card h-100">
                    <!-- Hình ảnh -->
                    <img src="<?= $flower['image']; ?>" class="card-img-top" alt="<?= $flower['name']; ?>" style="max-height: 200px; object-fit: cover;">
                    <!-- Nội dung -->
                    <div class="card-body">
                        <h3 class="card-title"><?= $flower['name']; ?></h3>
                        <p class="card-text"><?= $flower['description']; ?></p>
                        <p class="text-muted"><?= $flower['price']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <nav class="mt-4">
        <ul class="pagination d-flex">
            <!-- Trang trước -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
            </li>

            <!-- Các trang -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <!-- Trang sau -->
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
