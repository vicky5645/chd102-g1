<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");
$type = isset($_POST["type"]) ? $_POST["type"] : '';


if ($type == 'addImg') {
  $dir = "../images/tmp/"; //指定所要上傳的路徑
  if(file_exists($dir)===false){
      mkdir($dir); //make directory
  }

  // 接到圖檔內容
  $base64Image = $_POST['news_img']; // Base64 編碼的圖像數據
  // 將 Base64 編碼的圖像數據解碼二進制數據
  $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

  //處理檔名 -> 建立唯一性--------------------
  //---產生主檔名
  $fileName = uniqid(); //13個隨機字符
  //---取出副檔名   
  $newsFileName = $_POST['news_filename']; //test.gif
  $fileExt = pathInfo($newsFileName, PATHINFO_EXTENSION);

  $fileName = "$fileName.$fileExt"; //用uniqid()去串接副檔名

  //儲存圖檔到指定路徑
  $newfilePath = $dir . $fileName;
  if(file_put_contents($newfilePath, $imageData)){
    // 成功新增圖檔後，執行資料庫
    try {
      require_once("./connect_chd102g1.php");
      $sql = "insert into spot (`spot_no`, `spot_name`, `spot_info`, `spot_status`, `spot_file`)
        values (null, :spot_name, :spot_info, :spot_status, :spot_file);";
      $spot = $pdo->prepare($sql);

      // spot_no 這裡是AUTO_INCREMENT，不需要設定
      $spot->bindValue(":spot_name", $_POST["spot_name"]);
      $spot->bindValue(":spot_info", $_POST["spot_info"]);
      $spot->bindValue(":spot_status", $_POST["spot_status"]);
      $spot->bindValue(":spot_file", "images/tmp/$fileName");//添加圖檔路徑			
      $spot->execute();
      echo "新增成功";
      

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