<?php 


include_once("includes/header.php");
include_once("includes/classes/User.php");
include_once("includes/classes/Post.php"); //include to load with ajax


if(isset($_POST['post'])){ //if post isset then
	$post = new Post($con, $userLoggedIn); //create connection variable and take user logged in
	$post->submitPost($_POST['post_text'], 'none');
}
 ?>
	<div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a> <!-- Pull in user info -->
		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];
			 ?>
			</a>
			<br>

			<?php echo "Posts: " . $user['num_posts']. "<br>"; //get the number of posts the user has created and display in the users profile info div
			echo "Member since: <br>" . $user['signup_date']; //get the number of likes of the user and display in the users profile info div
			?>
		</div>
	</div>
	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Got something to say? Lets hear it!"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>
		</form>
		<div class="posts_area"></div>
		<img id="loading" src="assets/images/icons/loading.gif">
	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>'; //echo user logged in

	$(document).ready(function() {

		$('#loading').show(); //show the loading gif when loading in the posts for the user
		//the ajax request for the loading of the posts for the user 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php", //get the ajax file for loading the posts
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) { //when the posts have loaded in
				$('#loading').hide(); //hide the gif
				$('.posts_area').html(data); //show the posts through data parameter
			}
		});
		$(window).scroll(function() { //declare vars
			var height = $('.posts_area').height(); // the Div containing the posts
			var scroll_top = $(this).scrollTop(); //set as the top for posts
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val(); //if there is no more posts to show in the div 

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') { //if scroll down and while posts load
				$('#loading').show(); //show the loading gif

				var ajaxReq = $.ajax({ //make the request
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) { //if successful
						$('.posts_area').find('.nextPage').remove(); //Remove the current .nextpage when success 
						$('.posts_area').find('.noMorePosts').remove(); //Remove the current .nextpage when success
						$('#loading').hide(); //then hide the loading gif
						$('.posts_area').append(response); //append the posts and show
					}
				});

			} 

			return false;
		}); //finish the window scroll function
	});
	</script>
	</div>
</body>
</html>