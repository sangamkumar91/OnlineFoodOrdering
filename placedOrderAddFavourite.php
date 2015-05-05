<?php
session_start();
@$db = new mysqli('localhost', 'root', '', 'futurecaptcha');

$orderId = $_POST['orderid'];

//$result = mysql_query("SELECT * FROM `customers` WHERE customer_email = '$username' AND customer_password = '$password' AND active = '1'")or die(mysql_error()) ;
$query = "UPDATE  `futurecaptcha`.`order` SET  `favourite_order` = '1' WHERE  `order`.`order_id` ='$orderId'";
$db->query($query); 
//echo 'The id of the user in record is '.$info['customer_id'].'<br>';
echo 'true';
		
$db->close();

?>
