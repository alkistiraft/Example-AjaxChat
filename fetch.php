<?php
require_once("connectdb.php");
session_start();

$user1 = $_SESSION["user_id"];
$user2 = $_POST["receiver_id"];
$query = mysql_query("SELECT * FROM messages WHERE (sender_id = ".$user1." and receiver_id=".$user2.") or (sender_id = ".$user2." and receiver_id=".$user1.") ORDER BY date DESC ;");


while($row=mysql_fetch_array($query)){
		
	//αν εχει διαβαστει απο τον receiver_id
	
	if($row['receiver_id']==$user1){
		$query3 = mysql_query("UPDATE messages SET isRead=1 WHERE message_id=".$row['message_id']." ;");
    }
	$query2 = mysql_query("SELECT username FROM users WHERE user_id='".$row['sender_id']."';");
	$row2=mysql_fetch_array($query2);
	
	echo $row2['username'] ."," . $row['date'] ."," .$row['message'] . ",";
	
	}


?>
