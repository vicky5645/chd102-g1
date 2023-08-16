<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

$type=isset($_POST["type"])?$_POST["type"]:'';

	try {
		require_once("./connect_chd102g1.php");

		if($type=='editImg') {
			// 接到圖檔內容
			$base64Image = $_POST['new_img']; // Base64 編碼的圖像數據
			// 將 Base64 編碼的圖像數據解碼二進制數據
			$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));


			//先刪除原位置的圖檔
			$pattern_file = $_POST["pattern_file"];
			$filePath = "../$pattern_file";
			unlink($filePath); // 將檔案刪除

			//處理新的圖檔-------------------------------
			$dir = "../images/member/"; //指定所要上傳的路徑
			//---產生主檔名
			$fileName = uniqid();
			//---取出副檔名 --這裡用接資料的方式處理
			$newsFileName = $_POST['new_filename']; //test.gif
			$fileExt = pathinfo($newsFileName, PATHINFO_EXTENSION);

			$fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

  		// $to = $dir . $fileName;
			//儲存圖檔到指定路徑
			$newfilePath = $dir . $fileName;
			file_put_contents($newfilePath, $imageData);

			echo "修改成功<br>";

			$sql = "UPDATE member 
					SET 
						`pattern_file` = :pattern_file
					WHERE `mem_no` = :mem_no;";
		
		
			$member = $pdo->prepare($sql); 
		
			$member->bindValue(":mem_no", $_POST["mem_no"]);
			
			$member->bindValue(":pattern_file", "images/member/$fileName");//添加圖檔路徑
			$member->execute();
			
			$msg = "修改會員頭像成功!";
		} else {
			// 接到圖檔內容
			$base64Image = $_POST['new_img']; // Base64 編碼的圖像數據
			// 將 Base64 編碼的圖像數據解碼二進制數據
			$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

			//處理新的圖檔-------------------------------
			$dir = "../images/member/"; //指定所要上傳的路徑
			//---產生主檔名
			$fileName = uniqid();
			//---取出副檔名 --這裡用接資料的方式處理
			$newsFileName = $_POST['new_filename']; //test.gif
			$fileExt = pathinfo($newsFileName, PATHINFO_EXTENSION);

			$fileName = "$fileName.$fileExt";//用uniqid()去串接副檔名

			//儲存圖檔到指定路徑
			$newfilePath = $dir . $fileName;
			file_put_contents($newfilePath, $imageData);

			echo "修改成功<br>";

			$sql = "UPDATE member 
					SET 
						`pattern_file` = :pattern_file
					WHERE `mem_no` = :mem_no;";
		
		
			$member = $pdo->prepare($sql); 
		
			$member->bindValue(":mem_no", $_POST["mem_no"]);
			
			$member->bindValue(":pattern_file", "images/member/$fileName");//添加圖檔路徑
			$member->execute();


			$msg = "新增會員頭像成功!";
		}

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>