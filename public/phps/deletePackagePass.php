<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("./connect_chd102g1.php");

    // 首先刪除所有引用此文章的評論
    // $sql = "DELETE FROM comment WHERE article_no = :article_no";
    $sql = "DELETE FROM package_pass WHERE `package_pass`.`pkg_no` = :pkg_no AND `package_pass`.`spot_no` = :spot_no;";

    $comment = $pdo->prepare($sql);
    $comment->bindParam(":pkg_no", $_POST["pkg_no"]);
    $comment->bindParam(":spot_no", $_POST["spot_no"]);
    $comment->execute();

    $msg = "已刪除行程景點";
} catch (PDOException $e) {
    $msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
}

$result= ["msg" => $msg];
echo json_encode($result);

?>
