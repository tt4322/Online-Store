<?php include 'api/session.php';?>
<?php include 'api/header.php';?>

		<div class="container text-center" style="width: 35%">
			<div class="panel panel-primary">
				<div class="panel panel-heading""><h1>Store Management</h1></div>
					<h3>Menu</h3>
					<div>
						<a href="index.php">Front Page</a><br>
						<a href="api/addRemove.php">Add/Remove Items</a><br>
						<a href="api/updateproducts.php">Update Items/Set Discount Policies</a><br>
						<a href="api/readytoprocess.php">Process Orders with Expired Codes</a><br>
						<a href="api/newcodes.php">List of New Codes</a><br>
						<a href="api/logout.php">Logout</a><br>
					</div>
					<h3>Information</h3>
					<div>
						<a href="api/information.php?table_name=customers">Customers</a><br>
						<a href="api/information.php?table_name=orders">Orders</a><br>
						<a href="api/information.php?table_name=discount_codes">Discount Codes</a><br>
						<a href="api/information.php?table_name=credit_cards">Credit Cards</a><br>
						<a href="api/information.php?table_name=products">Products</a><br><br>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
