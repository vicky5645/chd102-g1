<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");

require_once("connect_chd102g1.php");

const MY_DIR = "../images/img/Forum";
const SQL_IMG_PATH = "images/img/Forum";


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
        $sql = "INSERT INTO forum(article_title, article_content, mem_no, article_date, article_views, article_likes, platform_online, article_image) VALUES (:article_title, :article_content, :mem_no, CURRENT_TIMESTAMP, :article_views, :article_likes, :platform_online, :article_image)";
        $products = $pdo->prepare($sql);
        $products->bindValue(":article_title", $_POST["title"]);
        $products->bindValue(":article_content", $_POST["content"]);
        $products->bindValue(":mem_no", $_POST["mem_no"]);
        $products->bindValue(":article_views", $_POST["article_views"]); 
        $products->bindValue(":article_likes", $_POST["article_likes"]); 
        $products->bindValue(":platform_online", $_POST["platform_online"]); 
        $products->bindValue(":article_image", $final_img_path);

        $products->execute();
        $msg = "新增成功";
        $result = [
            "msg" => $msg,
            "image" => $banner,
            "anno_title" => $_POST["title"]
        ];
    } catch (PDOException $e) {
        $msg = "資料庫寫入失敗，錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
        $result = ["msg" => $msg];
    }
}
}else{
    $msg = "檔案上傳錯誤,或沒上傳檔案";
    $result = ["msg" => $msg];
}

echo json_encode($result);
?>
