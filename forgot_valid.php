<?php
session_start();
$_SESSION = array();
$para = session_get_cookie_params();
setcookie(session_name(),'',time()-60*60,$para['path'], $para['domain']);
session_destroy();
session_start();
ob_start();
$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
require '/sign_up/try2.php';
require 'func.php';
connect();
/*if(isset($email) && !empty($email) )
 {   
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "E-Mail is not valid".'<br>';
        $_SESSION['msg'] = 'Invalid Email';
        header('Location: forgot.php');
        die();
    }
    else
    {
        echo "E-Mail is valid".'<br>';
    
    } 
}*/
//echo $email;
$re = mysql_query("SELECT * FROM `customers` WHERE customer_email = '$email' AND active = '1' ");
$r = mysql_num_rows($re);
//echo $r;

if($r==1)
{
    $re1 = mysql_fetch_array($re);
    $hash = $re1['hash'];
    
    $to      = $email; // Send email to our user  
    $subject = 'Forgot Password'; // Give the email a subject   
    $message = ' 
 
    
 
Please click this link to change your password: <br>
 
https://localhost/mock_page/verifyforgot.php?email='.$email.'&hash='.$hash.' 
 
'; // Our message above including the link  
                      
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
$mail->Body = $message;
$mail->Subject = $subject;
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
//$_SESSION['msg'] = 'Please check your mail to change password';
//header('Location: forgot.php');
echo 'true';
}
    
}
else
{
    //$_SESSION['msg'] = 'Email ID is not registered, please login/sign up to continue';
    //header('Location: form.php');
    //die();
	echo 'false';
}
ob_end_flush();
?>