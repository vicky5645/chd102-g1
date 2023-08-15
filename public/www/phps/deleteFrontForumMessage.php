<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("./connect_chd102g1.php");

    // 刪除留言
    $sql = "DELETE FROM comment WHERE comment_no = :comment_no";
    $comment = $pdo->prepare($sql);
    $comment->bindValue(":comment_no", $_POST["comment_no"]);
    $comment->execute();

    $msg = "已刪除留言";
} catch (PDOException $e) {
    $msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
}

$result= ["msg" => $msg];
echo json_encode($result);

?>
