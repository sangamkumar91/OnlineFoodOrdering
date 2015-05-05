<?php
session_start();
ob_start();
require 'func.php';

$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
require '/sign_up/try2.php';

$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING);
$first = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
$last = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
$contact = filter_input(INPUT_POST,'con',FILTER_SANITIZE_NUMBER_INT);
$build = filter_input(INPUT_POST,'buil',FILTER_SANITIZE_STRING);
$street = filter_input(INPUT_POST,'stree',FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
$state = filter_input(INPUT_POST,'state',FILTER_SANITIZE_STRING);
$zip = filter_input(INPUT_POST,'zip',FILTER_SANITIZE_NUMBER_INT);

if (!empty($_REQUEST['captcha'])) 
{
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) 
	{
        $note= 'Please enter valid captcha';
        $_SESSION['msg'] = $note;
        header('Location: sign_up.php');
        die();
    } 
    unset($_SESSION['captcha']);
}


if(isset($email) && !empty($email) AND isset($pass) && !empty($pass) AND isset($first) && !empty($first) AND isset($last) && !empty($last) AND isset($contact) && !empty($contact) AND isset($build) && !empty($build) AND isset($street) && !empty($street) AND isset($city) && !empty($city) AND isset($state) && !empty($state) AND isset($zip) && !empty($zip))
{  
    
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "E-Mail is not valid".'<br>';
        $_SESSION['msg'] = 'Invalid Email';
        header('Location: sign_up.php');
        die();
    }
    else
    {
        echo "E-Mail is valid".'<br>';
    
    } 
}
else
{
    $_SESSION['msg'] = 'Please fill in all the details';
    header('Location: sign_up.php');
   //echo '<html><body> <a href = "form.php">Go Back</a> </body></html>';
   die();
}


$pass = mysql_real_escape_string($pass);
$email = mysql_real_escape_string($email);
$first = mysql_real_escape_string($first);
$last = mysql_real_escape_string($last);
$contact = mysql_real_escape_string($contact);
$build = mysql_real_escape_string($build);
$street = mysql_real_escape_string($street);
$city = mysql_real_escape_string($city);
$state = mysql_real_escape_string($state);
$zip = mysql_real_escape_string($zip);


connect();

$res = mysql_query("SELECT * FROM `customers` WHERE customer_email = '$email';")or die(mysql_error());

if(mysql_num_rows($res)==1)
{
    $row = mysql_fetch_array($res);
    if($row['active']==1)
    {
        $_SESSION['msg'] = 'Sorry, email already exists';
        header('Location: sign_up.php');
        //echo 'Username already exists<br>';
        //echo '<html><body> <a href = "form.php">Go Back</a> </body></html>';
        die();
    }
    else
    {
       $result = mysql_query("DELETE FROM `customers` WHERE customer_email = '$email'")or die(mysql_error());
       if($result==false)
       {
            echo 'aaaaaaaaahhh!!';
       }
    }
    
}

echo 'aaaaaaaaahhh!!';
$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.  // Example output: f4552671f8909587cf485ea990207f3b
$pass_en = md5($pass); // Generate random number between 1000 and 5000 and assign it to a local variable.   // Example output: 4568   

$query = "INSERT INTO `customers`(`customer_fname`, `customer_sname`, `customer_email`, `customer_password`, `customer_contact_1`, `hash`,`active`) VALUES 
('$first','$last','$email','$pass_en','$contact','$hash','1')";
/*
$query = "INSERT INTO `customers`( `firstname`, `password`, `email`, `hash`, `lastname`) VALUES 
('$first','$pass_en','$email','$hash','$last')";
*/

$result = mysql_query($query) or die(mysql_error());

$result4 = mysql_query("SELECT `customer_id` FROM `customers` WHERE customer_email = '$email' AND customer_fname = '$first'")or die(mysql_error());
$re = mysql_fetch_array($result4);
$s = $re['customer_id'];
$result2 = mysql_query("INSERT INTO `address`(`customer_building`, `customer_street`, `customer_city`, `customer_state`, `customer_zipcode`) VALUES 
('$build','$street','$city','$state','$zip')")or die(mysql_error());
/*$result3 = mysql_query("SELECT `address_id` FROM `address` WHERE customer_building = '$build'" );

//$result3 = mysql_query("SELECT 'address_id' FROM 'address' WHERE customer_building = '$build' AND customer_street='$street'" );
$re1 = mysql_fetch_array($result3);
$s1 = $re1['address_id'];*/
$s1 = mysql_query("SELECT MAX(address_id) FROM `address` WHERE 1");
$r = mysql_fetch_array($s1);
$s1 = $r['MAX(address_id)'];
$result6 = mysql_query("INSERT INTO `customer_address`(`customer_id`, `address_id`) VALUES 
('$s','$s1')")or die(mysql_error());

ob_end_flush();
?>
<html>
<body>
<a href="index.php">Go Back to Home page and sign in</a>
</body>
</html>