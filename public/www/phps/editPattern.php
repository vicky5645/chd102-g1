<?php 
header('Access-Control-Allow-Origin:*');

	try {
		require_once("./connect_chd102g1.php");

		$sql = "UPDATE pattern 
        SET `pattern_name` = :pattern_name, 
            `pattern_desc` = :pattern_desc
        WHERE `pattern_no` = :pattern_no;";


		$pattern = $pdo->prepare($sql); 

		$pattern->bindValue(":pattern_no", $_POST["pattern_no"]);
		$pattern->bindValue(":pattern_name", $_POST["pattern_name"]);
		$pattern->bindValue(":pattern_desc", $_POST["pattern_desc"]);
		// $pattern->bindValue(":pattern_file", "images/pattern/$fileName");//添加圖檔路徑
		$pattern->execute();
		
		// $pattern_file = $_POST["pattern_file"];// images/pattern/2.svg
		// $filePath = "../../$pattern_file";
		// unlink($filePath); // 將檔案刪除

		$msg = "已修改圖片";
	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   