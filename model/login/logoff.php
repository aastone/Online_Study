<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script></html>



<?php
	//注销界面
	//print_r(getdate());
	session_start();
	$_SESSION = array();
	session_destroy();

	$login_date = getdate();
	echo "您已成功下线！";
	echo "<br/>";
	print("$login_date[weekday], $login_date[month], $login_date[mday], $login_date[year]");
	//echo $login_date['mday'];
	echo "<br/><br/>";
	echo "<a href='login.html'>重新登录</a>";
	$login_date = date("y-m-d");
	//echo $login_date;

	$zero1 = strtotime(date("y-m-d"));
	$zero2 = strtotime("2013-6-1");

	//echo "zero1 ".$zero1."<br/>";

	if (strtotime($zero1)<strtotime($zero2)) {
		# code...
		//echo "E";
	}else{
		//echo "L";
	}

	$tmp = ceil(($zero1-$zero2)/86400);
	//echo $tmp;

	echo"<br>";
	$total1 = 276+ 255*2 +149+338+49+82+58+148+56+177+79+162;
	$total2 = 276+404+197+78+47;
	//echo $total1;
	echo"<br>";
	//echo $total2;
	echo"<br>";

	//echo $total2+$total1;
?>