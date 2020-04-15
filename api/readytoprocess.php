<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<h1>Store Management</h1>
		<h3>Orders Ready For Processing</h3>

		<div id="main">
			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				$stmt = $dbh->prepare("
					SELECT D.code, D.date AS code_date, O.order_id, O.date AS order_date, P.product_id, P.name, P.price
					FROM discount_codes D, orders O, products P, credit_cards C
					WHERE DATE_ADD(D.date, INTERVAL 7 DAY) < CURDATE()
						AND D.code = O.code
						AND O.product_id = P.product_id
						AND O.credit_card_id = C.credit_card_id
						AND O.processed = 0
				");
				$stmt->execute();

				echo "<table class=\"products\">
				<tr>
				<th>Code</th>
				<th>Code Date</th>
				<th>Order ID</th>
				<th>Order Date</th>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Price</th>
				<th></th>
				</tr>";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					echo "<tr>";
					if ($row['code'] == 0)
						echo "<td>None</td>";
					else
						echo "<td>" . $row['code'] . "</td>";
					echo "<td>" . $row['code_date'] . "</td>";
					echo "<td>" . $row['order_id'] . "</td>";
					echo "<td>" . $row['order_date'] . "</td>";
					echo "<td>" . $row['product_id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "<td>" . "<a href=\"process.php?order_id=" . $row['order_id'] . "\">Process Order</a>" . "</td>";
					echo "</tr>";
				}

				echo "</table><br>";

				$dbh = null;
			?>
		</div>

		<a href="../management.html">Back</a>
	</body>
</html>