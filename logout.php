<?php
require_once("connectdb.php");
    session_start();
	$result = mysql_query("UPDATE users SET isOnline=0 WHERE username LIKE '" . $_SESSION['username'] . "';");
	
	session_unset();
	header('Location:/chat/index.php');
	
?>	
