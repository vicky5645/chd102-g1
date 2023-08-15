
<?php
header('Access-Control-Allow-Origin: *');

$type = isset($_POST["type"]) ? $_POST["type"] : '';

try {
    //引入連線工作的檔案
    require_once("./connect_chd102g1.php");

    if($type == 'authMixin') {
        // 檢查使用者的登錄狀態 authMixin.js 
        // 對照 資料庫的會員信箱 和 目前登入信箱是否一致
        // 回傳資料庫的會員資料 記錄到 updateUserInfo
        
        $sql = "SELECT * FROM member WHERE `mem_email` = :mem_email;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":mem_email", $_POST["mem_email"]);
        $stmt->execute();
        $data = $stmt->fetchAll();


    } else {
        // SQL 查詢
        $stmt = $pdo->query("SELECT * FROM member");
        $data = $stmt->fetchAll();
    }

} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}


// 輸出 JSON
echo json_encode($data);
?>

