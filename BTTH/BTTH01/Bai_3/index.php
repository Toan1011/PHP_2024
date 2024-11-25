<?php
// Đường dẫn tới file CSV
$filename = "student.csv";

// Mảng chứa dữ liệu sinh viên
$sinhvien = [];

// Mở file CSV
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Đọc dòng đầu tiên (tiêu đề)
    $headers = fgetcsv($handle, 1000, ",");

    // Đọc từng dòng dữ liệu
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sinhvien[] = array_combine($headers, $data); // Gán dữ liệu vào mảng với tiêu đề là khóa
    }

    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Danh sách sinh viên</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Lớp</th>
            <th>Điểm trung bình</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php
            foreach ($sinhvien as $sv) {
                echo "<tr>";
                echo "<td>{$sv['ID']}</td>";
                echo "<td>{$sv['Họ tên']}</td>";
                echo "<td>{$sv['Ngày sinh']}</td>";
                echo "<td>{$sv['Lớp']}</td>";
                echo "<td>{$sv['Điểm trung bình']}</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

