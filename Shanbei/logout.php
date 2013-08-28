<?php

	if(!isset($_SESSION["uid"])) {
		//unset($_SESSION["uid"]);
		die("You're already log out .");
	}
	
	// $home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php';
	// header('Location: '.$home_url);
	
?>
