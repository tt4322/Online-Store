<?php include 'header.php';?>

		<div class="container">
			<div class="panel">
				<div class="panel panel-heading"><h3>Code Information</h3></div>

				<?php
					include "../autoload.php";

					try {
						$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
					}
					catch (PDOException $e) {
						echo $e->getMessage();
					}

					$code = intval($_POST['code']);
					$stmt = $dbh->prepare("
						SELECT *
						FROM discount_codes D, products P, (SELECT COUNT(*) AS count FROM orders WHERE code = (?)) AS C
						WHERE D.code = (?)
					");
					$stmt->execute([$code, $code]);

					$row = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT);

					if ($row == 0 || $code == "") {
						echo "Code does not exist.<br><br>";
					}
					else {
						include 'calculatediscount.php';

						echo "<b>Current date: </b>" . $currentDate;
						echo "<br><br><b>For code: </b>" . $row['code'];
						echo "<br><br><b>Code was created on: </b>" . $initialDate;
						echo "<br><br><b>This code expires on: </b>" . $expiryDate;
						echo "<br><br><b>Number of Uses: </b>" . $row['count'];
						echo "<br><br><b>Product: </b>" . $row['name'];
						echo "<br><br><b>Product Description: </b>" . $row['description'];
						echo "<br><br><b>Price: $</b>" . $row['price'];
						echo "<br><br><b>Final Discount Rate: </b>" . $discount_percentage . "%";
						echo "<br><br><b>Discounted Price: $</b>" . $finalPrice . "<br><br>";
					}

					$dbh = null;
				?>
			</div>

			<div class="container text-center"><a href="../index.php">Back</a></div><br>
		</div>
	</body>
</html>