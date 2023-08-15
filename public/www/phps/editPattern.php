<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

$type=isset($_POST["type"])?$_POST["type"]:'';

	try {
		require_once("./connect_chd102g1.php");

		if($type=='editImg') {
			// 接到圖檔內容
			$base64Image = $_POST['news_img']; // Base64 編碼的圖像數據
			// 將 Base64 編碼的圖像數據解碼二進制數據
			$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));


			//先刪除原位置的圖檔
			$pattern_file = $_POST["pattern_file"];// images/pattern/2.svg
			$filePath = "../$pattern_file";
			unlink($filePath); // 將檔案刪除

			//處理新的圖檔-------------------------------
			$dir = "../images/pattern/"; //指定所要上傳的路徑
			//---產生主檔名
			$fileName = uniqid();
			//---取出副檔名 --這裡用接資料的方式處理
			$newsFileName = $_POST['news_filename']; //test.gif
			$fileExt = pathinfo($newsFileName, PATHINFO_EXTENSION);

			$fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  		// $to = $dir . $fileName;
			//儲存圖檔到指定路徑
			$newfilePath = $dir . $fileName;
			file_put_contents($newfilePath, $imageData);

			echo "修改成功<br>";

			$sql = "UPDATE pattern 
					SET `pattern_name` = :pattern_name, 
							`pattern_desc` = :pattern_desc,
							`pattern_file` = :pattern_file
					WHERE `pattern_no` = :pattern_no;";
		
		
			$pattern = $pdo->prepare($sql); 
		
			$pattern->bindValue(":pattern_no", $_POST["pattern_no"]);
			$pattern->bindValue(":pattern_name", $_POST["pattern_name"]);
			$pattern->bindValue(":pattern_desc", $_POST["pattern_desc"]);
			$pattern->bindValue(":pattern_file", "images/pattern/$fileName");//添加圖檔路徑
			$pattern->execute();
			
			$msg = "已修改圖片及描述";
		}else {
			// "未上傳圖檔，只修改文字";
			$sql = "UPDATE pattern 
					SET `pattern_name` = :pattern_name, 
							`pattern_desc` = :pattern_desc
					WHERE `pattern_no` = :pattern_no;";
		
		
			$pattern = $pdo->prepare($sql); 
		
			$pattern->bindValue(":pattern_no", $_POST["pattern_no"]);
			$pattern->bindValue(":pattern_name", $_POST["pattern_name"]);
			$pattern->bindValue(":pattern_desc", $_POST["pattern_desc"]);
			$pattern->execute();
		
			$msg = "已修改圖片描述";
	}

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   