<?php
header('Access-Control-Allow-Origin: *');

try {
    //引入連線工作的檔案
    require_once("./connect_chd102g1.php");
    // SQL 查詢
    $stmt = $pdo->query("SELECT * FROM forum AS F JOIN member AS M ON F.mem_no = M.mem_no ORDER BY article_date DESC");
    $data = $stmt->fetchAll();
// 輸出 JSON
echo json_encode($data);

} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>


