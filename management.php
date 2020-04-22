<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type="text/javascript" src="js/code.js"></script>
	</head>

	<body>
		<div class="general" style="text-align: center;">
			<h1>Store Management</h1>
			<h3>Menu</h3>
			<div>
				<a href="index.php">Front Page</a><br>
				<a href="api/addRemove.php">Add/Remove Items</a><br>
				<a href="api/updateproducts.php">Update Items/Set Discount Policies</a><br>
				<a href="api/readytoprocess.php">Process Orders with Expired Codes</a><br>
				<a href="api/newcodes.php">List of New Codes</a><br>
			</div>
			<h3>Information</h3>
			<div>
				<a href="api/information.php?table_name=customers">Customers</a><br>
				<a href="api/information.php?table_name=orders">Orders</a><br>
				<a href="api/information.php?table_name=discount_codes">Discount Codes</a><br>
				<a href="api/information.php?table_name=credit_cards">Credit Cards</a><br>
				<a href="api/information.php?table_name=products">Products</a><br>
			</div>
		</div>
	</body>
</html>