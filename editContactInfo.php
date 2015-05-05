<?php
session_start();
include 'header1.php';
$authenticated = isset($_SESSION['log']);
if($authenticated)
{
	$customer_id = $_SESSION['cust_id'];
	
	//$customer_id= 1;
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
		
			<title>Account Settings</title>
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
<!--			<script type="text/javascript" src="jquery.min.js"></script>
			<script type="text/javascript" src="parsley.min.js"></script>
	-->		
			
	
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
				<div id="contactinfo">
					<?php
						$action = isset($_GET['action'])?$_GET['action']:NULL;
						if(($action==NULL) || (($action!='savepassword') && ($action!='saveaddress')))
						{
							
					?>		
							<form action="editContactInfo.php" data-validate="parsley" method="get" style="padding-left:10%;">
						

								<ul class="customer_contactInfo">
									<li>	
										<ul class="customer_details" id="currentPassword">
											<li class="customer"><?php echo "Current Password :"; ?></li>
											<li><input type="password" name="currentPassword" data-required="true" data-trigger="keyup" data-validation-minlength="1" data-minlength="4" data-type="alphanum" data-error-container="#currentPassword" data-error-message="*Required.Must be minimum 4 characters alphanumeric value"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="newPassword">
											<li class="customer"><?php echo "New Password :"; ?></li>
											<li><input type="password" id="newPasswd" name="newPassword" data-required="true" data-trigger="keyup" data-validation-minlength="1" data-minlength="4" data-type="alphanum" data-error-container="#newPassword" data-error-message="*Required.Must be minimum 4 characters alphanumeric value"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="confirmPassword">
											<li class="customer"><?php echo "Confirm Password :"; ?></li>
											<li><input type="password" name="confirmPassword" data-equalTo="#newPasswd" data-required="true" data-trigger="keyup" data-error-container="#confirmPassword"></li>
										</ul>
									</li>
								</ul>
								<input type="submit" value="Change Password">
								<input type="hidden" name="action" value="savepassword">
							</form>
							<?php
								$query = "SELECT * FROM customer_address WHERE customer_id='$customer_id'";
								$results = $db->query($query);
								while($row = $results->fetch_assoc())
								{
									$address = $row['address_id'];
									$query_2 = "SELECT * FROM address WHERE address_id='$address'";
									$results_2 = $db->query($query_2);
									while($row_2 = $results_2->fetch_assoc())
									{
										$customer_building = $row_2['customer_building'];
										$customer_street = $row_2['customer_street'];
										$customer_city = $row_2['customer_city'];
										$customer_state = $row_2['customer_state'];
										$customer_zipcode = $row_2['customer_zipcode'];
										$customer_addressId = $row_2['address_id'];
									

								
							?>
							
										<form action="editContactInfo.php" data-validate="parsley" method="get" style="padding-left:10%;">
									

											<ul class="customer_contactInfo">
												<li>	
													<ul class="customer_details" id="building<?php echo $customer_addressId; ?>">
														<li class="customer" style="position:relative;bottom:22px;"><?php echo "Address :"; ?></li>
														<li><textarea name="building" data-required="true" data-error-container="#building<?php echo $customer_addressId; ?>"><?php echo "$customer_building"; ?></textarea></li>
													</ul>
												</li>
												<li>
													<ul class="customer_details" id="street<?php echo $customer_addressId; ?>">
														<li class="customer"><?php echo "Location :"; ?></li>
														<li><input type="text" name="street" value='<?php echo "$customer_street"; ?>' data-required="true" data-error-container="#street<?php echo $customer_addressId; ?>"></li>
													</ul>
												</li>
												<li>
													<ul class="customer_details" id="city<?php echo $customer_addressId; ?>">
														<li class="customer"><?php echo "City :"; ?></li>
														<li><select name="city" data-required="true" data-trigger="change" data-error-container="#city<?php echo $customer_addressId; ?>">
															<option value='<?php echo "$customer_city"; ?>'><?php echo "$customer_city"; ?></option>
															<?php
																$cities = array("Gurgaon", "Pune", "Bangalore", "Chennai");
																for($i=1;$i<=4;$i++)
																{
																	if(strcmp($customer_city,$cities[($i-1)])!=0)
																	{
																		$city = $cities[($i-1)];
															?>
																		<option value='<?php echo "$city"; ?>'><?php echo "$city"; ?></option>
															<?php	
																	}
																}
															?>
														</select></li>
														<!--<li><input type="text" name="city" value='<?php //echo "$customer_city"; ?>' data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$"></li>-->
													</ul>
												</li><li>
													<ul class="customer_details" id="state<?php echo $customer_addressId; ?>">
														<li class="customer"><?php echo "State :"; ?></li>
														<li><input type="text" name="state" value='<?php echo "$customer_state"; ?>' data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]+$" data-error-container="#state<?php echo $customer_addressId; ?>" data-error-message="*Required.Must be alphabets only"></li>
													</ul>
												</li>
												<li>
													<ul class="customer_details" id="zipcode<?php echo $customer_addressId; ?>">
														<li class="customer"><?php echo "Zipcode :"; ?></li>
														<li><input type="text" name="zipcode" value='<?php echo "$customer_zipcode"; ?>' data-required="true" data-trigger="keyup" data-type="alphanum" data-error-container="#zipcode<?php echo $customer_addressId; ?>" data-error-message="*Required.Must be alphanumeric value"></li>
													</ul>
												</li>
											</ul>
											<input type="submit" value="Edit Address">
											<!--<input type="submit" value="Remove Address">-->
											<input type="hidden" name="action" value="saveaddress">
											<input type="hidden" name="addressId" value="<?php echo "$customer_addressId"; ?>">
										</form>
										
							<?php
									}
								}
							?>
							<p style="padding-left:10%;"><a href="addAddress.php">+ADD ADDRESS</a></p>
							
					<?php
						}

						elseif($action=='savepassword')
						{
							
							$current_password = filter_input(INPUT_GET,'currentPassword',FILTER_SANITIZE_STRING);
							$new_password = filter_input(INPUT_GET,'newPassword',FILTER_SANITIZE_STRING);
							$confirm_password = filter_input(INPUT_GET,'confirmPassword',FILTER_SANITIZE_STRING);
							if(isset($current_password) && !empty($current_password) AND isset($new_password) && !empty($new_password) AND isset($confirm_password) && !empty($confirm_password))
							{
								$current_password = mysql_real_escape_string($current_password);
								$new_password = mysql_real_escape_string($new_password);
								$confirm_password = mysql_real_escape_string($confirm_password);
								$query = "SELECT customer_password FROM customers WHERE customer_id='$customer_id'";
								$results = $db->query($query);
								$row = $results->fetch_assoc();
								$current_password = md5($current_password);
								if($row['customer_password']!=$current_password)
								{
									echo "You have entered wrong current password.<br/>";
									echo "<a href=\"editContactInfo.php\">Click here</a>"." to go back and enter again";
								}
								else
								{
									if($new_password!=$confirm_password)
									{
										echo "New Password is not confirmed.<br/>";
										echo "Kindly ";
										echo "<a href=\"editContactInfo.php\">Click here</a>"." to go back and enter again";
									}
									else
									{
										$new_password = md5($new_password);
										$query = "UPDATE customers SET customer_password='$new_password' WHERE customer_id='$customer_id'";
										$db->query($query);
										echo "Changes saved successfully<br/>";
										echo "<a href=\"editContactInfo.php\">BACK</a>";
									}
								}
							}
							else
							{
								echo "One or more field is empty. Please ";
								echo "<a href=\"editContactInfo.php\">Click here</a>"." to enter again";
								echo "<br/>";
							}
						}
						elseif($action=='saveaddress')
						{
							$building = filter_input(INPUT_GET,'building',FILTER_SANITIZE_STRING);
							$street = filter_input(INPUT_GET,'street',FILTER_SANITIZE_STRING);
							$city = filter_input(INPUT_GET,'city',FILTER_SANITIZE_STRING);
							$state = filter_input(INPUT_GET,'state',FILTER_SANITIZE_STRING);
							$zipcode = filter_input(INPUT_GET,'zipcode',FILTER_SANITIZE_NUMBER_INT);
							if(isset($building) && !empty($building) AND isset($street) && !empty($street) AND isset($city) && !empty($city) AND isset($state) && !empty($state) AND isset($zipcode) && !empty($zipcode))
							{
								$addressId = $_GET['addressId'];
								$building = mysql_real_escape_string($building);
								$city = mysql_real_escape_string($city);
								$state = mysql_real_escape_string($state);
								$zipcode = mysql_real_escape_string($zipcode);
								$query = "UPDATE address SET customer_building='$building', customer_street='$street', customer_city='$city', customer_state='$state', customer_zipcode='$zipcode'
								WHERE address_id='$addressId'";
								$db->query($query);
								echo "Changes saved successfully<br/>";
								echo "<a href=\"editContactInfo.php\">BACK</a>";
							}
							else
							{
								echo "One or more field is empty. Please ";
								echo "<a href=\"editContactInfo.php\">Click here</a>"." to enter again";
								echo "<br/>";
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