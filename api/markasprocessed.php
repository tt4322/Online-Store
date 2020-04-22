<?php include 'session.php';?>
<?php include 'header.php';?>

		<div class="general" style="text-align: center;">
			<h1>Store Management</h1>
			<h3>Process Status</h3>

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
					echo "Order " . $order_id . " has been marked as processed.<br><br>";
				else
					echo "Order " . $order_id . " has not been marked as processed.<br><br>";

				$dbh = null;
			?>

			<a href="readytoprocess.php">Back</a>
		</div>
	</body>
</html>