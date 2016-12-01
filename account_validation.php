<?php

	include("bdd_connect.php");

	
	if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
}
else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
        //header('Location: account.php');
}
	

	
//////decrypt email/////
/* **********************************
*************************************
*****Hidden for security*************
*************************************
******************** */
{
	
/////ici code pour passer l'attribut vérif de 0 à 1//////////

$bdd->exec('UPDATE user SET verif = 1 WHERE user .email = "' . $decrypted . ' "');
echo 'la';
}
else
{
////ici redirect page pour renvoyer l'email/////
header('Location: not_verified.php');

}

///code pour rediriger dans my account/////
header('Location: account.php');

?>