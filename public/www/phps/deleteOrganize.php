<?php 
header('Access-Control-Allow-Origin:*');

	try {
		require_once("./connect_chd102g1.php");

		$sql = "DELETE FROM organize 
						WHERE org_no = :org_no";

		$org = $pdo->prepare($sql);
		$org->bindValue(":org_no", $_POST["org_no"]);
		$org->execute();

	
	} catch (PDOException $e) {
		echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
	}	

?>   