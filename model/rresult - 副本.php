<?php
	//session_start();
	require_once 'header.php';
?>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="homepage.css" />
 <link rel="stylesheet" type="text/css" href="../Shanbei/script/jquery.jqplot.css" />
  <link href="../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
 <script src="../Shanbei/script/jquery.jqplot.js"></script>
 <script src="../Shanbei/script/plugins/jqplot.pieRenderer.min.js"></script>
 <script src="../Shanbei/script/plugins/jqplot.donutRenderer.min.js"></script>
 <script type="text/javascript" src="../src/plugins/jqplot.barRenderer.min.js"></script>
 <script type="text/javascript" src="../src/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="../src/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="../src/plugins/jqplot.pointLabels.min.js"></script>
</head>

<body>

	<?php
		$con = mysql_connect("localhost", "stone", "123456");//连接数据库
	if (!$con){ 
 		die('Could not connect: ' . mysql_error());//连接失败，提示报错！
	}
	//
	$db_selected = mysql_select_db("db_study",$con);//选择数据库
	mysql_query('set names "utf8"');
	$email = $_SESSION["uemail"];

	$query1 = "SELECT id,degree,major FROM tbl_user WHERE email = '$email' ";
	$data1 = mysql_query($query1,$con)or die("Can't excute SQL：$query1");
	$row1 = mysql_fetch_array($data1);
	$user_id = $row1['id'];

	$query2 = "SELECT course_level_id,goal,spend_time,tag1,tag2,tag3 FROM tbl_study WHERE user_id = '$user_id'";
	$data2 = mysql_query($query2,$con)or die("Can't excute SQL：$query2");
	$row2 = mysql_fetch_array($data2);
	$course_level_id = $row2['course_level_id'];//找到学习者所学习的课程id

	$query3 = "SELECT title,answer1,answer2,answer3,answer4,id,answer,score from tbl_question ".
			  "WHERE course_level_id = '$course_level_id'";
	$data3 = mysql_query($query3,$con)or die("Can't excute SQL：$query3");
	$row3 = mysql_fetch_array($data3);

	$query4 = "SELECT name,level from tbl_course ".
			  "WHERE id = '$course_level_id'";
	$data4 = mysql_query($query4,$con)or die("Can't excute SQL: $query4");
	$row4 = mysql_fetch_array($data4);
	$course_name = $row4['name'];
	$course_level = $row4['level'];

	$query = "SELECT quizGrade,user_id,course_level_id FROM tbl_result WHERE user_id = '$user_id' ";
	$data = mysql_query($query,$con)or die("Can't excute SQL: $query");
	$row5 = mysql_fetch_array($data);

	//设置学生模型
	//学习目标

	if (isset($row2['goal'])) {
		# code...
		$goal = $row2['goal'];
	}else{
		$goal = 1;
	}

	//学习积极性

	if (isset($row2['spend_time'])) {
		# code...
		$activity = $row2['spend_time'];
	}else{
		$activity = 1;
	}

	//知识背景

	if (isset($row2['tag1'])) {
		# code...
		$knowledge_bg = $row2['tag1'];
		if (isset($row2['tag2'])) {
			# code...
			$knowledge_bg +=$row2['tag2'];

			if (isset($row2['tag3'])) {
				# code...
				$knowledge_bg +=2;
			}
		}
	}else if (isset($row2['tag2'])) {
		# code...
		$knowledge_bg = $row2['tag2'];
		if (isset($row2['tag3'])) {
			# code...
			$knowledge_bg +=2;
		}
	}else if (isset($row2['tag3'])) {
		# code...
		$knowledge_bg = 3;
	}else{
		$knowledge_bg = 1;
	}

	//学习背景

	if ($row1['degree'] > 2) {
		# code...
		$study_bg = $row1['degree'];
		if ($row1['major'] > 2) {
			# code...
			$study_bg += $row1['major'];
		}else{
			$study_bg += 1;
		}
	}else{
		$study_bg = 2;
	}



	//学习能力

	if (isset($row5['quizGrade'])){
		# code...
		$ability = $row5['quizGrade'];
	}else{
		$ability = 1;
	}

	//确定每一部分所占的比例

	$x = 0.05*$goal;
	$y = 0.12*$activity;
	$z = 0.20*$knowledge_bg;
	$f = 0.05*$study_bg;
	$g = 0.58*$ability;

	//echo "<br/>".$x,"<br/>".$y,"<br/>"."<br/>".$z,"<br/>".$f,"<br/>".$g."<br/>";

	$rank = $x + $y + $z + $f + $g ;

	//echo $rank;

	//存入学生模型表中
	$smquery1 = "SELECT * FROM tbl_student WHERE user_id = $user_id AND course_level_id = $course_level_id";
	$smdata1 = mysql_query($smquery1,$con)or die('ooo');
	$smrow1 = mysql_fetch_array($smdata1);
	//echo $smrow1;
	//echo $smquery1;
	if (!isset($smrow1['rank'])) {
		# code...
		$smquery2 = "UPDATE tbl_student SET goal=$x,activity=$y,knowledge_bg=$z,study_bg=$f,ability=$g WHERE user_id = $user_id AND course_level_id = $course_level_id";
		$smdata2 = mysql_query($smquery2,$con)or die("update wrong;152");
	}else{
		$smquery = "INSERT INTO tbl_student(user_id,course_level_id,goal,activity,knowledge_bg,study_bg,ability,rank)".
					"VALUES('$user_id','$course_level_id','$x','$y','$z','$f','$g','$rank')";
		$smdata = mysql_query($smquery,$con)or die("Can't excute sql: smquery $smquery");
	}

	if ($rank < 8.5) {
		# code...
		$tmprank = "不合格";
	}elseif ($rank >= 8.5 && $rank < 9.5) {
		# code...
		$tmprank = "合格";
	}elseif ($rank >=9.5 && $rank < 11) {
		# code...
		$tmprank = "掌握";
	}elseif ($rank >= 11 && $rank < 12.5) {
		# code...
		$tmprank = "优秀";
	}elseif ($rank >= 12.5) {
		# code...
		$tmprank = "精通";
	}


	
	//while($row = mysql_fetch_array($data)){echo $row["quizGrade"];}
	// echo $query;
	// $quizGrade = $row[0];
	// echo $row[0];
	// echo $row[0];


	?>
	<div class="span3">

			<h6>公式如下：</h6>

			<code>
				$x = 0.05*$goal;<br/>
				$y = 0.12*$activity;<br/>
				$z = 0.20*$knowledge_bg;<br/>
				$f = 0.05*$study_bg;<br/>
				$g = 0.58*$ability;<br/><br/>

				$score = $x + $y + $z + $f + $g ;<br/><br/>

				score<8.5 ,&nbsp;&nbsp;&nbsp;&nbsp;不合格<br/>
				8.5<=score<9.5 , 合格<br/>
				9.5<=score<11 , &nbsp;掌握<br/>
				11<=score<12.5 , 优秀<br/>
				score>=12.5 ,&nbsp;&nbsp;&nbsp;&nbsp;精通
			</code>
		
	</div>


	<div class="span11">

		

		<script>
	$(function(){
		$('.dropdown-toggle').dropdown()
		$("#navbarExmaple.nav li").on("active",function(){
			window.console && console.log($(this).find("b").attr("href"))
		})

		  // var data = [
		  //   ['学习目标', <?php echo $goal ?> ],['学习积极性', <?php echo $activity ?>], ['学习背景', 3], 
		  //   ['学习能力', 16],['知识背景', 7]
		  // ];
		  var data = [
		    ['学习目标', <?php echo $x ?> ],['学习积极性', <?php echo $y ?>], ['知识背景', <?php echo $z ?>], 
		    ['学习背景', <?php echo $f ?>],['学习能力', <?php echo $g ?>]
		  ];
		  var plot1 = jQuery.jqplot ('chart', [data], 
		    { 
		      title: "Student Model",
		      seriesDefaults: {
		        // Make this a pie chart.
		        renderer: jQuery.jqplot.PieRenderer, 
		        rendererOptions: {
		          // Put data labels on the pie slices.
		          // By default, labels show the percentage of the slice.
		          showDataLabels: true
		        }
		      }, 
		      legend: { show:true, location: 'e' }
		    }
		  );

		  $(document).ready(function(){
  var line1 = [[-12, 7, null], [-3, 14, null], [2, -1, '(low)'], 
      [7, -1, '(low)'], [11, 11, null], [13, -1, '(low)']];
  var plot2 = $.jqplot('chart2', [line1], {
    title: 'Point Labels From Extra Series Data', 
    seriesDefaults: {
      showMarker:false, 
      pointLabels:{ show:true, location:'s', ypadding:3 }
    },
    axes:{ yaxis:{ pad: 1.3 } }
  });
});
	})
	</script>

		<div id="chart" width="300px"></div>
		<table class="table table-striped">
			
			<caption>学生模型构成</caption>
			<thead>
				<tr>
					<th>Goal</th>
					<th>Acitivity</th>
					<th>Knowledge Background</th>
					<th>Study Background</th>
					<th>Ability</th>
					<th>Score</th>
					<th>Rank</th>
				</tr>
			</thead>
			<tbody>
				

				<tr>
					<td><?php echo $goal; ?></td>
					<td><?php echo $activity; ?></td>
					<td><?php echo $knowledge_bg; ?></td>
					<td><?php echo $study_bg; ?></td>
					<td><?php echo $ability; ?></td>
					<td><?php echo $rank; ?></td>
					<td><?php echo $tmprank; ?></td>
				</tr>
				
			</tbody>
		</table>
		
		<div id="chart2" width="600px"></div>

		<table class="table table-striped">
			
			<caption>Achievements</caption>
			<thead>
				<tr>
					<th>Name</th>
					<th>Level</th>
					<th>Grade</th>
					<!-- <th>rank</th> -->
				</tr>
			</thead>
			<tbody>
				<?php while($row = mysql_fetch_array($data)){ ?>

				<tr>
					<td><?php echo $course_name; ?></td>
					<td><?php echo $row['course_level_id']; ?></td>
					<td><?php echo $row['quizGrade']; ?></td>
				</tr>
				<?php
				  }
				  ?>
			</tbody>
		</table>
	</div>
</body>
</html>