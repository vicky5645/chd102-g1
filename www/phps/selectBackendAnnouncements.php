
<?php  
    header("Access-Control-Allow-Origin:*");
    try {
        require_once('peterSqlConnect.php');
        $sql ="SELECT * FROM announcement";
        $products = $pdo->query($sql);
        $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($prodRows);
    

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";	
    }
?>