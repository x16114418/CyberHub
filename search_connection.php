<?php

include("includes/header.php");


if(isset($_GET['q'])) { //get the q parameter from the url in the users browser
	$query = $_GET['q'];
	$query = mysqli_real_escape_string($con, $_GET['q']);
	$query = strip_tags($query);
	$query = preg_replace('/--;/u', '', $query);
	$query= preg_replace('/[^\p{L}\p{N}\s]/u', '', $query);
    $query = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $query);
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}
?>
<div class="main_column_search column" id="main_column">

	<?php 
	if($query == "") //if the search entered is empty throw prompt 
		echo "You must enter a connection name or username! Try again.";
	else {

		//If the users search/query contains a "_" then they are searching for a username.
		if($type == "username") 
			$theUserReturnQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 5");
		//If there are two elements or names take it that the user is searching for first and last names
		else {
			$names = explode(" ", $query); //break the string into the names array
			if(count($names) == 3)
				$theUserReturnQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no'");
			//If the user inputs one word into the search take it they are looking for first names and last names
			else if(count($names) == 2)
				$theUserReturnQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");
			else 
				$theUserReturnQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");
		}

		//see if the user found any results in their search
		if(mysqli_num_rows($theUserReturnQuery) == 0) //if the users query is 0 then
			echo "Cant find anyone by the connection name " . $type . " like: " .$query;//get the users entered name and prompt them 
		else 
			echo mysqli_num_rows($theUserReturnQuery) . " connections found: <br> <br>"; //if results found then show what the parameter returned

		echo "<p id='grey'>Search for name or username!</p>"; //if no results get user to search for user names like first and last
		echo "<a href='search_connection.php?q=" . $query ."&type=name'>Names</a>, <a href='search_connection.php?q=" . $query ."&type=username'>Usernames</a><br><br><hr id='search_hr'>";

		while($row = mysqli_fetch_array($theUserReturnQuery)) { //start the conditional while to see if they are connected with the users that were found in their search.
			$the_user_obj = new User($con, $user['username']);
			$button = ""; // yet to be defined 
			$mutual_connections = "";// yet to be defined

			if($user['username'] != $row['username']) {
				//display a button in the results search page for users to add or remove the connection
				if($the_user_obj->isFriend($row['username']))//check if the user (the_user_obj) is connected with the user
					$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Remove Connection'>"; //show remove
				else if($the_user_obj->requestReceived($row['username'])) //see if they received the request to connect
					$button = "<input type='submit' name='" . $row['username'] . "' class='warning' value='Respond to Request'>"; //show respond
				else if($the_user_obj->requestSent($row['username'])) //check if the connection request has be sent
					$button = "<input type='submit' class='default' value='Request Sent'>"; //show request has been sent
				else 
					$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='Add Connection'>"; //if all else is false well then show the add connection button to the user 
				$mutual_connections = $the_user_obj->getMutualConnections($row['username']) . " connections in common"; //if there is results show the mutual connections of those users
				//buttons for the connection search

				if(isset($_POST[$row['username']])){
					if($the_user_obj->isFriend($row['username'])) {

						$the_user_obj->removeConnection($row['username']);
						//when the user has removed the connection refresh the page to show add friend button
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($the_user_obj->requestReceived($row['username'])){
						header("Location: connection_request.php");
					}
					else if($the_user_obj->requestSent){

					}
					else {

						$the_user_obj->sendingRequest($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
				}
			}
			echo "<div class='search_results'>
					<div class='searchPageButtons'>
						<form action='' method='POST'>
							" . $button . "
							<br>
						</form>
					</div>

					<div class='result_profile_pic'>
						<a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' style='height: 100px;'></a>
					</div>

						<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
						<p id='grey'> " . $row['username'] ."</p>
						</a>
						<br>
						" . $mutual_connections ."<br>

				</div>
				<hr>";
		}
	}
	?>
</div>