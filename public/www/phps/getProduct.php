<?php
header('Access-Control-Allow-Origin: *');

try {
	//引入連線工作的檔案
	require_once("./connect_chd102g1.php");

	// SQL 查詢
	$stmt = $pdo->query("SELECT * FROM product");
    $data = $stmt->fetchAll();

	//取回所有的資料, 放在2維陣列中
	// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// 輸出 JSON
echo json_encode($data);
?>