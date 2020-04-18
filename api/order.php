<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>

	<body>
		<h1>Purchase</h1>

		<div id="main">
      <?php
        include "../autoload.php";

        try {
          $dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));

					//order info
          $date = date("Y-m-d");
          $product_id = intval($_POST['product_id']);
          $code = $_POST['code'];
					//customer info
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$address = $_POST['address'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$zip_code = $_POST['zip_code'];
					//credit card info
          $cc_num = $_POST['cc_num'];
					$exp_date = $_POST['exp_date'];
					$cc_zip_code = $_POST['cc_zip_code'];

					//check for customer
					$stmt = $dbh->prepare("SELECT customer_id
							FROM customers
							WHERE email = :email");
					$stmt->bindParam(':email', $email);
					$stmt->execute();
					$result = $stmt->fetch();
					$customer_id = $result["customer_id"];

					if(!($customer_id)){
						$stmt = $dbh->prepare("INSERT INTO customers
							(first_name, last_name, address, city, state, zip_code, phone_number, email)
							VALUES (:fname, :lname, :address, :city, :state, :zip_code, :phone, :email)");
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

					//check for credit card
					$stmt = $dbh->prepare("SELECT credit_card_id
						FROM credit_cards
						WHERE number = :cc_num");
					$stmt->bindParam(':cc_num', $cc_num);
					$stmt->execute();
					$result = $stmt->fetch();
					$cc_id = $result["credit_card_id"];
					//if no credit card, insert
					if(!($cc_id)){
						$ccins = $dbh->prepare("INSERT INTO credit_cards
							(number, zip_code, expiration_date)
							VALUES (:cc_num, :cc_zip_code, :exp_date)");
						$ccins->bindParam(':cc_num', $cc_num);
						$ccins->bindParam(':cc_zip_code', $cc_zip_code);
						$ccins->bindParam(':exp_date', $exp_date);
						$ccins->execute();
						$cc_id = $dbh->lastInsertID();
					}
					//insert order
          $ustmt = $dbh->prepare("INSERT INTO orders
						(date, product_id, code, credit_card_id, customer_id)
						VALUES (:date, :product_id, :code, :cc_id, :customer_id)");
          $ustmt->bindParam(':date', $date);
          $ustmt->bindParam(':product_id', $product_id);
          $ustmt->bindParam(':code', $code);
          $ustmt->bindParam(':cc_id', $cc_id);
					$ustmt->bindParam(':customer_id', $customer_id);

          $ustmt->execute();
					$order_id = $dbh->lastInsertID();

          echo "Order Placed! Order #: " . $order_id . "<br>";
        }
        catch (PDOException $e) {
          echo $e->getMessage();
        }

        $dbh = null;
       ?>
     </div>

    <a href="../index.html">Home</a>
  </body>
 </html>
