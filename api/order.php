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

          $date = date("Y-m-d");
          $product_id = intval($_POST['product_id']);
          $code = $_POST['code'];
          $cc_num = $_POST['cc_num'];
					$exp_date = $_POST['exp_date'];
					$cc_zip_code = $_POST['cc_zip_code'];

					$stmt = $dbh->prepare("SELECT credit_card_id FROM credit_cards WHERE number = :cc_num");
					$stmt->bindParam(':cc_num', $cc_num);
					$stmt->execute();
					$result = $stmt->fetch();
					$cc_id = $result["credit_card_id"];

					if(!($cc_id)){
						$ccins = $dbh->prepare("INSERT INTO credit_cards (number, zip_code, expiration_date) VALUES (:cc_num, :cc_zip_code, :exp_date)");
						$ccins->bindParam(':cc_num', $cc_num);
						$ccins->bindParam(':cc_zip_code', $cc_zip_code);
						$ccins->bindParam(':exp_date', $exp_date);
						$ccins->execute();
						$cc_id = $dbh->lastInsertID();
					}

          $ustmt = $dbh->prepare("INSERT INTO orders (date, product_id, code, credit_card_id, customer_id) VALUES (:date, :product_id, :code, :cc_id, '1')");
          $ustmt->bindParam(':date', $date);
          $ustmt->bindParam(':product_id', $product_id);
          $ustmt->bindParam(':code', $code);
          $ustmt->bindParam(':cc_id', $cc_id);

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
