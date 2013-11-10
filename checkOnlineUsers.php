<?php
require_once("connectdb.php");
session_start();
$query=mysql_query("SELECT * FROM users WHERE isOnline=1;");
while($row=mysql_fetch_array($query)){
	
	$query2=mysql_query("SELECT * FROM messages WHERE isRead=0 AND receiver_id = '".$_SESSION['user_id']."' AND sender_id = '".$row['user_id']."';");
	
	$row2=mysql_fetch_array($query2);
	$rows = mysql_num_rows($query2);
	
	echo $rows . "," . $row["user_id"] . "," . $row["username"] . "," ;
	
	}


?>
