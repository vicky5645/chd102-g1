<?php
header('Access-Control-Allow-Origin: *');

$type = isset($_GET["type"]) ? $_GET["type"] : '';

try {
  //引入連線工作的檔案
  require_once("./connect_chd102g1.php");

  // if ($type == 'getOrder') {
    // 檢查會員的商品訂單 

    $sql = "SELECT 
            po.order_no,
            po.order_date,
            po.mem_no,
            po.order_total,
            po.order_status,
            po.recipient,
            po.recipient_tele,
            po.recipient_address,
            po.pay,
            oi.price,
            oi.quantity,
            p.prod_name
        FROM product_order po
        JOIN order_item oi ON po.order_no = oi.order_no
        JOIN product p ON oi.prod_no = p.prod_no
        WHERE `mem_no` = :mem_no;";
        // WHERE po.order_status = 1; -- 1 表示已出貨";


    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mem_no", $_GET["mem_no"]);
    $stmt->execute();
    $data = $stmt->fetchAll();


  // } else {
  //   // SQL 查詢
  //   $stmt = $pdo->query("SELECT * FROM member");
  //   $data = $stmt->fetchAll();
  // }

} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int) $e->getCode());
}


// 輸出 JSON
echo json_encode($data);
?>