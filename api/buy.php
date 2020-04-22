<?php include 'header.php';?>

		<div class="container text-center">
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

				$row = $stmt->fetch(PDO::FETCH_NAMED);

				if (!file_exists('../images/' . $product_id . '.jpg')) {
					$image = 'placeholder.png';
				}
				else {
					$image = $product_id . '.jpg';
				}

				echo "<div class=\"panel panel-primary\">";
				echo "<div class=\"panel panel-heading\"><h3>{$row['name']}</h3></div><br>";

				echo "<div class=\"row\">";
				echo "<div class=\"col-lg-5 col-lg-offset-1\"><img src=\"../images/{$image}\" class=\"img-responsive\" style=\"width: 75%\"></div>";
				echo "<div class=\"col-lg-5 text-left\">";
				echo "<h4>Description:</h4>" . $row['description'] . "<br><br>";
				echo "<h4>Price:</h4>$" . $row['price'] . "<br><br>";
				echo "</div>";
				echo "</div><br>";

				// Order form
				echo "<div class=\"row\">";
				echo "<div class=\"col-lg-6 col-lg-offset-1 text-left\" style=\"background-color: #EBEDEF\">";
				echo "<h3 style=\"text-align: center\">Order</h3>";
				echo "<form action=\"order.php\" method=\"POST\">";

				// Code input
				echo "<h4>Discount Code:</h4>";
				echo "Code: <input type=\"text\" name=\"code\" id=\"order_code\"><br><br>";

				// Customer info
				echo "<h4>Shipping Info:</h4>";
				echo "First Name: <input type='text' name='fname'> ";
				echo "Last Name: <input type='text' name='lname'><br>";
				echo "Phone #: <input type='text' name='phone'> ";
				echo "Email: <input type='email' name='email'><br>";
				echo "Street Address: <input name='address'> City: <input name='city'><br>";
				echo "State: <input type='text' name='state'> Zip Code: <input type='text' name='zip_code'><br><br>";

				// Credit card info
				echo "<h4>Card Info:</h4>";
				echo "Name on Card: <input type=\"text\" name=\"cc_name\"> ";
				echo "Credit Card #: <input type=\"text\" name=\"cc_num\"><br>";
				echo "Exp. Date: <input type=\"text\" name=\"exp_date\"> ";
				echo "Zip Code: <input type=\"text\" name=\"cc_zip_code\"><br><br>";
				echo "<input name=\"product_id\" type=\"hidden\" value=" . $product_id .">";
				echo "<input type=\"submit\" value=\"Place Order\">";
				echo "</form>";
				echo "<br></div>";

				// Code request
				echo "<div class\"col-lg-4\">";
				echo "<h4>Request Discount Code:</h4>";
				echo "<form>";
				echo "<input type=\"textbox\" id=\"code\"> ";
				echo "<input type=\"button\" value=\"Generate\" onclick=\"generateCode(" . $product_id . ");\">";
				echo "</form>";
				echo "</div>";
				echo "</div><br>";
				echo "</div>";

				$dbh = null;
			?>

			<div class="container"><a href="../index.php">Back</a></div><br>
		</div>
	</body>
</html>
