<?php
// index.php
// BƯỚC 1: INCLUDE LOGIC XỬ LÝ DỮ LIỆU
// Giả định bạn đã có file 'quiz.php' chứa hàm loadQuizQuestions()
require_once 'quiz.php'; 

// Load dữ liệu câu hỏi từ file
$questions = loadQuizQuestions('Quiz.txt');

$score = 0;
$total_questions = count($questions);
$show_results = false;
$user_answers = [];

// ========================================================
// BƯỚC 2: XỬ LÝ KHI NGƯỜI DÙNG NỘP BÀI (Chức năng Chấm điểm)
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $total_questions > 0) {
    $show_results = true;
    
    // Lặp qua mảng câu hỏi để kiểm tra đáp án
    foreach ($questions as $index => $q_data) {
        $question_name = 'question_' . $index;
        
        // Lấy câu trả lời của người dùng (từ $_POST)
        $selected_answer = $_POST[$question_name] ?? null;
        $user_answers[$index] = $selected_answer;
        
        // So sánh với đáp án đúng
        if ($selected_answer !== null && $selected_answer === $q_data['answer']) {
            $score++; // Tăng điểm nếu đúng
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Trắc Nghiệm Có Chấm Điểm</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 30px; }
        
        /* Hiển thị kết quả */
        .result-box { text-align: center; padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; font-weight: bold; font-size: 1.2em; }
        
        /* Phong cách cho câu hỏi */
        .question-block { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: #fff; }
        .question-block h3 { margin-top: 0; color: #333; }
        .options label { display: block; margin: 8px 0; padding: 5px; border-radius: 3px; cursor: pointer; }
        
        /* Đánh dấu trạng thái sau khi nộp bài */
        .correct { background-color: #d4edda; border: 1px solid #c3e6cb; } /* Đáp án đúng */
        .incorrect { background-color: #f8d7da; border: 1px solid #f5c6cb; } /* Đáp án sai người dùng chọn */
        .options input:disabled + strong { cursor: default; } /* Bỏ hover khi đã chấm điểm */
    </style>
</head>
<body>

    <div class="container">
        <h1>Bài Trắc Nghiệm Android Cơ Bản</h1>

        <form method="POST" action="index.php">
        
            <?php foreach ($questions as $index => $q_data):
            $user_choice = $user_answers[$index] ?? null; // Lấy lựa chọn của người dùng
            ?>
                <div class="question-block">
                    <h3>Câu <?= $index + 1 ?>: <?= htmlspecialchars($q_data['question']) ?></h3>
                    
                    <div class="options">
                        <?php foreach ($q_data['options'] as $key => $option_text): 
                            
                            $is_user_selected = ($user_choice === $key);
                            $is_correct_answer = ($q_data['answer'] === $key);
                            $class = '';

                            if ($show_results) {
                                // Nếu đã nộp bài, kiểm tra trạng thái
                                if ($is_correct_answer) {
                                    $class = 'correct'; // Luôn đánh dấu đáp án đúng
                                } elseif ($is_user_selected && !$is_correct_answer) {
                                    $class = 'incorrect'; // Đánh dấu đáp án sai người dùng chọn
                                }
                            }
                        ?>
                            <label class="<?= $class ?>">
                                <input 
                                    type="radio" 
                                    name="question_<?= $index ?>" 
                                    value="<?= htmlspecialchars($key) ?>"
                                    <?= $is_user_selected ? 'checked' : '' ?>
                                    <?= $show_results ? 'disabled' : '' ?>
                                >
                                <?= htmlspecialchars($key) ?>. <?= htmlspecialchars($option_text) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div style="text-align: center; margin-top: 30px;">
                <?php if (!$show_results): ?>
                    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Nộp bài</button>
                <?php else: ?>
                    <button type="button" onclick="window.location.reload();" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Làm lại bài thi</button>
                <?php endif; ?>
            </div>
        </form>
        
        <?php if (empty($questions) && file_exists('Quiz.txt')): ?>
            <p style="text-align: center; color: orange;">Lưu ý: Dữ liệu đã được tải nhưng không có câu hỏi hợp lệ nào được phân tích.</p>
        <?php endif; ?>
    </div>

</body>
</html>