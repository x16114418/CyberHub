<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style type="text/css">
		body{
			background-color: #fff;
		}
		form {
			position: absolute;
			top: 0;
}

	</style>
	<?php  
	require 'config/config.php';
	include("includes/classes/User.php");
	include("includes/classes/Post.php");

	if (isset($_SESSION['username'])) {
		$userLoggedIn = $_SESSION['username'];
		$user_like_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
		$user = mysqli_fetch_array($user_like_details_query);
	}
	else {
		header("Location: register.php");
	}
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];//get the id of the post
	}

	$get_the_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($get_the_likes);
	$total_likes = $row['likes'];
	$user_likes = $row['added_by'];

	$user_like_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_likes'");
	$row = mysqli_fetch_array($user_like_details_query);
	$total_likes_user = $row['num_likes'];

	//buttons
	if(isset($_POST['like_button'])){
		$total_likes++;
		$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		$total_likes_user++;
		$user_like = mysqli_query($con, "UPDATE users SET num_likes='$total_likes_user' WHERE username='$user_likes'");
		$insert_user_update = mysqli_query($con, "INSERT INTO likes VALUES('', '$userLoggedIn', '$post_id')");

		
	}
	if(isset($_POST['unlike_button'])){
		$total_likes--;
		$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		$total_likes_user--;
		$user_like = mysqli_query($con, "UPDATE users SET num_likes='$total_likes_user' WHERE username='$user_likes'");
		$insert_user_update = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");

		
	}

	//if liked show unlike and vice versa see if likes exists
	$check_likes_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	$num_rows = mysqli_num_rows($check_likes_query);

	if($num_rows > 0){
		echo '<form action="likes.php?post_id=' . $post_id . '" method="POST">
		<input type="submit" class="comment_likes" name="unlike_button" value="Unlike">
		<div class="like_value">
		'. $total_likes .' Likes

		</div>
		</form>

		';
	}
	else {
		echo '<form action="likes.php?post_id=' . $post_id . '" method="POST">
		<input type="submit" class="comment_likes" name="like_button" value="Like">
		<div class="like_value">
		'. $total_likes .' Likes

		</div>
		</form>

		';
	}

	?>

</body>
</html>