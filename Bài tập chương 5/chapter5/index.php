<?php
require_once __DIR__ . '/model/SinhVienModel.php'; 
$host = '127.0.0.1'; 
$dbname = 'cse485_web';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
if (isset($_POST['ten_sinh_vien'])) { 
    $ten = trim($_POST['ten_sinh_vien']);
    $email = trim($_POST['email']);
    if (!empty($ten) && !empty($email)) { 
        addSinhVien($pdo, $ten, $email);
        header('Location: index.php');
        exit; 
    }
}
$danh_sach_sv = getAllSinhVien($pdo); 
include __DIR__ . '/views/sinhvien_view.php';
?>