<?php
	//session_start();
	include 'header.php';

echo <<<HTML
<html lang="en">
<!--
<head>
 <title>Bootstrap</title>
 <link rel="stylesheet" type="text/css" href="homepage.css" />
  <link href="../../Shanbei/stylesheets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
 <script src="../../Shanbei/script/jquery-1.9.1.min.js"></script>
 <script src="../../Shanbei/stylesheets/bootstrap/js/bootstrap.min.js"></script>
</head>
-->
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

	$('#button-submit').click(function(){
            $('form .required:input').trigger('blur');
            //var username = $('#id_username').val();
            //var passWord1 = $('#id_password1').val();
            //var passWord2 = $('#id_password2').val();
            //var formNum = $('#username').val();
            //var formNum1 = $('#id_email').val();
            //alert('已提交！');
            $.ajax({
            	url: "../views/profile/profile.php",
            	data: $('form').serializeArray(),
            	type: "POST",
            	dataType: "json",
            	success: function(mdata){
            		if(mdata.err_code == "0"){
            			location.href=mdata.data;
            			alert("正在保存并跳转...");
            		} else {
            			alert(mdata.data);
            		}
            	},
            	error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("status:" + XMLHttpRequest.status + 
                         " readyState:" + XMLHttpRequest.readyState + 
                         " textStatus:" + textStatus);
               },
               // beforeSend: function() {
               // 		alert("正在保存并跳转...");
               // },
               // complete: function() {
               // 		alert("正在保存并跳转...");
               // }

            });
     });


})
	
	
</script>	

	<div class="container">
		<div class="span2"></div>
		<div class="span6">
			<!--<form action="../views/profile/profile.php" method="post" class="form-horizontal">-->
			<form action="" method="post" class="form-horizontal">

			<br/><br/>
		<div class="control-group">
			
			 <label class="control-label" for="id_username">Education Background:</label>
			 <div class="controls">
			 <select name="edu" id="edu">
			 	<option value="2">Choose an option here</option>
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
			 	<option value="2">Choose an option here</option>
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
			<input type="radio" name="gender" id="gender2" value="female">female
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
				<button type="button" class="btn btn-info" id="button-submit">Save</button>
			</div>
			
		</div>		
	</form>
</div>
  </div>
</body>
</html>
HTML;

?>