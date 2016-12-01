<?php
 session_start();
////////////////To forbid access to not connected visitors///////////////
if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
	////////////pulling account info///////////////
	include("bdd_connect.php");
	$reponse = $bdd->query('SELECT * FROM user WHERE pseudo="' .$login. '" ');
	while ($donnees = $reponse->fetch())
		{
			$name = $donnees['name'];
			$surname = $donnees['surname'];
			$email = $donnees['email'];
			$address = $donnees['address'];
			$pseudo = $donnees['pseudo'];
			$password = $donnees['password'];
			$verif =$donnees['verif'];
		}
}
else
{
	header('Location: account.php');
}

if ($verif == 0)
			{
				header('Location: not_verified.php');
			}
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My Account - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	</head>
		
	<body>
	

		<div ID="content">
		<div ID="myinbox"><a href="inbox.php">My inbox</a></div>
		<?php echo '<h2>Hello '  .$login.   ' </h2>'; ?>
		<p>Welcome to your personnal space</p>
		<div ID="informations">
		
		<h3>Update your informations</h3>
		<form action="update_post.php" method="post"> 
			Username:<br>
			<input type="text" name="pseudo" size="30" <?php echo 'value="'.$pseudo.'"'; ?> ><br><br>
			Name:<br>
			<input type="text" name="name" size="30" <?php echo 'value="'.$name.'"'; ?>><br><br>
			Surname:<br>
			<input type="text" name="surname" size="30" <?php echo 'value="'.$surname.'"'; ?>><br><br>
			Address:<br>
			<input type="text" name="address" size="30" <?php echo 'value="'.$address.'"'; ?>><br><br>
			E-mail:<br>
			<input type="text" name="email" size="30" <?php echo 'value="'.$email.'"'; ?>> <br><br>  	
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

