<?php
session_start();
include 'header1.php';
$authenticated = isset($_SESSION['log']);
if($authenticated)
{
	$customer_id = $_SESSION['cust_id'];
	
//	$customer_id= 1;
	@$db = new mysqli('localhost', 'root', '', 'futurecaptcha');
	if($db->connect_errno!=0)
	{
		echo $db->connect_error ;
		exit;
	}
	else
	{

?>
		<!DOCTYPE html>
		<html>

		<head>
			<meta charset='UTF-8'>
			<!--<link href="src/rateit.css" rel="stylesheet" type="text/css">
			<title>(Better) Round Out Tabs</title>-->
			<script type="text/javascript" src="rating/jquery.js"></script>
			<script type="text/javascript" src="rating/rating.js"></script>
			<link rel="stylesheet" type="text/css" href="rating/rating.css" />
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
			<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>-->
			<style>
        body
        {
            font-family: Tahoma;
            font-size: 12px;
        }
        h1
        {
            font-size: 1.7em;
        }
        h2
        {
            font-size: 1.5em;
        }
        h3
        {
            font-size: 1.2em;
        }
        ul.nostyle
        {
            list-style: none;
        }
        ul.nostyle h3
        {
            margin-left: -20px;
        }
    </style>
    <!-- alternative styles -->
    <!--<link href="content/bigstars.css" rel="stylesheet" type="text/css">
    <link href="content/antenna.css" rel="stylesheet" type="text/css">
     syntax highlighter 
    <link href="sh/shCore.css" rel="stylesheet" type="text/css">
    <link href="sh/shCoreDefault.css" rel="stylesheet" type="text/css">-->
<!--			<script type="text/javascript" src="jquery.min.js"></script>
			<script type="text/javascript" src="parsley.min.js"></script>
	-->		
   
	<!-- You COULD just put both menus in the markup,
	     but if you don't like that, this is how you
	     could dynamically create it with jQuery.  -->
			
			
			
			

            

		</head>

		<body>
		<div id="bg">
			<div id="container"><?php  ?>
				<div id="tabs">
					<nav>
						<ul>
							<li><a href="profile.php" class="active">Profile</a></li>
							<li><a href="editContactInfo.php">Edit Contact Info</a></li>
							<li><a href="placedOrders.php">Placed Orders</a></li>
							<li><a href="favourites.php">Favourites</a></li>
						</ul>
					</nav>	
				</div>
				<div id="ordertable">
				<?php
				$query = "SELECT * FROM `order` WHERE customer_id = '$customer_id'";
				$result = $db->query($query);
				if($result->num_rows<1)
				{
				?>
				<h1> No orders placed yet </h1>
				<?php
				}
				else
				{
					/*$action = isset($_GET['action'])?$_GET['action']:NULL;
					if(($action==NULL) || ($action!='addRemove'))
					{*/
				?>
						<!--<form action="placedOrders.php" data-validate="parsley" method="get">-->
							<table id="cartTable">
								<tr>
									<td class="tableHeader center" class="orderFavourite" style="text-align:center;">
									Favourite
									</td>
									<td class="tableHeader" class="date" style="text-align:center;">
									Date
									</td>
									<td class="tableHeader center" class="restaurant" style="text-align:center;">
									Restaurant
									</td>
									<td class="tableHeader center" class="items" style="text-align:center;">
									Items
									</td>
									<td class="tableHeader center" class="price" style="text-align:center;">
									Price
									</td>
								</tr>
						<?php
								
							$query = "SELECT * FROM `order` WHERE customer_id = '$customer_id'";
							$result = $db->query($query);
							while($row=$result->fetch_assoc())
							{
								$order_id = $row['order_id'];
								$location_id = $row['location_id'];
								$date_time = $row['order_date_time'];
								$price = $row['order_price'];
								$favourite_order = $row['favourite_order'];
						?>	
								<tr>
									<td class="orderFavourite">
									<?php
										if($favourite_order == 1)
										{
									?>
											<!--<div class="rateit" id="<?php echo $order_id; ?>" data-rateit-max="1" data-rateit-value="<?php echo $favourite_order; ?>" data-rateit-step="1" onclick="favourite($(this).attr('id'),$(this).attr('data-rateit-value'))">
											</div>-->
											<div id="<?php echo $order_id; ?>" class="rating"></div>
											<script type="text/javascript">
											$(document).ready(function() {
												var one = <?php echo json_encode($order_id);?>;
												var id = "#" + one;
												$(id).rating('http://localhost/mock_page/placedOrderRemoveFavourite.php', {maxvalue:1, curvalue:1, orderid:one});
											});
											</script>
										<!--	<div>
												<span id="value5"></span><span id="hover5"></span>
											</div>-->
											<!--<a href="#" id="fav" class="active" title="[-] Remove as favorite"></a>-->
									<?php
										}
										elseif($favourite_order == 0)
										{
									?>
											<div id="<?php echo $order_id; ?>" class="rating"></div>
											<script type="text/javascript">
											$(document).ready(function() {
												var one = <?php echo json_encode($order_id);?>;
												var id = "#" + one;
												$(id).rating('http://localhost/mock_page/placedOrderAddFavourite.php', {maxvalue:1, curvalue:0, orderid:one});
											});
											</script>
											<!--<input type="range" min="0" max="2" value="0" step="1" id="backing2">
											<div class="rateit" data-rateit-backingfld="#backing2">
											</div>-->
											<!--<a href="#" id="fav" class="" title="[+] Add as favorite"></a>-->
									<?php
										}
									?>
									<!--<input type="checkbox" name="favOrder[<?php echo $order_id; ?>]" value="<?php echo $favourite_order; ?>" data-group="mygroup" data-mincheck="1" data-error-container="#addErrorContainer">-->
									</td>
									<td  class="date">
									<?php echo "$date_time"; ?>
									</td>
									<td class="restaurant">
									<?php
										$query_restaurant_name = "SELECT * FROM  `business_info` WHERE location_id ='$location_id'";
										$result_restaurant_name = $db->query($query_restaurant_name);//echo "$location_id";
										/*if($result_restaurant_name->num_rows==0)
										{
										echo "yoyo2";
										}*/
										while($row_restaurant_name=$result_restaurant_name->fetch_assoc())
										{
											//echo "yoyo";
											$restaurant_name = $row_restaurant_name['business_name'];
										}
										echo "$restaurant_name";
									?>
									</td>
									<td class="items">
									<?php
										$query_product_no = "SELECT * FROM order_product WHERE order_id='$order_id'";
										$result_product_no = $db->query($query_product_no);
										while($row_product_no=$result_product_no->fetch_assoc())
										{
											$product_id = $row_product_no['product_id'];
											$product_quantity = $row_product_no['product_quantity'];
											$query_item = "SELECT * FROM products WHERE product_id='$product_id'";
											$result_item = $db->query($query_item);
											while($row_item=$result_item->fetch_assoc())
											{
												$product_name = $row_item['product_name'];
												echo "$product_name-";
												echo "$product_quantity ";
											}
										}
									?>
									</td>
									<td class="price">
									<?php echo "$price"; ?>
									</td>
									<td>
									<?php
										//$_SESSION['order_id'] = $order_id;
									?>
									<a href = "#" id="<?php echo $order_id; ?>" onclick="f1($(this).attr('id'))">Order this now</a>
									</td>
								</tr>
						<?php	
							}
								
						?>
							</table>
							<!--<input type="submit" value="Add to/Remove from Favourites">
							<input type="hidden" name="action" value="addRemove">
						</form>-->
					<!--<p style="padding-left:5%;"><a href = "addFavouriteOrder.php">ADD Favourite Order</a></p>-->
				<?php
					//}
					/*elseif($action=='addRemove')
					{
						$favOrder = $_GET['favOrder'];
						foreach($favOrder as $order_no => $isfav)
						{
							if($isfav==0)
							{
								//echo "check";
								$fav = $order_no;
								//var_dump($fav);exit();
								$query = "UPDATE  `futurecaptcha`.`order` SET  `favourite_order` = '1' WHERE  `order`.`order_id` ='$fav'";
								$db->query($query);
							}
							elseif($isfav==1)
							{
								//echo "check";
								$fav = $order_no;
								//var_dump($fav);exit();
								$query = "UPDATE  `futurecaptcha`.`order` SET  `favourite_order` = '0' WHERE  `order`.`order_id` ='$fav'";
								$db->query($query);
							}
						}
						echo "Changes saved successfully<br/>";*/
				?>
						<!--<a href="placedOrders.php">BACK</a>-->
				<?php
					//}
				}
				?>
				
				</div>
			</div>
			<footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
						</div>
			
		</body>
		
		</html>
	
<?php
$db->close();
	}
}
else
{
	echo "Kindly log in to continue<br/>";
}
?>
<html>
<head>
 <!--<script src="sh/shCore.js" type="text/javascript"></script>

    <script src="sh/shBrushJScript.js" type="text/javascript"></script>

    <script src="sh/shBrushXml.js" type="text/javascript"></script>

    <script src="sh/shBrushCss.js" type="text/javascript"></script>

    <script src="sh/shBrushCSharp.js" type="text/javascript"></script>

    <script type="text/javascript">
        SyntaxHighlighter.all()
    </script>
			<script src="src/jquery.rateit.js" type="text/javascript"></script>-->
	
