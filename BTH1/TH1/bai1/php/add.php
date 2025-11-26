<?php
include 'functions.php';
$flowers = loadFlowers();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Tự tăng ID
    $id = $flowers ? end($flowers)["id"] + 1 : 1;

    // Upload ảnh
    $file = "images/" . $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], $file);

    // Tạo hoa mới
    $new = [
        'id' => $id,
        'name' => $_POST["name"],
        'desc' => $_POST["desc"],
        'image' => $file
    ];

    $flowers[] = $new;
    saveFlowers($flowers);
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Thêm hoa mới</h2>

<form method="post" enctype="multipart/form-data">
    Tên hoa: <br>
    <input type="text" name="name" required><br><br>

    Mô tả:<br>
    <textarea name="desc" required></textarea><br><br>

    Ảnh: <br>
    <input type="file" name="image" required><br><br>

    <button type="submit">Thêm</button>
</form>

</body>
</html>
