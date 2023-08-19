
<?php  
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type:application/json;charset=utf-8");
    $json = file_get_contents("php://input");
    $datas = json_decode($json, true); 
    try {
        require_once("connect_chd102g1.php");

        // 先刪除相關的訂單項目
        $ItemsSql = "DELETE FROM order_item WHERE order_no = :order_no";
        $OrderItems = $pdo->prepare($ItemsSql);
        $OrderItems->bindValue(":order_no", $datas["order_no"]);
        $OrderItems->execute();


        $sql ="DELETE FROM product_order WHERE order_no = :order_no";
        $products = $pdo->prepare( $sql ); 
        $products->bindValue(":order_no", $datas["order_no"]);
        $products->execute();
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