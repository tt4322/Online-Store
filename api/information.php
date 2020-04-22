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

				$table_name = $_GET['table_name'];
				$stmt;

				if (strcmp($table_name, "customers") == 0) {
					echo "<h3>Customers</h3>";

					$stmt= $dbh->prepare("SELECT * FROM customers");
					$stmt->execute();

					echo "<table class=\"table table-striped\">
					<tr>
					<th>Customer ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip Code</th>
					<th>Phone Number</th>
					<th>Email</th>
					</tr>";

					while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
						echo "<tr>";
						echo "<td>" . $row['customer_id'] . "</td>";
						echo "<td>" . $row['first_name'] . "</td>";
						echo "<td>" . $row['last_name'] . "</td>";
						echo "<td>" . $row['address'] . "</td>";
						echo "<td>" . $row['city'] . "</td>";
						echo "<td>" . $row['state'] . "</td>";
						echo "<td>" . $row['zip_code'] . "</td>";
						echo "<td>" . $row['phone_number'] . "</td>";
						echo "<td>" . $row['email'] . "</td>";
						echo "</tr>";
					}

					echo "</table>";
				}
				else if (strcmp($table_name, "orders") == 0) {
					echo "<h3>Orders</h3>";

					$stmt= $dbh->prepare("SELECT * FROM orders");
					$stmt->execute();

					echo "<table class=\"table table-striped\">
					<tr>
					<th>Order ID</th>
					<th>Date</th>
					<th>Product ID</th>
					<th>Code</th>
					<th>Credit Card ID</th>
					</tr>";

					while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
						echo "<tr>";
						echo "<td>" . $row['order_id'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td>" . $row['product_id'] . "</td>";
						echo "<td>" . $row['code'] . "</td>";
						echo "<td>" . $row['credit_card_id'] . "</td>";
						echo "</tr>";
					}

					echo "</table>";
				}
				else if (strcmp($table_name, "discount_codes") == 0) {
					echo "<h3>Discount Codes</h3>";

					$stmt= $dbh->prepare("SELECT * FROM discount_codes");
					$stmt->execute();

					echo "<table class=\"table table-striped\">
					<tr>
					<th>Code</th>
					<th>Date</th>
					<th>Product ID</th>
					</tr>";

					while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
						echo "<tr>";
						echo "<td>" . $row['code'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td>" . $row['product_id'] . "</td>";
						echo "</tr>";
					}

					echo "</table>";
				}
				else if (strcmp($table_name, "credit_cards") == 0) {
					echo "<h3>Credit Cards</h3>";

					$stmt= $dbh->prepare("SELECT * FROM credit_cards");
					$stmt->execute();

					echo "<table class=\"table table-striped\">
					<tr>
					<th>Credit Card ID</th>
					<th>Name</th>
					<th>Number</th>
					<th>Zip Code</th>
					<th>Expiration Date</th>
					</tr>";

					while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
						echo "<tr>";
						echo "<td>" . $row['credit_card_id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['number'] . "</td>";
						echo "<td>" . $row['zip_code'] . "</td>";
						echo "<td>" . $row['expiration_date'] . "</td>";
						echo "</tr>";
					}

					echo "</table>";
				}
				else if (strcmp($table_name, "products") == 0) {
					echo "<h3>Products</h3>";

					$stmt= $dbh->prepare("SELECT * FROM products");
					$stmt->execute();

					echo "<table class=\"table table-striped\"\">
					<tr>
					<th></th>
					<th>Product ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Discount Percentage</th>
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
						echo "<td>" . $row['product_id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['description'] . "</td>";
						echo "<td>" . $row['price'] . "</td>";
						echo "<td>" . $row['image'] . "</td>";
						echo "<td>" . $row['discount_percentage'] . "</td>";
						echo "</tr>";
					}

					echo "</table>";
				}

				$dbh = null;
			?>

			<a href="../management.php">Back</a><br><br>
		</div>
	</body>
</html>
