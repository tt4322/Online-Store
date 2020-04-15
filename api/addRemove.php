<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>

	<body>
		<h1>Store Management</h1>
        <h3>Inventory Management</h3>
        <h3><a href="./addProduct.php">Add an Item</a></h3>
		<?php
			//include "../autoload.php";

            $dbhost = "us-cdbr-iron-east-01.cleardb.net";
            $dbname = "heroku_e78a82b925de5db";
            $username = "b56c5bf006c12b";
            $password = "5e05a4dd";

			try {
				$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
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
				echo "<td>" . "<img src=\"../images/" . $image . "\" style=\"width:300;height:300;\">" . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>$" . $row['price'] . "</td>";
				echo "<td>" . "<a href=\"./remove.php?product_id=" . $row['product_id'] . "\">Remove</a>" . "</td>";
				echo "</tr>";
			}

			echo "</table><br>";

			$dbh = null;
		?>

		<a href="../management.html">Back</a>
	</body>
</html>
