<?php
session_start();
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
		
			<title>(Better) Round Out Tabs</title>
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
<!--			<script type="text/javascript" src="jquery.min.js"></script>
			<script type="text/javascript" src="parsley.min.js"></script>
	-->		
			
	
	<!-- You COULD just put both menus in the markup,
	     but if you don't like that, this is how you
	     could dynamically create it with jQuery.  -->
			
			
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

		</head>

		<body>
		<div id="bg">
			<div id="container"><?php include 'header1.php'; ?>
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
				<div id="removeFavouriteOrder">
					<?php
						$action = isset($_GET['action'])?$_GET['action']:NULL;
						if(($action==NULL) || ($action!='removeFavOrder'))
						{
							
					?>	
							<form action="removeFavouriteOrder.php"  data-validate="parsley" method="get">
								<table id="cartTable">
									<tr>
										<td class="check">
										Select
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
									
								$query = "SELECT * FROM `order` WHERE customer_id = '$customer_id' AND favourite_order=1";
								$result = $db->query($query);
								while($row=$result->fetch_assoc())
								{
									$order_id = $row['order_id'];
									$location_id = $row['location_id'];
									$date_time = $row['order_date_time'];
									$price = $row['order_price'];
									$value=1;
							?>	
									<p id="removeErrorContainer"></p>
									<tr>
										<td class="check">
										<input type="checkbox" name="favOrder[<?php echo $order_id; ?>]" value="<?php echo $order_id; ?>" data-group="mygroup2" data-mincheck="1" data-error-container="#removeErrorContainer">
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
										Rs.<?php echo "$price"; ?>
										</td>
									</tr>
							<?php	
								}
							?>
								</table>	
								<input type="submit" value="Save">
								<input type="hidden" name="action" value="removeFavOrder">
							</form>
							
					<?php
						}

						elseif($action=='removeFavOrder')
						{
							$favOrder = $_GET['favOrder'];
							foreach($favOrder as $order_no => $isfav)
							{
								if($isfav>=1)
								{
									//echo "check";
									$fav = $order_no;
									$query = "UPDATE  `futurecaptcha`.`order` SET  `favourite_order` =  '0' WHERE  `order`.`order_id` ='$fav';";
									$db->query($query);
								}
							}
							echo "Changes saved successfully<br/>";
							
					?>
							<a href="favourites.php">BACK</a>
					<?php

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