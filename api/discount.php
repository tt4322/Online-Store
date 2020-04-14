<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
  </head>
  <body>
    <h1>Online Store</h1>

    <div id="main">
      <?php
        include "../autoload.php";

        try {
					$dbh = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}

        $discountCode = $_GET["discountCode"];

        # Grab creation date of discount code
        $stmt = $dbh->prepare("SELECT date, processed FROM discount_codes WHERE (code = '$discountCode')");

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $result = $stmt->fetch(PDO::FETCH_NAMED);

        if ($result == null)
        {
          echo "This code does not exist!";
        }
        else
        {
          # Find date the code expires
          $currentDate = date("Y-m-d H:i:s");
          $initialDate = $result["date"];
          $expiryDate = date("Y-m-d H:i:s", strtotime($initialDate . ' + 7 days'));
          $processed = $result["processed"];

          $stmt = $dbh->prepare("SELECT COUNT(*) AS count FROM orders WHERE (code = '$discountCode')");
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_NAMED);

          # Calculate discount rate
          $count = $result["count"];
          $rate = .05 + ($count / 10) * .05;

          # Max discount of 30%
          if ($rate > .3)
            $rate = 30;
          else
            $rate = $rate * 100;

          echo "Current date is $currentDate<br><br>";
          echo "For code $discountCode:<br><br>";
          echo "Code was created on $initialDate<br>";

          echo "This code was used for $count purchases.<br>";

          # If code is expired then print "Code is expired" along with the final rate
          if ($expiryDate < $currentDate)
          {
            echo "This code expired on $expiryDate<br>";
            echo "The final rate was $rate%<br>";

            # If processed is not true (0) then set to true
            if ($processed == 0)
            {
                $stmt = $dbh->prepare("UPDATE discount_codes SET processed='1' WHERE code=35261");
                if (!$stmt->execute()) {
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                }
            }
          }
          else
          {
            echo "This code is still valid! It expires on $expiryDate.<br>";
            echo "The current discount rate is $rate%<br>";
          }
        }
        echo "<br>";
      ?>
    </div>

    <a href="../management.html">Back</a>
  </body>
</html>
