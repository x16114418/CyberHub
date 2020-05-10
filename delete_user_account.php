<?php
include("includes/header.php"); //pull in the header for nav

if(isset($_POST['cancel'])) { //if the user clicks cancel or it is initialized then redirect
	header("Location: settings_for_user_account.php");
}
if(isset($_POST['delete_the_account'])) { //if delete the account is clicked 
	$close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'"); //update the db and set that the user accout closed to yes
	session_destroy(); //kill the session and the redirect the user who closed their account to the register page
	header("Location: register.php");//redirected user
}
?>
<div class="main_column column">

	<h4>Close your Account with Cyberhub</h4>

	Do you really want to close your account with us?<br><br>
	If you close your account you can reactivate it by logging back in!<br><br>

	<form action="delete_user_account.php" method="POST">
		<input type="submit" name="delete_the_account" id="delete_the_account" value="Yes! Close it!" class="danger confirm_setting_buttons" >
		<input type="submit" name="cancel" id="update_details" value="No way!" class="default confirm_setting_buttons">
	</form>

</div>