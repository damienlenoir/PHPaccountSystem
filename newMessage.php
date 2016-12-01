 <?php
include("session.php"); 
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - Send a new message - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	</head>
		
	<body>


		<div ID="content">
			<h1>My Inbox</h1><h3>Send a new message</h3>
			<p><a href="inbox.php">Back to inbox</a>  -  <a href="message_post.php">Sent Messages</a> </p><br><br>
			<div ID="send">
			<form action="message_post.php" method="post"> 
				<p>Subject:</p><br>
				<input type="text" name="subject" size="100"><br><br>
				<p>To: (username)</p><br>
				<input type="text" name="receiver" size="100"><br><br>
				<p>Message:</p><br>
				<textarea name="message" rows="6" cols="100"> </textarea><br><br>  	
				<br></br>
				<input type="submit" value="Send !">
			</form>
						
			</div>

		</div>
	</body>
</html>

