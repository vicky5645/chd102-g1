<?php
header('Access-Control-Allow-Origin:*');

    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO package_pass (`pkg_no`, `spot_no`, `spot_sort`, `pkg_howday`)
        VALUES (:pkg_no, :spot_no, :spot_sort, :pkg_howday);";
      $pkg = $pdo->prepare($sql);

      // pkg_no 這裡是AUTO_INCREMENT，不需要設定
      $pkg->bindValue(":pkg_no", $_POST["pkg_no"]);
      $pkg->bindValue(":spot_no", $_POST["spot_no"]);
      $pkg->bindValue(":spot_sort", $_POST["spot_sort"]);
      $pkg->bindValue(":pkg_howday", $_POST["pkg_howday"]);
      $pkg->execute();
      // echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
    }


  ?>