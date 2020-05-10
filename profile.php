<?php 
include("includes/header.php"); //include header for the nav

//for the user profile

if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);
	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}
if(isset($_POST['remove_connection'])){ //if a user is on someones page and hits the remove connection button then
	$user = new User($con, $userLoggedIn); //create connection variable and
	$user->removeConnection($username); //pull the removeconnection function to remove the connection
}
if(isset($_POST['add_connection'])){ //if a user is on someones page and hits the remove connection button then
	$user = new User($con, $userLoggedIn);//create connection variable and
	$user->sendingRequest($username); //pull the sendingrequest Function to add the user as a connection
}
if(isset($_POST['reply_connection'])){
	header("Location: connection_requests.php"); //make this file ------------
}
 ?>
 		<style type="text/css">
 			.wrapper {
 				margin-left: 0px;
 				padding-left: 0px;
 			}
 		</style>

 	<div class="profile_picture">
    <!-- get the users profile info and display -->
 		<img src="<?php echo $user_array['profile_pic']; ?>">
 		<div class="profile_bio">
	 		<p><?php echo "Posts: " . $user_array['num_posts']; ?></p> 
      <p><?php echo "CyberHub Member since: <br>" . $user_array['signup_date']; ?></p>
	 		<p><?php echo "Connections: " . $num_friends ?></p>
 		</div>
 		<form action="<?php echo $username; ?>" method="POST">
      <?php 
      $the_profile_user_obj = new User($con, $username); 
      if($the_profile_user_obj->isClosed()) { //get the isclosed function and see if the user account is closed if it is closed then
        header("Location: user_closed.php"); //bring the logged in user to the user closed page/view
      }
      $user_who_is_loggedIn_obj = new User($con, $userLoggedIn); 

      if($userLoggedIn != $username) { //if the user that is logged in is not the user whos profile your on then
        //see what button to show
        if($user_who_is_loggedIn_obj->isFriend($username)) { //check if the user is a friend and if they are show the remove connection button
          echo '<input type="submit" name="remove_friend" class="danger" value="Remove Connection"><br>';
        }
        else if ($user_who_is_loggedIn_obj->requestReceived($username)) { // if the user logged in has received request then show respong to request button
          echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
        }
        else if ($user_who_is_loggedIn_obj->requestSent($username)) { //if the request has already been sent then display request sent button
          echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
        }
        else 
          echo '<input type="submit" name="add_friend" class="success" value="Add Connection"><br>'; //if all else is not true then display the add connection buttoon
      }
      ?>
    </form>
 		<input type="submit" class="default" data-toggle="modal" data-target="#post_modal" value="Got news to share?"> 

    <?php 
    if($userLoggedIn != $username) { //if user logged in is not the username with profile then
      echo '<div class="profile_info_bottom">';
        echo $user_who_is_loggedIn_obj->getMutualConnections($username) . " Mutual Connections"; //pull the mutual connections function and display
      echo '</div>';
    }
     ?>
 	</div>
	<div class="profile_post_main_column column">
		<div class="posts_area"></div>
    <img id="loading" src="assets/images/icons/loading.gif">
		?>
	</div>
<!-- for the modal pop up for the user posts to profile-->
<div class="modal fade" id="post_modal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Got news to share?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>This post will appear on their profile and news feed! Private message them in CyberHub Messenger</p>
        <p>Make it interesting!</p>
        <form class="profile_post" action="profile.php" method="POST">
        	<div class="form-group">
        		<textarea class="form-control" name="post_body"></textarea>
        		<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
        		<input type="hidden" name="user_to" value="<?php echo $username; ?>">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Send</button>
      </div>
    </div>
  </div>
</div>
<script> //for the scrolling on the user profile page
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';
  var profileUsername = '<?php echo $username; ?>';

  $(document).ready(function() {
    $('#loading').show(); //show the loading gif when loading in the posts on the users profile 
    //get the ajax request call to display the first posts on the user profile
    $.ajax({
      url: "includes/handlers/ajax_profile_posts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
      cache:false,

      success: function(data) { //when the posts load in successfully then 
        $('#loading').hide(); //hide the loading gif and then
        $('.posts_area').html(data);//load the parameter data for posts
      }
    });
    $(window).scroll(function() {
      var height = $('.posts_area').height(); //the assigned div that will have the posts in it 
      var scroll_top = $(this).scrollTop(); //scroll top
      var page = $('.posts_area').find('.nextPage').val(); 
      var noMorePosts = $('.posts_area').find('.noMorePosts').val(); //no more posts on profile
      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') { //if both arguments are false 
        $('#loading').show(); //show the loading gif that more posts are loading

        var ajaxReq = $.ajax({ //make the request
          url: "includes/handlers/ajax_profile_posts.php", //get the ajax forthe profile posts
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
          cache:false,

          success: function(response) { //if successful
            //gets rid of the currently .nextpage
            //gets rid of the currently .nextpage
            $('.posts_area').find('.nextPage').remove();
            $('.posts_area').find('.noMorePosts').remove(); 
            $('#loading').hide(); //hide the loading gif
            $('.posts_area').append(response); //then append and load the posts 
          }
        });
      }
      return false;

    });
  });
  </script>
	</div>
</body>
</html>