<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    require_once("./connect_chd102g1.php");

    $sql = "UPDATE report 
            SET `report_type` = :report_type
            WHERE `report_no` = :report_no;";

    $forum = $pdo->prepare($sql); 

    $forum->bindValue(":report_type", $_POST["report_type"]); 
    $forum->bindValue(":report_no", $_POST["report_no"]);

    $forum->execute();

    $msg = "已修改檢舉處理狀態";
} catch (PDOException $e) {
    $msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage();
}    

$result = ["msg" => $msg];
echo json_encode($result);

?>
