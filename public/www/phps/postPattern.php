<?php
if($_FILES["news_img"]["error"] === 0) {
  $dir = "../../images/pattern/"; //指定所要上傳的路徑
  if(file_exists($dir)===false){
      mkdir($dir); //make directory
  }

  $from = $_FILES["news_img"]["tmp_name"];

  //處理檔名 -> 建立唯一性--------------------
  //---產生主檔名
  $fileName = uniqid(); //13個隨機字符
  //---取出副檔名   
  $fileExt = pathInfo($_FILES["news_img"]["name"],
  PATHINFO_EXTENSION); //取得物件格式裡的檔案名稱後再處理: 01.svg -> .svg

  $fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  $to = $dir . $fileName;

  if(copy($from, $to)){
    //寫入資料庫
    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO pattern (`pattern_no`, `pattern_name`, `pattern_file`, `pattern_desc`, `creation_date`)
              VALUES (null, :pattern_name, :pattern_file, :pattern_desc, CURDATE());";
      $pattern = $pdo->prepare($sql); 

      // pattern_no 這裡是AUTO_INCREMENT，不需要設定
      $pattern->bindValue(":pattern_name", $_POST["pattern_name"]);
      $pattern->bindValue(":pattern_desc", $_POST["pattern_desc"]);
      // creation_date SQL 指令生成當下日期
      $pattern->bindValue(":pattern_file", "images/pattern/$fileName");//添加圖檔路徑
      $pattern->execute();

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