<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type:application/json;charset=utf-8");
    $json = file_get_contents("php://input");
    $datas = json_decode($json, true); 

require_once("connect_chd102g1.php");


// $result = ["msg" => $msg];

    try {
   
        $sql = "INSERT INTO product_order (`order_no`, `order_date`, `mem_no`, `order_total`, `order_status`, `recipient`, `recipient_tele`, `recipient_address`, `pay`)
              VALUES (null, CURRENT_DATE(), :mem_no, :order_total, :order_status, :recipient, :recipient_tele, :recipient_address, :pay)";
        $order = $pdo->prepare($sql);

        // order_no 在SQL裡是AUTO_INCREMENT，不需要設定
        // $order->bindValue(":order_date", $datas["order_date"]);
        $order->bindValue(":mem_no", (int)$datas["mem_no"]);
        $order->bindValue(":order_total", $datas["order_total"]);
        $order->bindValue(":order_status", $datas["order_status"]);
        $order->bindValue(":recipient", $datas["recipient"]);
        $order->bindValue(":recipient_tele", $datas["recipient_tele"]);
        $order->bindValue(":recipient_address", $datas["recipient_address"]);
        $order->bindValue(":pay", $datas["pay"]);
        $order->execute();


        // 訂單項目處理，取得剛插入的訂單號ID
        $orderNo = $pdo->lastInsertId();

        $orderItems = $datas['orderItems'];
        foreach ($orderItems as $item) {
            $prod_no = (int) $item['prod_no'];
            $price = (float) $item['price'];
            $quantity = (int) $item['quantity'];

            $orderItemSql = "INSERT INTO order_item (`order_no`, `prod_no`, `price`, `quantity`) 
                        VALUES (:order_no, :prod_no, :price, :quantity)";
            $orderItemStmt = $pdo->prepare($orderItemSql);
            // :order_no 使用上面訂單號ID
            $orderItemStmt->bindValue(':order_no', $orderNo, PDO::PARAM_INT); 
            $orderItemStmt->bindValue(":prod_no", $prod_no);
            $orderItemStmt->bindValue(":price", $price);
            $orderItemStmt->bindValue(":quantity", $quantity);
            $orderItemStmt->execute();
        }


        $msg = "訂單成功送出";
        $result = [
            "msg" => $msg,
        ];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
        $result = ["msg" => $msg];
    }
echo json_encode($result);
?>
