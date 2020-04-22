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

    $dbh = null;

    echo ("<script>location.href='$yourURL'</script>");
 ?>
