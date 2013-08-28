
<?php
	//session_start();
	include 'header.php';
	error_reporting(E_ALL^E_NOTICE);
	error_reporting(E_ERROR);
	ini_set("display_errors","Off"); 
?>
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
      			<form action="quiz.php" method="post">
      				<fieldset>
      					<legend>Enjoy your time !</legend>
      					<label>If you wanna take a quiz . Click here!</label>
      				</fieldset>
      				<button class="btn btn-success" type="submit">Quiz time !</button>
      			</form>
      			<form action="nextlevel.php" method="post">
      				<fieldset>
      					<label>If you wanna enter next level now. Click here!</label>
      				</fieldset>
      				<button class="btn btn-danger" type="submit">Next level study.</button>
      			</form>

      			

    		</div>
    		<div class="span1"></div>
    	<div class="span8" bgcolor="#46a546">
      		<!--Body content-->
      		<?php
      		error_reporting(E_ALL^E_NOTICE);
		$con = mysql_connect("localhost","stone","123456");
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		$db_selected = mysql_select_db("db_study",$con);
		mysql_query('set names "utf8"');
		if(isset($_POST['bac_1'])){
			$bac_1 = $_POST['bac_1'];
		}else{
			$bac_1 = 0;
		}
		if(isset($_POST['bac_2'])){
			$bac_2 = $_POST['bac_2'];
		}else{
			$bac_2 = 0;
		}
		if(isset($_POST['bac_3'])){
			$bac_3 = $_POST['bac_3'];
		}else{
			$bac_3 = 0;
		}

		if (isset($_POST['goal'])) {
			# code...
			$goal = $_POST['goal'];
		}else {
			$goal = 1;
		}

		if (isset($_POST['time_spend'])) {
			# code...
			$spend_time = $_POST['time_spend'];
		}else{
			$spend_time = 1;
		}

		//学习者填完课程表单后，将由下列规则来确定最初学习的课程

		if ($bac_1 != 0) {
			
			if ($bac_2 > 1) {
				# code...
				if (in_array(tag_if, bac_3)) {
					$tag2 = 2; 
					$tag3 = tag_if;					
					$level = 3;
				}else if (in_array(tag_while, bac_3)) {
					$tag2 = 2;
					$tag3 = tag_while;
					$level = 3;
				}else if (in_array(tag_point, bac_3)){
					$tag2 = 2;
					$level = 3;
					$tag3 = tag_point;

				} else{
					$level = 2;
					$tag2 = 2;
					$tag3 = tag_else;
				}
			}else{
				$tag2 = 1;
				$level = 1;
			}
		}else{
			$tag1 = 0;
			$level = 1;
		}
		//echo $bac_1;
		//$level = $bac_1;//在这里确定规则
		//$level = $_POST['level'];
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
		//echo $arr['url'].$arr['filename'];

		echo "<div class='span8'>";


		$content1 = fopen("../".$arr['url'].$arr['filename'], r);

		while (!feof($content1)) {
				# code...
				echo fgets($content1)."<br/>";
			}
		}

		echo "</div>";

		//将学习者目标等信息插入Study Model表中,其中tag有点问题，存数组？

		$query1 = "SELECT id from tbl_course where name = 'c' && level = '$level'";
		$rresult1 = mysql_query($query1,$con)or die("can't excute SQL: $query1");
		$arr1 = mysql_fetch_array($rresult1);
		$course_level_id = $arr1['id'];

		$user_id = $_SESSION['uid'];

		$query2 = "INSERT INTO tbl_study(course_level_id,user_id,goal,spend_time,tag1,tag2,tag3) " . 
				  "VALUES('$course_level_id','$user_id','$goal','$spend_time','$bac_1','$tag2','$tag3')";
		$rresult2 = mysql_query($query2,$con)or die("can't excute SQL: $query2");
		

		?>
    	</div>
  		</div>
	</div>
	<a id="scrollUp" href="#top" title style="position: fixed; z-index: 2147483647; display: block;"></a>
</body>
</html>