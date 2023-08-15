<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");
try {
    //引入連線工作的檔案
    require_once("./connect_chd102g1.php");
    $stmt = $pdo->prepare("SELECT * FROM comment as C Join member as M on M.mem_no = C.mem_no where article_no = :article_no");
    $stmt->bindValue(":article_no", $_POST["id"]);
    $stmt->execute();
    $data = $stmt->fetchAll();
    // 輸出 JSON
    echo json_encode($data);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// SQL 查詢

?>
