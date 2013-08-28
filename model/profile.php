<?php
	//session_start();

	include_once 'header.php';
	// if(!isset($_SESSION["uid"])) {
		// unset($_SESSION["uid"]);
		// die("请先登录");
	// }
	//echo $_SESSION["uid"] . "&nbsp;&nbsp;";
	$con = mysql_connect("localhost","stone","123456");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db("db_study",$con);
	mysql_query('set names "utf8"');

	$email = $_SESSION['uemail'];
	//echo $email;

	$query = "SELECT * FROM tbl_user WHERE email='$email' ";
	$result = mysql_query($query, $con)or die("Can't excute SQL:$query");
	$row = mysql_fetch_array($result);

	$dquery = "SELECT * FROM tbl_date WHERE email='$email' ";
	$dresult = mysql_query($dquery, $con)or die("Can't excute SQL dquery :$dquery");
	$drow = mysql_fetch_array($dresult);

	$tmp_login_date = $drow['login_date'];
	// echo $drow['login_date'];
	// foreach ($drow as $val) {
	// 	# code...
	// 	echo count($drow);
	// 	echo "<br/>";
	// 	echo $val;
	// 	echo "<br/>";
	// }

	// $late_login_date = $drow['login_date'];
	// print_r($drow['login_date']);

	// $dateLength = count($late_login_date);
	// while ($tmpdrow = mysql_fetch_array($dresult)) {
	// 	# code...
	// 	$late_login_date1 = $tmpdrow['login_date'];
	// 	//echo "$tmpdrow[login_date]"."<br/>";
	// 	if ($tmp_login_date<$late_login_date1) {
	// 		# code...
	// 		$late_login_date = $tmp_login_date;
	// 		$tmp_login_date = $late_login_date1;

	// 		//echo "2:".$late_login_date."<br/>";
	// 	}
	// }$arrayName = array('' => , );
	$tempdate= array();
	while ($tmpdrow = mysql_fetch_array($dresult)) {
		# code...
		// $late_login_date1 = $tmpdrow['login_date'];
		// //echo "$tmpdrow[login_date]"."<br/>";
		// if ($tmp_login_date<$late_login_date1) {
		// 	# code...
		// 	$late_login_date = $tmp_login_date;
		// 	$tmp_login_date = $late_login_date1;

		// 	//echo "2:".$late_login_date."<br/>";
		// }
		array_push($tempdate,$tmpdrow['login_date']);
	}
	$count_tempdate = count($tempdate);
	// while($count_tempdate<5){
	// 	array_unshift($tempdate, '00-00-00');
	// }
	$count_tempdate0 = $count_tempdate-5;
	$count_tempdate1 = $count_tempdate-4;
	$count_tempdate2 = $count_tempdate-3;
	$count_tempdate3 = $count_tempdate-2;
	$count_tempdate4 = $count_tempdate-1;
	$late_login_date = $tempdate[$count_tempdate-2];


	//$dateLength = count($temp)
	// while ($tmpdrow = mysql_fetch_array($dresult)) {

	// 	for($i=0;$i<$dateLength;$i++){
	// 		if($late_login_date[$i]>$late_login_date[$i+1]){
	// 			$temp = $late_login_date[$i+1];
	// 			$late_login_date[$i+1] = $late_login_date[$i];
	// 			$late_login_date[$i]=$temp;
	// 		}
	// 		$reslutLastTime = $late_login_date[$dateLength-1];
	// 	}

	// }

	$i=0;
	$line1=array();
	while( $count_tempdate-$i>-1 && $i<5){
		$tempLine = $count_tempdate - $i -1;
		// echo $tempLine;
		if($tempLine>-1){
			array_unshift($line1,$tempdate[$tempLine]);
						
			}
		else break;
		$i++;
	}

	//print_r($line1);

	//echo $line1[0];
	$countLine = count($line1);
	$json = json_encode($line1);

	//echo $reslutLastTime;

	if ($row['degree'] == 3) {
		# code...
		$degree = "College/University";
	}else if ($row['degree'] == 4) {
		# code...
		$degree = "Graduated";
	}else {
		$degree = "High&nbspSchool";
	}

	if ($row['major'] == 4) {
		# code...
		$major = "Computer&nbspScience";
	}else if ($row['major'] == 3) {
		# code...
		$major = "Science";
	}else if ($row['major'] == 2) {
		$major = "Business";
	}else {
		$major = "Liberal&nbspArts";
	}


