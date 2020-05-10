<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>
<html>
<head>
	<title>CyberHub</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php  

	if(isset($_POST['register_button'])) { //if button clicked then show the register, shows login on default
		echo '
		<script>

		$(document).ready(function() {
			$("#one").hide();
			$("#two").show();
		});
		</script>

		';
	}
	?>
	<div class="wrapper">
		<div class="login_box">
			<div class="login_header">
				<h1>CyberHub</h1><hr>
				<h2><a href="about.html" class="button">About</a></h2>
				<br>
				
			</div>
			<br>
			<div id="first">
				<form action="register.php" method="POST">
					<input type="email" name="log_email" autocomplete="off" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password" autocomplete="off">
					<br>
					<?php if(in_array("<span style='color: #00fa43;'>Email or password was incorrect</span><br>", $error_array)) echo  "<span style='color: #00fa43;'>Email or password was incorrect</span><br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">Set up your account here!</a>
				</form>

			</div>
			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" autocomplete="off" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<span style='color: #00fa43;'>Your first name must be between 3 and 15 characters</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Your first name must be between 3 and 15 characters</span><br>"; ?>
					<input type="text" name="reg_lname" autocomplete="off" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<span style='color: #00fa43;'>Your last name must be between 3 and 15 characters</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Your last name must be between 3 and 15 characters</span><br>"; ?>
					<input type="email" name="reg_email" autocomplete="off" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>
					<input type="email" name="reg_email2" autocomplete="off" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<span style='color: #00fa43;'>Email in use! You may already have an account</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Email in use! You may already have an account</span><br>"; 
					else if(in_array("<span style='color: #00fa43;'>Please enter a valid email</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Please enter a valid email</span><br>";
					else if(in_array("<span style='color: #00fa43;'>Emails don't match</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Emails don't match</span><br>"; ?>
					<input type="password" name="reg_password" placeholder="Password" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("<span style='color: #00fa43;'>Your passwords do not match</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Your passwords do not match</span><br>"; 
					else if(in_array("<span style='color: #00fa43;'>Your password can only contain letters or numbers</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Your password can only contain letters or numbers</span><br>";
					else if(in_array("<span style='color: #00fa43;'>Your password must be betwen 8 and 64 characters</span><br>", $error_array)) echo "<span style='color: #00fa43;'>Your password must be betwen 8 and 64 characters</span><br>"; ?>
					<input type="submit" name="register_button" value="Register">
					<br>
					<?php if(in_array("<span style='color: #00fa43;'><h1>Account set up! Log in and connect with friends!</h1></span><br>", $error_array)) echo "<span style='color: #00fa43;'><h1>Account set up! Log in and connect with friends!</h1></span><br>"; ?>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>