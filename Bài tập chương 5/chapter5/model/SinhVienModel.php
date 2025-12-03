<?php
// Tệp Model chịu trách nhiệm cho logic truy vấn CSDL

/**
 * Lấy tất cả sinh viên từ CSDL.
 * @param PDO $pdo Đối tượng PDO kết nối CSDL
 * @return array Danh sách sinh viên
 */
function getAllSinhVien($pdo) {
    // TODO 1: Viết 1 hàm tên là getAllSinhVien()
    $sql = "SELECT * FROM sinhvien";
    $stmt = $pdo->query($sql);
    // Hàm trả về kết quả (dùng fetchAll)
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Thêm một sinh viên mới vào CSDL.
 * @param PDO $pdo Đối tượng PDO kết nối CSDL
 * @param string $ten Tên sinh viên
 * @param string $email Email sinh viên
 */
function addSinhVien($pdo, $ten, $email) {
    // TODO 2: Viết 1 hàm tên là addSinhVien()
    // Bên trong hàm, thực thi câu lệnh INSERT (dùng Prepared Statement)
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
}
?>