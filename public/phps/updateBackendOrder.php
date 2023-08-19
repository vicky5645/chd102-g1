<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type:application/json;charset=utf-8");
    $json = file_get_contents("php://input");
    $datas = json_decode($json, true); 

require_once("connect_chd102g1.php");


// $result = ["msg" => $msg];

    try {
   
        $sql = "UPDATE product_order SET order_status = :order_status, recipient = :recipient, recipient_tele = :recipient_tele, recipient_address = :recipient_address WHERE order_no = :order_no";
        $order = $pdo->prepare($sql);

        $order->bindValue(":order_no", (int)$datas["order_no"]);
        $order->bindValue(":order_status", $datas["order_status"]);
        $order->bindValue(":recipient", $datas["recipient"]);
        $order->bindValue(":recipient_tele", $datas["recipient_tele"]);
        $order->bindValue(":recipient_address", $datas["recipient_address"]);
        $order->execute();
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
