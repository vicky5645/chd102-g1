<?php
header('Access-Control-Allow-Origin:*');

    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO package (`pkg_no`, `pkg_price`, `pkg_status`, `pkg_name`, `pkg_desc`, `train_no`, `conductor`, `cover_file`)
        VALUES (null, :pkg_price, :pkg_status, :pkg_name, :pkg_desc,:train_no,:conductor ,:cover_file);";
      $pkg = $pdo->prepare($sql);

      // pkg_no 這裡是AUTO_INCREMENT，不需要設定
      $pkg->bindValue(":pkg_price", $_POST["pkg_price"]);
      $pkg->bindValue(":pkg_status", $_POST["pkg_status"]);
      $pkg->bindValue(":pkg_name", $_POST["pkg_name"]);
      $pkg->bindValue(":pkg_desc", $_POST["pkg_desc"]);
      $pkg->bindValue(":train_no", $_POST["train_no"]);
      $pkg->bindValue(":conductor", $_POST["conductor"]);
      $pkg->bindValue(":cover_file", $_POST["cover_file"]);
      $pkg->execute();
      // echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
    }


  ?>