<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Group Buy</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/code.js"></script>
		<script type="text/javascript" src="../js/code.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div class="jumbotron">
			<div class="container text-center">
				<h1>Group Buy</h1>
				<h4><i>Group Discounts</i></h4>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" href="#">Group Buy</a>
				</div>
				<ul class="nav navbar-nav">
				<?php
					if (strpos(getcwd(), "api") !== false)
						echo "<li><a href=\"../index.php\">Home</a></li>";
					else
						echo "<li><a href=\"index.php\">Home</a></li>";

					if (strpos(getcwd(), "api") !== false)
						echo "<li><a href=\"../management.php\">Manage</a></li>";
					else
						echo "<li><a href=\"management.php\">Manage</a></li>";

					// if (strpos(getcwd(), "api") !== false)
					// 	echo "<li><a href=\"logout.php\">Logout</a></li>";
					// else
					// 	echo "<li><a href=\"api/logout.php\">Logout</a></li>";
				?>
				</ul>
			</div>
		</nav><br>