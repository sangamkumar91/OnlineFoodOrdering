<?php
ob_start();
session_start();
if(isset($_SESSION['msg']))
{
    echo $_SESSION['msg'];
}
$_SESSION = array();
$para = session_get_cookie_params();
setcookie(session_name(),'',time()-60*60,$para['path'], $para['domain']);
session_destroy();
ob_end_flush();
?>
<html>

<head>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="parsley2.min.js"></script>

</head>
<body>
<h3>Please enter your email</h3>
<form action="forgot_valid.php" data-validate="parsley" method="POST">
<input type="text" name="email" data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="1" data-error-message="*Required.Must be in the format: yourId@example.com">
<input type="submit" value="Submit">
</form>
<form action="form.php" method="POST">
<input type="submit" value="Go Back"/>
</form>
</body>
</html>