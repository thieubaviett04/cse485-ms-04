<?php
require_once 'config.php';

$error = '';
$name = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (strlen($name) < 2 || strlen($name) > 100) {
        $error = "Ten danh muc phai tu 2 ky tu den 100 ky tu";
    } else {
        try {
            $stmt = db()->prepare("INSERT INTO categories(name, description) VALUES (?,?)");
            $stmt->execute([$name, $description]);
            header("Location: index.php?msg=Thêm danh mục thành công");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $error = "Tên danh mục đã tồn tại.";
            } else {
                $error = "Lỗi database: " . $e->getMessage();
            }
        }
    }


}


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm danh mục</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="navbar">
            <div class="brand">MiniShop Admin</div>
            <a href="index.php" class="btn-secondary">Quay lại danh sách</a>
        </header>
        <div class="login-card-wrapper">
            <div class="login-card">
                <div class="login-header">
                    <h1>Thêm danh mục mới</h1>
                    <p>Nhập thông tin cho danh mục sản phẩm</p>
                </div>
                <?php if ($error): ?>
                    <div class="alert-error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Tên danh mục (*):</label>
                        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả chi tiết:</label>
                        <textarea name="description" id="description" rows="4"><?= htmlspecialchars($description) ?></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit" style="width: 100%;">Lưu danh mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>