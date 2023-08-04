<?php
header('Access-Control-Allow-Origin: *');

// 資料庫連接設定
$host = 'localhost';
$port = 8889; // 端口
$db   = 'CHD102_g1';
$user = 'root'; // 帳號
$pass = 'root'; // 密碼
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset"; // 注意這裡加入了 port
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// SQL 查詢
$stmt = $pdo->query("SELECT * FROM package");
$data = $stmt->fetchAll();

// 輸出 JSON
echo json_encode($data);
?>
