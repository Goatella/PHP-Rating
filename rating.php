<?php 
 // Connects to your Database 
 mysql_connect("YOURinfo.db.5296901.hostedresource.com", "YOURusername", "YOURpassword") or die(mysql_error()); 
 mysql_select_db("YOURdatabase") or die(mysql_error()); 
 
$mode = $_GET['mode'];
$voted = $_GET['voted'];
$id = $_GET['id'];


 //We only run this code if the user has just clicked a voting link
 if ( $mode=="vote") 
 { 
 
 //If the user has already voted on the particular thing, we do not allow them to vote again 	$cookie = "Mysite$id"; 
 	if(isset($_COOKIE[$cookie])) 
 		{ 
 		Echo "Sorry You have already ranked that site <p>"; 
 		} 
 
 //Otherwise, we set a cooking telling us they have now voted 
 	else 
 		{ 
 		$month = 2592000 + time(); 
 		setcookie(Mysite.$id, Voted, $month); 

 		 //Then we update the voting information by adding 1 to the total votes and adding their vote (1,2,3,etc) to the total rating 
 mysql_query ("UPDATE vote SET total = total+$voted, votes = votes+1 WHERE id = $id"); 
 		Echo "Your vote has been cast <p>"; 
 		} 
 } 




 //Puts SQL Data into an array
 $data = mysql_query("SELECT * FROM vote") or die(mysql_error()); 
 
 //Now we loop through all the data 
 while($ratings = mysql_fetch_array( $data )) 
 { 
 
 //This outputs the sites name 
 Echo "Name: " .$ratings['name']."<br>"; 
 
 //This calculates the sites ranking and then outputs it - rounded to 1 decimal 
 $current = $ratings[total] / $ratings[votes]; 
 Echo "Current Rating: " . round($current, 1) . "<br>"; 
 
 //This creates 5 links to vote a 1, 2, 3, 4, or 5 rating for each particular item 
 Echo "Rank Me: "; 
 Echo "<a href=".$_SERVER['PHP_SELF']."?mode=vote&voted=1&id=".$ratings[id].">Vote 1</a> | "; 
 Echo "<a href=".$_SERVER['PHP_SELF']."?mode=vote&voted=2&id=".$ratings[id].">Vote 2</a> | "; 
 Echo "<a href=".$_SERVER['PHP_SELF']."?mode=vote&voted=3&id=".$ratings[id].">Vote 3</a> | "; 
 Echo "<a href=".$_SERVER['PHP_SELF']."?mode=vote&voted=4&id=".$ratings[id].">Vote 4</a> | "; 
 Echo "<a href=".$_SERVER['PHP_SELF']."?mode=vote&voted=5&id=".$ratings[id].">Vote 5</a><p>"; 
 } 
 ?>
