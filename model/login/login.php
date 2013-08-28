<?php
	session_start();
	// If the user isn't logged in, try to log them in
	// if(!isset($_SESSION['user_id']))
	// {
		$dbc = mysqli_connect('localhost','stone','123456','db_study') or die('ERROR connecting to MySQL.');
	
		// $username = $_POST['username'];
		$email 	= 	$_POST['email'];
		$password = $_POST['password1'];

		//$login_date = strtotime(date("y-m-d"));
		$login_date = date("Y-m-d");
	
		$query = "SELECT * FROM tbl_user WHERE email='$email' AND "."password='$password'";
		$data = mysqli_query($dbc,$query);
		$row = mysqli_fetch_array($data);
		
		header('Content-Type: application/json; charset=utf-8');
		// while ($row = mysqli_fetch_array($data)) 
		// {
			if($row['password']==$password)
			{
				$name = $row['name'];
				$id = $row['id'];			

				//echo $dquery;
				$dquery = "INSERT INTO tbl_date(user_id,email,login_date) VALUES('$id','$email','$login_date')";
				$ddata = mysqli_query($dbc,$dquery);

				$err_code = "0";
				$data = "../homepage.php";
				$_SESSION["uid"] = $id;
				$_SESSION["uname"] = $name;
				$_SESSION["uemail"]	= $email; 
				// echo "Right!";
				// echo $_SESSION["uid"] . "&nbsp;&nbsp;";
				//echo ('<p class="login">You are logged in as '.$username.'</p>');
				// $_SESSION['user_id'] = $row['user_id'];
				// $_SESSION['email'] = $row['email'];
				// $home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php';
				// header('Location: '.$home_url);
			}
			else {
				$err_code = "1";
				$data = "Wrong Email/Password!";
			}
			$json_result = json_encode(array("err_code" => $err_code, "data" => $data));
			die($json_result);

			mysqli_close($dbc);
	
	
	
	//$result = mysql_query($query);
	//$row = mysql_fetch_array($result);
	
	// if($result)
	// {
		// echo "1";
		// if($result["password1"]==$password1)
		// {
			// echo $password1;
			// echo "Success";
		// }
	// }
	// else
		// {
			// echo "Wrong password.";
		// }
	
//	$query = "INSERT INTO account_register(username,email,password1)".
//			"VALUES('$username','$email','$password1')";
	//mysqli_query($dbc,$query) or die('Email already exists.');
	//echo 'Reg Successed !';
	

	
?>