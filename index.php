<?php
require_once 'config.php';

$rows = db()->query('SELECT id, name, description, created_at FROM categories ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách danh mục</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="navbar">
            <div class="brand">MiniShop Admin</div>
            <div class="user-info">
                <span>Quản lý Danh Mục</span>
            </div>
        </header>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>

        <div class="table-card">
            <div class="table-title">
                Danh sách danh mục (Categories)
                <a href="create.php" class="btn-submit">Thêm mới</a>
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td style="font-weight: 600; color: var(--text-primary);"><?= htmlspecialchars($row['name']) ?></td>
                            <td style="color: var(--text-secondary);"><?= htmlspecialchars($row['description'] ?? '') ?></td>
                            <td style="font-size: 0.85rem; color: var(--text-secondary);"><?= $row['created_at'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn-warning">Sửa</a>
                                <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($rows)): ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 2rem;">Chưa có danh mục nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
