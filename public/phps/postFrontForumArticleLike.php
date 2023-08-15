<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json;charset=utf-8");

try {
    require_once("./connect_chd102g1.php");

    // 檢查是否傳遞了 article_no 和 likeIncrement 參數
    if (!isset($_POST["article_no"]) || !isset($_POST["likeIncrement"])) {
        echo json_encode(['status' => 'error', 'message' => '參數不足']);
        exit;
    }

    $articleNo = $_POST["article_no"];
    $likeIncrement = $_POST["likeIncrement"];

    // 更新資料庫
    $sql = "UPDATE forum SET article_likes = article_likes + :likeIncrement WHERE article_no = :articleNo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":articleNo", $articleNo, PDO::PARAM_INT);
    $stmt->bindValue(":likeIncrement", $likeIncrement, PDO::PARAM_INT);
    
    $stmt->execute();

    if ($stmt->rowCount() > 0) { // 確保有更新到資料
        echo json_encode(['status' => 'success', 'message' => '讚數已更新']);
    } else {
        echo json_encode(['status' => 'error', 'message' => '更新失敗']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => '系統錯誤：' . $e->getMessage()]);
}
?>
