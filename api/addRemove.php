<?php include 'header.php';?>

		<div class="container">
			<h1>Store Management</h1>
			<h3>Inventory Management</h3>
			<h3><a href="./addProduct.php">Add an Item</a></h3>

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

				echo "<table class=\"products\">
				<tr>
				<th></th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th></th>
				</tr>";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					$product_id = $row['product_id'];

					if (!file_exists('../images/' . $product_id . '.jpg')) {
						$image = 'placeholder.png';
					}
					else {
						$image = $product_id . '.jpg';
					}

					echo "<tr>";
					echo "<td style=\"text-align:center\">" . "<img src=\"../images/" . $image . "\" style=\"width: 300px;\">" . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
					echo "<td>$" . $row['price'] . "</td>";
					echo "<td>" . "<a href=\"./remove.php?product_id=" . $row['product_id'] . "\">Remove</a>" . "</td>";
					echo "</tr>";
				}

				echo "</table><br>";

				$dbh = null;
			?>

			<a href="../management.php">Back</a>
		</div>
	</body>
</html>
