<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = db()->prepare('DELETE FROM categories WHERE id = ?');
        $stmt->execute([$id]);
    }

    header('Location: index.php?msg=Xóa thành công');
    exit;
} else {
    // Không cho phép gọi GET request tới file này
    header('Location: index.php');
    exit;
}
