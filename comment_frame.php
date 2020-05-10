<?php  
	require 'config/config.php';
	include("includes/classes/User.php");
	include("includes/classes/Post.php");

	if (isset($_SESSION['username'])) {

		$userLoggedIn = $_SESSION['username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'"); //if user logged in show if not return to register
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: register.php");
	}
	?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<style type="text/css">
	* {
		font-size: 12px;
		font-family: Arial, Helvetica, Sans-serif;
	}
	</style>

	
	<script>
		function toggle() { //toggle the comment form
			var element = document.getElementById("comment_section");

			if(element.style.display == "block") 
				element.style.display = "none";
			else 
				element.style.display = "block";
		}
	</script>

	<?php  
	//pull the id of the post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}
	$user_who_added_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id='$post_id'"); //get who added the post
	$row = mysqli_fetch_array($user_who_added_query);
	$posted_to = $row['added_by'];

	if(isset($_POST['postComment' . $post_id])) {
		$post_body = $_POST['post_body'];
		$post_body = mysqli_escape_string($con, $post_body); //escape any bad/illegal characters by user
		$post_body = preg_replace('/--;/u', '', $post_body);
		$post_body= preg_replace('/[^\p{L}\p{N}\s]/u', '', $post_body);
    	$post_body = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $post_body);
		$date_and_time = date("Y-m-d H:i:s");
		$insert_the_comment = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', '$date_and_time', 'no', '$post_id')");//send post to db and display
		echo "<p><span style='color:#fff;text-align:center;'>Comment has been posted!</span><p>"; //prompt the user it has been posted
	}
	?>
	<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
		<textarea name="post_body"></textarea>
		<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
	</form>

	<!-- pull in the comments -->
	<?php 
	$get_the_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id ASC");
	$counter = mysqli_num_rows($get_the_comments);

	if($counter != 0) {
		while($theComment = mysqli_fetch_array($get_the_comments)){

			$body_of_the_comment = $theComment['post_body'];
			$posted_to = $theComment['posted_to'];
			$posted_by = $theComment['posted_by'];

			$date_added = $theComment['date_added'];
			$removed = $theComment['removed'];

						//get the times of the comments 
						$date_and_time = date("Y-m-d H:i:s");
						$start_date = new DateTime($date_added); 
						$end_date = new DateTime($date_and_time); 
						$time_intervals = $start_date->diff($end_date);
						if($time_intervals->y >= 1) {
							if($time_intervals == 1)
								$time_of_message = $time_intervals->y . " year ago"; 
							else 
								$time_of_message = $time_intervals->y . " years ago";
						}
						else if ($time_intervals->m >= 1) {
							if($time_intervals->d == 0) {
								$days = " ago";
							}
							else if($time_intervals->d == 1) {
								$days = $time_intervals->d . " day ago";
							}
							else {
								$days = $time_intervals->d . " days ago";
							}
							if($time_intervals->m == 1) {
								$time_of_message = $time_intervals->m . " month". $days;
							}
							else {
								$time_of_message = $time_intervals->m . " months". $days;
							}
						}
						else if($time_intervals->d >= 1) {
							if($time_intervals->d == 1) {
								$time_of_message = "Yesterday";
							}
							else {
								$time_of_message = $time_intervals->d . " days ago";
							}
						}
						else if($time_intervals->h >= 1) {
							if($time_intervals->h == 1) {
								$time_of_message = $time_intervals->h . " hour ago";
							}
							else {
								$time_of_message = $time_intervals->h . " hours ago";
							}
						}
						else if($time_intervals->i >= 1) {
							if($time_intervals->i == 1) {
								$time_of_message = $time_intervals->i . " minute ago";
							}
							else {
								$time_of_message = $time_intervals->i . " minutes ago";
							}
						}
						else {
							if($time_intervals->s < 30) {
								$time_of_message = "Just now";
							}
							else {
								$time_of_message = $time_intervals->s . " seconds ago";
							}
						}

						$the_user_obj = new User($con, $posted_by);
						?>
						<div class="comment_section">
						 	<a href="<?php echo $posted_by?>" target="_parent"><img src="<?php echo $the_user_obj->getProfilePicture()?>" title="<?php echo $posted_by; ?>" style="float:left;" height="30"></a>
						 	<a href="<?php echo $posted_by?>" target="_parent"> <b><?php echo $the_user_obj->getFirstAndLastName(); ?></b></a>
						 	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_of_message . "<br>" . $body_of_the_comment; ?>
						 	<hr>
						 </div>
						<?php
				}
			}
			else {
				echo "<center><br><br>Sorry! No comments to show</center>";
			}
			 ?>
</body>
</html>