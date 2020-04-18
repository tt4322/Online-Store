<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<h1>Online Store</h1>

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
				$stmt = $dbh->prepare("SELECT * FROM products WHERE product_id = " . $product_id);
				$stmt->execute();

				echo "<table class=\"product\">";

				while ($row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT)) {
					$image = $row['image'];

					if (!file_exists('images/' . $image)) {
						$image = 'placeholder.png';
					}

					echo "<h3>" . $row['name'] . "</h3>";
					echo "<tr style=\"text-align:center\"><td>" . "<img src=\"../images/" . $image . "\" style=\"width:300;height:300;\">" . "<br><br></td></tr>";
					echo "<tr><td><h4>Description:</h4>" . $row['description'] . "<br><br></td></tr>";
					echo "<tr><td><h4>Price:</h4>$" . $row['price'] . "<br><br></td></tr>";
				}

				echo "<tr><td>";
				echo "<h4>Request Discount Code:</h4>";
				echo "<form onsubmit=\"generateCode(" . $product_id . "); return false;\">";
				echo "<input type=\"textbox\" id=\"code\"><br><br>";
				echo "<input type=\"submit\" value=\"Generate\">";
				echo "</form>";
				echo "<br></td></tr>";

				echo "<tr><td>";
				//order form
				echo "<h4>Order:</h4>";
				echo "<form action=\"order.php\" method=\"post\">";
				//code input
				echo "Code: <input type=\"text\" name=\"code\"><br>";
				//customer info
				echo "First Name: <input type='text' name='fname'> ";
				echo "Last Name: <input type='text' name='lname'><br>";
				echo "Phone #: <input type='number' name='phone'> ";
				echo "Email: <input type='email' name='email' required><br>";
				echo "Street Address: <input name='address'> City: <input name='city'><br>";
				echo "State: <input type='text' name='state'> Zip Code: <input type='number' name='zip_code'><br>";
				//credit card info
				echo "Credit Card #: <input type=\"text\" name=\"cc_num\" required> ";
				echo "Exp. Date: <input type=\"date\" name=\"exp_date\"><br>";
				echo "Zip Code: <input type=\"text\" name=\"cc_zip_code\"><br><br>";
				echo "<input name=\"product_id\" type=\"hidden\" value=" . $product_id .">";
				echo "<input type=\"submit\">";
				echo "</form>";
				echo "<br></td></tr>";
				echo "</table><br>";

				$dbh = null;
			?>
		</div>

		<a href="../index.html">Back</a>
	</body>
</html>
