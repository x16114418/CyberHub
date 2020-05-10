<?php 
include("includes/header.php"); //include the header for the nav 


$the_message_obj = new Messenger($con, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u']; //assign the parameter u to the users username
else {
	$user_to = $the_message_obj->getMostRecentUserMsg(); //call the most recent user message to pull the last user you talked to
	if($user_to == false) //if false you havent had a converstaion yet - add in function for users to search for users to chat to
		$user_to = 'new';
}
if($user_to != "new")//if user is not sending a new message then dont create a new user and if sending new message create new user object
	$user_to_msg_obj = new User($con, $user_to); 
	if(isset($_POST['post_message'])){ //if there is an action on post_message then

		if(isset($_POST['message_body'])){
			$body = mysqli_real_escape_string($con, $_POST['message_body']); //escape the illegal characters if a user has enetered them
			$body = preg_replace('/--;/u', '', $body);
			$body= preg_replace('/[^\p{L}\p{N}\s]/u', '', $body);
    		$body = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $body);
			$date = date("Y-m-d H:i:s"); //get date of message sent/posted
			$the_message_obj->sendTheMessage($user_to, $body, $date); //pull the sendtheMessage function with the parameters user_to, body and date
		}
	}
 ?>
 <div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>
		<!-- for the profile info -->
		<div class="user_details_left_right"> <!-- display the data  -->
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name']; //show names
			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; //show posts and likes 
			echo "Likes: " . $user['num_likes']; //show the likes 
			?>
		</div>

	</div>
	<div class="main_column column" id="main_column"> 
		<div class="name_to">
		<?php
		if($user_to != "new"){ //if the user_to is not new and is sending a message show the message
			echo "<h4> You and <a href='$user_to'>" . $user_to_msg_obj->getFirstAndLastName() . "</a></h4><hr><br>"; 
			echo "<div class='load_messages' id='first_message'>";
			echo $the_message_obj->getTheMessages($user_to); //call the getTheMessages function with the user_to parameter
			echo "</div>";
		}
		else{
			echo "<h4>Share something!</h4>";
		}
		?>
	</div>
		<div class="message_post">
			<form action="" method="POST">
				<?php
				if($user_to == "new") { //if the user to is new then
					echo "Pick the connection you want to message! <br><br>";
					?> 
					To: <input type='text' onkeyup='getUsername(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input'>
					<?php
					echo "<div class='results'></div>";
				}
				else {
					echo "<textarea name='message_body' id='message_textarea' placeholder='Put your message here...'></textarea>";
					echo "<input type='submit' name='post_message' class='info' id='message_send' value='Send'>";
				}
				?>
			</form>
		</div>
		<script>
      var div = document.getElementById("first_message"); //scrolling to messages 
      if(div != null) //if the current div is not equal to null then
      div.scrollTop = div.scrollHeight; //div scroll top
    </script>
	</div>
	<div class="user_details column" id="conversations">
			<h4>Conversation List</h4>

			<div class="load_the_conversations">
				<?php echo $the_message_obj->getMessageList(); ?> <!-- pull the getMessageList -->
			</div>
			<br>
			<a href="messages.php?u=new">Chat to another Connection!</a>

		</div>