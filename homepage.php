
<html lang="en">
<head>
 <title>Bootstrap</title>
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
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
      </a>
				<li class="active">
					<a href="header.php">Homepage</a>
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
	
</body>
</html>