<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');




try {
	require_once("./connect_chd102g1.php");

	// 先刪除相關的評論
	$sql_comment = "DELETE FROM comment WHERE article_no = :article_no";
	$comment = $pdo->prepare($sql_comment);
	$comment->bindValue(":article_no", $_POST["article_no"]);
	$comment->execute();

	// 然後刪除文章
	$sql_forum = "DELETE FROM forum WHERE article_no = :article_no";
	$article = $pdo->prepare($sql_forum);
	$article->bindValue(":article_no", $_POST["article_no"]);
	$article->execute();
	
	$article_image = $_POST["article_image"]; // images/pattern/2.svg
	$filePath = "../$article_image";
	if(file_exists($filePath)){ // 檢查檔案是否存在
		unlink($filePath);// 將檔案刪除
	}
	

	$msg = "已刪除文章和相關評論，並刪除圖片";
	$result= ["msg" => $msg];

	
} catch (PDOException $e) {
	$msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage();
	$result= ["msg" => $msg];
}



echo json_encode($result);

// echo $_POST["article_image"];

?>   