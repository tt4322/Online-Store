<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<h1>Store Management</h1>
		<h3>Process Update</h3>

		<div id="main">
			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
			
				$product_id = intval($_POST['product_id']);
				$name = $_POST['name'];
				$description = $_POST['description'];
				$price = intval($_POST['price']);
				$discount_percentage = intval($_POST['discount_percentage']);
				$max_discount_percentage = intval($_POST['max_discount_percentage']);
							
				$stmt = $dbh->prepare("
					UPDATE products
					SET name = (?), description = (?), price = (?), discount_percentage = (?), max_discount_percentage = (?)
					WHERE product_id = (?)
				");
				$stmt->execute([$name, $description, $price, $discount_percentage, $max_discount_percentage, $product_id]);
								
				$count = $stmt->rowCount();

				if ($count != 0)
					echo "Product " . $product_id . " was updated.<br><br>";
				else
					echo "Product " . $product_id . " was not updated.<br><br>";

				$dbh = null;
			?>
		</div>

		<a href="updateproducts.php">Back</a>
	</body>
</html>