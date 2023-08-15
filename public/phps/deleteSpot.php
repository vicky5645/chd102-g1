<?php 
header('Access-Control-Allow-Origin:*');

	try {
		require_once("./connect_chd102g1.php");

		$sql = "DELETE FROM spot 
						WHERE spot_no = :spot_no";

		$spot = $pdo->prepare($sql);
		$spot->bindValue(":spot_no", $_POST["spot_no"]);
		$spot->execute();
		
		$spot_file = $_POST["spot_file"];// images/pattern/2.svg
		$filePath = "../$spot_file";
		unlink($filePath); // 將檔案刪除

		$msg = "已刪除圖片";
	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   