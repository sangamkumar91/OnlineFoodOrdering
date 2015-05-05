<?php
//$customer_fname = "Anshul";
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
		
			<title>Add address</title>
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
	<!--		<script type="text/javascript" src="jquery.min.js"></script>
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
				<div id="addAddress">
					<?php
						$action = isset($_GET['action'])?$_GET['action']:NULL;
						if(($action==NULL) || ($action!='saveaddress'))
						{
							
					?>	
							<form action="addAddress.php" data-validate="parsley" method="get" style="padding-left:10%;">
								<ul class="customer_contactInfo">
									<li>	
										<ul class="customer_details" id="addBuilding">
											<li class="customer" style="position:relative;bottom:22px;"><?php echo "Address :"; ?></li>
											<li><textarea name="building" data-required="true" data-error-container="#addBuilding"></textarea></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="addStreet">
											<li class="customer"><?php echo "Location :"; ?></li>
											<li><input type="text" name="street" data-required="true" data-error-container="#addStreet"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="addCity">
											<li class="customer"><?php echo "City :"; ?></li>
											<li><select name="city" data-required="true" data-trigger="change" data-error-container="#addCity">
												<option value="Gurgaon">Gurgaon</option>
												<option value="Pune">Pune</option>
												<option value="Bangalore">Bangalore</option>
												<option value="Chennai">Chennai</option>
											</select></li>
											<!--<li><input type="text" name="city" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$"></li>-->
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="addState">
											<li class="customer"><?php echo "State :"; ?></li>
											<li><input type="text" name="state" data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$" data-error-container="#addState" data-error-message="*Required.Must be alphabets only"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="addZipcode">
											<li class="customer"><?php echo "Zipcode :"; ?></li>
											<li><input type="text" name="zipcode" data-required="true" data-trigger="keyup" data-type="alphanum" data-error-container="#addZipcode" data-error-message="*Required.Must be alphanumeric value"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="addCountryCode">
											<li class="customer"><?php echo "Countrycode(not required) :"; ?></li>
											<li><input type="text" name="country" data-trigger="keyup" data-type="alphanum" data-error-container="#addCountryCode"></li>
										</ul>
									</li>
								</ul>
								<input type="submit" value="Add Address">
								<input type="hidden" name="action" value="saveaddress">
								
							</form>
							
					<?php
						}
						elseif($action=='saveaddress')
						{
							$building = $_GET['building'];
							$street = $_GET['street'];
							$city = $_GET['city'];
							$state = $_GET['state'];
							$zipcode = $_GET['zipcode'];
							$country = $_GET['country'];
							//$addressId = $_GET['addressId'];
							$query = "INSERT INTO address (customer_building, customer_street, customer_city, customer_state, customer_zipcode, customer_countrycode)  VALUES('$building','$street','$city','$state','$zipcode','$country')";
							$result = $db->query($query);
							if($db-> affected_rows!=1)
							{
								echo "Some problem occurred";
							}

							else
							{

								$query_findId = "SELECT MAX(address_id) AS maximum FROM `address`";
								$result_findId = $db->query($query_findId);
								while($row_findId = $result_findId->fetch_assoc())
								{
									$maxAddress = $row_findId['maximum'];
									$query_insertId = "INSERT INTO customer_address (customer_id, address_id)  VALUES('$customer_id','$maxAddress')";
									$result_insertId = $db->query($query_insertId);
									echo "Address is successfully added<br/>";
									echo "<a href=\"editContactInfo.php\">BACK</a>";
								}
							}
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