<script type="text/javascript">
	$(document).ready(function(){
	
		$("a#placedRemoveFav").click(function(){
  alert("kjdfhksj");
			var orderid = <?php echo json_encode($order_id);?>;
		//alert(<?php echo json_encode($order_id);?>);
			$.ajax({
				type: "POST",
				url: "placedOrderRemoveFavourite.php",
				data: "orderid="+orderid,
				success: function(html){
				  if(html=='true')
				  {
					$("a#placedRemoveFav").attr('title','[+] Add as favorite');
					$("a#placedRemoveFav").attr('id','placedAddFav');
				  }
				  
				},
			});
			 return false;
		});
		$("a#placedAddFav").click(function(){
  
			var orderid = <?php echo json_encode($order_id);?>;
		//alert(<?php echo json_encode($order_id);?>);
			$.ajax({
				type: "POST",
				url: "placedOrderAddFavourite.php",
				data: "orderid="+orderid,
				success: function(html){
				  if(html=='true')
				  {
					$("a#placedAddFav").attr('title','[-] Remove as favorite');
					$("a#placedAddFav").attr('id','placedRemoveFav');
				  }
				  
				},
			});
			 return false;
		});
	
	});
</script>
<script type="text/javascript">
function f1(x)
{
    var order_i = x;
    alert(order_i);
    var r = confirm("Do you wish to continue with your order ?");
    if (r == true)
    {
        alert('true');
        $.ajax({
				url: 'backend.php', //your server side script
                data: {order_id: order_i}, //our data
				type: 'GET',
				success: function (result) {
				var data = $.parseJSON(result);
				alert(data.error);	
                if(data.error)
                {
                    window.location.href = 'menu.php';	
                }				
                },
													
                });
                
       //window.location = 'menu.php';
    }
    else
    {
        ;
    }
    
    //window.location.href="menu.php";
}
</script>
<script type="text/javascript">
												function favourite(x,y){
												  
												  
												  var favid = "#" + x;
																								
												//$('favid').bind('rated', function (e) {
												//alert(favid);
												//var ri = $(this);

												//if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
												//var value = ri.rateit('value');
												 // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()

												//maybe we want to disable voting?
												//ri.rateit('readonly', true);
												if(y == 0)
												{

												$.ajax({
													url: 'placedOrderAddFavourite.php', //your server side script
													data: { orderid: x}, //our data
													type: 'POST',
													success: function (data) {
													//	$(favid).attr('data-rateit-value','1');
														//alert("kjjdhckjh");//$('#response').append('<li>' + data + '</li>');
														$(favid).rating({maxvalue:1, curvalue:0});

													},
													error: function (jxhr, msg, err) {
													//	$('#response').append('<li style="color:red">' + msg + '</li>');
													}
												});
												}
												else if(y == 1)
												{
												$.ajax({
													//alert("fuy");
													url: 'placedOrderRemoveFavourite.php', //your server side script
													data: { orderid: x}, //our data
													type: 'POST',
													success: function (data) {
														//$(favid).attr('data-rateit-value','0');
														//$('#response').append('<li>' + data + '</li>');
														$(favid).rating({maxvalue:1, curvalue:1});

													},
													error: function (jxhr, msg, err) {
													//	$('#response').append('<li style="color:red">' + msg + '</li>');
													}
												});
												}
											}
											</script>

</head>
</html>
											