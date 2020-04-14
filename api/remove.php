<?php
    $yourURL = "./addRemove.php";
    $dbhost = "***REMOVED***";
    $dbname = "***REMOVED***";
    $username = "***REMOVED***";
    $password = "***REMOVED***";

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
