<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");

require_once("connect_chd102g1.php");

const MY_DIR = "../../images/online-mall"; 
// const SQL_IMG_PATH = "images/online-mall";


if(isset($_FILES["image"])){ //isset檢查是否有上傳文件 //true or false
switch ($_FILES["image"]["error"]) {
    case UPLOAD_ERR_OK:
        if (!file_exists(MY_DIR)) {
            mkdir(MY_DIR);
        }

        $from = $_FILES["image"]["tmp_name"]; //獲取圖檔
        $fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); //取得副檔名
        $banner = uniqid() . "." . $fileExt; //建立一個亂數檔名
        $to = MY_DIR . "/" . $banner; //圖檔要存放的路徑
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
      $sql = "INSERT INTO product (`prod_name`, `prod_summary`, `prod_price`, `prod_status`, `prod_file`, `prod_type`, `prod_hot`)
              VALUES (:prod_name, :prod_summary, :prod_price, :prod_status, :prod_file, :prod_type, :prod_hot)";
        $products = $pdo->prepare($sql);

        // product_no 在SQL裡是AUTO_INCREMENT，不需要設定
        $products->bindValue(":prod_name", $_POST["prod_name"]);
        $products->bindValue(":prod_summary", $_POST["prod_summary"]);
        $products->bindValue(":prod_price", $_POST["prod_price"]);
        $products->bindValue(":prod_status", $_POST["prod_status"]);
        $products->bindValue(":prod_file", $banner);
        $products->bindValue(":prod_type", $_POST["prod_type"]);
        $products->bindValue(":prod_hot", $_POST["prod_hot"]);
        // $products->bindValue(":prod_file", $final_img_path); // 使用已儲存的檔案名稱或路徑
        $products->execute();
        $msg = "新增成功";
        $result = [
            "msg" => $msg,
            "image" => $banner,
            "prod_name" => $_POST["prod_name"]
        ];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
        $result = ["msg" => $msg];
    }
}
}else{
    // try {
    //     $sql = "INSERT INTO announcement(anno_title, anno_type, anno_content) VALUES (:anno_title, :anno_type, :anno_content)";
    //     $products = $pdo->prepare($sql);
    //     $products->bindValue(":anno_title", $_POST["title"]);
    //     $products->bindValue(":anno_type", $_POST["type"]);
    //     $products->bindValue(":anno_content", $_POST["content"]);
    //     $products->execute();
    //     $msg = "新增成功";
    //     $result = [
    //         "msg" => $msg,
    //         "anno_title" => $_POST["title"]
    //     ];
    // } catch (PDOException $e) {
    //     $msg = "資料庫寫入失敗，錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
    //     $result = ["msg" => $msg];
    // }
    echo "未上傳圖片";
}

echo json_encode($result);
?>
