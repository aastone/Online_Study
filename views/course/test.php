<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Read from a file</title>
<link rel="stylesheet" type="text/css" href="../../stylesheet/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="../../script/jquery-1.9.1.min.js"></script>
</head>
<body>
	<?php
		$con = mysql_connect("localhost","root","123456");
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		$db_selected = mysql_select_db("onlinestudy",$con);
		mysql_query('set names "utf8"');
		$query="select url,filename from tbl_course where name='c'&&level='2' ";
		$rresult=mysql_query($query,$con)or die("无法执行SQL：$query");
		
		//将数据库中取得的数据存入arr数组
		$arr = mysql_fetch_array($rresult);
		//echo $arr['url'].$arr['filename'];


		$content1 = fopen($arr['url'].$arr['filename'], r);

		while (!feof($content1)) {
				# code...
				echo fgets($content1)."<br/>";
			}
		

		?>
</body>