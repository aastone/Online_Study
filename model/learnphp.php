
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
					<a href="homepage.php">Homepage</a>
				</li>
				<li class="dropdown">
					<a href="homepage.php" class="dropdown-toggle" data-toggle="dropdown">
						Courses
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li class=""><a tabindex="-1" href="learnphp.php">PHP</a></li>
						<li><a tabindex="-1" href="learnc.php">C</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="">English</a></li>

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
 		<div class="row-fluid">
    		<div class="span2">
      			<!--Sidebar content-->
      			<form>
      				<fieldset>
      					<legend>PHP</legend>
      					<label>Select a course Level</label>
      					<select>
      						<option>Level 1</option>
      						<option>Level 2</option>
      						<option>Level 3</option>
      					</select>

      				</fieldset>
      			</form>

      			<button class="btn btn-success" type="button">Select!</button>

    		</div>
    	<div class="span10">
      		<!--Body content-->
      		<h2>
      		<p class="text-center">
      			PHP    Learning
      		</p>
      		</h2>

      		<h4>
      			<p class="text-center">
      				php
      			</p>
      		</h4>
      		<div class="pagination text-center">
      			
  			<ul>
    			<li><a href="#">Prev</a></li>
    			<li><a href="#">1</a></li>
    			<li><a href="#">2</a></li>
    			<li><a href="#">3</a></li>
    			<li><a href="#">4</a></li>
    			<li><a href="#">5</a></li>
    			<li><a href="#">Next</a></li>
 	 		</ul>

			</div>
    	</div>
  		</div>
	</div>
	


</body>
</html>