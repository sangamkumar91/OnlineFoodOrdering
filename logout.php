<?php
session_start();
ob_start();
if($_SESSION['log']==true)
{
    echo "yoyoyooy";
	unset($_SESSION['user_name']);
	$_SESSION['msg']='Logged Out';
    $_SESSION['log']=false;
    
}


header('Location: index.php');
ob_end_flush();


?>