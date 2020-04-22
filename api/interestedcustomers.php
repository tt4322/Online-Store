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

				$product_id = $_GET['product_id'];
				$code = $_GET['code'];
				$stmt= $dbh->prepare("
					SELECT DISTINCT C.first_name, C.last_name, C.phone_number, C.email
					FROM customers C, orders O
					WHERE O.product_id = (?) AND O.customer_id = C.customer_id
				");
				$stmt->execute([$product_id]);

				echo "<h3>Customers That May Be Interested In Code " . $code . "</h3>";

				echo "<table class=\"general\">
				<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone Number</th>
				<th>Email</th>
				</tr>";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					echo "<tr>";
					echo "<td>" . $row['first_name'] . "</td>";
					echo "<td>" . $row['last_name'] . "</td>";
					echo "<td>" . $row['phone_number'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "</tr>";
				}

				echo "</table><br>";

				$dbh = null;
			?>

			<a href="newcodes.php">Back</a>
		</div>
	</body>
</html>