<?php
include 'flower.php'; // Chứa danh sách $flowers
global $flowers;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Tìm sản phẩm theo ID và xóa
    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id) {
            unset($flowers[$key]); // Xóa sản phẩm khỏi mảng
            break;
        }
    }

    // Lưu thay đổi vào file flower.php
    file_put_contents('flower.php', '<?php $flowers = ' . var_export(array_values($flowers), true) . ';');

    // Chuyển hướng về trang danh sách
    header('Location: admin.php');
    exit;
}
?>

