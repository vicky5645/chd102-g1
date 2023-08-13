<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: *");
header("Content-Type:application/json;charset=utf-8");

  $newProduct = json_decode(file_get_contents("php://input"), true);

    //寫入資料庫
    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO product (`prod_name`, `prod_summary`, `prod_price`, `prod_status`, `prod_file`, `prod_type`, `prod_hot`)
              VALUES (:prod_name, :prod_summary, :prod_price, :prod_status, :prod_file, :prod_type, :prod_hot)";
      $product = $pdo->prepare($sql); 

      // product_no 這裡是AUTO_INCREMENT，不需要設定
      $product->bindParam(':prod_name', $newProduct["prod_name"]);
      $product->bindParam(':prod_summary', $newProduct["prod_summary"]);
      $product->bindParam(':prod_price', $newProduct["prod_price"]);
      $product->bindParam(':prod_status', $newProduct["prod_status"]);
      $product->bindParam(':prod_file', $newProduct["prod_file"]);
      $product->bindParam(':prod_type', $newProduct["prod_type"]);
      $product->bindParam(':prod_hot', $newProduct["prod_hot"]);
      $product->execute();

      echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      echo "系統暫時不能正常運行，請稍後再試<br>";  
    }



?>

