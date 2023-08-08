<?php 
if($_FILES["image"]["error"] === 0) {
  $dir = "../../images/pattern/"; //指定所要上傳的路徑
  if(file_exists($dir)===false){
      mkdir($dir); //make directory
  }

  $from = $_FILES["image"]["tmp_name"];

  $to = $dir . $_FILES["image"]["name"];

  $fileName = $_FILES["image"]["name"]; // 將檔案名稱設定給 $fileName
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
      echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
    }

  }else{
      echo "寫入失敗";
  }

} else {
  echo "未上傳圖檔";
}
?>