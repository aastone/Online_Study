<?php
	session_start();

echo <<<HTML
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
	<script type="text/javascript">

$(function(){

	$('').click(function(){
            $('form .required:input').trigger('blur');
            //var username = $('#id_username').val();
            //var passWord1 = $('#id_password1').val();
            //var passWord2 = $('#id_password2').val();
            //var formNum = $('#username').val();
            //var formNum1 = $('#id_email').val();
            //alert('已提交！');
            $.ajax({
            	url: "views/profile/profile.php",
            	data: $('form').serializeArray(),
            	type: "POST",
            	dataType: "json",
            	success: function(mdata){
            		if(mdata.err_code == "0"){
            			location.href=mdata.data;
            		} else {
            			alert(mdata.data);
            		}
            	},
            	error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("status:" + XMLHttpRequest.status + 
                         " readyState:" + XMLHttpRequest.readyState + 
                         " textStatus:" + textStatus);
               },
               beforeSend: function() {
               		alert("begin");
               },
               complete: function() {
               		alert("finished");
               }
            });
     });


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
	<div class="container">
		<div class="span2"></div>
		<div class="span6">
		<form action="views/profile/profile.php" method="post" class="form-horizontal">
			<!-- <form action="" method="post" class="form-horizontal"> -->
		<div class="control-group">
			
			 <label class="control-label" for="id_username">Education Background:</label>
			 <div class="controls">
			 <select name="edu" id="edu">
	  			<option value="1">Middle School</option>
	  			<option value="2">High School</option>
	  		 	<option value="3">College/University</option>
	   		 	<option value="4">Graduated</option>
	    		<option value="3">Others</option>
  			</select>
  		</div>
		</div>
		<div class="control-group">
			
			 <label class="control-label" for="id_username">Major:</label>
			 <div class="controls">
			 <select name="major" id="major">
	  			<option value="4">Computer Science & related</option>
	  			<option value="3">Science</option>
	  		 	<option value="2">Business</option>
	   		 	<option value="1">Liberal Arts</option>
	    		<option value="2">Others</option>
  			</select>
  		</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="id_username">Gender:</label>
			<div class="controls">
		<label class="radio">
			<input type="radio" name="gender" id="gender1" value="male" checked>male
		</label>
		<label class="radio">
			<input type="radio" name="gender" id="gender2" value="female" checked>female
		</label>
	</div>
	</div>
		<div class="control-group">
			<label class="control-label" for="id_course">Interest:</label>
			<div class="controls">
				<input name="interest" class="input-large" type="textarea" id="id_course">			
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="id_course">Introduction:</label>
			<!--
			<div class="controls">
				<input type="textarea" id="id_course" name="introduction">
			</div>
			-->
			<div class="controls">
				<textarea row="5" id="id_course" name="introduction"></textarea>
			</div>
		</div>
		<div class="control-group">
			
			<div class="controls">
				<button type="submit" class="btn btn-info" id="button-submit">Save</button>
			</div>
			
		</div>


		
	</form>
</div>
  </div>
</body>
</html>
HTML;

?>