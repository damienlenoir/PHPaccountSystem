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

		<div ID="content">
			<h1>My Inbox</h1><br>
			<p><a href="newMessage.php">Send a new message</a>  -  <a href="sentMessages.php">Sent Messages</a> </p><br>
			 <table ID="inbox">
			 <p class="pages">
			<tr>
				<th style="width:15%;">Date</th>
				<th style="width:15%;">Sender</th>
				<th style="width:60%;">Subject</th>
				<th style="width:10%;"> </th>
			</tr>
 
    
 
<?php

$reponse = $bdd->query('SELECT id FROM user WHERE pseudo="' .$login. '" ');
				while ($donnees = $reponse->fetch())
					{
						$iduser = $donnees['id'];
					}



 

// On met dans une variable le nombre de messages qu'on veut par page
$nombreDeMessagesParPage = 10; // Essayez de changer ce nombre pour voir :o)
// On récupère le nombre total de messages
$reponse = $bdd->query('SELECT COUNT(*) AS nb_messages FROM messages WHERE receiver="' .$login. '"');
$donnees = $donnees =  $reponse->fetch();
$totalDesMessages = $donnees['nb_messages'];
// On calcule le nombre de pages à créer
$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
// Puis on fait une boucle pour écrire les liens vers chacune des pages
echo 'Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    echo '<a href="inbox.php?page=' . $i . '">' . $i . '  </a> ';
}
$reponse->closeCursor();
?>
 
</p>
 
<?php
 
 
// display per page

if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
}
else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
        $page = 1; // On se met sur la page 1 (par défaut)
}
 
// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 
$reponse = $bdd->query('SELECT * FROM messages  WHERE receiver="' .$login. '" ORDER BY date DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
while ($donnees =  $reponse->fetch())
{
        echo '<tr><td>';
		echo $donnees['date'];
		echo '</td><td>' ;
		echo $donnees['sender'];
		echo'</td><td>' ;
		echo $donnees['subject'];
		echo'</td><td>' ;
		echo '<a href="message.php?page=' .$donnees['id']. '">View</a>';
		echo'</td><td>' ;
						
}
 
$reponse->closeCursor();
?>
 
</body>
</html>
