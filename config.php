<?php
function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $host = '127.0.0.1';
        $db   = 'minishop_cse485';
        $user = 'root';
        $pass = ''; // Mật khẩu XAMPP thường để trống
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            die("Không thể kết nối CSDL: " . $e->getMessage());
        }
    }
    return $pdo;
}
