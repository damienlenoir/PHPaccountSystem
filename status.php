<?php

if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
	if ($pw != "" and $login != "")
		{
			echo 'Hello ' .$login. ' - <a href="connect_out">Log Out</a>';
		}
	else
		{
			echo '<a  ID="status" href="account.php">Log in or create an account</a>';
		}
}
else
{
	echo '<a href="account.php">Log in</a>';
}

?>