<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<h1>Store Management</h1>

		<div id="main">
			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				$product_id = intval($_GET['product_id']);
				$stmt = $dbh->prepare("SELECT * FROM products WHERE product_id = (?)");
				$stmt->execute([$product_id]);
				
				$row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT);

				echo "<h3>Update Product " . $row['product_id'] . "</h3>";

				echo "<table class=\"product\">";

				$image = $row['image'];

				if (!file_exists('images/' . $image)) {
					$image = 'placeholder.png';
				}

				echo "<tr style=\"text-align:center\"><td>" . "<img src=\"../images/" . $image . "\" style=\"width:300;height:300;\">" . "</td></tr>";
				echo "<tr><td><br>";
				echo "
					<form action=\"processupdate.php\" method=\"POST\">
						<input type=\"hidden\" name=\"product_id\" value=\"" . $row['product_id'] . "\">
						Name:<br><br>
						<input type=\"text\" name=\"name\" value=\"" . $row['name'] . "\"><br>
						<br>Description:<br><br>
						<textarea name=\"description\" rows=\"10\" cols=\"40\">" . $row['description'] . "</textarea><br>
						<br>Price:<br><br>
						<input type=\"text\" name=\"price\" value=\"" . $row['price'] . "\"><br>
						<br>Discount Percentage:<br><br>
						<input type=\"text\" name=\"discount_percentage\" value=\"" . $row['discount_percentage'] . "\"><br>
						<br>Max Discount Percentage:<br><br>
						<input type=\"text\" name=\"max_discount_percentage\" value=\"" . $row['max_discount_percentage'] . "\"><br>
						<br><input type=\"submit\" value=\"Update\">
					</form>
				";
				echo "</td></tr>";

				echo "</table><br>";

				$dbh = null;
			?>
		</div>

		<a href="updateproducts.php">Back</a>
	</body>
</html>