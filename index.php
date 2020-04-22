<?php include 'api/header.php';?>

		<div style="text-align: right;" class="container">
			<h4>Look up code information:</h4>
			<form action="api/codeinformation.php" method="POST">
				<input type="text" name="code">
				<input type="submit" value="Lookup">
			</form><br>
		</div>

		<div id="main" class="container"></div><br>

<?php include 'api/footer.php';?>

<script type="text/javascript">
	window.onload = showProducts();
</script>