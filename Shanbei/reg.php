<?php

	session_start();//启动会话
// // //获取用户的登录信息。用户名、密码，是否保存信息
 // $_SESSION['email'] = 'stone';
 // echo ('You are logged in as '.$_SESSION['email']);
// $username = $HTTP_POST_VARS['username'];
// $password1 = $HTTP_POST_VARS['password1'];
	
	//if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$dbc = mysqli_connect('localhost','stone','123456','ls_login') or die('ERROR connecting to MySQL.');
		
		//$first_name = $_POST['firstname'];
		//$last_name = $_POST['lastname'];
		$username = $_POST['username'];
		$email 	= 	$_POST['email'];
		$password1 = $_POST['password1'];
		$flag = true;
		//$password2 = $_POST['password2'];
		
		$query = "INSERT INTO account_register(username,email,password1)".
				"VALUES('$username','$email','$password1')";
		// $query1 = "INSERT INTO infor_basis(email)".
				// "VALUES('$email')";

		//创建会话，保存登录信息
		// session_unset(); //删除会话
		// session_destroy();
		// session_register('password1');//创建会话变量，保存密码
		// $HTTP_POST_VARS['password1']=$password11;
		// session_register('email');//保存用户名
		// $HTTP_POST_VARS['email']=$email1;

		header('Content-Type: application/json; charset=utf-8');
		
		mysqli_query($dbc,$query) or $flag = false;
		mysqli_close($dbc);
	 
	 	if($flag) {
	 		$err_code = "0";
			$data = "infor_1.php";
			$_SESSION["uid"] = $username;
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