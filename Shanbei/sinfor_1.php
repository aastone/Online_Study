<?php
	session_start();
	$dbc = mysqli_connect('localhost','stone','123456','ls_login') or die('ERROR connecting to MySQL.');
	
	$edu = $_POST['edu'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$interest = $_POST['interest'];
	$email = $_SESSION["uemail"];
	//echo $email;
	
	$query = "INSERT INTO infor_basis(edu,gender,age,interest,email)".
			"VALUES('$edu','$gender','$age','$interest','$email')";
	header('Content-Type: application/json; charset=utf-8');
	
			//$username = $row['username'];
			$err_code = "0";
			$data = "main/homepage.php";
			//$_SESSION["uid"] = $username;	 
	
			$json_result = json_encode(array("err_code" => $err_code, "data" => $data));
			die($json_result);
	//mysqli_query($dbc,$query) or die('wrong 1.');
	//echo 'Successed !';
	mysqli_close($dbc);
	
	
?>

