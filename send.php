<?php
require_once("connectdb.php");
session_start();

$query= mysql_query("INSERT INTO messages (message,receiver_id,sender_id) VALUES ('".$_POST['message']."', '".$_POST['receiver_id']."','".$_SESSION['user_id']."')  ;");
//echo $_POST["message"];
echo "1";

?>
