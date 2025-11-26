<?php
/**
 * functions.php
 * Chứa logic đọc và phân tích dữ liệu trắc nghiệm từ Quiz.txt
 */

function loadQuizQuestions($filename = 'Quiz.txt') {
    $questions = [];

    if (file_exists($filename)) {
        // Đọc toàn bộ nội dung file
        $content = file_get_contents($filename);
        
        // Chia nội dung thành các khối câu hỏi dựa trên dòng trống
        // \n\s*\n tìm kiếm 1 dòng trống (chứa 0 hoặc nhiều khoảng trắng) giữa 2 lần xuống dòng
        $question_blocks = preg_split("/\n\s*\n/", $content, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($question_blocks as $block) {
            // Tách các dòng trong một khối câu hỏi và loại bỏ dòng trống
            $lines = array_filter(array_map('trim', explode("\n", $block)));
            
            if (empty($lines)) continue;

            $question_data = [
                'question' => array_shift($lines), // Dòng đầu tiên là câu hỏi
                'options' => [],
                'answer' => null
            ];

            foreach ($lines as $line) {
                // Trích xuất đáp án đúng (ANSWER: X)
                if (preg_match('/^ANSWER:\s*([A-Z])/', $line, $matches)) {
                    $question_data['answer'] = trim($matches[1]);
                } 
                // Trích xuất các lựa chọn (A. Text, B. Text)
                elseif (preg_match('/^([A-D])\.\s*(.*)/', $line, $matches_option)) {
                    $question_data['options'][$matches_option[1]] = trim($matches_option[2]);
                }
            }
            
            // Chỉ thêm vào mảng nếu có cả câu hỏi và đáp án
            if ($question_data['answer']) {
                $questions[] = $question_data;
            }
        }

    } else {
        // Trả về mảng rỗng nếu file không tồn tại
        echo "<p style='color: red; text-align: center;'>Lỗi: Không tìm thấy file dữ liệu trắc nghiệm **{$filename}**!</p>";
    }

    return $questions;
}

// Chạy hàm và lưu kết quả vào biến global $questions (có thể bỏ qua bước này nếu gọi trực tiếp trong index.php)
$questions = loadQuizQuestions('Quiz.txt');

?>