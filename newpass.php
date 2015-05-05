<?php

session_start();
ob_start();
require 'func.php';
connect();
$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_EMAIL);
$repass = filter_input(INPUT_POST,'repass',FILTER_SANITIZE_EMAIL);
$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
$hash = filter_input(INPUT_POST,'hash',FILTER_SANITIZE_EMAIL);
$pass = mysql_real_escape_string($pass);
$repass = mysql_real_escape_string($repass);

if($pass == $repass)
{
    $pass_en = md5($pass);
    $result = mysql_query("UPDATE customers SET customer_password='$pass_en' WHERE customer_email='$email'")or die(mysql_error());
    $_SESSION['msg'] = 'Your password has been reset';
    header('Location: form.php');
    die();
}
else
{
    $_SESSION['msg'] = 'Please re-enter password correctly<br>';
    header('Location: verifyforgot.php?email='.$email.'&hash='.$hash.' ');
    die();
}
ob_end_flush();
?>