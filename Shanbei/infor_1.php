<?php session_start(); 
	if(!isset($_SESSION["uid"])) {
		unset($_SESSION["uid"]);
		die("请先登录");
	}
?>
<html>
<head>
 <title>个人信息</title>
 <link rel="stylesheet" type="text/css" href="stylesheets/style.css" >
 <script src="script/jquery-1.9.1.min.js" type="text/javascript"></script>
 <script type="text/javascript">

$(function(){
	
	$('form :input').blur(function(){
		var $parent = $(this).parent();
		//验证邮箱
		  
		if($(this).is('#id_password1')){
			if(this.value==''){
				 // var errorMsg = '请输入正确的邮箱地址';
				 // $parent.find('.infor').html(errorMsg); 
			}else{
				//var okMsg = '输入正确';
				//$parent.find('.infor').html('');
			}
		}

	}).focus(function(){
		$(this).triggerHandler('blur');
	});
	//验证表单并提示
	$('#button-submit').click(function(){
            $('form .required:input').trigger('blur');
          
            $.ajax({
            	url: "sinfor_1.php",
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
               	//	alert("begin");
               },
               complete: function() {
               	//	alert("finished");
               }
            });
     });


})
	
	
</script>
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
			<?php echo $_SESSION["uemail"] . "&nbsp;&nbsp;"; ?>
			</a>
			<a id='login' class="twin-btn-left" name="login" href="login.html">
				<span>主页</span>
			</a>

		</div>
	</div>

</div>


<div id="register-body">
<div id="blue-background">
<div class="register-box registration">
    <div class="register-box-inner">
		<br/>
        <h1>个人信息</h1>
        <hr>
        <form action="sinfor_1.php" method="post">
		<div style='display:none'>
		<input type='hidden' name='csrfmiddlewaretoken' value='bb77fadf50431e346d4263a9c877abef' />
		</div>
    <ul>
		
		 <li>
			 <label for="id_username">您的学历背景:</label>
			 <select size="1" name="edu" class="required" maxlength="90">
	  			<option value="middleschool">Middle School</option>
	  			<option value="highschool">High School</option>
	  		 	<option value="college">College/University</option>
	   		 	<option value="graduated">Graduated</option>
	    		<option value="others">Others</option>
  			</select>
  			<br/>
		 </li>
		
		<li>
			<label for="id_gender">您的性别:</label> 
			<input id="id_gender1" type="radio" name="gender" class="required" value="male"/>Male<br/>    
			<input id="id_gender2" type="radio" name="gender" class="required" value="female"/>Female
		</li>
<br/>
		<li>
			<label for="id_password1">您的年龄:</label> 
			<input id="id_password1" type="text" name="age" />
			<span class="helptext">如：21</span>
		</li>
		<li>
			<label for="id_password2">您的兴趣、爱好:</label> 
			<input id="id_password2" type="text" class="required" name="interest" />
			<span class="helptext">请用 “,” 隔开，如：计算机,英语,经济</span>
		</li>

            </ul>
			<br/>
            <div class="login-buttons">
            	<button type="button" class="btn btn-large btn-success" id="button-submit">提交</button>            
            </div>
            </div>


        </form>
    </div>
</div>
</div>
</div>




</body>