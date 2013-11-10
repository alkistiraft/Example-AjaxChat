<?php
require_once("connectdb.php");
session_start();

if (isset($_SESSION['username'])) {
			echo "Welcome, ".$_SESSION['username'];
			echo '<form action="logout.php" method="post" >';
			echo '<input type="submit" value="Logout" />';
			echo '</form>';
}
?>

<html>

	<head>
		
		<title>Ajax Chat</title>
		
    </head>
    
	<body>
	<h1>Ajax Chat (v0.1)</h1>
		<div class="chat">
				<div class="messages" style="border : 1px solid #CCCCCC; width:250px; height:210px;padding:10px;overflow-y: scroll;"> 
			    </div>
				
				<textarea style="width:260px;height:70px; padding:5px;font: 1em Arial" class="entry" placeholder="Type your message here"></textarea>
				
				<input type="button" value="Send" onclick="sendMessage();"/>
		        <input type="button" value="Show Online Users" onclick="checkForOnlineUsers();"/>
		</div>
				
		
		<div class="users">
			<table class="online" >
				<tr> 
				<td></td>
				</tr>
 			</table>		
			
		</div>	
				
	</body>
	
</html>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<script>
	var receiver_id = 0;
	<?php if(isset($_GET['receiver_id'])) { ?>
	receiver_id = <?php echo $_GET['receiver_id'] ?> ;
	<?php } ?>
   
                  
	

function checkForOnlineUsers(){
	$.ajax({
		             
				type: "POST",
				url: "checkOnlineUsers.php",
	            dataType: "html"
				})
				.done(function( msg ) {
					
					//alert( "Data Saved: " + msg );
				$('.users .online').html("");
					
				var onlineUsers = msg.split(",");
				for(var i=0;  i<= onlineUsers.length; i=i+3) {
					if (i + 2 > onlineUsers.length) {
							break;
						}
						var notifications = onlineUsers[i];
						var id  = onlineUsers[i + 1];
						var username = onlineUsers[i + 2];
					$('.users .online').append("<tr> <td> <a href='index.php?receiver_id=" + id + "'>" + username + "(" + notifications + ")" + "</a> </td> </tr>");
					
					}
						
					
   		});
	
	}
	


function fetchMessages(){

			$.ajax({
				type: "POST",
				url: "fetch.php",
				data: {receiver_id: receiver_id},
	            dataType: "html"
				})
				.done(function( msg ) {
					$('.chat .messages').html("");
					
				var messages = msg.split(",");
				for(var i=0;  i<= messages.length; i=i+3) {
						if (i + 1 > messages.length) {
							break;
						}
						var username = messages[i];
						var date  = messages[i + 1];
						var message = messages[i + 2];
						$('.chat .messages').append(username + " " + date + " <br> " + message + "<br><hr>"); 
						
					}
				
				//alert( "Data Saved: " + msg );
		});
	
	}


function sendMessage(){
	 
     $.ajax({
	            
				type: "POST",
				url: "send.php",
				data: { message : $(".chat .entry").val(), receiver_id: receiver_id },
				dataType: "html"
				})
				.done(function( msg ) {	
					//alert(" Data Saved: " + msg );
					$('.chat .entry').val('').empty();
		});
		
	}
	
	
	
	
	$('.chat .entry').keydown(function (e) {
    if (e.keyCode === 13 && !e.shiftKey) {
        sendMessage();
    }else if (e.keyCode === 13 && e.shiftKey){
		//$('.chat .entry').val($('.chat .entry').val() + "\n");
		$('.chat .entry').append("<br>");
		}
});

function sessionStatus(){
	$.ajax({
	            
				type: "POST",
				url: "sessionstatus.php",
				data: {isLoggedin : "1"  },
				dataType: "html"
				})
				.done(function( msg ) {	
					//alert(" Data Saved: " + msg );
					
		});
		
	}
	



$(document).ready(function() {
	setInterval(fetchMessages,1000);
	setInterval(checkForOnlineUsers,1000);
	setInterval(sessionStatus,1000);
});	
	

</script>
