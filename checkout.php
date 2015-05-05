<?php

ob_start();
session_start();
include 'header1.php';

require 'func.php';
$email = 'raghavgoyal14@gmail.com';
$email2 = 'sangamkumar91@gmail.com';
$email3 = 'anshul.jain@futurecaptcha.com';
$email4 = 'lokesh@futurecaptcha.com';
require '/sign_up/try2.php';
$mail->AddCC($email2, 'Sangam');
$mail->AddCC($email3, 'Anshul');
$mail->AddCC($email4, 'Lokesh');



connect();
//$_SESSION['order_id'] = 1;
/*
if(isset($_SESSION['order_id']))
{
    $order_id = $_SESSION['order_id'];
    $re1 = mysql_query("SELECT * FROM `order` WHERE order_id='$order_id'");
    $re = mysql_fetch_array($re1);
    $op = $re['order_price'];
    $loc_id = $re['location_id'];
    $cust_i = $re['customer_id'];
    $name = mysql_query("SELECT * FROM `customers` WHERE customer_id = '$cust_i'");
    $n = mysql_fetch_array($name);
    $name = $n['customer_fname'];
    $re2 = mysql_query("INSERT INTO `order`(`customer_id`, `location_id`, `order_price`) VALUES ($cust_i,$loc_id,$op)");//or die(mysql_error());
    $order_id2 = mysql_query("SELECT MAX(order_id) FROM `order`");
    $t = mysql_fetch_array($order_id2);
    $order_id2 = $t['MAX(order_id)'];
    
    //echo 'Order id '.$order_id;
    $result = mysql_query("SELECT * FROM `order_product` WHERE order_id = '$order_id'");
    
    while($row = mysql_fetch_array($result))
    {
        
        $p_id = $row['product_id'];
        $p_q = $row['product_quantity'];
        $re3 = mysql_query("INSERT INTO `order_product`(`order_id`, `product_id`, `product_quantity`) VALUES ($order_id2,$p_id,$p_q)")or die(mysql_error());
       
    }

    echo 'Dear '.$name.' your order has been placed as before<br>';
    echo 'Your order id is '.$order_id2.'<br>';
    unset($_SESSION['order_id']);
    ?>

 <footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
    <?php die();
    
}
*/

if (($_SESSION['nonce'] != $_POST['nonce'] )||($_SESSION['mail']==true)) {
    header('Location: menu.php');
    die();
} else {
    // clear the session nonce
    $_SESSION['nonce'] = null;
}
$loc_id = $_SESSION['loc_id'];
$result2 = mysql_query("SELECT * FROM `business_info` WHERE location_id = '$loc_id'")or die(mysql_error());
$service_row = mysql_fetch_array($result2);
$place= $service_row['business_city'];

//var_dump($_SESSION['id']);
$id = $_SESSION['id'];
$p = $_SESSION['p'];

$sum = 0;
$o1 = array();
$c = count($id);

if($_SESSION['order_log']==true)
{
    $sum = ($_SESSION['order']-$service_row['delivery_charges'])/(1+($service_row['tax']/100));
}
else
{
    for($i=0;$i<$c;$i++)
    {
    $o = 'od'.$id[$i];
    $o1[$i] = filter_input(INPUT_POST,$o,FILTER_SANITIZE_NUMBER_INT);
    if(!isset($o1[$i])||empty($o1[$i]))
    {
        $o1[$i]=0;
    }
    $sum = $sum + $o1[$i] * $p[$i];
    

    }
}/*
if($sum==0)
{
    $sum = $_SESSION['order']-$service_row['delivery_charges'];
}*/
echo $place;
echo '<br>'.'The Total amount is Rs. '.$sum.'<br>';
echo 'Delivery Charge is Rs. '.$service_row['delivery_charges'].' <br>';
echo 'Tax rate charged is '.$service_row['tax'].' %<br>';
$ord = $sum + $service_row['delivery_charges'] + ($sum * $service_row['tax'])/100;
echo 'The total order cost is Rs. '. $ord.'<br>';
if($_SESSION['log']==false)
{
    $_SESSION['order'] = $ord;   
}
echo 'The minimum delivery cost for order is: Rs. '.$service_row['minimum_delivery_cost'].'<br>';
if($ord < $service_row['minimum_delivery_cost'])
{
    echo 'The order amount must exceed minimum delivery cost i.e. Rs. '.$service_row['minimum_delivery_cost'].'<br>Therefore, the order cannot be placed<br>';
    ?>

 <footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer></body></html>
    <?php
    die();
}
$i = 0;