echo <<<FORM1
	<link rel="stylesheet" type="text/css" href="../Shanbei/script/jquery.jqplot.css" />
  	<link href="../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	<script src="../Shanbei/script/jquery-1.9.1.min.js"></script>
	<script src="../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../Shanbei/script/jquery.jqplot.js"></script>
	<script src="../Shanbei/script/plugins/jqplot.pieRenderer.min.js"></script>
	<script src="../Shanbei/script/plugins/jqplot.donutRenderer.min.js"></script>
	<script type="text/javascript" src="../Shanbei/script/plugins/jqplot.barRenderer.min.js"></script>
	<script type="text/javascript" src="../src/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="../src/plugins/jqplot.pointLabels.min.js"></script>
	<script type="text/javascript" src="../Shanbei/script/plugins/jqplot.dateAxisRenderer.min.js"></script>
	<div class="container">
	<div class="span1">
	</div>
	<div class="span6">
		<h3>个人信息</h3>
		<div class="span1">
		</div>
		<div class="span4">
			<h5>
			<br/>
			User &nbsp:&nbsp $row[name] <br/><br/>
			Email &nbsp:&nbsp $row[email] <br/><br/>
			Education &nbsp:&nbsp $degree <br/><br/>
			Gender &nbsp:&nbsp $row[gender] <br/><br/>
			Major &nbsp:&nbsp $major <br/><br/>
			Interest &nbsp:&nbsp $row[intrest] <br/><br/>
			Introduction &nbsp:&nbsp $row[introduction] <br/><br/>			
			上次登录日期 &nbsp:&nbsp $late_login_date <br/><br/>
			注册日期 &nbsp:&nbsp $drow[reg_date] <br/><br/>
			</h5>
			<script>

			var count1 = $countLine;
			var line2 = new Array();
			//alert(count1);
			// alert(count($line1));
			switch (count1) {
				case 5:
						line2.unshift(['$line1[4]',5]);
				case 4:
						line2.unshift(['$line1[3]',4]);
				case 3:
						line2.unshift(['$line1[2]',3]);
				case 2:
						line2.unshift(['$line1[1]',2]);
				case 1:
						line2.unshift(['$line1[0]',1]);
			}
			$(document).ready(function(){
				
  //var line1=[['2013-06-01',1], ['2013-06-02',2], ['2013-06-03',3], ['2013-06-07',4], ['2013-06-08',5]];
  // var line1=[['$line1[0]',1], ['$line1[1]',2], ['2013-06-03',3], ['2013-06-07',4], ['$line1[4]',5]];
				var line1 = new Array();
				line1.unshift(['$line1[1]',2]);
				line1.unshift(['$line1[0]',1]);
  var plot1 = $.jqplot('chart1', [line2], {
    title:'登录日期',
    axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer}},
    series:[{lineWidth:4, markerOptions:{style:'square'}}]
  });
});
	$(function(){
		$("#navbarExmaple.nav li").on("active",function(){
			window.console && console.log($(this).find("b").attr("href"))
		})

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
		
		</div>
		<a href="user/profile.php" class="btn btn-info btn-small">Edit</a>


	</div>
	
	</div>
	<div class="span2"></div>
	<div class="span9">
		<!--<div id="chart1" width="600px"></div>-->
	</div>


	
FORM1;
/*

*/

?>