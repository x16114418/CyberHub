function getUsername(e,s){$.post("includes/handlers/ajax_friend_search.php",{query:e,userLoggedIn:s},function(e){$(".results").html(e)})}function getConnectionSearch(e,s){$.post("includes/handlers/ajax_connection_search.php",{query:e,userLoggedIn:s},function(s){$(".results_empty")[0]&&($(".results_empty").toggleClass("search_result"),$(".results_empty").toggleClass("search_empty")),$(".search_result").html(s),$(".search_empty").html("<a href='search_connection.php?q="+e+"'> Connections found</a>"),""==s&&($(".search_result").html(""),$(".search_result").toggleClass("search_empty"),$(".search_result").toggleClass("search_result"))})}$(document).ready(function(){$("#search_input").focus(function(){window.matchMedia("(min-width: 800px)").matches&&$(this).animate({width:"250px"},200)}),$(".button_place").on("click",function(){document.form_for_search.submit()}),$("#submit_profile_post").click(function(){$.ajax({type:"POST",url:"includes/handlers/ajax_submit_profile_post.php",data:$("form.profile_post").serialize(),success:function(e){$("#post_form").modal("hide"),location.reload()},error:function(){alert("Failure")}})})}),$(document).click(function(e){"search_result"!=e.target.class&&"search_input"!=e.target.id&&($(".search_result").html(""),$(".search_result").html(""),$(".search_result").toggleClass("search_empty"),$(".search_result").toggleClass("search_result"))});