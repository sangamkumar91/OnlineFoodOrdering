<?php
session_start();
ob_start();
require 'func.php';
connect();

if(isset($_SESSION['msg']))
{
    echo $_SESSION['msg'];
}

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{  
    // Verify data  
    $email = mysql_real_escape_string($_GET['email']); // Set email variable  
    $hash = mysql_real_escape_string($_GET['hash']); // Set hash variable  
 
//echo 'email '.$email.'<br>';
//echo 'hash '.$hash.'<br>';
    $query = "SELECT * FROM `customers` WHERE customer_email = '$email' AND hash = '$hash'";
    $result = mysql_query($query);

    $rows = mysql_num_rows($result);

    if($rows>0)
    {
        
        ?>
        <html>
        <body>
        
        <h2>Set New Password</h2>
        <form action="newpass.php" method="POST">
        New Password: <input type="password" name="pass"/><br/>
        Re-enter Password: <input type="password" name="repass"/>
        <input type="hidden" name="email" value="<?php echo $email;?>"/>
        <input type="hidden" name="hash" value="<?php echo $hash;?>"/>
        <input type="submit" name="submit"/>
        </form>
        </body>
        </html>
        <?php
        //$query = "UPDATE `customers` SET `active`='1' WHERE customer_email='$email' AND hash='$hash' AND active='0'";
        //$result = mysql_query($query);
        /*echo 'Your account has been activated, you can now login<br>';
        echo 'Please click the following link to go to login page<br>';
        echo '<html><body><a href="login.php">Click here</a></body></html>';
        $_SESSION['msg'] = 'Your account has been activated, you can now login<br>';
        header('Location: form.php');
        die();
    */}
    else
    {
        echo'The url is either invalid or you already have activated your account.<br>';
    }
}
else
{
    echo 'Invalid approach, please use the link that has been send';
}

ob_end_flush();
?>