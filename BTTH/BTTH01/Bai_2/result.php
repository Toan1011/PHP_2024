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

// Tính kết quả
$userAnswers = $_POST;
$score = 0;
$totalQuestions = count($questions);
$results = [];

foreach ($questions as $index => $question) {
    $correctAnswer = $question['answer'];
    $userAnswerIndex = isset($userAnswers["question$index"]) ? $userAnswers["question$index"] : null;
    $userAnswer = $userAnswerIndex !== null ? $question['choices'][$userAnswerIndex][0] : 'Chưa trả lời';
    $isCorrect = $userAnswer === $correctAnswer;
    $results[] = [
        'question' => $question['question'],
        'choices' => $question['choices'],
        'userAnswer' => $userAnswer,
        'correctAnswer' => $correctAnswer,
        'isCorrect' => $isCorrect,
    ];
    if ($isCorrect) {
        $score++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Kết Quả Bài Thi</h1>
    <div class="alert alert-info text-center">
        Bạn trả lời đúng <strong><?= $score; ?></strong> / <?= $totalQuestions; ?> câu.
    </div>
    <div class="mt-4">
        <?php foreach ($results as $result): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong><?= $result['question']; ?></strong>
                </div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($result['choices'] as $index => $choice): ?>
                            <li
                                <?php if ($choice[0] === $result['correctAnswer']): ?>
                                    class="text-success fw-bold"
                                <?php elseif ($choice[0] === $result['userAnswer']): ?>
                                    class="text-danger fw-bold"
                                <?php endif; ?>
                            >
                                <?= $choice; ?>
                                <?php if ($choice[0] === $result['correctAnswer']): ?>
                                    (Đáp án đúng)
                                <?php elseif ($choice[0] === $result['userAnswer']): ?>
                                    (Bạn chọn)
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($result['isCorrect']): ?>
                        <div class="text-success">✔ Bạn đã trả lời đúng!</div>
                    <?php else: ?>
                        <div class="text-danger">✘ Bạn đã trả lời sai!</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-center align-items-center">
         <a href="question.php" class="btn btn-primary btn-lg">Làm lại</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
