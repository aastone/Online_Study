<?php
	//session_start();
	require_once 'header.php';
	// if(!isset($_SESSION["uid"])) {
		// unset($_SESSION["uid"]);
		// die("请先登录");
	// }
	//echo $_SESSION["uid"] . "&nbsp;&nbsp;";	
?>
<html lang="en">
<head>
 
	<div class="container">
		<div class="hero-unit">
			<h1>Hello, <?php echo $_SESSION['uname']; ?> !</h1>
			<p>This is a website you can accept knowledge here. Choose a course and fill
				up your profile, then you'll be extraordinary !</p>
			<p>
				<a href="profile.php" class="btn btn-primary btn-large">Start Now !</a>
			</p>
		</div>

		<div class="span3">

			<i class="icon-hand-right"></i><a href="/1-project-shanbei/model/user/profile.php" class="btn btn-info btn-large">1. Fill up your profile</a><br/>
			
			<h5><p>&nbsp;&nbsp;&nbsp;&nbsp;完整信息能让系统更加了解你.</p></h5>
		</div>
		<br/><br/><br/>
		<div class="span3">

			<i class="icon-hand-right"></i><a href="/1-project-shanbei/model/test.php" class="btn btn-warning btn-large">2. Take a basic test</a><br/>
			
			<h5><p>&nbsp;&nbsp;&nbsp;&nbsp;学习之前先测验一下自己吧！</p></h5>
		</div>
		<br/><br/>
		<div class="span3">

			<i class="icon-hand-right"></i><a href="/1-project-shanbei/model/learnc.php" class="btn btn-danger btn-large">3. Choose a course</a>
			<br/>
			<h5><p>&nbsp;&nbsp;&nbsp;&nbsp;现在选择一门课程开始学习吧~</p></h5>
		</div>


		
	</div>
	
</body>
</html>