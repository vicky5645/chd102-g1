<?php
if($_FILES["new_img"]["error"] === 0) {
  $dir = "../../images/online-mall/"; //指定所要上傳的路徑
  if(file_exists($dir)===false){
      mkdir($dir); //make directory
  }

  $newProduct = json_decode(file_get_contents("php://input"), true);

  $from = $_FILES["new_img"]["tmp_name"];

  //處理檔名 -> 建立唯一性--------------------
  //---產生主檔名
  $fileName = uniqid(); //13個隨機字符
  //---取出副檔名   
  $fileExt = pathInfo($_FILES["new_img"]["name"],
  PATHINFO_EXTENSION); //取得物件格式裡的檔案名稱後再處理: 01.svg -> .svg

  $fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  $to = $dir . $fileName;

  if(copy($from, $to)){
    //寫入資料庫
    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO product (`prod_name`, `prod_summary`, `prod_price`, `prod_status`, `prod_file`, `prod_type`, `prod_hot`)
              VALUES (:prod_name, :prod_summary, :prod_price, :prod_status, :prod_file, :prod_type, :prod_hot";
      $product = $pdo->prepare($sql); 

      // product_no 這裡是AUTO_INCREMENT，不需要設定
      $product->bindParam(":prod_name", $newProduct["prod_name"]);
      $product->bindParam(":prod_summary", $newProduct["prod_summary"]);
      $product->bindParam(":prod_price", $newProduct["prod_price"]);
      $product->bindParam(":prod_status", $newProduct["prod_status"]);
      // creation_date SQL 指令生成當下日期
      $product->bindValue(":prod_file", "images/online-mall/$fileName");//添加圖檔路徑
      $product->bindParam(":prod_type", $newProduct["prod_type"]);
      $product->bindParam(":prod_hot", $newProduct["prod_hot"]);
      $product->execute();

      echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      echo "系統暫時不能正常運行，請稍後再試<br>";  
    }

  }else{
    echo "寫入失敗";
  }

} else {
  echo "未上傳圖檔";
}
?>