<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("./connect_chd102g1.php");

    // 刪除檢舉
    $sql = "DELETE FROM report WHERE report_no = :report_no";
    $comment = $pdo->prepare($sql);
    $comment->bindValue(":report_no", $_POST["report_no"]);
    $comment->execute();

    $msg = "已刪除檢舉";
} catch (PDOException $e) {
    $msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
}

$result= ["msg" => $msg];
echo json_encode($result);

?>
