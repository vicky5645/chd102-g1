<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");

require_once("connect_chd102g1.php");

const MY_DIR = "../../images/img/announcements";
const SQL_IMG_PATH = "images/img/announcements";


if(isset($_FILES["image"])){
switch ($_FILES["image"]["error"]) {
    case UPLOAD_ERR_OK:
        if (!file_exists(MY_DIR)) {
            mkdir(MY_DIR);
        }

        $from = $_FILES["image"]["tmp_name"];
        $fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $banner = uniqid() . "." . $fileExt;
        $to = MY_DIR . "/" . $banner;
        $final_img_path = SQL_IMG_PATH . "/" . $banner;

        if (copy($from, $to)) {
            $msg = "檔案上傳成功且移動成功";
        } else {
            $msg = "檔案上傳成功，但移動失敗";
        }
        break;
    case UPLOAD_ERR_INI_SIZE:
        $msg = "上傳檔案太大，不能超過 " . ini_get("upload_max_filesize");
        break;
    case UPLOAD_ERR_FORM_SIZE:
        $msg = "上傳檔案太大，不能超過 " . $_POST["MAX_FILE_SIZE"];
        break;
    case UPLOAD_ERR_PARTIAL:
        $msg = "上傳檔案不完整";
        break;
    case UPLOAD_ERR_NO_FILE:
        $msg = "沒有上傳檔案";
        break;
    default:
        $msg = "上傳檔案失敗，錯誤代碼: " . $_FILES["image"]["error"] . " 請通知系統開發人員";
}

$result = ["msg" => $msg];

if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    try {
        $sql = "UPDATE announcement SET anno_title = :anno_title, anno_type = :anno_type, anno_content = :anno_content, anno_file = :anno_file WHERE anno_no = :anno_no";
        $products = $pdo->prepare($sql);
        $products->bindValue(":anno_no", $_POST["id"]);
        $products->bindValue(":anno_title", $_POST["title"]);
        $products->bindValue(":anno_type", $_POST["type"]);
        $products->bindValue(":anno_content", $_POST["content"]);
        $products->bindValue(":anno_file", $final_img_path);
        $products->execute();
            
        
        $image_path = $_POST["FilePath"];
		$image_current_path = "../../$image_path";
        if (file_exists($image_current_path)) { 
		unlink($image_current_path); 
        } 

        $msg = "更新成功";
        $result["msg"] = $msg;
        $result["image"] = $banner;
        $result["anno_no"] = $_POST["id"];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號: " . $e->getLine() . ", 錯誤訊息: " . $e->getMessage();
        $result["msg"] = $msg;
    }
}
}else{
    try {
        $sql = "UPDATE announcement SET anno_title = :anno_title, anno_type = :anno_type, anno_content = :anno_content WHERE anno_no = :anno_no";
        $products = $pdo->prepare($sql);
        $products->bindValue(":anno_no", $_POST["id"]);
        $products->bindValue(":anno_title", $_POST["title"]);
        $products->bindValue(":anno_type", $_POST["type"]);
        $products->bindValue(":anno_content", $_POST["content"]);
        $products->execute();
        $msg = "更新成功";
        $result = [
            "msg" => $msg,
            "anno_no" => $_POST["id"],
         ];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號: " . $e->getLine() . ", 錯誤訊息: " . $e->getMessage();
        $result["msg"] = $msg;
    }
}

echo json_encode($result);
?>
