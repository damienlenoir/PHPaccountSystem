<?php
 session_start();
 include("bdd_connect.php"); 
////////////////To forbid access to not connected visitors///////////////
if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
}
else
{
	header('Location: account.php');
}

$reponse = $bdd->query('SELECT * FROM user WHERE pseudo="' .$login. '" ');
	while ($donnees = $reponse->fetch())
		{
			$verif =$donnees['verif'];
			if ($verif == 0)
			{
				header('Location: not_verified.php');
			}
		}



?>