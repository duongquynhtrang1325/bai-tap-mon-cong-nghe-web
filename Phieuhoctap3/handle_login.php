<?php
//TODO 1: Khởi động session    
//Phải gọi hàm này TRƯỚC BẤT KỲ output HTML nào  
session_start ();
//TODO 2: Kiểm tra xem người dùng đã nhập nút "Đăng nhập" gửi form chưa 
if (isset ( $_POST ['username'] )) {
    //TODO 3: Nếu đã gửi form, lấy dữ liệu 'username' và 'passwword' từ $_POST
    $user = $_POST ['username'];
    $pass = $_POST ['password'];
    
    //TODO 4: (Giả lâp) Kiểm tra logic đăng nhập)
    if ($user == 'Trang Duong' && $pass == '132508') {
        //TODO 5: Nếu thành công, lưu tên username vào session
        $_SESSION ['TrangDuong'] = $user;
        
        //TODO 6: Chuyển hướng người dùng sang trang "chào mừng"
        header('Location: welcome.php');
        exit ();
    } else {
        //Nếu thất bại, chuyển hướng đến login.html
        header(('Location: login.html?error=1'));
        //Kèm theo thông báo lỗi trên URL
        exit ();
    }
} else {
    //TODO 7: Nếu người dùng truy cập trực tiếp file này (không qua POST). 
    // "đá" họ về trang login.html
    header('Location: login.html');
    exit ();
}
?>