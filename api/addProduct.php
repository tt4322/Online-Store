<?php include 'header.php';?>

        <div class="general">
            <?php
                echo "<h1>Store Management</h1>";
                echo "<h3>Add an Item to the Inventory:</h3>";
                echo "<table class=\"general\">";
                echo "<tr><td>";
                echo "<form action=\"add.php\" method=\"post\">";
                echo "<h4><b>Name:<b></h4>";
                echo "<input type=\"textbox\" name=\"product_name\"><br><br>";
                echo "<h4><b>Description:<b></h4>";
                echo "<input type=\"textbox\" name=\"description\"><br><br>";
                echo "<h4><b>Price:<b></h4>";
                echo "<input type=\"textbox\" name=\"price\"><br><br>";
                echo "<h4><b>Discount Percentage:<b></h4>";
                echo "<input type=\"textbox\" name=\"discount_percentage\" value=0><br><br>";
                echo "<h4><b>Max Discount Percentage:<b></h4>";
                echo "<input type=\"textbox\" name=\"max_discount_percentage\" value=0><br><br>";
                echo "<input type=\"submit\">";
                echo "</form>";
                echo "</td></tr>";
                echo "</td></tr>";
                echo "</table><br>";
            ?>

            <a href="addRemove.php">Back</a><br><br>
        </div>
    </body>
</html>
