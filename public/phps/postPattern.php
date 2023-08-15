<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");
$type = isset($_POST["type"]) ? $_POST["type"] : '';


if($type == 'addImg') {
  $dir = "../images/pattern/"; //指定所要上傳的路徑
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

  $fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  //儲存圖檔到指定路徑
  $newfilePath = $dir . $fileName;
  if(file_put_contents($newfilePath, $imageData)){
    // 成功新增圖檔後，執行資料庫
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

      $msg = "新增成功~";
    } catch (PDOException $e) {
      $msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage();
    }

  }else{
    $msg = "寫入失敗";
  }

} else {
  $msg = "未上傳圖檔";
}
$result = ["msg" => $msg];
echo json_encode($result);
?>