<?php
	require_once 'header.php';
?>
<html>
	<div class="container">
		<div class="span2"></div>
		<div class="span6">
			<form action="login.php" method="post" id="loginform"> 
        	<div style='display:none'>
        		<input type='hidden' name='csrfmiddlewaretoken' value='bb77fadf50431e346d4263a9c877abef' />
    		</div>
            <ul>
                <li>
                	<label for="id_email">原密码:</label> 
                	<input id="id_email" type="password" class="required" name="email" maxlength="75" />
                	<span class="infor"></span>
                </li>
				<li>
					<label for="id_password">新的密码:</label> 
					<input type="password" name="password1" id="id_password" />
				</li>
				<li>
					<label for="id_password">重复新的密码:</label> 
					<input type="password" name="password1" id="id_password" />
				</li>
            </ul>
			<!--
            <div class="reset-password">
                <a href="/accounts/password/reset/">重设密码</a>
            </div>
			-->
			<br/>
            
            <div class="login-buttons">
                <button type="button"  class="btn btn-success"  id="button-submit" name="login">提交</button>
            </div>
            
            </div>


                
            <input type="hidden" value="home" name="continue"/>
            <input type="hidden" value="1" name="u"/>
            <input type="hidden" style="width: 18.5em;" class="textfield" name="next" id="redirect" value=""/>
        </form>
		</div>
	</div>