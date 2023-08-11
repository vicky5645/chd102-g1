<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");


	try {
		require_once("./connect_chd102g1.php");
        // "未只修改文字";
        $sql = "UPDATE package 
                SET `pkg_price` = :pkg_price, 
                `pkg_status` = :pkg_status,
                `pkg_name` = :pkg_name,
                `pkg_desc` = :pkg_desc,
                `train_no` = :train_no,
                `conductor` = :conductor
                WHERE `pkg_no` = :pkg_no;";
    
    
        $pkg = $pdo->prepare($sql); 
    
        $pkg->bindValue(":pkg_no", $_POST["pkg_no"]);
        $pkg->bindValue(":pkg_price", $_POST["pkg_price"]);
        $pkg->bindValue(":pkg_status", $_POST["pkg_status"]);
        $pkg->bindValue(":pkg_name", $_POST["pkg_name"]);
        $pkg->bindValue(":pkg_desc", $_POST["pkg_desc"]);
        $pkg->bindValue(":train_no", $_POST["train_no"]);
        $pkg->bindValue(":conductor", $_POST["conductor"]);
        $pkg->execute();
    
        $msg = "已修改資料";

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   