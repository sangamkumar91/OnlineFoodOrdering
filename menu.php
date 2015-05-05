<?php
session_start();
require 'func.php';
include 'header1.php';

$_SESSION['order_log']=false;

if(isset($_GET['loc_id']))
{
    if(!isset($_SESSION['loc_id']))
    {
        $loc_id = $_GET['loc_id'];
        $loc_id = mysql_real_escape_string($loc_id);
        $_SESSION['loc_id'] = $loc_id;
    }
}
if(isset($_SESSION['mail']))
{
    unset($_SESSION['mail']);
}
if(isset($_SESSION['id']))
{
    unset($_SESSION['id']);
    unset($_SESSION['p']);
}

connect();



if(isset($_SESSION['order_id']))
{
    
    $order_id = $_SESSION['order_id'];
    //echo $order_id.'<br>';
    $re1 = mysql_query("SELECT * FROM `order` WHERE order_id='$order_id'");
    $re = mysql_fetch_array($re1);
    $op = $re['order_price'];
    $loc_id = $re['location_id'];
    $_SESSION['loc_id'] = $loc_id;
    $cust_i = $re['customer_id'];
    $name = mysql_query("SELECT * FROM `customers` WHERE customer_id = '$cust_i'");
    $n = mysql_fetch_array($name);
    $name = $n['customer_fname'];
    $result = mysql_query("SELECT * FROM `order_product` WHERE order_id = '$order_id'");
    //$order_name = array();
    //$order_p_q = array();
    $l = 0;
    $p_id = array();
    $p_q = array();
    while($row = mysql_fetch_array($result))
    {
        
        $p_id[$l] = $row['product_id'];
        $p_q[$l] = $row['product_quantity'];
        
        $l++;
        //$re3 = mysql_query("INSERT INTO `order_product`(`order_id`, `product_id`, `product_quantity`) VALUES ($order_id2,$p_id,$p_q)")or die(mysql_error());
       
    }
    }


require 'rest.php';
?>
<html>
<head>
<script type="text/javascript">
function display_category_start(elem){
    
    var id = elem;
   
   // alert('sdasd');
    //var ajax_load = "<img src='img/load.gif' alt='loading...' />";  
      $.post(  
            "category.php",  
            {cat_id: id},  
            function(responseText){  
                $("#first_form").html(responseText);  
                $("#first_form").fadeIn(500);
            },
             
            "html"  
        );  
    }; 
</script>
</head>
</html>
<?php

$result2 = mysql_query("SELECT * FROM `products` WHERE location_id = '$loc_id' ORDER BY product_category")or die(mysql_error());


$result3 = mysql_query("SELECT DISTINCT product_category FROM `products` WHERE location_id = '$loc_id' ORDER BY product_category");
$categories = array();
$i = 0;
while($re3 = mysql_fetch_array($result3))
{
    $categories[$i] = $re3['product_category'];
    $i++;
}
$_SESSION['nonce'] = $nonce = md5(rand());
?>

<html>
<body>
<style>
.iadd {
    width: 20px;
    height: 16px;
    text-decoration: none;
    background-color: #666;
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    text-transform: uppercase;
    display: inline-block;
    padding: 3px;
    text-align: center;
    font-weight: bold;
}

</style>
<h3>Please give your order</h3>
<div id="forms">

<div id="category_box" style="float: left;
padding: 9px;
border: 2px solid gray;
margin-top: 52px;" >
<h3>Select Category</h3>
<ul>
<?php for($i=0;$i<count($categories);$i++)
{
?>
<li><a href="#h3" id="<?php echo $categories[$i]; ?>" onclick="display_category(this)"><?php echo $categories[$i];?></a></li><br />

<?php } ?>
</ul>
</div>




<div id="first_form" style="width:36%;height: 100%;float:left;display: none; ">
<!--<form id="frm1" method="POST" action="checkout.php">-->

<!--<table id="menu" border='1' cellpadding='5'>-->

<?php
$i = 0;
$id = array();
$p = array();
$od = array();
$cat = '';
$ids = array();

while($product_row = mysql_fetch_array($result2))
{
     
    $id[$i] = $product_row['product_id'];
    $p[$i] = $product_row['product_price'];
    $names[$i] = $product_row['product_name'];
    $i++;
}
//echo $categories[0];
echo "<script> display_category_start('$categories[0]'); </script>";

    ?>
    
    
    <!--  
    <tr>
    <td><?php //echo $product_row['product_name'];?></td>
    <td><input  type="text" value=" <?php //echo $product_row['product_price'];?>" readonly size="2" id="prodprice"/>   </td>
    <td>
        <input id="<?php //echo 'item'.$i; ?>" type="text" name="od<?php //echo //$product_row['product_id'];?>" value="1" size="1" /><a href="#h3" class="iadd" id="<?php //echo $i; ?>" onclick="additem(this)">+</a>
        <input type="hidden" name="nonce" value="<?php //echo $nonce; ?>" />
    </td>
    -->
    
    


