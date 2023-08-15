<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    require_once("./connect_chd102g1.php");

    $sql = "UPDATE forum 
            SET `platform_online` = :platform_online
            WHERE `article_no` = :article_no;";

    $forum = $pdo->prepare($sql); 

    $forum->bindValue(":platform_online", $_POST["platform_online"]); 
    $forum->bindValue(":article_no", $_POST["article_no"]);

    $forum->execute();

    $msg = "已修改文章上線狀態";
} catch (PDOException $e) {
    $msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage();
}    

$result = ["msg" => $msg];
echo json_encode($result);

?>
