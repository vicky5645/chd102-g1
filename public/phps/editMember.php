<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");


	try {
		require_once("./connect_chd102g1.php");
        $sql = "UPDATE member 
                SET `mem_name` = :mem_name, 
                        `mem_salutation` = :mem_salutation,
                        `mem_email` = :mem_email,
                        `mem_mobile` = :mem_mobile,
                        `mem_addr` = :mem_addr                
                        WHERE `mem_no` = :mem_no;";
    
    
        $pkg = $pdo->prepare($sql); 
    
        $pkg->bindValue(":mem_name", $_POST["mem_name"]);
        $pkg->bindValue(":mem_salutation", $_POST["mem_salutation"]);
        $pkg->bindValue(":mem_email", $_POST["mem_email"]);
        $pkg->bindValue(":mem_mobile", $_POST["mem_mobile"]);
        $pkg->bindValue(":mem_addr", $_POST["mem_addr"]);
        $pkg->bindParam(":mem_no", $_POST["mem_no"]);
        $pkg->execute();
    
        $msg = "已修改資料";

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   