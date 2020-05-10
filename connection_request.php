<?php
include("includes/header.php"); //pull in the header for nav

?>
<div class="main_column_requests column" id="main_column">

	<h4>Connection Requests for <?php echo $user['first_name']; ?></h4>
	<?php  
	$query = mysqli_query($con, "SELECT * FROM connection_requests WHERE user_to='$userLoggedIn'");//check if there is any requests for the user logged in
	if(mysqli_num_rows($query) == 0)
		echo "You have no connection requests, search for new connections and reach out to them!"; //if 0 then echo out no requests
	else { //if there is
		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$the_user_from_obj = new User($con, $user_from);

			echo $the_user_from_obj->getFirstAndLastName() . " sent you a connection request!";

			$user_from_the_friend_array = $the_user_from_obj->getConnectionArray();

			if(isset($_POST['accept_request' . $user_from ])) { //if the user logged in accepts request then update the db adding that user to the friend array
				$add_connection_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
				$add_connection_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_request_query = mysqli_query($con, "DELETE FROM connection_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo '<span style="color:#fff;text-align:center;">Request Accepted</span>';
				header("Location: connection_request.php");
			}
			if(isset($_POST['decline_request' . $user_from ])) { //if the logged in user declines the request then delete it from the db in the connection request table
				$delete_request_query = mysqli_query($con, "DELETE FROM connection_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo '<span style="color:#fff;text-align:center;">Request Denied</span>';
				header("Location: connection_request.php");
			}
			?>
			<form action="connection_request.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept Request">
				<input type="submit" name="decline_request<?php echo $user_from; ?>" id="decline_button" value="Decline Request">
			</form>
			<?php
		}
	}
	?>
</div>