<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type="text/javascript" src="js/code.js"></script>
	</head>

	<body onload="showProducts()">
		<div class="general">
			<h1>Group Buy</h1>
			<h3>Products</h3>
			<div style="text-align: right;"><h4>Look up code information:</h4>
				<form action="api/codeinformation.php" method="POST">
					<input type="text" name="code">
					<input type="submit" value="Lookup">
				</form><br>
			</div>
			<div id="main"></div><br>
			<div style="text-align: center;">
				<a href="management.php">Management</a><br><br>
				Created by: COP 4710 Team 8
			</div>
		</div>
	</body>
</html>