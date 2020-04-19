<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<div class="general">
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

					$row = $stmt->fetch(PDO::FETCH_NAMED);

					$image = $row['image'];

					if (!file_exists('images/' . $image)) {
						$image = 'placeholder.png';
					}

					echo "<h3>" . $row['name'] . "</h3>";
					echo "<tr><td style=\"text-align: center;\">" . "<img src=\"../images/" . $image . "\" style=\"width: 500px\">" . "<br><br></td>";
					echo "<td style=\"vertical-align: top; width: 40%;\"><h4>Description:</h4>" . $row['description'] . "<br><br>";
					echo "<h4>Price:</h4>$" . $row['price'] . "<br><br></td></tr>";

					// Code request
					echo "<tr><td style=\"vertical-align: top;\" colspan=\"2\">";
					echo "<h4>Request Discount Code:</h4>";
					echo "<form onsubmit=\"generateCode(" . $product_id . "); return false;\">";
					echo "<input type=\"textbox\" id=\"code\"><br><br>";
					echo "<input type=\"submit\" value=\"Generate\">";
					echo "</form>";
					echo "<br></td></tr>";

					// Order form
					echo "<tr><td colspan=\"2\">";
					echo "<div style=\"margin: 0px auto\">";
					echo "<h3>Order:</h3>";
					echo "<form action=\"order.php\" method=\"POST\">";

					// Code input
					echo "<h4>Discount Code:</h4>";
					echo "Code: <input type=\"text\" name=\"code\" id=\"order_code\"><br>";

					// Customer info
					echo "<h4>Shipping Info:</h4>";
					echo "First Name: <input type='text' name='fname'> ";
					echo "Last Name: <input type='text' name='lname'><br>";
					echo "Phone #: <input type='text' name='phone'> ";
					echo "Email: <input type='email' name='email'><br>";
					echo "Street Address: <input name='address'> City: <input name='city'><br>";
					echo "State: <input type='text' name='state'> Zip Code: <input type='text' name='zip_code'><br>";

					// Credit card info
					echo "<h4>Card Info:</h4>";
					echo "Name on Card: <input type=\"text\" name=\"cc_name\"> ";
					echo "Credit Card #: <input type=\"text\" name=\"cc_num\"><br>";
					echo "Exp. Date: <input type=\"text\" name=\"exp_date\"> ";
					echo "Zip Code: <input type=\"text\" name=\"cc_zip_code\"><br><br>";
					echo "<input name=\"product_id\" type=\"hidden\" value=" . $product_id .">";
					echo "<div id=\"error\"></div><br>";
					echo "<input type=\"submit\" value=\"Place Order\">";
					echo "</form>";
					echo "<br></div></td></tr>";
					echo "</table><br>";

					$dbh = null;
				?>
			</div>

			<a href="../index.html">Back</a>
		</div>
	</body>
</html>
