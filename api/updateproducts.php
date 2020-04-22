<?php include 'session.php';?>
<?php include 'header.php';?>

		<div class="general">
			<h1>Store Management</h1>
			<h3>Update Products/Set Discount Policies</h3>

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

				echo "<table class=\"table table-striped\">
				<tr>
				<th></th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th></th>
				</tr>";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					$image = $row['image'];
					$product_id = $row['product_id'];

					if (!file_exists('../images/' . $product_id . '.jpg')) {
						$image = 'placeholder.png';
					}
					else {
						$image = $product_id . '.jpg';
					}

					echo "<tr>";
					echo "<td style=\"text-align: center; padding: 15px\">" . "<img src=\"../images/" . $image . "\" style=\"width: 300px;\">" . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
					echo "<td>$" . $row['price'] . "</td>";
					echo "<td>" . "<a href=\"updateproduct.php?product_id=" . $row['product_id'] . "\">Update</a>" . "</td>";
					echo "</tr>";
				}

				echo "</table><br>";

				$dbh = null;
			?>

			<a href="../management.php">Back</a><br><br>
		</div>
	</body>
</html>