<!--</table>-->
<!--</form>-->
</div>



</body>
</html>
<?php


$_SESSION['id'] = $id;
$_SESSION['p'] = $p;
$size = count($id);
$i = 0;
for($i=0;$i<$size;$i++)
{
    $ids[$i] = 0;
}
$i = 0;
$pres = array();
for($i=0;$i<$size;$i++)
{
    $pres[$i] = 0;
}

$re = mysql_query("SELECT * FROM `business_info` WHERE location_id = '$loc_id'") or die(mysql_error());
$r = mysql_fetch_array($re);
$tax = $r['tax'];
$minimum_delivery_cost = $r['minimum_delivery_cost'];
$delivery_charges = $r['delivery_charges'];



if(isset($_SESSION['order_id']))
{
    $order_quan = array();
    for($i=0;$i<count($id);$i++)
    {
        for($j=0;$j<count($p_id);$j++)
        {
            if($id[$i] == $p_id[$j])
            {
                $order_quan[$i] = $p_q[$j];
            }
        }
    }
 //  var_dump($order_quan); 
   for($i=0;$i<count($id);$i++)
   {
        if(empty($order_quan[$i]) == 1)
        {
            $order_quan[$i] = '0';
        }
   }
   //echo(empty($order_quan[4]));
   //var_dump($order_quan); 
   
   
}




?>
<html>
<body>
<div id="finalform" style="position: relative;
left: 70px;
width: 34%;
height: 100%;
float: left;
margin-left: 1%;
margin-top: 5%;
border: 5px solid;
padding: 14px;">
<p style="text-align: center;
margin: 2px;
font-size: 1.5em;
margin-bottom: 5px;">Your Order</p>
<form id="frm2" action="checkout.php" method="POST">

     <div id="dynamicinput">
         <!-- Entry 1<br><input type="text" name="myInputs[]">-->
     </div>
     <input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
     
     <!--<input type="button" value="Add another text input" onclick="addInput('dynamicinput');">-->


<p id="inner"></p>
<p id="inner1"></p>
<p id="inner2"></p>
<p id="inner3"></p>
<p id="inner4"></p>
<p id="inner5"></p>
<input type="button" onclick="formSubmit()" name ="submit1" value="Place Order">
</form>
</div>
</div>

<script type="text/javascript" >

     var pres = <?php echo json_encode($pres); ?>;
    var intRegex = /^\d+$/;
    var minimum_delivery_cost = <?php echo json_encode($minimum_delivery_cost); ?>;
    var prod_id =  <?php echo json_encode($id); ?>;
    var ids = <?php echo json_encode($ids); ?>;
   
    var sum =0.00;
    var valid = 1;
    function myFunction()
    {
        sum =0.00;
        var num = 0;
        
        var no = <?php echo json_encode($size); ?>;
        var price = <?php echo json_encode($p); ?>;
        var tax = <?php echo json_encode($tax); ?>;
        var delivery_charges = <?php echo json_encode($delivery_charges); ?>;
        for (var i=0;i<no;i++)
        {
           
            idchild = 'childinput'+i;
            
            if(pres[i]==1)
            {
              
                n = document.getElementById(idchild).value;
                if(!intRegex.test(n)) {
                valid = 0;
                n = 0; 
                 
                }
                
                sum = sum + n * price[i];
            }
        }
       if(sum == 0.00)
       {
             document.getElementById('inner1').innerHTML = "There are no items in your cart";
             document.getElementById('inner2').innerHTML = "";
             document.getElementById('inner3').innerHTML = "";
             document.getElementById('inner4').innerHTML = "";
             document.getElementById('inner').innerHTML = "";
       }
       else if(valid == 0)
       {
            alert("Invalid charater entered");
       }
       else
       {
        document.getElementById('inner1').innerHTML = "The Total sum without any extra charges is Rs. "+sum;
        document.getElementById('inner2').innerHTML = "Tax Rate applied is "+tax+" %";
        sum = sum + (tax*sum)/100;
        document.getElementById('inner3').innerHTML = "Delivery charges are Rs. "+parseFloat(delivery_charges);
        sum = sum + parseFloat(delivery_charges);
       
        document.getElementById('inner').innerHTML = "The Total Order is Rs. "+sum;
        document.getElementById('inner4').innerHTML = "The minimum Delivery cost is Rs. "+minimum_delivery_cost;
        }
       
    }
    function order_item()
    {
        var prod_id =  <?php echo json_encode($id); ?>;
        var names = <?php echo json_encode($names); ?>;
        var order_quan = <?php echo json_encode($order_quan); ?>;
        var no = <?php echo json_encode($size); ?>;
        var divName = 'dynamicinput';
        for (var i=0;i<no;i++)
        {
            idchild = 'childinput'+i;
            if(parseInt(order_quan[i])!=0)
            {   
                pres[i] = 1;
                //alert(i);
                
                var name = 'od'+prod_id[i];
                var newdiv = document.createElement('div');
                newid = 'childinput'+i;
               // var name = 'od'+prod_id[id];
                newdiv.id = 'child'+i;
                newdiv.innerHTML = names[i]+" <input type='text' id='"+newid+"' value='"+order_quan[i]+"' name='"+name+"' onkeyup='myFunction()'><a href='#h3' class='iadd' onclick='removeElement("+i+")'>-</a><br>";
              document.getElementById(divName).appendChild(newdiv);
            }
        }
    
    }
    

