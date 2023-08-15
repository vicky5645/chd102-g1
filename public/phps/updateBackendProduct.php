<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");

require_once("connect_chd102g1.php");

const MY_DIR = "../images/online-mall"; 
// const SQL_IMG_PATH = "images/online-mall";


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
        // $final_img_path = SQL_IMG_PATH . "/" . $banner;

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
        $sql = "UPDATE product SET prod_name = :prod_name, prod_summary = :prod_summary, prod_price = :prod_price, prod_status = :prod_status, prod_file = :prod_file, prod_type = :prod_type, prod_hot = :prod_hot WHERE prod_no = :prod_no";
        $products = $pdo->prepare($sql);
        $products->bindValue(":prod_no", $_POST["prod_no"]);
        $products->bindValue(":prod_name", $_POST["prod_name"]);
        $products->bindValue(":prod_summary", $_POST["prod_summary"]);
        $products->bindValue(":prod_price", $_POST["prod_price"]);
        $products->bindValue(":prod_status", $_POST["prod_status"]);
        $products->bindValue(":prod_file", $banner);
        $products->bindValue(":prod_type", $_POST["prod_type"]);
        $products->bindValue(":prod_hot", $_POST["prod_hot"]);
        $products->execute();

        //刪除原位置的圖檔
		$prod_file = $_POST["old_file"];// test.png
		$filePath = MY_DIR . "/" . $prod_file; //../images/online-mall/test.png
        if (file_exists($filePath)) { //判斷該路徑圖檔存在才進行刪除
            unlink($filePath);
        }
        $msg = "更新成功";
        $result["msg"] = $msg;
        $result["image"] = $banner;
        $result["prod_name"] = $_POST["prod_name"];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號: " . $e->getLine() . ", 錯誤訊息: " . $e->getMessage();
        $result["msg"] = $msg;
    }
}
}else{
    $result = []; 
    try {
        $sql = "UPDATE product SET prod_name = :prod_name, prod_summary = :prod_summary, prod_price = :prod_price, prod_status = :prod_status, prod_type = :prod_type, prod_hot = :prod_hot WHERE prod_no = :prod_no";
        $products = $pdo->prepare($sql);
        $products->bindValue(":prod_no", $_POST["prod_no"]);
        $products->bindValue(":prod_name", $_POST["prod_name"]);
        $products->bindValue(":prod_summary", $_POST["prod_summary"]);
        $products->bindValue(":prod_price", $_POST["prod_price"]);
        $products->bindValue(":prod_status", $_POST["prod_status"]);
        $products->bindValue(":prod_type", $_POST["prod_type"]);
        $products->bindValue(":prod_hot", $_POST["prod_hot"]);
        $products->execute();
        $msg = "更新成功";
        $result = [
            "msg" => $msg,
            "prod_name" => $_POST["prod_name"],
         ];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號: " . $e->getLine() . ", 錯誤訊息: " . $e->getMessage();
        $result["msg"] = $msg;
    }
}

echo json_encode($result);
?>
