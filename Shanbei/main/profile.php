<?php
	session_start();
	// if(!isset($_SESSION["uid"])) {
		// unset($_SESSION["uid"]);
		// die("请先登录");
	// }
	//echo $_SESSION["uid"] . "&nbsp;&nbsp;";
	
?>
<html>
<head>
 <title>主页</title>
 <link rel="stylesheet" type="text/css" href="../stylesheets/style.css" >
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../script/jquery-1.9.1.min.js"></script>
 <script src="../stylesheets/bootstrap/js/bootstrap.min.js"></script>
 <style>
        body{
            margin-top:0;
            padding-top:0px;
        }
        .navbar.navbar-fixed-top {
            display:none;
        }
 </style>
</head>

<body>
<div class="container main-body">
	<div id="csrftoken">
		<input type="hidden" name="csrfmiddlewaretoken" value="bb77fadf50431e346d4263a9c877abef">
	</div>
</div>
<div id="container">
	
	<div id="page-head-right">
		<div id="main-login" class="pull-right">
			<a >
			<?php echo $_SESSION["uid"] . "&nbsp;&nbsp;"; ?>
			</a>
			<a id='login' class="twin-btn-left" name="login" href="../logout.php">
				<span>Logout</span>
			</a>

		</div>
	</div>
<div id="navigation1">
	
	<a href="homepage.php">Homepage</a>
	<a href="course_select.php">Courses</a>
	<a href="profile.php">MyProfile</a>
	<a href="test.php">Test&Quiz</a>
	<a href="result.php">Results</a>
	</div>
</div>



<!-- <div id="register-body">
<div id="blue-background"> -->
<!-- <div class="register-box registration">
   
</div> -->

	<form action="" method="post" class="form-horizontal">
		<div class="control-group">
		
		
			 <label class="control-label" for="id_username">Education Background:</label>
			 <div class="controls">
			 <select size="1" name="edu" class="required" maxlength="90">
	  			<option value="middleschool">Middle School</option>
	  			<option value="highschool">High School</option>
	  		 	<option value="college">College/University</option>
	   		 	<option value="graduated">Graduated</option>
	    		<option value="others">Others</option>
  			</select>
  		</div>
		</div>
		
	</form>

<!-- </div>
</div> -->




</body>
</html>