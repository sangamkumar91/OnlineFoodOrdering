<?php
session_start();
ob_start();
$name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING);
//$repass = filter_input(INPUT_POST,'repass',FILTER_SANITIZE_STRING);
$first = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
$last = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);

$link = mysql_connect("localhost", "root" , "");
if (!$link) 
{
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db('a_database', $link);

if (!$db_selected)
{
  die ("Can\'t use test_db : " . mysql_error());
}

echo 'Connected Successfully <br>';

if(empty($name) || empty($pass)  || empty($first) || empty($last))
{
    
   
   $_SESSION['msg'] = 'Please fill in all the details';
   header('Location: form.php');
   //echo '<html><body> <a href = "form.php">Go Back</a> </body></html>';
   die();
}


$res = mysql_query("SELECT * FROM `users` WHERE username = '$name';")or die(mysql_error());

while($row = mysql_fetch_array($res))
  {
  echo $row['username'] . " " . $row['password'];
  echo "<br />";
  }
  echo 'No. of rows '.mysql_num_rows($res).'<br>';
if(mysql_num_rows($res)==1)
{
    
    $_SESSION['msg'] = 'Sorry, username already exists';
    header('Location: form.php');
    //echo 'Username already exists<br>';
    //echo '<html><body> <a href = "form.php">Go Back</a> </body></html>';
    die();
}
else
{
    echo 'not found <br>';
}
$result=mysql_query("INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`) VALUES ('$name','$pass','$first','$last')")or die(mysql_error());
if($result==true)
{
    echo 'Successfully Inserted.<br>';
  
}
ob_end_flush();
?>