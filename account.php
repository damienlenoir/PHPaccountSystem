<?php
session_start();
include("bdd_connect.php");

if (isset($_SESSION['pseudo']))
{
$login = $_SESSION['pseudo'];

$reponse = $bdd->query('SELECT * FROM user WHERE pseudo="' .$login. '" ');
while ($donnees = $reponse->fetch())
	{
			$verif = $donnees['verif'];
	}
}
////////////////To forbid access to connected visitors///////////////

if (isset($verif))
	{
		if ( $verif == 0 )
			{
				header('Location: not_verified.php');
			}
	}
	else { $verif=0; }
	
	
if (isset($_SESSION['pseudo']) and $verif == 1)
{

header('Location: myAccount.php');
	
}




?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My account - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
		
	<body>


<div ID="content">
	<h1>Account</h1>
		<h3>Do you have already an account?</h3>
			<div ID="register">
				<h1>Sign in</h1>
				<form action="login_post.php" method="post"> 
				Username:<br>
				<input type="text" name="pseudo" size="30"><br><br>
				Password:<br>
				<input type="password" name="password" size="30"><br><br><br></br>
				<input type="submit" value="OK"><br>
				<i><a href="pw_recovery.php">I forgot my password</a></i>
				</form>
			</div>
		<h3>Register a new account</h3>
			<div ID="register">
				<form action="inscription_validation.php" method="post"> 
				Username:<br>
				<input type="text" name="pseudo" size="30"><br><br>
				E-mail:<br>
				<input type="text" name="email" size="30"><br><br>  	
				Password:<br>
				<input type="password" name="password" size="30"><br><br>
				Confirm Password:<br>
				<input type="password" name="password2" size="30"><br>
					<br></br>
				<input type="submit" value="Confirm">
				</form>
			</div>

		
</div>
			
			
	</body>
</html>

