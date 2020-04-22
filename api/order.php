<?php include 'header.php';?>

			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));

					// Order info
					$product_id = intval($_POST['product_id']);
					$code = $_POST['code'];

					// Customer info
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$address = $_POST['address'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$zip_code = $_POST['zip_code'];

					// Credit card info
					$cc_name = $_POST['cc_name'];
					$cc_num = $_POST['cc_num'];
					$exp_date = $_POST['exp_date'];
					$cc_zip_code = $_POST['cc_zip_code'];

					// Check code
					$stmt = $dbh->prepare("
						SELECT COUNT(*) AS count
						FROM discount_codes WHERE code = (?)
							AND product_id = (?)
							AND DATE_ADD(date, INTERVAL 7 DAY) >= CURDATE()
					");
					$stmt->execute([$code, $product_id]);

					$row = $stmt->fetch(PDO::FETCH_NAMED);
					$count = $row['count'];

					if ($code == "") {
						$code = 0;
						$count = 1;
					}
					else if ($code == 0) {
						$count = 0;
					}

					echo "<div class=\"container text-center\">";

					if ($count != 0) {
						// Check for customer
						$stmt = $dbh->prepare("
							SELECT customer_id
							FROM customers
							WHERE email = :email
								AND first_name = :fname
								AND last_name = :lname
								AND phone_number = :phone
								AND address = :address
								AND city = :city
								AND state = :state
								AND zip_code = :zip_code
						");
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':fname', $fname);
						$stmt->bindParam(':lname', $lname);
						$stmt->bindParam(':phone', $phone);
						$stmt->bindParam(':address', $address);
						$stmt->bindParam(':city', $city);
						$stmt->bindParam(':state', $state);
						$stmt->bindParam(':zip_code', $zip_code);
						$stmt->execute();
						$result = $stmt->fetch();
						$customer_id = $result["customer_id"];

						if(!($customer_id)){
							$stmt = $dbh->prepare("
								INSERT INTO customers (first_name, last_name, address, city, state, zip_code, phone_number, email)
								VALUES (:fname, :lname, :address, :city, :state, :zip_code, :phone, :email)
							");
							$stmt->bindParam(':fname', $fname);
							$stmt->bindParam(':lname', $lname);
							$stmt->bindParam(':address', $address);
							$stmt->bindParam(':city', $city);
							$stmt->bindParam(':state', $state);
							$stmt->bindParam(':zip_code', $zip_code);
							$stmt->bindParam(':phone', $phone);
							$stmt->bindParam(':email', $email);
							$stmt->execute();
							$customer_id = $dbh->lastInsertID();
						}

						// Check for credit card
						$stmt = $dbh->prepare("
							SELECT credit_card_id
							FROM credit_cards
							WHERE number = :cc_num
						");
						$stmt->bindParam(':cc_num', $cc_num);
						$stmt->execute();
						$result = $stmt->fetch();
						$cc_id = $result["credit_card_id"];

						// If no credit card, insert
						if(!($cc_id)){
							$ccins = $dbh->prepare("
								INSERT INTO credit_cards (name, number, zip_code, expiration_date)
								VALUES (:cc_name, :cc_num, :cc_zip_code, :exp_date)
							");
							$ccins->bindParam(':cc_name', $cc_name);
							$ccins->bindParam(':cc_num', $cc_num);
							$ccins->bindParam(':cc_zip_code', $cc_zip_code);
							$ccins->bindParam(':exp_date', $exp_date);
							$ccins->execute();
							$cc_id = $dbh->lastInsertID();
						}

						// Insert order
						$ustmt = $dbh->prepare("
							INSERT INTO orders (product_id, code, credit_card_id, customer_id)
							VALUES (:product_id, :code, :cc_id, :customer_id)
						");
						$ustmt->bindParam(':product_id', $product_id);
						$ustmt->bindParam(':code', $code);
						$ustmt->bindParam(':cc_id', $cc_id);
						$ustmt->bindParam(':customer_id', $customer_id);

						$ustmt->execute();
						$order_id = $dbh->lastInsertID();

						if (!$order_id) {
							echo "<h3>Error placing order.</h3><br>";
							echo "<a href=\"javascript:history.back()\">Back</a>";
						}
						else {
							echo "<h3>Your order has been placed! Order #{$order_id}.</h3><br>";
							echo "<a href=\"../index.php\">Continue Shopping</a>";
						}
					}
					else {
						echo "<h3>Error placing order. Code is invalid.</h3><br>";
						echo "<a href=\"javascript:history.back()\">Back</a>";
					}

					echo "</div>";
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				$dbh = null;
			?>
		</div>
	</body>
</html>
