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
      $sql = "insert into spot (`spot_no`, `spot_name`, `spot_info`, `spot_status`, `spot_file`)
        values (null, :spot_name, :spot_info, :spot_status, :spot_file);";
      $pattern = $pdo->prepare($sql); 

      // pattern_no 這裡是AUTO_INCREMENT，不需要設定
      $pattern->bindValue(":spot_name", $_POST["spot_name"]);
      $pattern->bindValue(":spot_info", $_POST["spot_info"]);
      $pattern->bindValue(":spot_file", "images/pattern/$fileName");//添加圖檔路徑


// 添加以下代碼進行調試
// echo "pattern_name: ".$_POST["pattern_name"]."<br>";
// echo "pattern_desc: ".$_POST["pattern_desc"]."<br>";


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