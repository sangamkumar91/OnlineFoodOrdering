<?php
//$customer_fname = "Anshul";
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
		
			<title>Meal Gaadi</title>
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
	
	
	<!-- You COULD just put both menus in the markup,
	     but if you don't like that, this is how you
	     could dynamically create it with jQuery.  -->
			
			
			

		</head>

		<body>
		<div id="bg">
			<div id="container">
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
				<div id="favOrders">
					<h style="font-size:24px;padding:5%;"> Favourite Orders </h>
					<table id="cartTable" style="margin-top:1%;">
						<tr>
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
						
					$query = "SELECT * FROM `order` WHERE customer_id = '$customer_id' AND favourite_order = 1";
					$result = $db->query($query);
					while($row=$result->fetch_assoc())
					{
						$order_id = $row['order_id'];
						$location_id = $row['location_id'];
						$date_time = $row['order_date_time'];
						$price = $row['order_price'];
				?>	
						<tr>
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
							<a href = "#" id="<?php echo $order_id; ?>" onclick="f2($(this).attr('id'))">Order this now</a>
							</td>
						</tr>
				<?php	
					}
						
				?>
					</table>
					<!--<p style="padding-left:5%;"><a href = "addFavouriteOrder.php">ADD Favourite Order</a></p>
					<p style="padding-left:5%;"><a href = "removeFavouriteOrder.php">Remove Favourite Order</a></p>-->
					
				
				</div>
				<div id="favRestaurants">
					<h> Favourite Restaurants </h>
				<?php
					$query = "SELECT * FROM customer_favourite_restaurants WHERE customer_id='$customer_id'";
					$result = $db->query($query);
					while($row = $result->fetch_assoc())
					{
						$location_id = $row['location_id'];
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
						echo "<br/>$restaurant_name<br/>";
					}
				?>
					<a href = "addFavouriteRestaurant.php">ADD Favourite Restaurant</a>
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
		<html>
		<head>
		<script>
			 // DOM ready
			 $(function() {
			   
			  // Create the dropdown base
			  $("<select />").appendTo("nav");
			  
			  // Create default option "Go to..."
			  $("<option />", {
				 "selected": "selected",
				 "value"   : "",
				 "text"    : "Go to..."
			  }).appendTo("nav select");
			  
			  // Populate dropdown with menu items
			  $("nav a").each(function() {
			   var el = $(this);
			   $("<option />", {
				   "value"   : el.attr("href"),
				   "text"    : el.text()
			   }).appendTo("nav select");
			  });
			  
			   // To make dropdown actually work
			   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
			  $("nav select").change(function() {
				window.location = $(this).find("option:selected").val();
			  });
			 
			 });
			</script>
<script type="text/javascript">
function f2(x)
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
}
</script>
		</head>
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