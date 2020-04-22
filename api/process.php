<?php include 'header.php';?>

		<div class="general">
			<h1>Store Management</h1>
			<h3>Process Order</h3>

			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				// Get order information
				$order_id = intval($_GET['order_id']);
				$stmt = $dbh->prepare("
					SELECT D.code,
						D.date AS code_date,
						O.order_id,
						O.date AS order_date,
						P.product_id,
						P.name AS product_name,
						P.price,
						P.image,
						P.description,
						C.customer_id,
						C.first_name,
						C.last_name,
						C.address,
						C.city,
						C.state,
						C.zip_code AS customer_zip_code,
						C.phone_number,
						C.email,
						CC.name AS card_name,
						CC.number,
						CC.zip_code AS card_zip_code,
						CC.expiration_date,
						P.discount_percentage,
						P.max_discount_percentage
					FROM discount_codes D, orders O, products P, customers C, credit_cards CC
					WHERE D.code = O.code
						AND O.product_id = P.product_id
						AND O.credit_card_id = CC.credit_card_id
						AND O.customer_id = C.customer_id
						AND O.order_id = (?)
				");
				$stmt->execute([$order_id]);

				$row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT);

				include 'calculatediscount.php';

				// Output
				echo "<table class=\"product\">";

				$product_id = $row['product_id'];

				if (!file_exists('../images/' . $product_id . '.jpg')) {
					$image = 'placeholder.png';
				}
				else {
					$image = $product_id . '.jpg';
				}

				echo "<tr><td>";
				echo "<h3>Product Information</h3>";
				echo "<div style=\"text-align: center\"><img src=\"../images/" . $image . "\" style=\"width: 500px;\"></div>";
				echo "<br><br><b>Product ID: </b>" . $row['product_id'];
				echo "<br><br><b>Name: </b>" . $row['product_name'];
				echo "<br><br><b>Description: </b>" . $row['description'];
				echo "<br><br><b>Price: </b>$" . $row['price'];
				echo "<br><br><b>Discount Percentage: </b>" . $discount_percentage . "%";
				echo "<br><br><b>Final Price </b>$" . $finalPrice;
				echo "<br><br></td></tr>";

				echo "<tr><td>";
				echo "<h3>Customer Information</h3>";
				echo "<b>Customer ID: </b>" . $row['customer_id'];
				echo "<br><br><b>First Name: </b>" . $row['first_name'];
				echo "<br><br><b>Last Name: </b>" . $row['last_name'];
				echo "<br><br><b>Address: </b>" . $row['address'];
				echo "<br><br><b>City: </b>" . $row['city'];
				echo "<br><br><b>State: </b>" . $row['state'];
				echo "<br><br><b>Zip Code: </b>" . $row['customer_zip_code'];
				echo "<br><br><b>Email: </b>" . $row['email'];
				echo "<br><br><b>Phone Number: </b>" . $row['phone_number'];
				echo "<br><br></td></tr>";

				echo "<tr><td>";
				echo "<h3>Credit Card Information</h3>";
				echo "<b>Name: </b>" . $row['card_name'];
				echo "<br><br><b>Number: </b>" . $row['number'];
				echo "<br><br><b>Zip Code: </b>" . $row['card_zip_code'];
				echo "<br><br><b>Expiration Date: </b>" . $row['expiration_date'];
				echo "<br><br></td></tr>";

				echo "<tr><td align=\"center\"><br>";
				echo "<form action=\"markasprocessed.php?order_id\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"order_id\" value=\"" . $order_id . "\">";
				echo "<input type=\"submit\" value=\"Mark As Processed\">";
				echo "<br><br></td></tr>";

				echo "</table><br>";

				$dbh = null;
			?>

			<a href="readytoprocess.php">Back</a>
		</div>
	</body>
</html>