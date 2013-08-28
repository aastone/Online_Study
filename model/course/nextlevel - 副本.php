<?php
	session_start();
	//include 'header.php';
	//error_reporting(E_ALL^E_NOTICE);//禁止报错
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

	if ($quizGrade < 80) {
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
	<div class="navbar container navbar-inverse">
		<div class="navbar-inner">
			<ul class="nav navbar-inverse">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
      			</a>
				<li class="active">
					<a href="homepage.php">Homepage</a>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						Courses
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li class=""><a tabindex="-1" href="learnphp.php">PHP</a></li>
						<li><a tabindex="-1" href="learnc.php">C</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="learnen.php">English</a></li>

					</ul>
				</li>
				<li class="active">
					<a href="profile.php">My Profile</a>
				</li>
				<li class="active">
					<a href="test.php">Tests</a>
				</li>
				<li class="active">
					<a href="result.php">Results</a>
				</li>
			</ul>
		</div>
	</div>
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
			<a class="btn btn-primary btn-large">
			Take a quiz
			</a>
			or
			<a class="btn btn-primary btn-large">
			Learn more
			</a>
			</p>
		</div>
	</div>

</div>
HTML;


	}else{


	//$page变量标示当前显示的页
	if(!isset( $_REQUEST['pagex'])) {
		$page=1;
		$query5 = "INSERT INTO tbl_result (user_id,course_level_id) VALUES($user_id,$course_level_id)";
		$data5 = mysql_query($query5,$con)or die("Can't excute SQL: $query5");
	} else {
		$page = $_REQUEST['pagex'];
	}
	if($page==0) {
		$page=1;
		$query5 = "INSERT INTO tbl_result (user_id,course_level_id) VALUES($user_id,$course_level_id)";
		$data5 = mysql_query($query5,$con)or die("Can't excute SQL: $query5");
		} 
	//得到当前查询到的纪录数   $nNumRows  
	if(($nNumRows=mysql_num_rows($data3))<=0)
	{
	//echo "<p align=center>error1</p>";
	//exit;
	}
	//得到最大页码数MaxPage  
	$MaxPage=(int)ceil($nNumRows/$gPageSize);

	if($page > 1) {
		if (!isset($score)) {
			$score = 0;
			echo $score;
		}
		if($page == $MaxPage+1) {
			//检查答案+跳转,最后一题
			$uanswer = $_POST['uanswer'];
			if ($uanswer == $_POST['ranswer']) {
				# code...
				//echo $row3['answer'];
				$tmpright_q_id = $_POST['rid'];
				$rrquery3 = "SELECT right_q_id FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rrdata3 = mysql_query($rrquery3,$con)or die("Can't excute SQL: $rrquery3");
				$rrrow3 = mysql_fetch_array($rrdata3);

				$right_q_id = $tmpright_q_id.",".$rrrow3['right_q_id'];
				$rrquery2 = "UPDATE tbl_result SET right_q_id = '$right_q_id' WHERE user_id=$user_id ";
				$rrdata2 = mysql_query($rrquery2,$con)or die("Can't excute SQL: $rquery2");
			

				$tmpscore = $_POST['rscore'];
				$rquery0 = "SELECT testGrade FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rdata0 = mysql_query($rquery0,$con)or die("Can't excute SQL: $rquery0");
				$rrow0 = mysql_fetch_array($rdata0);
				$testGrade = $rrow0['testGrade'];
				$score = $testGrade + $tmpscore;
				$rquery1 = "UPDATE tbl_result SET testGrade = $score WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rdata1 = mysql_query($rquery1,$con)or die("Can't excute SQL: $rquery1");
				echo $score;
		}else{
			echo "Wrong answer.";
			$tmpwrong_q_id = $_POST['rid'];
			$rquery3 = "SELECT wrong_q_id FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
			$rdata3 = mysql_query($rquery3,$con)or die("Can't excute SQL: $rquery3");
			$rrow3 = mysql_fetch_array($rdata3);

			$wrong_q_id = $tmpwrong_q_id.",".$rrow3['wrong_q_id'];
			$rquery2 = "UPDATE tbl_result SET wrong_q_id = '$wrong_q_id' WHERE user_id=$user_id ";
			$rdata2 = mysql_query($rquery2,$con)or die("Can't excute SQL: $rquery2");
		}

			}
		
		if((int)$page <= $MaxPage){
			//执行检查答案
			echo $_POST['uanswer'];
			//echo $row3['answer'];
			echo $_POST['ranswer'];
			echo $_POST['rscore'];
			$uanswer = $_POST['uanswer'];
			if ($uanswer == $_POST['ranswer']) {
				# code...
				//echo $row3['answer'];
				$tmpright_q_id = $_POST['rid'];
				$rrquery3 = "SELECT right_q_id FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rrdata3 = mysql_query($rrquery3,$con)or die("Can't excute SQL: $rrquery3");
				$rrrow3 = mysql_fetch_array($rrdata3);

				$right_q_id = $tmpright_q_id.",".$rrrow3['right_q_id'];
				$rrquery2 = "UPDATE tbl_result SET right_q_id = '$right_q_id' WHERE user_id=$user_id ";
				$rrdata2 = mysql_query($rrquery2,$con)or die("Can't excute SQL: $rquery2");
			

				$tmpscore = $_POST['rscore'];
				$rquery0 = "SELECT testGrade FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rdata0 = mysql_query($rquery0,$con)or die("Can't excute SQL: $rquery0");
				$rrow0 = mysql_fetch_array($rdata0);
				$testGrade = $rrow0['testGrade'];
				$score = $testGrade + $tmpscore;
				$rquery1 = "UPDATE tbl_result SET testGrade = $score WHERE user_id=$user_id and course_level_id=$course_level_id";
				$rdata1 = mysql_query($rquery1,$con)or die("Can't excute SQL: $rquery1");
				echo $score;
		}else{
			echo "Wrong answer.";
			$tmpwrong_q_id = $_POST['rid'];
			$rquery3 = "SELECT wrong_q_id FROM tbl_result WHERE user_id=$user_id and course_level_id=$course_level_id";
			$rdata3 = mysql_query($rquery3,$con)or die("Can't excute SQL: $rquery3");
			$rrow3 = mysql_fetch_array($rdata3);

			$wrong_q_id = $tmpwrong_q_id.",".$rrow3['wrong_q_id'];
			$rquery2 = "UPDATE tbl_result SET wrong_q_id = '$wrong_q_id' WHERE user_id=$user_id ";
			$rdata2 = mysql_query($rquery2,$con)or die("Can't excute SQL: $rquery2");
		}
	}
}

	if((int)$page>$MaxPage){
		$page=$MaxPage;
	}

echo <<<HTML
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title>Bootstrap</title>
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

	 function submitAnswer() {
	 	if($(":checked").val() == undefined){
	 		alert("请选择一个答案再提交");
	 		return;
	 	}
	 	$("#answerForm").submit();
	 }
	 function submitAnswer2() {
	 	if($(":checked").val() == undefined){
	 		alert("请选择一个答案再提交");
	 		return;
	 	}else{
	 		$("#answerForm").submit();
	 		alert("您已完成该阶段的所有题目。");
	 		return;
	 	}
	 	$("#answerForm").submit();
	 }
 </script>
</head>

<body>
	<div class="navbar container navbar-inverse">
		<div class="navbar-inner">
			<ul class="nav navbar-inverse">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
      			</a>
				<li class="active">
					<a href="homepage.php">Homepage</a>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						Courses
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li class=""><a tabindex="-1" href="learnphp.php">PHP</a></li>
						<li><a tabindex="-1" href="learnc.php">C</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="learnen.php">English</a></li>

					</ul>
				</li>
				<li class="active">
					<a href="profile.php">My Profile</a>
				</li>
				<li class="active">
					<a href="test.php">Tests</a>
				</li>
				<li class="active">
					<a href="result.php">Results</a>
				</li>
			</ul>
		</div>
	</div>
<div class="container-fluid">
	<div class="span2">
		<!--Slide Bar-->
	</div>
<div class="span10"> 
<!--<table align="center" width="80%" border="1" cellspacing="0" cellpadding="4" bordercolorlight="#CC9966"  bgcolor="#00F2EE" bordercolordark="#FFFFFF"   class="LZH">  -->
HTML;

//根据偏移量($page - 1)*$gPageSize,运用mysql_data_seek函数得到要显示的页面
//if( mysql_data_seek($rresult,($page -1)*$gPageSize) )

$PHP_SELF=$_SERVER['PHP_SELF'];
if(mysql_data_seek($data3,($page-1)*$gPageSize))
{
  $i=0;
  for($i;$i<$gPageSize;$i++)
  {
  
  $arr=mysql_fetch_row($data3);
  if($arr)
  {
    $tmp=0;

    echo "<div class='hero-unit control-group'>";
    echo "<form action='quiz.php' id='answerForm' method='POST'>";
    echo "<input name='pagex' type='hidden' value='" . ($page+1) . "'/>";
    echo "<input name='rid' type='hidden' value='" . $arr[5] . "'/>";
    echo "<input name='rscore' type='hidden' value='" . $arr[7] . "'/>";  
    echo "<input name='ranswer' type='hidden' value='" . $arr[6] . "'/>";
    echo "<label class='control-label'><h3>"."&nbsp".$arr[0]."</h3></label><br/>";

    echo "<div class='controls'>";

    $ansArr = array(
    	1 => 'A',
    	2 => 'B',
    	3 => 'C',
    	4 => 'D'
    	);
    for($nOffSet=1;$nOffSet<5;$nOffSet++) 
    {
     // $tmp++;

      echo "<h4><label class='radio'><input name='uanswer' id='uanswer' type='radio' value='". $ansArr[$nOffSet] ."' >"."&nbsp";
      echo $arr[$nOffSet]."</label></h4><br/>";

    }
    echo "</div>";

    echo "</form>";
    echo "</div>";
    }
  //  echo "</tr>";
    }
  }


echo "<div align=center style='font-size:12px' class='pagination pagination-large'>";   
   $prevPage=$page-1;    
   echo   "<div class='pagination'><ul>"; 
 
//下一页和末页的链接  
 
if($page>=0 && $page<$MaxPage)  
{  
 
    $nextPage= $page+1;  
    $PHP_SELF=$_SERVER['PHP_SELF']; // (/admin/test.php)
    echo   "<li><a onclick='submitAnswer()'>Next</a></li> </ul></div>  </div>  ";  
    //echo   "<li><a   href=$PHP_SELF?page=$MaxPage>End</a></li></ul></div>  </div> ";    
}

if($page == $MaxPage) {
	echo "<li><a onclick='submitAnswer2()'>Submit</a></li></ul></div></div>";
}
}

?>
</div>
</div>
</div>  
</body>
</html>