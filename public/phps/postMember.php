<?php
header('Access-Control-Allow-Origin:*');

    try {
      require_once("./connect_chd102g1.php");
      $sql = "INSERT INTO  member (`mem_no`, `mem_name`,  `mem_email`, `mem_acc`, `mem_pwd`)
        VALUES (null, :mem_name, :mem_email, :mem_acc, :mem_pwd);";
      $pkg = $pdo->prepare($sql);

      // mem_no  這裡是AUTO_INCREMENT，不需要設定 // pk引入firebase 的 uid ()
      $pkg->bindValue(":mem_name", $_POST["mem_name"]);
      $pkg->bindValue(":mem_email", $_POST["mem_email"]);
      $pkg->bindValue(":mem_acc", $_POST["mem_acc"]);
      $pkg->bindValue(":mem_pwd", $_POST["mem_pwd"]);
      $pkg->execute();
      $msg = "新增成功~";
    } catch (PDOException $e) {
        $msg = "error_line: " . $e->getLine() . ", error_msg: " . $e->getMessage(); 
    }

$result = ["msg" => $msg];
echo json_encode($result);

  ?>