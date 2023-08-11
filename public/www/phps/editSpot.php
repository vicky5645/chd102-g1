<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

$type=isset($_POST["type"])?$_POST["type"]:'';

	try {
		require_once("./connect_chd102g1.php");

		if($type=='editimg') {
			// 接到圖檔內容
			$base64Image = $_POST['news_img']; // Base64 編碼的圖像數據
			// 將 Base64 編碼的圖像數據解碼二進制數據
			$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));


			//先刪除原位置的圖檔
			$spot_file = $_POST["spot_file"];
			$filePath = "../../$spot_file";
			unlink($filePath); // 將檔案刪除

			//處理新的圖檔-------------------------------
			$dir = "../../images/tmp/"; //指定所要上傳的路徑
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

			$sql = "UPDATE spot 
					SET `spot_name` = :spot_name, 
						`spot_info` = :spot_info,
						`spot_status` = :spot_status,
						`spot_file` = :spot_file
					WHERE `spot_no` = :spot_no;";
		
		
			$spot = $pdo->prepare($sql); 
		
			$spot->bindValue(":spot_no", $_POST["spot_no"]);
			$spot->bindValue(":spot_name", $_POST["spot_name"]);
			$spot->bindValue(":spot_info", $_POST["spot_info"]);
			$spot->bindValue(":spot_status", $_POST["spot_status"]);
			$spot->bindValue(":spot_file", "images/tmp/$fileName");//添加圖檔路徑
			$spot->execute();
			
			$msg = "已修改圖片及描述";
		}else {
			// "未上傳圖檔，只修改文字";
			$sql = "UPDATE spot 
					SET `spot_name` = :spot_name, 
						`spot_info` = :spot_info,
						`spot_status` = :spot_status
					WHERE `spot_no` = :spot_no;";
		
		
			$spot = $pdo->prepare($sql); 
		
			$spot->bindValue(":spot_no", $_POST["spot_no"]);
			$spot->bindValue(":spot_name", $_POST["spot_name"]);
			$spot->bindValue(":spot_info", $_POST["spot_info"]);
			$spot->bindValue(":spot_status", $_POST["spot_status"]);
			$spot->execute();
		
			$msg = "已修改資料";
	}

	
	} catch (PDOException $e) {
		$msg = "error_line: ".$e->getLine().", error_msg: ".$e->getMessage();
	}	


$result= ["msg" => $msg];
echo json_encode($result);

?>   