<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<script type="text/javascript" src="../js/code.js"></script>
	</head>

	<body>
		<h1>Store Management</h1>
		<h3>Process Order</h3>

		<div id="main">
			<?php
				include "../autoload.php";

				try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

				$order_id = intval($_POST['order_id']);
				$stmt = $dbh->prepare("UPDATE orders SET processed = 1 WHERE order_id = (?)");
				$stmt->execute([$order_id]);

				$count = $stmt->rowCount();

				if ($count != 0)
					echo "Order " . $order_id . " marked as processed.<br><br>";
				else
					echo "Order " . $order_id . " was not marked as processed.<br><br>";

				$dbh = null;
			?>
		</div>

		<a href="readytoprocess.php">Back</a>
	</body>
</html>