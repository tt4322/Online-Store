<?php
	$stmt = $dbh->prepare("SELECT COUNT(*) AS count FROM orders WHERE code = (?)");
	$result = $stmt->execute([$row['code']]);

	if ($result == null) {
		echo "This code does not exist!";
	}
	else {
		# Find date the code expires
		$currentDate = date("Y-m-d H:i:s");
		$initialDate = $row["date"];
		$expiryDate = date("Y-m-d H:i:s", strtotime($initialDate . ' + 7 days'));
		$processed = $result["processed"];

		$result = $stmt->fetch(PDO::FETCH_NAMED, PDO::FETCH_ORI_NEXT);

		$count = $result["count"];
		$total_discount_percentage = $row['discount_percentage'] + ($result["count"] / 10) * $row['discount_percentage'];

		if ($total_discount_percentage < $row['max_discount_percentage'])
			$discount_percentage = $total_discount_percentage;
		else
			$discount_percentage = $row['max_discount_percentage'];

		if ($discount_percentage == 0)
			$finalPrice = $row['price'];
		else
			$finalPrice = $row['price'] * (1 - ($discount_percentage / 100));

		$finalPrice = number_format($finalPrice, 2);

		if ($row['code'] == 0) {
			$discount_percentage = 0;
			$finalPrice = $row['price'];
		}

	}
?>