if($_SESSION['log']==true)
{
    $_SESSION['order_log']=true;
    $cust_id = $_SESSION['cust_id'];
    //$cust_id = 1;
    
    echo 'Dear '.$_SESSION['cust_name'].' your order has been placed<br>';
    $result3 = mysql_query("INSERT INTO `futurecaptcha`.`order` ( `customer_id`, `location_id`,  `order_price`, `loc`) VALUES ('$cust_id','$loc_id','$ord','$place')")or die(mysql_error());
    
   // $result3 = mysql_query("INSERT INTO `order`('customer_id', 'location_id', 'order_price') VALUES ($cust_id,'$loc_id','$ord')")or die(mysql_error());
    //echo "ID of last inserted record is: " . mysql_insert_id();
    $result4 = mysql_query("SELECT * FROM `order` order by order_id desc limit 1")or die(mysql_error());
    $re = mysql_fetch_array($result4);
    $s = $re['order_id'];
    $loc_men= $re['loc'];
    $result4 = mysql_query("SELECT * FROM `delivery_men` where place = '$loc_men'and status = 'leaving'")or die(mysql_error());
    
    
    $num_rows = mysql_num_rows($result4);
    
    if ($num_rows != 0) {
        
        
        while($row = mysql_fetch_array($result4))
    {
            $dev_man = $row['dm_id'];
            break;
            
        }
        
        $upadte_query1= mysql_query("UPDATE `futurecaptcha`.`order` SET `dm_id` = '$dev_man' WHERE `order`.`order_id` = '$s'");
        $upadte_query2= mysql_query("UPDATE delivery_men SET run=run+1 WHERE dm_id='$dev_man'");
    }
    
    else{
        
        $result4 = mysql_query("SELECT MIN(run),dm_id FROM `delivery_men` where status = 'free'")or die(mysql_error());
    
    
    while($row = mysql_fetch_array($result4))
    {
            $dev_man = $row['dm_id'];
            break;
            
        }
        
        $upadte_query1= mysql_query("UPDATE `futurecaptcha`.`order` SET `dm_id` = '$dev_man' WHERE `order`.`order_id` = '$s'");
        $upadte_query2= mysql_query("UPDATE delivery_men SET status='leaving',time_counter='40',run=run+1,place='$loc_men' WHERE dm_id='$dev_man'");
    }
        
    
    echo 'Your order id is '.$s.'<br>';
    for($i=0;$i<$c;$i++)
    {
        if($o1[$i] > 0)
        {
            $result5 = mysql_query("INSERT INTO `order_product`(`order_id`, `product_id`, `product_quantity`) VALUES ($s,$id[$i],$o1[$i])")or die(mysql_error());
            
        }
    }
    
   
$to      = $email; // Send email to our user  
$subject = 'Order id '.$s.' Customer id '.$_SESSION['cust_id']; // Give the email a subject   
$message = ' 
Order Placed with<br>
Order id: '.$s.'<br>
Customer Name: '.$_SESSION['cust_name'].'<br>
Customer Id: '.$_SESSION['cust_id'].'<br>
'; // Our message above including the link  
                      
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
$mail->Body = $message;
$mail->Subject = $subject;
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else{
    $_SESSION['mail'] = true;
}

    
    ?>
    
    <?php
}


    
    
 else if($_SESSION['log']==false)
    {
    echo 'Please log in to place your order';
    $_SESSION['order_log']=true;
    }
    ?>
    
    
    
    

 <footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
    
    <?php 


ob_end_flush();
?>
