<?php include 'session.php';?>
<?php
    $yourURL = "./addRemove.php";

    include "../autoload.php";

    try {
        $dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
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