function formSubmit()
{
    if(sum < minimum_delivery_cost)
    {
        alert("The order cannot be placed because minimum delivery cost is Rs. "+minimum_delivery_cost);
    }
    else
    {
        var r=confirm("Do you wish to continue with your order ?");
        
        if (r==true)
        {
            document.getElementById("frm2").submit();
        }
        else
        {
            x="You pressed Cancel!";
        }
        
    }
}



function additem(elem)
{
    
    var names = <?php echo json_encode($names); ?>;
    var no = <?php echo json_encode($size); ?>;
    var id = $(elem).attr("id");
    var lol = document.getElementById('item'+id); 
    for (var i=0;i<no;i++)
    {
        //alert(ids[i]);
        idchild = 'childinput'+i;
        
        if(pres[i]==1)
        {
            ids[i] = document.getElementById(idchild).value;
        }
    }
    ids[id] = parseInt(ids[id]);
    if(!intRegex.test((lol.value))) {
                
                lol.value = 0; 
                 
                }
    
    ids[id] = ids[id] + parseInt(lol.value);
    var name = 'od'+prod_id[id];
    if(parseInt(pres[id])==0)
    {
        var divName = 'dynamicinput';
        //alert("aa gaye");
            var newdiv = document.createElement('div');
            newid = 'childinput'+id;
           // var name = 'od'+prod_id[id];
          newdiv.id = 'child'+id;
          newdiv.innerHTML = names[id]+" <input type='text' id='"+newid+"' value='"+ids[id]+"' name='"+name+"' onkeyup='myFunction()'><a href='#h3' class='iadd' onclick='removeElement("+id+")'>-</a><br>";
          document.getElementById(divName).appendChild(newdiv);
          
          pres[id] = 1;
    }
    else
    {
        newid = 'child'+id;
        idchild = 'childinput'+id;
        document.getElementById(newid).innerHTML = names[id]+ " <input type='text' id='"+idchild+"' value='"+ids[id]+"' name='"+name+"' onkeyup='myFunction()'><a href='#h3' class='iadd' onclick='removeElement("+id+")'>-</a><br>";
        
    }
    myFunction();
   
    
}

function removeElement(childDiv){
    //alert(childDiv);
      if (document.getElementById('child'+childDiv)) {  
        //alert("remoave");
        var parentDiv = 'dynamicinput';
       // alert(parentDiv);
          var child = document.getElementById('child'+childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
          pres[childDiv] = 0;
          ids[childDiv] = 0;
          myFunction();
     }
     else {
          alert("Child div has already been removed or does not exist.");
          return false;
     }
}

function display_category(elem){
    //var ajax_load = "<img src='images/ajax-loader.gif' alt='loading...' />";  
    var id = $(elem).attr("id");
    //$("#first_form").html(ajax_load);
   // alert('sdasd');
    //var ajax_load = "<img src='img/load.gif' alt='loading...' />";  
    $("#first_form").fadeOut(1100);
      $.post(  
            "category.php",  
            {cat_id: id},  
            function(responseText){  
                $("#first_form").html(responseText);  
                $("#first_form").fadeIn(200);
            },
             
            "html"  
        );  
    };  


</script>
<?php
    if(isset($_SESSION['order_id']))
    {
        echo "<script> order_item(); myFunction();</script>";
        
        unset($_SESSION['order_id']);
    }


?>
<br />
<div class="backto" style="clear: both;"><a href="index.php"><image src="images/back.jpg	" alt="back to home" ></a><br>
			</div>

 <footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
</body>
</html>