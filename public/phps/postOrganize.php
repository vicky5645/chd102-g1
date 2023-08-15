<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json;charset=utf-8");

    try {
      require_once("./connect_chd102g1.php");
      $sql = "insert into organize (`org_no`, `pkg_no`, `pkg_limit`, `pkg_sale`, `dept_date`, `enrolled`, `reg_start`,`reg_end`)
        values (null, :pkg_no, :pkg_limit, :pkg_sale, :dept_date,:enrolled,:reg_start,:reg_end);";
      $org = $pdo->prepare($sql);

      // org_no 這裡是AUTO_INCREMENT，不需要設定
      $org->bindValue(":pkg_no", $_POST["pkg_no"]);
      $org->bindValue(":pkg_limit", $_POST["pkg_limit"]);
      $org->bindValue(":pkg_sale", $_POST["pkg_sale"]);
      $org->bindValue(":dept_date", $_POST["dept_date"]);
      $org->bindValue(":enrolled", $_POST["enrolled"]);
      $org->bindValue(":reg_start", $_POST["reg_start"]);
      $org->bindValue(":reg_end", $_POST["reg_end"]);
      $org->execute();
      // echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
    }


  ?>