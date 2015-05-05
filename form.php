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
    
    //$_SESSION['sign']='Please log out to log in';
    header("Location: index.php");
    die();
    /*if(isset($_SESSION['msg']))
    {
        echo $_SESSION['msg'];
    }*/
    /*$_SESSION = array();
    $para = session_get_cookie_params();
    setcookie(session_name(),'',time()-60*60,$para['path'], $para['domain']);
    session_destroy();*/
}
ob_end_flush();
?><!--
<html>
<head>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="parsley.min.js"></script>
</head>
<body>
<div id="centerlogin">
<h2>Login Form</h2>
<form action = "check.php"  data-validate="parsley" method="POST">
Email: <br><input type = "text" name = "email" data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="3">
<br>Password: <br><input type = "password" name = "pass" data-required="true" data-trigger="keyup" data-validation-minlength="1" data-minlength="4" data-type="alphanum">

<input type="submit" name="Submit" value="Login" >
</form>



<a href="sign_up.php">Create New Account</a>
<a href="forgot.php">Forgot Password ?</a>
</div>
</body>
</html>
-->
<html>
<body>
<br />


                        <footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>

</body>
</html>