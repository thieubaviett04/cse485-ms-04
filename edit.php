<?php
require_once 'config.php';

$error = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Thiếu tham số ID.");
}

// Lấy thông tin hiện tại
$stmt = db()->prepare('SELECT * FROM categories WHERE id = ?');
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    die("Không tìm thấy danh mục.");
}

$name = $category['name'];
$description = $category['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (strlen($name) < 2 || strlen($name) > 100) {
        $error = "Tên danh mục phải từ 2 đến 100 ký tự.";
    } else {
        try {
            $updateStmt = db()->prepare('UPDATE categories SET name = ?, description = ? WHERE id = ?');
            $updateStmt->execute([$name, $description, $id]);

            header('Location: index.php?msg=Sửa thành công');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Tên danh mục '{$name}' đã tồn tại ở một mục khác.";
            } else {
                $error = "Có lỗi xảy ra: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa danh mục</title>
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
                    <h1>Sửa danh mục #<?= htmlspecialchars($id) ?></h1>
                    <p>Chỉnh sửa thông tin danh mục</p>
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
                        <button type="submit" class="btn-submit" style="width: 100%;">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>