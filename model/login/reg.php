<?php

	session_start();//启动会话
// // //获取用户的登录信息。用户名、密码，是否保存信息
 // $_SESSION['email'] = 'stone';
 // echo ('You are logged in as '.$_SESSION['email']);
// $username = $HTTP_POST_VARS['username'];
// $password1 = $HTTP_POST_VARS['password1'];
	
	//if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$dbc = mysqli_connect('localhost','stone','123456','db_study') or die('ERROR connecting to MySQL.');
		mysql_query('set names "utf8"');
		
		//$first_name = $_POST['firstname'];
		//$last_name = $_POST['lastname'];
		$name = $_POST['username'];
		$email 	= 	$_POST['email'];
		$password = $_POST['password1'];
		$flag = true;
		//$password2 = $_POST['password2'];
		$reg_date = date("y-m-d");
		
		$query = "INSERT INTO tbl_user(name,email,password)".
				"VALUES('$name','$email','$password')";

		$dquery = "INSERT INTO tbl_date(email,reg_date) VALUES('$email','$reg_date')";
		$ddata = mysqli_query($dbc,$dquery);

		header('Content-Type: application/json; charset=utf-8');
		
		mysqli_query($dbc,$query) or $flag = false;

		$query1 = "SELECT id FROM tbl_user WHERE email = '$email'";
		$result = mysqli_query($dbc,$query1);
		$row = mysqli_fetch_array($result);
		$id = $row['id'];

		mysqli_close($dbc);
	 
	 	if($flag) {
	 		$err_code = "0";
			$data = "../homepage.php";
			$_SESSION["uid"] = $id;
			$_SESSION["uname"] = $name;
			$_SESSION["uemail"] = $email;
			// $query = "INSERT INTO infor_basis(email)".
						// "VALUES('$email')";
	 	} else {
	 		$err_code = "1";
			$data = "Email has already exist!";
	 	}
	// 	header('location:info_1.html');
		$json_result = json_encode(array("err_code" => $err_code, "data" => $data));
		die($json_result);
	//}
	
?>