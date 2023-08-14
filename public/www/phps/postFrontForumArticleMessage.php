<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json;charset=utf-8");

    try {
      require_once("./connect_chd102g1.php");
      $sql = "insert into comment (`comment_no`, `article_no`, `mem_no`, `commen_content`)
        values (null, :article_no, :mem_no, :commen_content);";
      $org = $pdo->prepare($sql);

      // org_no 這裡是AUTO_INCREMENT，不需要設定
      $org->bindValue(":article_no", $_POST["article_no"]);
      $org->bindValue(":mem_no", $_POST["mem_no"]);
      $org->bindValue(":commen_content", $_POST["commen_content"]);

      $org->execute();

      $msg = "新增成功";
      $result=["msg"=>$msg];
      echo json_encode($result);

      // echo "新增成功~<br>";
    } catch (PDOException $e) {
      echo "錯誤行號 : ", $e->getLine(), "<br>";
      echo "錯誤原因 : ", $e->getMessage(), "<br>";
      //echo "系統暫時不能正常運行，請稍後再試<br>";  
    }


  ?> 