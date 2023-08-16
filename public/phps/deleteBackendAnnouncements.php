
<?php  
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type:application/json;charset=utf-8");
    $json = file_get_contents("php://input");
    $datas = json_decode($json, true); 
    
    try {
        require_once("connect_chd102g1.php");
        $sql ="DELETE FROM announcement WHERE anno_no = :anno_no";
        $products = $pdo->prepare( $sql ); 
        $products->bindValue(":anno_no", $datas["id"]);
        $products->execute();

      
        $image_path = $datas["FilePath"];
		$image_current_path = "../../$image_path";
        if (file_exists($image_current_path)) { 
		unlink($image_current_path); 
        } 
 
        $msg = "刪除成功";
        $result = ["msg" => $msg]; 
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        $msg = "刪除失敗";
        $result = ["msg" => $msg];
    }  
    echo json_encode($result);
?>