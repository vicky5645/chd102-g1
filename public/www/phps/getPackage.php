<?php 
header('Access-Control-Allow-Origin: *');

try {
	//引入連線工作的檔案
	require_once("./connect_chd102g1.php");
	
	//執行sql指令並取得pdoStatement
	$sql = "select * from package";
	$package = $pdo->query($sql); 

	//取回所有的資料, 放在2維陣列中
	$packageData= $package->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($packageData);
} 
catch (Exception $e) {
	echo "錯誤row : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>