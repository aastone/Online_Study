<?php
	//session_start();
	include 'header.php';
	error_reporting(E_ALL^E_NOTICE);//禁止报错
	$con = mysql_connect("localhost", "stone", "123456");//连接数据库
	if (!$con){ 
 		die('Could not connect: ' . mysql_error());//连接失败，提示报错！
	}
	//
	$gPageSize=1; //定义每页显示的记录数
	$db_selected = mysql_select_db("db_study",$con);//选择数据库
	mysql_query('set names "utf8"');

	//$dbc = mysql_connect('localhost','stone','123456','db_study') or die('ERROR connecting to MySQL.');
	//mysql_query('set names "utf8"');

	$email = $_SESSION["uemail"];
	//echo $email;



	$query1 = "SELECT id FROM tbl_user WHERE email = '$email' ";
	$data1 = mysql_query($query1,$con)or die("Can't excute SQL：$query1");
	$row1 = mysql_fetch_array($data1);
	$user_id = $row1['id'];

	//echo $row1['id'];

	$query2 = "SELECT course_level_id FROM tbl_study WHERE user_id = '$user_id'";
	$data2 = mysql_query($query2,$con)or die("Can't excute SQL：$query2");
	$row2 = mysql_fetch_array($data2);
	$course_level_id = $row2['course_level_id'];//找到学习者所学习的课程id

	$query3 = "SELECT title,answer1,answer2,answer3,answer4,id,answer,score from tbl_question ".
			  "WHERE course_level_id = '$course_level_id'";
	$data3 = mysql_query($query3,$con)or die("Can't excute SQL：$query3");
	$row3 = mysql_fetch_array($data3);

	$query4 = "SELECT id from tbl_question ".
			  "WHERE course_level_id = '$course_level_id'";

	$query = "SELECT quizGrade FROM tbl_result WHERE course_level_id = '$course_level_id' AND user_id = '$user_id' ";
	$data = mysql_query($query,$con)or die("Can't excute SQL: $query");
	$row = mysql_fetch_array($data);
	$quizGrade = $row['quizGrade'];

	if ($quizGrade < 12) {
		# code...
		//如果不符合要求，则不能跳转至下一阶段的学习
		echo <<<HTML
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title>Learning System</title>
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript">
	$(function(){
		$('.dropdown-toggle').dropdown();
		$("#navbarExmaple.nav li").on("active",function(){
			window.console && console.log($(this).find("b").attr("href"))
		});
	});
 </script>
</head>

<body>
	
<div class="container-fluid">
	<div class="span2">
		<!--Slide Bar-->
	</div>
	<div class="span10">
		<div class="hero-unit">
			<h2>Sorry,</h2>
			<h4>You can't go to the next level before you accomplished.</h4>
			<p>
			You can 
			<a class="btn btn-primary btn-large" href="/1-project-shanbei/model/course/quiz.php">
			Take a quiz
			</a>
			or
			<a class="btn btn-primary btn-large" href="/1-project-shanbei/model/learnc.php">
			Learn more
			</a>
			</p>
		</div>
	</div>

</div>
HTML;


	}else{
		echo <<<LEARNC


		<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title>Bootstrap</title>
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
 <style type="text/css">
  #scrollUp {
bottom: 20px;
right: 20px;
height: 38px;
width: 38px;
background: url("../views/img/top.png") no-repeat;
}
</style>
</head>

<body>
	<script>
	$(function(){
		$('.dropdown-toggle').dropdown()
		$("#navbarExmaple.nav li").on("active",function(){
			window.console && console.log($(this).find("b").attr("href"))
		})
	});
	$(document).ready(function(){
		$('#quiz_hints').tooltip({
			placement: 'right',
			triger: 'hover'
		});
	/*	$("#quiz_hints").on({
			mouseenter: function(){
				$('#quiz_hints').tooltip('show');
			},
			mouseleave: function(){
				$('#quiz_hints').tooltip('hide');
			}
			});*/
	});
	</script>
	
	<div class="container-fluid">
 		<div class="row-fluid">
    		<div class="span2">
      			<!--Sidebar content-->
      			<!-- <a href="#" data-toggle="tooltip" title="first tooltip" id="quiz_hints">hover over me</a> -->
      			<form action="/1-project-shanbei/model/course/quiz.php" method="post">
      				<fieldset>
      					<legend>Enjoy your time !</legend>
      					<label>If you wanna take a quiz . Click here!</label>
      				</fieldset>
      				<button class="btn btn-success" type="submit">Quiz time !</button>
      			</form>
      			<form action="/1-project-shanbei/model/course/nextlevel.php" method="post">
      				<fieldset>
      					<label>If you wanna enter next level now. Click here!</label>
      				</fieldset>
      				<button class="btn btn-danger" type="submit">Next level study.</button>
      			</form>

      			

    		</div>
    		<div class="span1"></div>
    	<div class="span8" bgcolor="#46a546">
      		<!--Body content-->
		
		

		
    	
LEARNC;

$level = $course_level_id+1;
		if (!$level) {
			# code...
			echo "<div>";
			echo "<h3>Hello, C !</h3>";
			echo "</div>";
		}else{

		echo "<h2>Level&nbsp".$level."</h2>";
		$query="select * from tbl_course where name='c'&&level=$level ";
		$rresult=mysql_query($query,$con)or die("无法执行SQL：$query");
		
		//将数据库中取得的数据存入arr数组
		$arr = mysql_fetch_array($rresult);

		echo "<h5>Tags:&nbsp;<i class='icon-tag'></i>$arr[tag1]&nbsp;&nbsp;<i class='icon-tag'></i>$arr[tag2]&nbsp;&nbsp;<i class='icon-tag'></i>$arr[tag3]</h5>";
		//echo $arr[url].$arr[filename];

		echo "<div class='span8'>";


		$content1 = fopen("../".$arr['url'].$arr['filename'], 'r');

		while (!feof($content1)) {
				# code...
				echo fgets($content1)."<br/>";
			}
		}

		echo "</div>";

		$query1 = "SELECT id from tbl_course where name = 'c' && level = '$level'";
		$rresult1 = mysql_query($query1,$con)or die("can't excute SQL: $query1");
		$arr1 = mysql_fetch_array($rresult1);
		$course_level_id = $arr1['id'];

		$user_id = $_SESSION['uid'];

		// $query2 = "INSERT INTO tbl_study(course_level_id,user_id,goal,spend_time,tag1,tag2,tag3) " . 
		// 		  "VALUES('$course_level_id','$user_id','$goal','$spend_time','$bac_1','$tag2','$tag3')";
		// $rresult2 = mysql_query($query2,$con)or die("can't excute SQL: $query2");

		echo <<<LEARNC2

		</div>
  		</div>
	</div>
	<a id="scrollUp" href="#top" title style="position: fixed; z-index: 2147483647; display: block;"></a>
</body>
</html>

LEARNC2;
}

?>
</div>
</div>
</div>  
</body>
</html>