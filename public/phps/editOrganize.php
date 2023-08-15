<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");


	try {
		require_once("./connect_chd102g1.php");
        
        $sql = "UPDATE organize 
                SET `pkg_no` = :pkg_no, 
                `pkg_limit` = :pkg_limit,
                `pkg_sale` = :pkg_sale,
                `dept_date` = :dept_date,
                `enrolled` = :enrolled,
                `reg_start` = :reg_start,
                `reg_end` = :reg_end
                WHERE `org_no` = :org_no;";
    
    
        $org = $pdo->prepare($sql); 
    
        $org->bindValue(":org_no", $_POST["org_no"]);
        $org->bindValue(":pkg_no", $_POST["pkg_no"]);
        $org->bindValue(":pkg_limit", $_POST["pkg_limit"]);
        $org->bindValue(":pkg_sale", $_POST["pkg_sale"]);
        $org->bindValue(":dept_date", $_POST["dept_date"]);
        $org->bindValue(":enrolled", $_POST["enrolled"]);
        $org->bindValue(":reg_start", $_POST["reg_start"]);
        $org->bindValue(":reg_end", $_POST["reg_end"]);
        $org->execute();
    
        $msg = "已修改資料";

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   