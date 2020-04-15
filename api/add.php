<?php
    $yourURL = "./addRemove.php";
    $dbhost = "us-cdbr-iron-east-01.cleardb.net";
    $dbname = "heroku_e78a82b925de5db";
    $username = "b56c5bf006c12b";
    $password = "5e05a4dd";

    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);

        $price = $_POST['price'];
        $description = $_POST['description'];
        $name = $_POST['product_name'];
        $discount_percentage = $_POST['discount_percentage'];
        $max_discount_percentage = $_POST['max_discount_percentage'];

        $stmt = $dbh->prepare("INSERT INTO products (name, description, price, discount_percentage, max_discount_percentage) VALUES (:name, :description, :price, :discount_percentage, :max_discount_percentage)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':discount_percentage', $discount_percentage);
        $stmt->bindParam(':max_discount_percentage', $max_discount_percentage);

        $stmt->execute();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    $dbh = null;

    echo ("<script>location.href='$yourURL'</script>");
 ?>
