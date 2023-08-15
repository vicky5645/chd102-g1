<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");
$type = isset($_POST["type"]) ? $_POST["type"] : '';

    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO package_pass (`pkg_no`, `spot_no`, `spot_sort`, `pkg_howday`)
        VALUES (:pkg_no, :spot_no, :spot_sort, :pkg_howday);";
      $pkg = $pdo->prepare($sql);

      $pkg->bindValue(":pkg_no", $_POST["pkg_no"]);
      $pkg->bindValue(":spot_no", $_POST["spot_no"]);
      $pkg->bindValue(":spot_sort", $_POST["spot_sort"]);
      $pkg->bindValue(":pkg_howday", $_POST["pkg_howday"]);
      $pkg->execute();

      $msg = "新增成功~";
    } catch (PDOException $e) {
      $msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage();
    }

$result = ["msg" => $msg];
echo json_encode($result);
  ?>