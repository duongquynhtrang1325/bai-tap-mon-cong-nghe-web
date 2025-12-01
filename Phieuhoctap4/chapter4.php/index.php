<?php
// === KẾT NỐI CSDL ===
$host = '127.0.0.1'; // hoặc localhost
$dbname = 'cse485_web'; // Tên CSDL bạn vừa tạo [cite: 19]
$username = 'root'; // Username mặc định của XAMPP [cite: 19]
$password = ''; // Password mặc định của XAMPP (rỗng)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; // [cite: 19]

try {
    // TODO 1: Tạo đối tượng PDO để kết nối CSDL
    $pdo = new PDO($dsn, $username, $password); // [cite: 20]
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Thiết lập chế độ báo lỗi PDO [cite: 20]
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage()); // [cite: 21]
}

// === XỬ LÝ THÊM SINH VIÊN (LOGIC THÊM VÀO CSDL) ===
// TODO 2: Kiểm tra xem form đã được gửi đi (method POST) và có 'ten_sinh_vien' không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_sinh_vien'])) { // [cite: 22]
     
    // TODO 3: Lấy dữ liệu 'ten_sinh_vien' và 'email' từ $_POST
    $ten = $_POST['ten_sinh_vien']; // [cite: 22]
    $email = $_POST['email']; // [cite: 22]

    // TODO 4: Viết câu lệnh SQL INSERT với Prepared Statement (dùng dấu ?)
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)"; // [cite: 22]

    // TODO 5: Chuẩn bị (prepare) và thực thi (execute) câu lệnh
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]); // Gắn giá trị vào placeholder và thực thi [cite: 23]
     
    // TODO 6: (Tùy chọn) Chuyển hướng về trang chủ để "làm mới" và tránh gửi lại form
    header("Location: index.php"); // [cite: 23] (Sử dụng index.php như trong ảnh 2)
    exit; // [cite: 23]
}

// === LOGIC LẤY DANH SÁCH SINH VIÊN (SELECT) ===
// TODO 7: Viết câu lệnh SQL SELECT *
$sql_select = "SELECT * FROM sinhvien ORDER BY ngay_tao DESC"; // [cite: 24]

// TODO 8: Thực thi câu lệnh SELECT (dùng query vì không có tham số)
$stmt_select = $pdo->query($sql_select); // [cite: 24]
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHT Chương 4 - Website hướng dữ liệu</title>
    <style>
        table { width: 100%; border-collapse: collapse; } // [cite: 25]
        th, td { border: 1px solid #ddd; padding: 8px; } // [cite: 26]
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Thêm Sinh Viên Mới (Chủ đề 4.3)</h2>
    <form action="index.php" method="POST"> Tên sinh viên: <input type="text" name="ten_sinh_vien" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Thêm</button> </form>
    
    <h2>Danh Sách Sinh Viên (Chủ đề 4.2)</h2>
    <table> 
        <tr> 
            <th>ID</th> 
            <th>Tên Sinh Viên</th> 
            <th>Email</th> 
            <th>Ngày Tạo</th> 
        </tr> 
   
        <?php 
        // TODO 9: Dùng vòng lặp while để duyệt qua kết quả $stmt_select
        // PDO::FETCH_ASSOC chỉ lấy tên cột làm khóa
        while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) : // [cite: 28]
        ?> 
            <tr> 
                <td><?= htmlspecialchars($row['id']) ?></td> <td><?= htmlspecialchars($row['ten_sinh_vien']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td> <td><?= htmlspecialchars($row['ngay_tao']) ?></td>
            </tr> 
        <?php 
        endwhile; // Đóng vòng lặp [cite: 28]
        ?>
    </table>
</body>
</html>