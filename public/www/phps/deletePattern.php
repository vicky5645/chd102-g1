<?php 
header('Access-Control-Allow-Origin:*');

	try {
		require_once("./connect_chd102g1.php");

		$sql = "DELETE FROM pattern 
						WHERE pattern_no = :pattern_no";

		$pattern = $pdo->prepare($sql);
		$pattern->bindValue(":pattern_no", $_POST["pattern_no"]);
		$pattern->execute();
		
		$pattern_file = $_POST["pattern_file"];// images/pattern/2.svg
		$filePath = "../../$pattern_file";
		unlink($filePath); // 將檔案刪除

		$msg = "已刪除圖片";
	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   