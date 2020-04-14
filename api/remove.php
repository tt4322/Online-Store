<?php
    $yourURL = "./addRemove.php";
    $dbhost = "us-cdbr-iron-east-01.cleardb.net";
    $dbname = "heroku_e78a82b925de5db";
    $username = "b56c5bf006c12b";
    $password = "5e05a4dd";

    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    $product_id = intval($_GET['product_id']);
    $stmt = $dbh->prepare("DELETE FROM products WHERE product_id = " . $product_id);
    $stmt->execute();

    $dbh = null;

    echo ("<script>location.href='$yourURL'</script>");
 ?>
