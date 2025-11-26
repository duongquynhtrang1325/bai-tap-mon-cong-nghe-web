<?php 
include 'functions.php';
$flowers = loadFlowers();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản trị hoa</title>
<style>
    body { font-family: Arial; width: 900px; margin: auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; }
    img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
    .btn-add { padding: 10px; background: green; color: white; text-decoration: none; }
    .btn { padding: 5px 10px; color: white; text-decoration: none; border-radius: 3px; }
    .edit { background: orange; }
    .del { background: red; }
</style>
</head>
<body>

<h1>Danh sách hoa</h1>
<a class="btn-add" href="add.php">+ Thêm hoa mới</a>

<table>
<tr>
    <th>ID</th>
    <th>Tên hoa</th>
    <th>Mô tả</th>
    <th>Ảnh</th>
    <th>Hành động</th>
</tr>

<?php foreach ($flowers as $flower): ?>
<tr>
    <td><?= $flower["id"] ?></td>
    <td><?= $flower["name"] ?></td>
    <td><?= $flower["desc"] ?></td>
    <td><img src="<?= $flower["image"] ?>"></td>
    <td>
        <a class="btn edit" href="edit.php?id=<?= $flower['id'] ?>">Sửa</a>
        <a class="btn del" onclick="return confirm('Xóa?')" href="delete.php?id=<?= $flower['id'] ?>">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>
