<?php
// Đọc dữ liệu từ file flower.json
$flowers = json_decode(file_get_contents('flower.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Lỗi khi đọc file JSON.');
}

// Kiểm tra nếu có tham số `id` trong URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Lấy ID từ URL và ép kiểu thành số nguyên

    // Tìm sản phẩm theo ID và xóa
    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id) {
            unset($flowers[$key]); // Xóa sản phẩm khỏi mảng
            break;
        }
    }

    // Cập nhật lại mảng hoa sau khi xóa (chuyển mảng về dạng chỉ số liên tục)
    $flowers = array_values($flowers);

    // Lưu thay đổi vào file flower.json dưới dạng JSON hợp lệ
    file_put_contents('flower.json', json_encode($flowers, JSON_PRETTY_PRINT));

    // Chuyển hướng về trang danh sách
    header('Location: admin.php');
    exit;
} else {
    die('Không có ID sản phẩm được cung cấp.');
}
?>
