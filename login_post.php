 <link href="style.css" rel="stylesheet" type="text/css" media="all" />	
<?php 
session_start();
include("bdd_connect.php"); 
$pseudo = htmlspecialchars($_POST['pseudo']); 
$password = htmlspecialchars($_POST['password']); 

///////////pulling the data//////////////////
$reponse = $bdd->query('SELECT pseudo FROM `user` WHERE pseudo="' .$pseudo. '" ');
while ($donnees = $reponse->fetch()){$bddpseudo = $donnees['pseudo'] ;}
$reponse = $bdd->query('SELECT password FROM `user` WHERE pseudo="' .$pseudo. '" ');
while ($donnees = $reponse->fetch()){$bddpassword = $donnees['password'] ;}

/////////////testing data////////////////////
if (isset($bddpassword) == false ) {$bddpassword = "incorrect password";}
if (isset($bddpseudo) == false ){$bddpseudo = "incorrect password";}
if ($bddpassword == $password) {$passwordcheck = "";}
else{$passwordcheck = "Password doesn't match";}
if ($bddpseudo == $pseudo){	$pseudocheck = "";}
else{	$pseudocheck = "This username doesn't exist";}

////////////displaying results////////////////
if ($passwordcheck == "" and $pseudocheck == "")	{ $_SESSION['password'] = htmlspecialchars($_POST['password']); $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']); header('Location: myAccount.php');}
else if ($pseudocheck == "This username doesn't exist"){  include("header.php"); include("nav.php"); include_once("analyticstracking.php"); echo '<div ID="register"><h1>Log in</h1><p>Oups, it didn\'t worked. Please check below for errors and try again: <a href="account.php">Log in</a><br><br>error: '  .$pseudocheck. '  ' ; }
else{	echo 'error: ' .$passwordcheck. ' ' .$pseudocheck. '  ' ; }	
?>
