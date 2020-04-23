<?php
	include "../autoload.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myusername = $_POST['username'];
		$mypassword = $_POST['password'];

		if($myusername == env('ADMIN_USERNAME') && $mypassword == env('ADMIN_PASSWORD')) {
			// session_register("myusername");
			$_SESSION['login_user'] = $myusername;
			header("location: ../management.php");
		}
		else {
			// $error = "Your Login Name or Password is invalid";
		}
	}
?>

<?php include "header.php";?>

		<div class="container text-center" style="max-width: 20%">
			<div class="panel panel-heading text-center">
				<h4>Login</h4>
				<div class="panel text-center">
						<form action = "" method="post">
						<label>Userrname </label><br>
						<input type="text" name="username" ><br><br>
						<label>Password </label><br>
						<input type="password" name="password"><br><br>
						<input type = "submit" value = " Submit "/><br />
						</form>
					<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				</div>
			</div>
		</div>
	</body>
</html>