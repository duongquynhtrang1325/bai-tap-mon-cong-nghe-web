<?php include 'functions.php'; ?>
<?php $flowers = loadFlowers(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách hoa</title>
<style>
    body { font-family: Arial; width: 900px; margin: auto; line-height: 1.6; }
    h1 { text-align: center; margin-top: 30px; }
    .flower { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; display: flex; }
    .flower img { width: 200px; height: 200px; object-fit: cover; border-radius: 10px; margin-right: 20px; }
    .flower-content { max-width: 650px; }
    .flower-content h2 { margin: 0 0 10px 0; }
    .flower-content p { margin: 0; }
    a.admin-link { display: inline-block; margin-top: 20px; padding: 10px; background: #333; color: white; text-decoration: none; border-radius: 5px; }
</style>
</head>
<body>

<h1>14 loại hoa tuyệt đẹp</h1>

<?php foreach($flowers as $flower): ?>
<div class="flower">
    <img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>">
    <div class="flower-content">
        <h2><?= $flower['name'] ?></h2>
        <p><?= $flower['desc'] ?></p>
    </div>
</div>
<?php endforeach; ?>

<a class="admin-link" href="admin.php">→ Quản trị</a>

</body>
</html>
