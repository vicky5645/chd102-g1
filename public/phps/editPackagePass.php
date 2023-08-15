<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");


	try {
		require_once("./connect_chd102g1.php");
        $sql = "UPDATE package_pass 
                SET `spot_sort` = :spot_sort, 
                `pkg_howday` = :pkg_howday
                WHERE `package_pass`.`pkg_no` = :pkg_no AND `package_pass`.`spot_no` = :spot_no;";
    
    
        $pkg = $pdo->prepare($sql); 
    
        $pkg->bindValue(":spot_sort", $_POST["spot_sort"]);
        $pkg->bindValue(":pkg_howday", $_POST["pkg_howday"]);
        $pkg->bindParam(":pkg_no", $_POST["pkg_no"]);
        $pkg->bindParam(":spot_no", $_POST["spot_no"]);
        $pkg->execute();
    
        $msg = "已修改資料";

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   