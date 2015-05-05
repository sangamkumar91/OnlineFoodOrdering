<?php
session_start();
if(isset($_SESSION['msg']))
{
    echo $_SESSION['msg'];
}
session_destroy();
?>

<html>
<body>


<h2>Please Sign Up</h2>
<form action = "sign_validate.php"  method="POST">
<ul>
<li>Username: <input type = "text" name = "name"></li>
<li>Password: <input type = "text" name = "pass"></li>

<li>First name: <input type = "text" name = "fname"></li>
<li>Last name: <input type = "text" name = "lname"></li>
<input type="submit" name="Submit" ></li>
</ul>
</form>

</body>
</html>