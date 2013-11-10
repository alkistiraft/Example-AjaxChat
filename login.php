<?php
	
	session_start();
	if (isset($_SESSION["username"])) {
		header( 'Location: /chat/index.php' );
	}
		

		
			echo '<form action="welcome.php" method="post">';
		    echo 'Username: <input type="text" name="username" style="margin:3;"><br>';
		     	
		    echo '<input type="submit" value="Login" >';
		    echo '</form>';
		
	

         ?>


     

