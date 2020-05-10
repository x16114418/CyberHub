<?php

include("includes/header.php");
include("includes/form_handlers/settings_account_handler.php"); //include the settings_account_handler to validate the data the user has entered.
 ?>

 <div class="main_column_settings column">
 	<h3><?php echo $user['first_name']; ?>`s Account Settings</h3>
 	<div class="profile_img_fix">
 	<?php
 	echo "<img src='" . $user['profile_pic'] . "' id='profile_prev_Picture'>"; //show the profile picture of the user logged in



 	?>
 	<br>
 	<a href="upload.php"><?php echo $user['first_name']; ?>! Upload/Change your profile picture? Click here!</a> <br><br><br>

 	When you make your changes click Update to save them!
 	<?php
 	$user_info_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");//pull in the users current data
 	$row = mysqli_fetch_array($user_info_query);
 	$first_name = $row['first_name'];
 	$last_name = $row['last_name'];
 	$email = $row['email'];

 	?>
 	<form action="settings_for_user_account.php" method="POST">
 		First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_forms"><br>
 		Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_forms"><br>
 		Email: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_forms"><br>
 		<?php echo $prompt; ?>
 		<input type="submit" name="update_details" id="save_details" value="Update information" class="default confirm_setting_buttons"><br>
 	</form>
 	<h3>Change your Password</h3>
 	<a href="https://securityboulevard.com/2019/03/nist-800-63-password-guidelines/">CyberHub goes by NIST password Guidelines, view them here!</a>
 	<br><br>
 	<form action="settings_for_user_account.php" method="POST">
 		Your Old password: <input type="password" name="password_old" id="settings_forms"><br>
 		Your New Password: <input type="password" name="password_new_one" id="settings_forms"><br>
 		Confirm New Password: <input type="password" name="password_new_two" id="settings_forms"><br>
 		<?php echo $password_prompt; ?>
 		<input type="submit" name="password_update" id="user_details_save" value="Update Password" class="default confirm_setting_buttons"><br>
 	</form>
 	<h3>Delete your CyberHub account?</h3>
 	<form action="delete_user_account.php" method="POST">
		<input type="submit" name="delete_account" id="close_account" value="Close Account" class="danger confirm_setting_buttons">
	</form>
 	

 </div>