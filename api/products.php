<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>

	<body>
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
				$image = $row['image'];

				if (!file_exists('images/' . $image)) {
					$image = 'placeholder1.png';
				}

				echo "<tr>";
				echo "<td>" . "<img src=\"images/" . $image . "\" style=\"width:300;height:300;\">" . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>$" . $row['price'] . "</td>";
				echo "<td>" . "<a href=\"api/buy.php?product_id=" . $row['product_id'] . "\">Buy</a>" . "</td>";
				echo "</tr>";
			}

			echo "</table>";

			$dbh = null;
		?>
	</body>
</html>
