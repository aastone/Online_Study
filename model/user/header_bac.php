<?php
	//session_start();
	// if(!isset($_SESSION["uid"])) {
		// unset($_SESSION["uid"]);
		// die("请先登录");
	// }
	//echo $_SESSION["uid"] . "&nbsp;&nbsp;";
	
?>
<html lang="en">
<head>
 <title>Bootstrap</title>
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<script>
	$(function(){
		$('.dropdown-toggle').dropdown()
		$("#navbarExmaple.nav li").on("active",function(){
			window.console && console.log($(this).find("b").attr("href"))
		})
	})
	</script>
	<div class="navbar container navbar-inverse">
		<div class="navbar-inner">
			<ul class="nav navbar-inverse">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			    	<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <a class="brand" href="/">Learning System</a>
			    </a>
				<li class="active">
					<a href="homepage.php"><i class="icon-home"></i>Homepage</a>

				</li>
				<li class="dropdown active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-book"></i>Courses
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li class=""><a tabindex="-1" href="learnphp.php"><i class="icon-book"></i>PHP</a></li>
						<li><a tabindex="-1" href="learnc.php"><i class="icon-book"></i>&nbsp;C</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="learnen.php"><i class="icon-book"></i>English</a></li>
					</ul>
				</li>
				<li class="active">
					<a href="profile.php"><i class="icon-leaf"></i>My Profile</a>
				</li>
				<li class="active">
					<a href="test.php"><i class="icon-pencil"></i>Tests</a>
				</li>
				<li class="active">
					<a href="result.php"><i class="icon-comment"></i>Results</a>
				</li>
				<li>&nbsp;&nbsp;</li>
			</ul>
			<ul class="nav navbar-inverse pull-right">
				<li class="dropdown active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>
						<?php echo $_SESSION["uname"]; ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a tabindex="-1" href="login/changepw.php">Change password</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="login/login.html">Log off</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>