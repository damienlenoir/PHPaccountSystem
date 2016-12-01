<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
<?php 
include("session.php"); 

///////////////pulling message info////////////////
$subject = $_POST['subject'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];
$date = date("Y-m-d");

/////////checking if destination user exist////////
$reponse = $bdd->query('SELECT pseudo FROM `user` WHERE pseudo="' .$receiver. '" ');
while ($donnees = $reponse->fetch()){$bddpseudo = $donnees['pseudo'] ;}
if (isset($bddpseudo) == false ){$bddpseudo = "incorrect password";}
if ($bddpseudo == $receiver){	$receiver_test = "";}
else{	$receiver_test = "This username doesn't exist";}

//////checking if message and subject are filled///////

if ($subject=="")
{	$subject_test="Subject field is mandatory";} else {$subject_test=""; }

if (strlen($message) < 4 )
			{
				$message_test = "Your message is too short" ;
			}
		else { $message_test = "" ; }

///////////registration into data base/////////////
if ($receiver_test == "" and $subject_test=="" and $message_test=="")
	{
		$req = $bdd->prepare('INSERT INTO messages (id, sender, receiver, subject, message, date) VALUES(:id, :sender, :receiver, :subject, :message, :date)');
		$req->execute(array(
					'id' => null,
					'sender' => $login,
					'receiver' => $receiver,
					'subject' => $subject,
					'message' => $message,
					'date' => $date
                    ));
					header('Location: sentMessages.php');

	} else { 
		include("header.php"); 
		include("nav.php"); 
		include_once("analyticstracking.php") ;
		echo '<div ID="register"><h1>Error</h1><p>Oups, it didn\'t worked. Please check below for errors and try again: <br><a href="newMessage.php">Go back</a><br><br>';
		echo '<p><i> ' .$receiver_test. '</i></p>'; 
		echo '<p><i> ' .$subject_test. '</i></p>'; 
		echo '<p><i> ' .$message_test. '</i></p>'; 
}



/////////////linking recevier pseudo to receiver email///////////////
$reponse = $bdd->query('SELECT email FROM `user` WHERE pseudo="' .$receiver. '" ');
while ($donnees = $reponse->fetch()){$mail = $donnees['email'] ;}


///////////sending an email to the recevier ////////////////

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "You have a new message";
$message_html = "<html><head></head><body><b>Your have a new message</b>, <br><br>You receiver a new message from <strong> ".$login.". </strong> Please connect to your account to read it and reply :)</body></html>";
//==========
 
 
//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "You have a new message";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"******sender name******\"<******adress mail******>".$passage_ligne;
$header.= "Reply-to: \"******sender mail******\" <******adress mail******>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
 
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========
 
 
 
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
//=====Ajout de la pièce jointe.
//$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
//$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
//$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
//$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
//$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
//========== 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
 
//==========

// Redirection du visiteur vers la page 
header('Location: inbox.php');
			
?>