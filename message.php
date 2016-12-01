<?php
//Thanks to openclassroom
include("session.php"); 

?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My Inbox - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	</head>
		
	<body>
	<?php include("header.php"); ?>
	<?php include("nav.php"); ?>
	<?php include_once("analyticstracking.php") ?>

		<div ID="content">
			<h1>My Inbox</h1><br>
			<p><a href="newMessage.php">Send a new message</a>  -  <a href="sentMessages.php">Sent Messages</a> <br><a href="inbox.php">Back to Inbox</a><br><br></p>
			 <table ID="inbox">
			 
<?php
// display per page

if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
}
else // La variable n'existe pas
{
        header('Location: inbox.php');
}
 
 
$reponse = $bdd->query('SELECT * FROM messages  WHERE id="' .$page. '" ');
while ($donnees =  $reponse->fetch())
{
         
		echo "The  ".$donnees['date']."  from  ".$donnees['sender']." 	To: ".$donnees['receiver']." <br><br>";					
		echo "Subject:  " .$donnees['subject']. "<br> ";
		echo "message:  " .$donnees['message']. "  ";
						
}
 
$reponse->closeCursor();
?>
 
</body>
</html>
