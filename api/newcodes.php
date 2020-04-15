<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>

	<body>
		<h1>Store Management</h1>
		<h3>New Codes</h3>

		<div id="main">
			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				$table_name = $_GET['table_name'];
				$stmt= $dbh->prepare("
					SELECT D.code, P.product_id, P.name
					FROM discount_codes D, products P
					WHERE DATE_ADD(date, INTERVAL 7 DAY) >= CURDATE()
						AND D.product_id = P.product_id
				");
				$stmt->execute();

				echo "<table class=\"information\">
				<tr>
				<th>Code</th>
				<th>Product ID</th>
				<th>Product Name</th>
				<th></th>
				</tr>";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					if ($row['code'] != 0) {
						echo "<tr>";
						echo "<td>" . $row['code'] . "</td>";
						echo "<td>" . $row['product_id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . "<a href=\"interestedcustomers.php?product_id=" . $row['product_id'] . "\">" . "Interested Customers" . "</a>" . "</td>";

						echo "</tr>";
					}
				}

				echo "</table><br>";

				$dbh = null;
			?>
		</div>

		<a href="../management.html">Back</a>
	</body>
</html>