<?php
// Đọc dữ liệu từ file questions.txt
$filename = "questions.txt";
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Xử lý dữ liệu từ file thành mảng câu hỏi
$questions = [];
$currentQuestion = [];
foreach ($lines as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($currentQuestion)) {
            $questions[] = $currentQuestion;
        }
        $currentQuestion = ['question' => $line, 'choices' => [], 'answer' => ''];
    } elseif (strpos($line, "Đáp án:") === 0) {
        $currentQuestion['answer'] = trim(substr($line, strpos($line, ":") + 1));
    } else {
        $currentQuestion['choices'][] = $line;
    }
}
if (!empty($currentQuestion)) {
    $questions[] = $currentQuestion;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Bài Thi Trắc Nghiệm</h1>
    <form method="POST" action="result.php">
        <!-- Hiển thị từng câu hỏi -->
        <?php foreach ($questions as $index => $question): ?>
            <div class="card mb-4">
                <div class="card-header"><strong><?= $question['question']; ?></strong></div>
                <div class="card-body">
                    <?php foreach ($question['choices'] as $choiceIndex => $choice): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?= $index; ?>" id="q<?= $index . $choiceIndex; ?>" value="<?= $choiceIndex; ?>" required>
                            <label class="form-check-label" for="q<?= $index . $choiceIndex; ?>"><?= $choice; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Nút nộp bài -->
        <div class="d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-primary btn-lg">Nộp bài</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
