
<?php  
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type:application/json;charset=utf-8");
    $json = file_get_contents("php://input");
    $datas = json_decode($json, true); 
    const MY_DIR = "../images/online-mall"; 
    try {
        require_once("connect_chd102g1.php");
        $sql ="DELETE FROM product WHERE prod_no = :prod_no";
        $products = $pdo->prepare( $sql ); 
        $products->bindValue(":prod_no", $datas["prod_no"]);
        $products->execute();
        $msg = "刪除成功";
        $result = ["msg" => $msg]; 

        //刪除原位置的圖檔
		$prod_file = $datas["old_file"];// test.png
		$filePath = MY_DIR . "/" . $prod_file; //../images/online-mall/test.png
        if (file_exists($filePath)) { //判斷該路徑圖檔存在才進行刪除
            unlink($filePath);
        }
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        $msg = "刪除失敗";
        $result = ["msg" => $msg];
    }  
    echo json_encode($result);
?>