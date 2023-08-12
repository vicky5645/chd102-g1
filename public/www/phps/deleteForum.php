<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("./connect_chd102g1.php");

    // 首先刪除所有引用此文章的評論
    $sql = "DELETE FROM comment WHERE article_no = :article_no";
    $comment = $pdo->prepare($sql);
    $comment->bindValue(":article_no", $_POST["article_no"]);
    $comment->execute();

    // 接下來刪除所有引用此文章的報告
    $sql = "DELETE FROM report WHERE article_no = :article_no";
    $report = $pdo->prepare($sql);
    $report->bindValue(":article_no", $_POST["article_no"]);
    $report->execute();

    // 然後刪除文章
    $sql = "DELETE FROM forum WHERE article_no = :article_no";
    $forum = $pdo->prepare($sql);
    $forum->bindValue(":article_no", $_POST["article_no"]);
    $forum->execute();

    $article_image_file = $_POST["article_image_file"];
    $filePath = "../../$article_image_file";
    unlink($filePath); // 將檔案刪除

    $msg = "已刪除文章";
} catch (PDOException $e) {
    $msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
}

$result= ["msg" => $msg];
echo json_encode($result);

?>
