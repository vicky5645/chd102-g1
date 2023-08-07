<?php 
// 資料庫連接設定
$host = 'localhost';
$port = 3306; // 端口
$db   = 'chd102_g1';
$user = "root";
$pass = "";
$charset = 'utf8';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset"; // 注意這裡加入了 port

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

	
//建立pdo物件
$pdo = new PDO($dsn, $user, $pass, $options);	
?>