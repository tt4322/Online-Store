<?php
	include "../autoload.php";

	try {
		$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}

	$stmt = $dbh->prepare("SELECT * FROM products");
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
		$product_id = $row['product_id'];

		if (!file_exists('../images/' . $product_id . '.jpg')) {
			$image = 'placeholder.png';
		}
		else {
			$image = $product_id . '.jpg';
		}

		echo "<div class=\"col-lg-6\">";
		echo "<div class=\"panel panel-primary\">";
		echo "<div class=\"panel-heading\">{$row['name']}</div>";
		echo "<div class=\"panel-body\"><img src=\"images/{$image}\" class=\"img-responsive center-block\" style=\"width: 50%\"></div>";
		echo "<div class=\"panel-footer\">";
		echo "{$row['description']}<br>";
		echo "$" . $row['price'] . "<br>";
		echo "<a href=\"api/buy.php?product_id={$row['product_id']}\">Buy</a>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}

	$dbh = null;
?>
