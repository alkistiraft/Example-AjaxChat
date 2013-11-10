<?php
require_once("connectdb.php");
session_start();

$query = mysql_query("SELECT * FROM users WHERE user_id= '".$_SESSION['user_id']."';");
$row = mysql_fetch_array(query);

//1.update the date and the isOnline with the current date every 20"
//2.php file which is executed every half minute from server kai checks if date einai < 30
?>
