<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>

	<body>
        <?php
            echo "<table class=\"general\">";
            echo "<tr><td>";
            echo "<h2>Add an Item to the Inventory:</h2>";
            echo "<form action=\"add.php\" method=\"post\">";
            echo "<h4>Name:</h4>";
            echo "<input type=\"textbox\" name=\"product_name\"><br><br>";
            echo "<h3>Description:</h3>";
            echo "<input type=\"textbox\" name=\"description\"><br><br>";
            echo "<h3>Price:</h3>";
            echo "<input type=\"textbox\" name=\"price\"><br><br>";
            echo "<h3>Discount Percentage:</h3>";
            echo "<input type=\"textbox\" name=\"discount_percentage\" value=0><br><br>";
            echo "<h3>Max Discount Percentage:</h3>";
            echo "<input type=\"textbox\" name=\"max_discount_percentage\" value=0><br><br>";
            echo "<input type=\"submit\">";
            echo "</form>";
            echo "</td></tr>";
            echo "</td></tr>";
            echo "</table><br>";
         ?>

        <a href="addRemove.php">Back</a>
    </body>
</html>
