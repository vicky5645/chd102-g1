<?php 
if($_FILES["news_img"]["error"] === 0) {
  $dir = "../../images/pattern/"; //指定所要上傳的路徑
  if(file_exists($dir)===false){
      mkdir($dir); //make directory
  }

  $from = $_FILES["news_img"]["tmp_name"];

  //處理檔名 -> 建立唯一性--------------------
  //---產生主檔名
  $fileName = uniqid();
  //---取出副檔名
  $fileExt = pathInfo($_FILES["news_img"]["name"],
  PATHINFO_EXTENSION); //test.gif

  $fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  $to = $dir . $fileName;

  if(copy($from, $to)){
    //寫入資料庫
    try {
      require_once("./connect_chd102g1.php");
      $sql = "insert into pattern (`pattern_no`, `pattern_name`, `pattern_file`, `pattern_desc`, `creation_date`)
        values (null, :pattern_name, :pattern_file, :pattern_desc, :creation_date);";
      $pattern = $pdo->prepare($sql); 
      $creation_date = date("Y-m-d");// 自動生成當下時間

      // pattern_no 這裡是AUTO_INCREMENT，不需要設定
      $pattern->bindValue(":pattern_name", $_POST["pattern_name"]);
      $pattern->bindValue(":pattern_desc", $_POST["pattern_desc"]);
      $pattern->bindValue(":creation_date", $creation_date);
      $pattern->bindValue(":pattern_file", "images/pattern/$fileName");//添加圖檔路徑
      $pattern->execute();

      // $msg = "新增成功";
      echo "新增成功~<br>";
    } catch (PDOException $e) {
      // $msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage(); 
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      echo "系統暫時不能正常運行，請稍後再試<br>";  
    }

  }else{
    // $msg = "寫入失敗";
    echo "寫入失敗";
  }

} else {
  // $msg = "未上傳圖檔";
  echo "未上傳圖檔";
}
?>