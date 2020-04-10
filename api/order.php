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
          $credit_card_id = $_POST['credit_card_id'];

          $stmt = $dbh->prepare("INSERT INTO orders (date, product_id, code, credit_card_id) VALUES (:date, :product_id, :code, :credit_card_id)");
          $stmt->bindParam(':date', $date);
          $stmt->bindParam(':product_id', $product_id);
          $stmt->bindParam(':code', $code);
          $stmt->bindParam(':credit_card_id', $credit_card_id);

          $stmt->execute();

          /*
          $sql = "INSERT INTO orders (order_id, date, product_id, code, credit_card_id) VALUES (1, '1-1-2020', 1, 'A1B2C3', '1234')";
          // use exec() because no results are returned
          $dbh->exec($sql);
          */
          echo "Order Placed!";
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
