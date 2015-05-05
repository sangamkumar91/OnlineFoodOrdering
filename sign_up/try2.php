<?php
require("phpmailer/class.phpmailer.php");
$mail = new PHPMailer(); 
$mail->IsSMTP(); // send via SMTP
//IsSMTP(); // send via SMTP
$mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
$mail->Port = 443; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "sangamkumar91@gmail.com"; // SMTP username
$mail->Password = "resurrection"; // SMTP password
$webmaster_email = "username@doamin.com"; //Reply to this email ID
//$email="ra"; // Recipients email ID
$name="name"; // Recipient's name
$mail->From = $webmaster_email;
$mail->FromName = "Sangam";
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Webmaster");
$mail->WordWrap = 50; // set word wrap
$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Subject";
$mail->Body = "Hi,
This is the HTML BODY "; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
/*
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
*/
?>