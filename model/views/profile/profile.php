<?php
	session_start();//启动会话
	error_reporting(E_ALL^E_NOTICE);//禁止报错
	//require('header.php');

	$con = mysql_connect("localhost","stone","123456");
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
	$db_selected = mysql_select_db("db_study",$con);
	
	mysql_query('set names "utf8"');
	
	
	$edu = $_POST['edu'];
	$major = $_POST['major'];
	$gender = $_POST['gender'];
	$interest = $_POST['interest'];
	$introduction = $_POST['introduction'];
	$name = $_SESSION["uid"];
	$email = $_SESSION["uemail"];

	//$flag = true;
	//echo $introduction;

	$query = "UPDATE tbl_user ".
			"SET degree = '$edu',major = '$major',gender = '$gender',intrest = '$interest',introduction = '$introduction'".
			"WHERE email='$email'";
	$rresult=mysql_query($query,$con)or die("Can't excute SQL:$query");
	//echo $rresult;
	header('Content-Type: application/json; charset=utf-8');
		
		mysql_close($con);

	//$qtest = "SELECT * FROM tbl_user";
	//$result = mysql_query($query,$con);
//	echo $query;

	

		if($rresult) {
	 		$err_code = "0";
			$data = "../profile.php";
			$_SESSION["uid"] = $name;
			$_SESSION["uemail"] = $email;

	 	} else {
	 		$err_code = "1";
			$data = "Email has already exist!";
	 	}
		$json_result = json_encode(array("err_code" => $err_code, "data" => $data));
		die($json_result);
	




?>
