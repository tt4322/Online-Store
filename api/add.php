<?php
    $yourURL = "./addRemove.php";
    $dbhost = "***REMOVED***";
    $dbname = "***REMOVED***";
    $username = "***REMOVED***";
    $password = "***REMOVED***";

    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);

        $discount_percentage = 0;
        $price = $_POST['price'];
        $description = $_POST['description'];
        $name = $_POST['product_name'];

        $stmt = $dbh->prepare("INSERT INTO products (name, description, price, discount_percentage) VALUES (:name, :description, :price, :discount_percentage)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':discount_percentage', $discount_percentage);

        $stmt->execute();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    $dbh = null;

    echo ("<script>location.href='$yourURL'</script>");
 ?>
