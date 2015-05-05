<?php
session_start();
ob_start();
include 'header1.php';

if(isset($_SESSION['msg']))
{
    echo $_SESSION['msg'];
}
if($_SESSION['log']==true)
{
    //$_SESSION['sign'] = 'Please log out to sign up';
    header('Location: temp.php');
    die();
}
/*else

    
    if(isset($_SESSION['msg'])){echo $_SESSION['msg'];}
    $_SESSION = array();
    $para = session_get_cookie_params();
    setcookie(session_name(),'',time()-60*60,$para['path'], $para['domain']);
    session_destroy();
}*/
ob_end_flush();
?>
<html>
<head>
<!--<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="parsley2.min.js"></script>-->

</head>
<body>
<div>
<h2 class="title1">Signup!</h2>  
        <p>Please enter the following details to create your account:</p>  
          
        <!-- start sign up form -->     
        <form action="sign_validate.php" data-validate="parsley" method="post">  
            <ul>
            <li>First name: <br><input type = "text" name = "fname" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]" data-validation-minlength="1" data-error-message="*Required.Must be alphabets only"></li>
            <br><li>Last name: <br><input type = "text" name = "lname" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]" data-validation-minlength="1" data-error-message="*Required.Must be alphabets only"></li>
            
            <br><li>Email: <br><input type = "text" name = "email" data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="1" data-error-message="*Required.Must be in the format: yourId@example.com"></li>
            <br><li>Password: <br><input type = "password" id="newPasswd" name = "pass" data-required="true" data-trigger="keyup" data-validation-minlength="1" data-minlength="4" data-type="alphanum" data-error-message="*Required.Must be minimum 4 characters alphanumeric value"></li>
           <br /><li>Confirm Password: <br /><input  type="password" name="confirmPassword" data-equalTo="#newPasswd" data-required="true" data-minlength="1" data-trigger="keyup"  data-error-message="*Please enter same password as above"/></li>
           <br><li>Contact No: <br><br><input type = "text" name = "con" data-required="true"  data-trigger="keyup" data-type="phone"></li>
            <br><li>Address : <br><textarea name = "buil" data-required="true"></textarea></li>
            <br><li>Location: <br><input type = "text" name = "stree" data-required="true"></li>
            <!--<li>City: <input type = "text" name = "city" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$"></li>-->
			<br><li>City: <br><select name="city" data-required="true" data-trigger="change">
				<option value="Gurgaon">Gurgaon</option>
				<option value="Pune">Pune</option>
				<option value="Bangalore">Bangalore</option>
				<option value="Chennai">Chennai</option>
			</select></li>
            <br><li>State: <br><input type = "text" name = "state" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$" data-error-message="*Required.Must be alphabets only"></li>
            <br><li>Zip(PIN) Code: <br><input type = "text" name = "zip" data-required="true" data-trigger="keyup" data-type="alphanum" data-error-message="*Required.Must be alphanumeric value"></li>
            <!--
            <br /><br />
            
           <li><img src="captcha.php" id="captcha" /><br/></li>
            <li><a href="#" onclick="
            document.getElementById('captcha').src='captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/><br/>
	<b>Human Test</b><br/></li>
	<li><input type="text" name="captcha" id="captcha-form" /><br/></li>-->
            </ul>
            <input type="submit" class="submit_button" value="Sign up" />  
        </form> <br>
		
</body>

</html>

<html>
<body>
<footer>
                    <div id="footer_text"> <br> 
						Designed by kumar sangam
        </footer>
</body>
</html>