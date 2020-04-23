<?php include 'session.php';?>
<?php include 'header.php';?>

		<div class="general">
			<h1>Store Management</h1>

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

				echo "<table class=\"table\">";

				if (!file_exists('../images/' . $product_id . '.jpg')) {
					$image = 'placeholder.png';
				}
				else {
					$image = $product_id . '.jpg';
				}

				echo "<tr style=\"text-align:center\"><td><br>" . "<img src=\"../images/" . $image . "\" style=\"width: 500px;\">" . "</td></tr>";
				echo "<tr><td>";
				echo "
					<form action=\"processupdate.php\" method=\"POST\">
						<input type=\"hidden\" name=\"product_id\" value=\"" . $row['product_id'] . "\">
						<h4><b>Name:</b>
						<input type=\"text\" name=\"name\" value=\"" . $row['name'] . "\"><br>
						<br><b>Description:</b><br><br>
						<textarea name=\"description\" rows=\"10\" cols=\"40\">" . $row['description'] . "</textarea><br>
						<br><b>Price:</b><br><br>
						<input type=\"text\" name=\"price\" value=\"" . $row['price'] . "\"><br>
						<br><b>Discount Percentage:</b><br><br>
						<input type=\"text\" name=\"discount_percentage\" value=\"" . $row['discount_percentage'] . "\"><br>
						<br><b>Max Discount Percentage:</b><br><br>
						<input type=\"text\" name=\"max_discount_percentage\" value=\"" . $row['max_discount_percentage'] . "\"><br></h4>
						<br><input type=\"submit\" value=\"Update\">
					</form>
				";
				echo "</td></tr>";

				echo "</table>";

				$dbh = null;
			?>

			<a href="updateproducts.php">Back</a><br><br>
		</div>
	</body>
</html>
