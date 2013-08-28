<?php
	//session_start();
	require_once 'header.php';
	$id = $_SESSION['uid'];


	$con = mysql_connect("localhost","stone","123456");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db("db_study",$con);
	mysql_query('set names "utf8"');

	$query = "SELECT * FROM tbl_study WHERE user_id = '$id'";
	$result = mysql_query($query,$con)or die("Can't excute SQL:$query");
	$row = mysql_fetch_array($result);

	if (isset($row['course_level_id'])) {
		# code...
		

		//将学习者目标等信息插入Study Model表中,其中tag有点问题，存数组？
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
background: url("views/img/top.png") no-repeat;
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
		//查找学习的最大的课程等级

		$level = $row['course_level_id'];
		while ($row = mysql_fetch_array($result)) {
			# code...
			$tmpmax = $row['course_level_id'];
			if ($tmpmax >$level) {
				# code...
				$level = $tmpmax;
			}
		}
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


		$content1 = fopen($arr['url'].$arr['filename'], 'r');

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
		
		
	}else{
		echo <<<HTML

		<html lang="en">
<head>
<style type="text/css">
  #scrollUp {
bottom: 20px;
right: 20px;
height: 38px;
width: 38px;
background: url("../views/img/top.png") no-repeat;
}
</style>
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
      			<legend>Hello, C !</legend>
      			<p>&nbsp;&nbsp;&nbsp;C语言是一种计算机程序设计语言，
      				它既具有高级语言的特点，又具有汇编语言的特点。
      			</p>
      			<p>
      				&nbsp;&nbsp;&nbsp;它由美国贝尔研究所的D.M.Ritchie于1972年推出，1978年后，
      				C语言已先后被移植到大、中、小及微型机上，
      				它可以作为工作系统设计语言，编写系统应用程序，
      				也可以作为应用程序设计语言，编写不依赖计算机硬件的应用程序。
      			</p>
      			<p>
      				&nbsp;&nbsp;&nbsp;它的应用范围广泛，具备很强的数据处理能力，不仅仅是在软件开发上，
      				而且各类科研都需要用到C语言，适于编写系统软件，
      				三维，二维图形和动画，具体应用比如单片机以及嵌入式系统开发。
      			</p>

    		</div>
    		<div class="span1"></div>
    	<div class="span6" bgcolor="#46a546">
      		<!--Body content-->


			<div>
<p>在开始正式学习前，请完成下列问题。</p>
</div>
			<div style='background-color:#EEF3F7'>
				<!--该表单用于确定学习者的预先知识、学习目标等，存入Study Model中-->
			<form action='course/learnc.php' method='post' class='form-horizontal'>
		
		<div class='control-group'>
			 <label class='control-label' for='id_username'>您之前有了解过C语言吗？</label>
			 <div class='controls'>
			 <select name='bac_1'>
			 	<option value='0'><--请选择--></option>
	  			<option value='3'>有，但没用过</option>
	  			<option value='2'>有，且有C编程经验</option>
	  		 	<option value='1'>没有，但有其他编程经验</option>
	   		 	<option value='0'>没有</option>
	    		
  			</select>
  		</div>
		</div>
		<div class='control-group'>
			
			 <label class='control-label' for='id_username'>您的学习目标是？</label>
			 <div class='controls'>
			 <select name='goal'>
	  			<option value='2'><--请选择--></option>
	  			<option value='1'>我只想基本的了解下C语言</option>
	  		 	<option value='2'>我想会一些基本的C语言编程</option>
	   		 	<option value='3'>我想达到计算机二级的水平</option>
	    		<option value='4'>我想熟练的使用C语言</option>
	    		<option value='5'>I want be a C pro.</option>
	    		<option value='4'>Others</option>
  			</select>
  		</div>
		</div>
		<div class='control-group'>
		<label class='control-label' for='id_tag'>您具有：</label>
		<div class='controls'>
		<label class='checkbox'>
			<input type='checkbox' value='4' name='bac_2[]'>
			C++/Objective-C编程知识
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='3' name='bac_2[]'>
			VB编程经验
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='1' name='bac_2[]'>
			线性代数/高等数学等知识
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='2' name='bac_2[]'>
			Java/PHP等其他编程知识
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='0' name='bac_2[]'>
			大学英语4级水平
		</label>

		</div>
		</div>
				<div class='control-group'>
		<label class='control-label' for='id_tag'>您了解过：</label>
		<div class='controls'>
		<label class='checkbox'>
			<input type='checkbox' value='tag_if' name='bac_3[]'>
			分支结构
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='tag_point' name='bac_3[]'>
			指针
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='tag_num' name='bac_3[]'>
			数组
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='tag_while' name='bac_3[]'>
			循环结构
		</label>
		<label class='checkbox'>
			<input type='checkbox' value='tag_mod' name='bac_3[]'>
			模块化程序结构
		</label>

		</div>
		</div>
<div class='control-group'>
			
			 <label class='control-label' for='id_username'>您一周愿意花多少时间来学习？</label>
			 <div class='controls'>
			 <select name="time_spend">
	  			<option value='3'><--请选择--></option>
	  			<option value='3'>不多于3小时</option>
	  		 	<option value='6'>3小时~6小时</option>
	   		 	<option value='8'>6小时~8小时</option>
	    		<option value='12'>大于8小时</option>
	    		<option value='5'>It depends.</option>
  			</select>
  		</div>
		</div>
		<div class='control-group'>
			
			<div class='controls'>
				<button type='submit' class='btn btn-success'>Save&Continue</button>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="course/learnc.php" data-toggle="tooltip" title="强烈不建议您跳过！填写上面信息可以帮助系统更加了解您的知识背景。" id="quiz_hints">Skip & Continue</a>
			</div>
			
		</div>


		
	</form></div>
		

		


    	</div>
  		</div>
	</div>
	
</body>
</html>



HTML;
	}

?>