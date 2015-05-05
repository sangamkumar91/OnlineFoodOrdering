<?php
session_start();
include 'func.php';
connect();
if(isset($_POST['cat_id']))
{
    $cat = $_POST['cat_id'];
}
//echo $cat;
//echo $_SESSION['loc_id'];

$loc_id = $_SESSION['loc_id'];
?>

<table id="menu" border='1' cellpadding='5'>
<h3><?php echo $cat; ?></h3>
<tr>
    <th>Item Name</th>
    <th>Price</th>
    <th>Quantity</th>
</tr>
<?php

$i = 0;

$result3 = mysql_query("SELECT * FROM `products` WHERE location_id = '$loc_id' AND product_category = '$cat'")or die(mysql_error());


$result2 = mysql_query("SELECT * FROM `products` WHERE location_id = '$loc_id' ORDER BY product_category")or die(mysql_error());
while($product_row = mysql_fetch_array($result2))
{
    $result3 = mysql_query("SELECT * FROM `products` WHERE location_id = '$loc_id' AND product_category = '$cat'")or die(mysql_error());
    while($cat_row = mysql_fetch_array($result3))
    {
        if($product_row['product_id'] == $cat_row['product_id'])
        {
            ?>
            <tr>
            <td><?php echo $product_row['product_name'];?></td>
            <td><input  type="text" value=" <?php echo $product_row['product_price'];?>" readonly size="2" id="prodprice"/>   </td>
            <td>
                <input id="<?php echo 'item'.$i; ?>" type="text" name="od<?php echo $product_row['product_id'];?>" value="1" size="1" /><a href="#h3" class="iadd" id="<?php echo $i; ?>" onclick="additem(this)">+</a>
                <input type="hidden" name="nonce" value="<?php //echo $nonce; ?>" />
            </td>
            </tr>
                    
            <?php
        }
    }
    
    $i++;
}




?>