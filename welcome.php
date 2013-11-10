<?php
require_once("connectdb.php");
session_start();
$result = mysql_query("SELECT * FROM users WHERE username LIKE '" . $_POST['username'] . "' ;");
$success = false;
$username = "";
$privilege = 0;
$userId = 0;
while ($row = mysql_fetch_array($result)) {
	$success = true;
	$userId = $row["user_id"];
	$username = $row["username"];
	$result = mysql_query("UPDATE users SET isOnline=1 WHERE username LIKE '" . $_POST['username'] . "';");
	
}

if ($success) {
	echo $username . " successfully logged in"; 
	$_SESSION['username'] = $username;
	$_SESSION['user_id'] = $userId;
	header( 'Location: /chat/index.php' );
} else {
	echo "bye bye";
}
?>
