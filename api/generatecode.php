<?php
	include "../autoload.php";

	try {
		$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}

	$product_id = intval($_GET['product_id']);
	$stmt = $dbh->prepare("INSERT INTO discount_codes (product_id) VALUES (?)");
	$stmt->execute([$product_id]);
	$code_id = $dbh->lastInsertId();

	echo $code_id;

	$dbh = null;
?>