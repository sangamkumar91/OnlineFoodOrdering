<?php
session_start();
ob_start();
require 'func.php';

connect(); 

$username = $_POST['name'];
$password = md5($_POST['pwd']);
//$mysqli=mysqli_connect('localhost','root','','ci_user');
$result = mysql_query("SELECT * FROM `customers` WHERE customer_email = '$username' AND customer_password = '$password' AND active = '1'")or die(mysql_error()) ;
$info = mysql_fetch_array( $result ); 
//echo 'The id of the user in record is '.$info['customer_id'].'<br>';
		if(mysql_num_rows($result)==1) {
          
			
			$_SESSION['user_name']=$row['customer_email'];
			$_SESSION['log']=true;
			$_SESSION['cust_id'] = $info['customer_id'];
			//echo 'The id of the user in record is '.$info['customer_id'].'<br>';
			//echo 'Welcome '.$info['customer_fname'].'<br>';
			$_SESSION['cust_name'] = $info['customer_fname'];
            if(isset($_SESSION['id']))
            {
                $postdata = array(
                    "log" => 'true',
                    "sess" => 'true',
                    "name" => $_SESSION['cust_name'],
                    );
    
            }
            else
            {
                $postdata = array(
                    "log" => 'true',
                    "sess" => 'false',
                    "name" => $_SESSION['cust_name'],
                    );
            }
            

           
		}
		else{
			$postdata = array(
                    "log" => 'false',
                    "sess" => 'false',
                    );
		}
        echo json_encode($postdata);

ob_end_flush();

?>
